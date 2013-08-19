<?php

/**
 * This is the model class for table "{{offerdelivery}}".
 *
 * The followings are the available columns in table '{{offerdelivery}}':
 * @property integer $id
 * @property integer $idOffer
 * @property string $Name
 * @property string $Instruction
 * @property double $Price
 * @property double $FreeIf
 * @property string $Type
 * @property integer $Active
 */
class OfferDelivery extends CActiveRecord
{
    	public function behaviors() {
	    return array(
	    'cached'=>array(
		'class'=>'application.components.CachedBehavior',

	    ),
	);
	}
	public $payments;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OfferDelivery the static model class
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
		return '{{offerdelivery}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idOffer, Name, Instruction, Price', 'required'),
			array('payments','safe'),
			array('idOffer,id,Active,Type', 'numerical', 'integerOnly'=>true),
			array('Price, FreeIf', 'numerical'),
			array('Name', 'length', 'max'=>100),
			
			array('id, idOffer, Name, Instruction, Price, FreeIf', 'safe', 'on'=>'search'),
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
		    'payment'=>array(self::HAS_MANY,'DeliveryPayment','idOfferDelivery'),
		    //'payment_api'=>array(self::HAS_MANY,'DeliveryPayment','idOfferDelivery','on'=>'payment_api.Status=1'),
		    'payment_api'=>array(self::MANY_MANY,'OfferPayment','{{deliverypayment}}(idOfferDelivery,idOfferPayment)','on'=>'payment_api_payment_api.Status=1'),
		);
	}
	public function setPayments(){
	    if(!empty($this->payment))
	    foreach ($this->payment as $value)
	    {if($value->Status)
		$this->payments[] = $value->idOfferPayment;
	    }
	}
//	protected function afterFind() {
//	    
//	    return parent::afterFind();
//	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idOffer' => 'Id Offer',
			'Name' => 'Название',
			'Instruction' => 'Краткое описание',
			'Price' => 'Стоимость доставки, руб.',
			'FreeIf' => 'Бесплатно если сумма больше, руб.',
			'payments'=>'Доступные способы оплаты',
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
		$criteria->compare('idOffer',$this->idOffer);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Instruction',$this->Instruction,true);
		$criteria->compare('Price',$this->Price);
		$criteria->compare('FreeIf',$this->FreeIf);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}