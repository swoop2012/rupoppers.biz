<?php

/**
 * This is the model class for table "{{subproduct}}".
 *
 * The followings are the available columns in table '{{subproduct}}':
 * @property integer $id
 * @property integer $idProduct
 * @property string $Name
 * @property integer $Count
 * @property string $Measure
 * @property string $Size
 * @property string $Property
 * @property double $Price
 * @property integer $Avaible
 * @property integer $Position
 */
class SubProduct extends CActiveRecord
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
	 * @return SubProduct the static model class
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
		return '{{subproduct}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Avaible,idProduct, Count, Position,id', 'numerical', 'integerOnly'=>true),
			array('Price', 'numerical'),
			array('Name, Property', 'length', 'max'=>100),
			array('Measure, Size', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idProduct, Name, Count, Measure, Size, Property, Price, Avaible, Position', 'safe', 'on'=>'search'),
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
            'product'=>array(self::BELONGS_TO,'Product','idProduct','select'=>'UpPrice'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idProduct' => 'Id Product',
			'Name' => 'Наименование',
			'Count' => 'Кол-во',
			'Measure' => 'Чего',
			'Size' => 'Размер',
			'Property' => 'Свойство',
			'Price' => 'Цена',
			'Avaible' => 'Наличие',
			'Position' => 'Позиция',
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
		$criteria->compare('idProduct',$this->idProduct,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Count',$this->Count,true);
		$criteria->compare('Measure',$this->Measure,true);
		$criteria->compare('Size',$this->Size,true);
		$criteria->compare('Property',$this->Property,true);
		$criteria->compare('Price',$this->Price);
		$criteria->compare('Avaible',$this->Avaible);
		$criteria->compare('Position',$this->Position,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}