<?php

/**
 * This is the model class for table "menu_items".
 *
 * The followings are the available columns in table 'menu_items':
 * @property integer $id_item
 * @property string $name
 * @property integer $menu
 * @property integer $node
 * @property integer $page
 *
 * The followings are the available model relations:
 * @property MenuItems $node0
 * @property MenuItems[] $menuItems
 * @property Menus $menu0
 * @property Pages $page0
 */
class MenuItems extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu', 'required'),
			array('menu, node, page', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_item, name, menu, node, page', 'safe', 'on'=>'search'),
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
			'node0' => array(self::BELONGS_TO, 'MenuItems', 'node'),
			'menuItems' => array(self::HAS_MANY, 'MenuItems', 'node'),
			'menu0' => array(self::BELONGS_TO, 'Menus', 'menu'),
			'page0' => array(self::BELONGS_TO, 'Pages', 'page'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_item' => 'Id Item',
			'name' => 'Name',
			'menu' => 'Menu',
			'node' => 'Node',
			'page' => 'Page',
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

		$criteria->compare('id_item',$this->id_item);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('menu',$this->menu);
		$criteria->compare('node',$this->node);
		$criteria->compare('page',$this->page);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MenuItems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
