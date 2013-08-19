<?php

/**
 * This is the model class for table "{{offerbonus}}".
 *
 * The followings are the available columns in table '{{offerbonus}}':
 * @property string $id
 * @property string $idOffer
 * @property double $ConditionSum
 * @property string $Bonus
 */
class OfferBonus extends CActiveRecord
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
	 * @return OfferBonus the static model class
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
		return '{{offerbonus}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idOffer', 'required'),
			array('ConditionSum', 'numerical'),
			array('idOffer', 'length', 'max'=>11),
			array('Bonus', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idOffer, ConditionSum, Bonus', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idOffer' => 'Id Offer',
			'ConditionSum' => 'Condition Sum',
			'Bonus' => 'Bonus',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('idOffer',$this->idOffer,true);
		$criteria->compare('ConditionSum',$this->ConditionSum);
		$criteria->compare('Bonus',$this->Bonus,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}