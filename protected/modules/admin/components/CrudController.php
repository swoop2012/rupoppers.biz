<?php

/**
 * CRUD controller for any model
 * 
 * $_model The model
 */
class CrudController extends AdminController {

    /**
     * Model name
     */
    protected $_model;

    /**
     * Flag "show all for admin"
     */
    protected $_showAll = true;

    public function setModel($model) {
        $this->_model = $model;
    }

    public function getModel() {
        return $this->_model;
    }
    /**
     * Manages all models.
     */
    public function actionIndex() {
        if (isset($_POST["action"])) {
            $this->_action($_POST["action"], $_POST["Models"]);
        } else if (isset($_GET["action"])) {
            $this->_action($_GET["action"], $_GET["Models"]);
        }

        // PHP 5.2 compatibility
        eval('$model = new ' . $this->_model . '("search");');
        //$model = new $this->_model('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET[$this->_model]))
            $model->attributes = $_GET[$this->_model];
	
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model (JUI).
     */
    public function actionCreate() {
        $controller = $this;
        eval('$model = new ' . $this->_model . '();');
        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
        if (isset($_POST[$this->_model])) {
            if ($this->_createModel($model, $_POST[$this->_model])) {
                
                echo CJSON::encode(array(
                    'status' => 'success',
                    'content' => Yii::t('main', 'ITEM_CREATED'),
                ));
                exit;
            } else {
            }
        }
        echo CJSON::encode(array(
            'status' => 'failure',
            'content' => $controller->renderPartial("_form", array(
                'model' => $model), true, true),
        ));
    }

    public function actionUpdate($id) {
        $controller = $this;
        $model = $this->loadModel($id);
        $this->performAjaxValidation($model);
        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
        if (isset($_POST[$this->_model])) {
            if ($this->_updateModel($model, $_POST[$this->_model])) {
                
                echo CJSON::encode(array(
                    'status' => 'success',
                    'content' => Yii::t('main', 'ITEM_UPDATED'),
                ));
                exit;
            }
        }
        echo CJSON::encode(array(
            'status' => 'failure',
            'content' => $controller->renderPartial('_form', array(
                'model' => $model), true, true),
        ));
    }

    public function actionDelete($id) {

        $model = $this->loadModel($id);
        $this->_deleteModel($model);

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    public function loadModel($id) {
        $className = $this->_model;
        eval('$model = ' . $className . '::model()->findByPk($id);');
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'model-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function _createModel(&$model, $attrs) {
        $model->attributes = $attrs;
        if ($model->hasAttribute('user_id')) {
            $model->user_id = Yii::app()->user->id;
        }
        return $model->save();
    }
    protected function _updateModel(&$model, $attrs) {
        // Не даем редактировать чужие объекты
        $user = Yii::app()->user;
        $model->attributes = $_POST[$this->_model];
        // Не меняем user_id, кому принадлежит, если админ редактирует чужой элемент
        if ($model->hasAttribute('user_id')) {
            if (!UserModule::isAdmin() || $model->user_id == 0) {
                $model->user_id = Yii::app()->user->id;
            }
        }

        return $model->save();
    }

    protected function _deleteModel($model) {
        if (Yii::app()->user->checkAccess('Administrator')) {
            $model->delete();
        }
    }

    protected function _action($action, $modelIds) {
        if (!is_array($modelIds)) {
            return;
        }
        $className = $this->_model;
        $condition = "(0";
        foreach ($modelIds as $id) {
            $condition .= " OR id=" . (int) $id;
        }
        $condition .= ")";
        eval('$hasUserId = ' . $className . '::model()->hasAttribute("user_id");');
        if (!UserModule::isAdmin() && $hasUserId) {
            $condition .= " AND user_id=" . (int) Yii::app()->user->id;
        }
        switch ($action) {
            case "delete":
                eval('$query = "DELETE FROM " . ' . $className . '::model()->tableName();');
                break;
            default:
                return;
        }
        $query .= " WHERE " . $condition;
        Yii::app()->db->createCommand($query)->execute();
    }

}
