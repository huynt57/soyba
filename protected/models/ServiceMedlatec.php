<?php

/**
 * This is the model class for table "tbl_service_medlatec".
 *
 * The followings are the available columns in table 'tbl_service_medlatec':
 * @property integer $id
 * @property string $service_name
 * @property string $service_price
 * @property string $favorable
 * @property string $description
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $service_price_after
 * @property string $relative_favorable
 * @property string $absolute_favorable
 * @property string $condition
 * @property integer $provider_id
 */
class ServiceMedlatec extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_service_medlatec';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, created_at, updated_at, provider_id', 'numerical', 'integerOnly'=>true),
			array('service_name, service_price, favorable, description, service_price_after, relative_favorable, absolute_favorable, condition', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_name, service_price, favorable, description, status, created_at, updated_at, service_price_after, relative_favorable, absolute_favorable, condition, provider_id', 'safe', 'on'=>'search'),
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
			'service_name' => 'Service Name',
			'service_price' => 'Service Price',
			'favorable' => 'Favorable',
			'description' => 'Description',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'service_price_after' => 'Service Price After',
			'relative_favorable' => 'Relative Favorable',
			'absolute_favorable' => 'Absolute Favorable',
			'condition' => 'Condition',
			'provider_id' => 'Provider',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('service_price',$this->service_price,true);
		$criteria->compare('favorable',$this->favorable,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('updated_at',$this->updated_at);
		$criteria->compare('service_price_after',$this->service_price_after,true);
		$criteria->compare('relative_favorable',$this->relative_favorable,true);
		$criteria->compare('absolute_favorable',$this->absolute_favorable,true);
		$criteria->compare('condition',$this->condition,true);
		$criteria->compare('provider_id',$this->provider_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceMedlatec the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
