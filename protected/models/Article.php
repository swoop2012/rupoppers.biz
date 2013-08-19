<?php

/**
 * This is the model class for table "{{article}}".
 *
 * The followings are the available columns in table '{{article}}':
 * @property integer $id
 * @property string $URL
 * @property string $Name
 * @property string $Text
 * @property string $Title
 * @property string $Keywords
 * @property string $Description
 */
class Article extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
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
		return '{{article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('URL','required'),
			array('URL, Name', 'length', 'max'=>100),
            array('Keywords,Description, Title', 'length', 'max'=>255),
			array('Text', 'safe'),
            array('URL','unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, URL, Title, Text', 'safe', 'on'=>'search'),
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
			'URL' => 'Url',
			'Name' => 'Название статьи',
			'Text' => 'Text',
            'Title' => 'Title',
            'Keywords' => 'Keywords',
            'Description' => 'Description',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('URL',$this->URL,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Text',$this->Text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}