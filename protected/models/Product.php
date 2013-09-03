<?php

/**
 * This is the model class for table "{{product}}".
 *
 * The followings are the available columns in table '{{product}}':
 * @property integer $id
 * @property integer $idOffer
 * @property string $Name
 * @property string $ShortName
 * @property string $PictureMain
 * @property string $PictureProduct1
 * @property string $PictureProduct2
 * @property string $PictureProduct3
 * @property integer $Position
 * @property string $ShortDescription
 * @property string $MiddleDescription
 * @property string $URL
 * @property string $Description
 * @property string $Keywords
 * @property integer $Active
 * @property integer $UpPrice
 * @property string $Article
 * @property string $ShortDescriptionMain
 * @property string $Title
 * @property string $DontChangeImages
 * @property string $DontChangeDescriptions
 * @property integer $DefaultPosition
 */
class Product extends CActiveRecord
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
	 * @return Product the static model class
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
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name,URL', 'required'),
			array('idOffer,Active,UpPrice,id,Position,DontChangeImages,DontChangeDescriptions,DefaultPosition', 'numerical', 'integerOnly'=>true),
			array('Name, ShortName, PictureMain, PictureProduct1, PictureProduct2, PictureProduct3', 'length', 'max'=>100),
			array('ShortDescription,MiddleDescription,Article','safe'),
			array('URL','length', 'max'=>100),
            array('URL','unique'),
            array('Title','length', 'max'=>255),
			array('Description,Keywords,ShortDescriptionMain','length', 'max'=>400),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idOffer, Name, ShortDescription, PictureMain, PictureProduct1, PictureProduct2, PictureProduct3, Position', 'safe', 'on'=>'search'),
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
		    'subproduct'=>array(self::HAS_MANY,'SubProduct','idProduct','order'=>'subproduct.Position','on'=>'subproduct.Avaible=1'),
		    'one_subproduct'=>array(self::HAS_MANY,'SubProduct','idProduct','order'=>'one_subproduct.Position DESC','limit'=>1),
		);
	}
	protected function beforeDelete() {
	    SubProduct::model()->deleteAllByAttributes(array('idProduct'=>$this->id));
	    return parent::beforeDelete();
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idOffer' => 'Id Offer',
			'Name' => 'Наименование',
			'ShortName' => 'Сокращенно для главной страницы',
			'PictureMain' => 'Для главной',
			'PictureProduct1' => 'На странице товара 1',
			'PictureProduct2' => 'На странице товара 2',
			'PictureProduct3' => 'На странице товара 3',
			'Position' => 'Позиция',
			'ShortDescription'=>'Краткое описание',
            'ShortDescriptionMain'=>'Краткое описание для главной',
			'MiddleDescription'=>'Среднее описание',	
			'Article'=>'Статья',	
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
		$criteria->compare('ShortDescription',$this->ShortDescription,true);
		$criteria->compare('PictureMain',$this->PictureMain,true);
		$criteria->compare('PictureProduct1',$this->PictureProduct1,true);
		$criteria->compare('PictureProduct2',$this->PictureProduct2,true);
		$criteria->compare('PictureProduct3',$this->PictureProduct3,true);
		$criteria->compare('Position',$this->Position,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}