<?php
class DateConversionBehavior extends CActiveRecordBehavior
{
    public $field;
	public function afterFind($event)
        {
        $this->owner->{$this->field} = DateChange::ChangeDate( $this->owner->{$this->field},1);
        }
        public function beforeSave($event) {
	
        $this->owner->{$this->field} = DateChange::ReverseDate( $this->owner->{$this->field});
        }
	public function afterSave($event) {
	
        $this->owner->{$this->field} = DateChange::ChangeDate( $this->owner->{$this->field},1);
        }

	
}
?>
