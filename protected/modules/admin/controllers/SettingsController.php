<?php

class SettingsController extends CrudController
{
       function init() {
	  parent::init("settings");    
       $this->setModel('Settings');
       
    }
    public function actionTestCache(){
        $models = GetArray::getCache('settings');
        if(!empty($models))
            foreach($models as $value)
                VarDumper::dump($value);
    }
    public function actionClearCache(){
        Yii::app()->cache->flush();
        $this->cleanDir(Yii::app()->getRuntimePath());
        echo CJSON::encode(array('success'=>1));
        exit;
    }

    private function cleanDir($dir)
    {
        $di = new DirectoryIterator ($dir);
        foreach($di as $d)
        {
            if(!$d->isDot())
            {
                $this->removeDirRecursive($d->getPathname());
            }
        }
    }
    private function removeDirRecursive($dir)
    {
        $files = glob($dir.'*', GLOB_MARK);
        foreach ($files as $file)
        {
            if (is_dir($file))
                $this->removeDirRecursive($file);
        else
        unlink($file);
        }
        if (is_dir($dir))
            rmdir($dir);
    }
}
