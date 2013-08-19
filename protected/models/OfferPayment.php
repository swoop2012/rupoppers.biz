<?php

/**
 * This is the model class for table "{{offerpayment}}".
 *
 * The followings are the available columns in table '{{offerpayment}}':
 * @property integer $id
 * @property integer $idOffer
 * @property string $Name
 * @property string $ShortDescription
 * @property string $Description
 */
class OfferPayment extends CActiveRecord
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
	 * @return OfferPayment the static model class
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
		return '{{offerpayment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idOffer, Name, Description,ShortDescription', 'required'),
			array('idOffer,id', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idOffer, Name, Description', 'safe', 'on'=>'search'),
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
			'Name' => 'Название',
			'Description' => 'Инструкция по оплате',
            'ShortDescription'=>'Краткое описание',
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}