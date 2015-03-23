<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id_new
 * @property string $title
 * @property string $new
 * @property string $image
 * @property integer $language
 * @property integer $original
 * @property string $date
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Languages $language0
 * @property News $original0
 * @property News[] $news
 */
class News extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, new, language, date', 'required'),
			array('language, original, status', 'numerical', 'integerOnly'=>true),
			array('title, image', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_new, title, new, image, language, original, date, status', 'safe', 'on'=>'search'),
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
			'original0' => array(self::BELONGS_TO, 'News', 'original'),
			'news' => array(self::HAS_MANY, 'News', 'original'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_new' => 'Id New',
			'title' => 'Title',
			'new' => 'New',
			'image' => 'Image',
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

		$criteria->compare('id_new',$this->id_new);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('new',$this->new,true);
		$criteria->compare('image',$this->image,true);
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
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
