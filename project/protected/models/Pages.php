<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $id_page
 * @property string $title
 * @property string $body
 * @property string $navigation
 * @property integer $language
 * @property integer $original
 * @property integer $editable
 * @property string $date
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Menus[] $menuses
 * @property Languages $language0
 * @property Pages $original0
 * @property Pages[] $pages
 * @property Galleries[] $galleries
 */
class Pages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, body, navigation, language', 'required'),
			array('language, original, editable, status', 'numerical', 'integerOnly'=>true),
			array('title, navigation', 'length', 'max'=>255),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_page, title, body, navigation, language, original, editable, date, status', 'safe', 'on'=>'search'),
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
			'menuses' => array(self::MANY_MANY, 'Menus', 'menus_has_pages(pages_id_page, menu)'),
			'language0' => array(self::BELONGS_TO, 'Languages', 'language'),
			'original0' => array(self::BELONGS_TO, 'Pages', 'original'),
			'pages' => array(self::HAS_MANY, 'Pages', 'original'),
			'galleries' => array(self::MANY_MANY, 'Galleries', 'pages_has_galleries(page, gallery)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_page' => 'Id Page',
			'title' => 'Title',
			'body' => 'Body',
			'navigation' => 'Navigation',
			'language' => 'Language',
			'original' => 'Original',
			'editable' => 'Editable',
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

		$criteria->compare('id_page',$this->id_page);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('navigation',$this->navigation,true);
		$criteria->compare('language',$this->language);
		$criteria->compare('original',$this->original);
		$criteria->compare('editable',$this->editable);
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
	 * @return Pages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
