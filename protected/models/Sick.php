<?php

/**
 * This is the model class for table "tbl_sick".
 *
 * The followings are the available columns in table 'tbl_sick':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $for_gender
 * @property integer $count
 * @property string $sick_short_name
 */
class Sick extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_sick';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('for_gender, count', 'numerical', 'integerOnly' => true),
            array('name, sick_short_name', 'length', 'max' => 255),
            array('description', 'length', 'max' => 700),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description, for_gender, count, sick_short_name', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'for_gender' => 'For Gender',
            'count' => 'Count',
            'sick_short_name' => 'Sick Short Name',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('for_gender', $this->for_gender);
        $criteria->compare('count', $this->count);
        $criteria->compare('sick_short_name', $this->sick_short_name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Sick the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function createSickUser($sicks, $patient_id) {
        $sick_arr = json_decode($sicks);
        foreach ($sick_arr as $sick) {
            $model = new PatientSick();
            $model->patient_id = $patient_id;
            $model->sick_id = $sick;
            $model->save(FALSE);
            $this->createScheduleSick($sick, $patient_id);
        }
    }

    public function createScheduleSick($sick_id, $patient_id) {
        $sick_infos = InjectionScheduler::model()->findAllByAttributes(array('sick_id' => $sick_id));
        $patient_info = Patient::model()->findByPk($patient_id);

        foreach ($sick_infos as $sick_info) {
            $model = new PatientInjection;
            $model->sick_id = $sick_id;
            $model->patient_id = $patient_id;
            $model->number = $sick_info->number;
            $model->done = 0;
            $model->month = $sick_info->month;
            $date = new DateTime($patient_info->dob);
            $date->modify('+' . $sick_info->month . ' month');
            $model->inject_day = $date->format('d-m-Y');
            $model->last_updated = time();
            $model->save(FALSE);
        }
    }

    public function updateSickPatient($sicks, $patient_id) {
        $sick_del = PatientSick::model()->findAllByAttributes(array('patient_id' => $patient_id));
        foreach ($sick_del as $sick) {
            $sick->delete();
        }
        $sick_arr = json_decode($sicks);

        foreach ($sick_arr as $sick) {
            $model = new PatientSick();
            $model->patient_id = $patient_id;
            $model->sick_id = $sick;
            $model->save(FALSE);
            $this->createScheduleSick($sick, $patient_id);
        }
    }

}
