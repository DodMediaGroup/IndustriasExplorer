<?php

/**
 * This is the model class for table "work_orders".
 *
 * The followings are the available columns in table 'work_orders':
 * @property integer $id_order
 * @property integer $number
 * @property string $title
 * @property integer $client
 * @property string $description
 * @property integer $order_status
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Reports[] $reports
 * @property Clients $client0
 * @property OrdersStatus $orderStatus
 */
class WorkOrders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'work_orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, title, client, description, order_status', 'required'),
			array('number, client, order_status, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_order, number, title, client, description, order_status, status', 'safe', 'on'=>'search'),
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
			'reports' => array(self::HAS_MANY, 'Reports', 'work_order'),
			'client0' => array(self::BELONGS_TO, 'Clients', 'client'),
			'orderStatus' => array(self::BELONGS_TO, 'OrdersStatus', 'order_status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_order' => 'Id Order',
			'number' => 'Number',
			'title' => 'Title',
			'client' => 'Client',
			'description' => 'Description',
			'order_status' => 'Order Status',
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

		$criteria->compare('id_order',$this->id_order);
		$criteria->compare('number',$this->number);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('client',$this->client);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('order_status',$this->order_status);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WorkOrders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
