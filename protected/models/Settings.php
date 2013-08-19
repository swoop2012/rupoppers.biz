<?php

/**
 * This is the model class for table "{{settings}}".
 *
 * The followings are the available columns in table '{{settings}}':
 * @property string $Attribute
 * @property string $Description
 * @property string $Value
 */
class Settings extends CActiveRecord
{
	public function behaviors() {
	    return array(
	    'cached'=>array(
		'class'=>'application.components.CachedBehavior',
		
	    ),
	);
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Settings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{settings}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Attribute, Value', 'required'),
			array('Attribute', 'length', 'max'=>30),
			array('Description', 'length', 'max'=>100),
			array('Value', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Attribute, Description, Value', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

    public function afterSave(){
        if($this->Attribute=='Key'){
            $result = Curl::getContent($this->getValue('MainDomain').'/api/validateKey?key='.$this->Value);
            $decoded = CJSON::decode($result);
            if(isset($decoded['success'])&&$decoded['success'])
                $this->setValue('ValidateKey',1);
            else
                $this->setValue('ValidateKey',0);
        }
        return parent::afterSave();
    }

    public static function getValue($attr) {
        $item = Settings::model()->findByAttributes(array('Attribute' => $attr));
        return $item ? $item->Value : '';
    }

    public static function setValue($attr, $value) {
        $item = Settings::model()->findByAttributes(array('Attribute' => $attr));
        if (empty($item)) {
            $item = new Settings();
            $item->Attribute = $attr;
        }
        $item->Value = $value;
        $item->save();
    }
        /**
	 * @return array customized attribute labels (name=>label)
	 */


	public function attributeLabels()
	{
		return array(
			'Attribute' => 'Название',
			'Description' => 'Описание',
			'Value' => 'Значение',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->addCondition('Attribute NOT IN("Phones","idWebmaster","Type","ValidateKey")');
		$criteria->compare('Attribute',$this->Attribute,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Value',$this->Value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}