<?php

/**
 * This is the model class for table "tbl_medicine_remind".
 *
 * The followings are the available columns in table 'tbl_medicine_remind':
 * @property integer $id
 * @property integer $patient_id
 * @property integer $sick_id
 * @property string $name
 * @property integer $is_enabled
 * @property integer $notify_hour_type
 * @property string $notify_times_in_day
 * @property integer $hour_interval
 * @property string $notify_days_in_week
 * @property string $start_date
 * @property string $end_date
 * @property integer $day_interval
 * @property double $dosage
 * @property integer $dosage_unit
 * @property integer $meal
 * @property string $more_instruction
 * @property integer $last_updated
 * @property integer $doctor_id
 */
class MedicineRemind extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_medicine_remind';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id', 'required'),
            array('id, patient_id, sick_id, is_enabled, notify_hour_type, hour_interval, day_interval, dosage_unit, meal, last_updated, doctor_id', 'numerical', 'integerOnly' => true),
            array('dosage', 'numerical'),
            array('name, notify_times_in_day, notify_days_in_week, start_date, end_date, more_instruction', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, patient_id, sick_id, name, is_enabled, notify_hour_type, notify_times_in_day, hour_interval, notify_days_in_week, start_date, end_date, day_interval, dosage, dosage_unit, meal, more_instruction, last_updated, doctor_id', 'safe', 'on' => 'search'),
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
            'patient_id' => 'Patient',
            'sick_id' => 'Sick',
            'name' => 'Name',
            'is_enabled' => 'Is Enabled',
            'notify_hour_type' => 'Notify Hour Type',
            'notify_times_in_day' => 'Notify Times In Day',
            'hour_interval' => 'Hour Interval',
            'notify_days_in_week' => 'Notify Days In Week',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'day_interval' => 'Day Interval',
            'dosage' => 'Dosage',
            'dosage_unit' => 'Dosage Unit',
            'meal' => 'Meal',
            'more_instruction' => 'More Instruction',
            'last_updated' => 'Last Updated',
            'doctor_id' => 'Doctor',
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
        $criteria->compare('patient_id', $this->patient_id);
        $criteria->compare('sick_id', $this->sick_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('is_enabled', $this->is_enabled);
        $criteria->compare('notify_hour_type', $this->notify_hour_type);
        $criteria->compare('notify_times_in_day', $this->notify_times_in_day, true);
        $criteria->compare('hour_interval', $this->hour_interval);
        $criteria->compare('notify_days_in_week', $this->notify_days_in_week, true);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);
        $criteria->compare('day_interval', $this->day_interval);
        $criteria->compare('dosage', $this->dosage);
        $criteria->compare('dosage_unit', $this->dosage_unit);
        $criteria->compare('meal', $this->meal);
        $criteria->compare('more_instruction', $this->more_instruction, true);
        $criteria->compare('last_updated', $this->last_updated);
        $criteria->compare('doctor_id', $this->doctor_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MedicineRemind the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addRemind($post) {
        $model = new MedicineRemind;
        $model->setAttributes($post);
        $model->last_updated = time();
        if ($model->save(FALSE)) {
            return $model->id;
        }
        return FALSE;
    }

    public function getMedicineRemindOfPatient($patient_id) {
//            $sql = "SELECT * FROM tbl_medicine_remind JOIN tbl_sick ON tbl_medicine_remind.sick_id = tbl_sick.sick_id WHERE tbl_medicine_remind.patient_id = $patient_id";
//            $result = Yii::app()->db->createCommand($sql)->queryAll();
        $result = MedicineRemind::model()->findAllByAttributes(array('patient_id' => $patient_id));
        return $result;
    }

    public function deleteRemind($remind_id) {
        $model = MedicineRemind::model()->findByPk($remind_id);
        if ($model) {
            if ($model->delete()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }

    public function editRemind($remind_id, $post) {
        $model = MedicineRemind::model()->findByPk($remind_id);
        $model->setAttributes($post);
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

}
