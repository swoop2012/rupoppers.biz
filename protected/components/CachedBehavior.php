<?php
class CachedBehavior extends CActiveRecordBehavior
{
        public function afterSave($event)
        {
                $this->updateCacheDependencies();       
        }
        public function afterUpdate($event)
        {
                $this->updateCacheDependencies();       
        }

        public function afterDelete($event)
        {
                $this->updateCacheDependencies();
        }
        public function updateCacheDependencies()
        {
                $cacheUpdates = array();
                $cacheUpdates[] = 'Cache.'.strtolower(get_class($this->owner));
                $relations = $this->owner->relations();
                foreach($relations as $relation)
                        $cacheUpdates[] = 'Cache.'.strtolower($relation[1]);

                foreach($cacheUpdates as $cacheUpdate)
                {
                        Yii::app()->setGlobalState($cacheUpdate, time());
                        Yii::app()->saveGlobalState();
                }
        }
}