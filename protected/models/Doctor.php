<?php

/**
 * This is the model class for table "tbl_doctor".
 *
 * The followings are the available columns in table 'tbl_doctor':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $description
 * @property integer $province
 * @property string $laititude
 * @property string $longitude
 */
class Doctor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_doctor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('province', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('laititude, longitude', 'length', 'max'=>200),
			array('address, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, address, description, province, laititude, longitude', 'safe', 'on'=>'search'),
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
			'address' => 'Address',
			'description' => 'Description',
			'province' => 'Province',
			'laititude' => 'Laititude',
			'longitude' => 'Longitude',
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('laititude',$this->laititude,true);
		$criteria->compare('longitude',$this->longitude,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Doctor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
