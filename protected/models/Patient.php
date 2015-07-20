<?php

/**
 * This is the model class for table "tbl_patient".
 *
 * The followings are the available columns in table 'tbl_patient':
 * @property integer $patient_id
 * @property string $name
 * @property string $dob
 * @property string $gender
 * @property string $last_updated
 * @property string $relationshipWithUser
 * @property string $bloodType
 */
class Patient extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_patient';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, dob, gender', 'length', 'max' => 255),
            array('last_updated', 'length', 'max' => 200),
            array('relationshipWithUser, bloodType', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('patient_id, name, dob, gender, last_updated, relationshipWithUser, bloodType', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'patient_id' => 'Patient',
            'name' => 'Name',
            'dob' => 'Dob',
            'gender' => 'Gender',
            'last_updated' => 'Last Updated',
            'relationshipWithUser' => 'Relationship With User',
            'bloodType' => 'Blood Type',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('patient_id', $this->patient_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('dob', $this->dob, true);
        $criteria->compare('gender', $this->gender, true);
        $criteria->compare('last_updated', $this->last_updated, true);
        $criteria->compare('relationshipWithUser', $this->relationshipWithUser, true);
        $criteria->compare('bloodType', $this->bloodType, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Patient the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getPatientInfo($id) {
        $id = StringHelper::filterString($id);
        $sql = "SELECT * FROM tbl_patient JOIN tbl_user_patient ON tbl_patient.patient_id = tbl_user_patient.patient_id WHERE tbl_user_patient.user_id = $id";
        $patient_info = Yii::app()->db->createCommand($sql)->queryAll();
        return $patient_info;
    }

    public function getPatientDetail($patient_id) {
        $patient_id = StringHelper::filterString($patient_id);
        $sql = "SELECT * FROM tbl_patient_injection JOIN tbl_patient_sick ON tbl_patient_injection.patient_id = tbl_patient_sick.patient_id "
                . " JOIN tbl_patient ON tbl_patient_injection.patient_id = tbl_patient.patient_id WHERE tbl_patient_injection.patient_id = $patient_id";
        $patient_info = Yii::app()->db->createCommand($sql)->queryAll();
        return $patient_info;
    }

}
