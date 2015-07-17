<?php

/**
 * This is the model class for table "tbl_patient_injection".
 *
 * The followings are the available columns in table 'tbl_patient_injection':
 * @property integer $id
 * @property integer $patient_id
 * @property integer $sick_id
 * @property integer $number
 * @property string $inject_day
 * @property integer $done
 * @property string $month
 * @property string $vaccine_name
 * @property string $note
 * @property string $last_updated
 */
class PatientInjection extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_patient_injection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, sick_id, number, done', 'numerical', 'integerOnly'=>true),
			array('inject_day, month, vaccine_name, note', 'length', 'max'=>255),
			array('last_updated', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, patient_id, sick_id, number, inject_day, done, month, vaccine_name, note, last_updated', 'safe', 'on'=>'search'),
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
			'patient_id' => 'Patient',
			'sick_id' => 'Sick',
			'number' => 'Number',
			'inject_day' => 'Inject Day',
			'done' => 'Done',
			'month' => 'Month',
			'vaccine_name' => 'Vaccine Name',
			'note' => 'Note',
			'last_updated' => 'Last Updated',
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
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('sick_id',$this->sick_id);
		$criteria->compare('number',$this->number);
		$criteria->compare('inject_day',$this->inject_day,true);
		$criteria->compare('done',$this->done);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('vaccine_name',$this->vaccine_name,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('last_updated',$this->last_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PatientInjection the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
