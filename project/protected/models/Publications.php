<?php

/**
 * This is the model class for table "publications".
 *
 * The followings are the available columns in table 'publications':
 * @property integer $id_publication
 * @property string $title
 * @property string $description
 * @property string $file
 * @property integer $language
 * @property integer $original
 * @property string $date
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Languages $language0
 * @property Publications $original0
 * @property Publications[] $publications
 */
class Publications extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'publications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, language, date', 'required'),
			array('language, original, status', 'numerical', 'integerOnly'=>true),
			array('title, file', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_publication, title, description, file, language, original, date, status', 'safe', 'on'=>'search'),
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
			'language0' => array(self::BELONGS_TO, 'Languages', 'language'),
			'original0' => array(self::BELONGS_TO, 'Publications', 'original'),
			'publications' => array(self::HAS_MANY, 'Publications', 'original'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_publication' => 'Id Publication',
			'title' => 'Title',
			'description' => 'Description',
			'file' => 'File',
			'language' => 'Language',
			'original' => 'Original',
			'date' => 'Date',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_publication',$this->id_publication);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('language',$this->language);
		$criteria->compare('original',$this->original);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Publications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
