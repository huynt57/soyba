<?php

/**
 * This is the model class for table "tbl_provider_order".
 *
 * The followings are the available columns in table 'tbl_provider_order':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property integer $status
 * @property integer $active
 * @property integer $service_id
 * @property integer $user_meboo
 * @property string $requirement
 * @property integer $ward
 * @property integer $province
 * @property integer $district
 * @property integer $created_at
 * @property integer $time_confirm
 * @property integer $time_meet
 */
class ProviderOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_provider_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, active, service_id, user_meboo, ward, province, district, created_at, time_confirm, time_meet', 'numerical', 'integerOnly'=>true),
			array('name, phone, email, address', 'length', 'max'=>255),
			array('requirement', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, phone, email, address, status, active, service_id, user_meboo, requirement, ward, province, district, created_at, time_confirm, time_meet', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'phone' => 'Phone',
			'email' => 'Email',
			'address' => 'Address',
			'status' => 'Status',
			'active' => 'Active',
			'service_id' => 'Service',
			'user_meboo' => 'User Meboo',
			'requirement' => 'Requirement',
			'ward' => 'Ward',
			'province' => 'Province',
			'district' => 'District',
			'created_at' => 'Created At',
			'time_confirm' => 'Time Confirm',
			'time_meet' => 'Time Meet',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('active',$this->active);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('user_meboo',$this->user_meboo);
		$criteria->compare('requirement',$this->requirement,true);
		$criteria->compare('ward',$this->ward);
		$criteria->compare('province',$this->province);
		$criteria->compare('district',$this->district);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('time_confirm',$this->time_confirm);
		$criteria->compare('time_meet',$this->time_meet);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProviderOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
