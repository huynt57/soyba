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
 * @property string $district
 * @property string $province
 * @property string $ward
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $identity
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
            array('name, dob, gender, district, province, ward, email, phone, identity', 'length', 'max' => 255),
            array('last_updated', 'length', 'max' => 200),
            array('relationshipWithUser, bloodType, address', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('patient_id, name, dob, gender, last_updated, relationshipWithUser, bloodType, district, province, ward, email, phone, address, identity', 'safe', 'on' => 'search'),
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
            'district' => 'District',
            'province' => 'Province',
            'ward' => 'Ward',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'identity' => 'Identity',
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
        $criteria->compare('district', $this->district, true);
        $criteria->compare('province', $this->province, true);
        $criteria->compare('ward', $this->ward, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('identity', $this->identity, true);

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
        $sql = "SELECT tbl_patient.*, tbl_user_patient.user_id FROM tbl_patient JOIN tbl_user_patient ON tbl_patient.patient_id = tbl_user_patient.patient_id WHERE tbl_user_patient.user_id = $id";
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

    public function getPatientDetailAdmin($patient_id) {
        $patient_id = StringHelper::filterString($patient_id);
        $sql = "SELECT * FROM tbl_patient JOIN tbl_biography_stat ON tbl_patient.patient_id = tbl_biography_stat.patient_id WHERE tbl_patient.patient_id = $patient_id";
        $patient_info = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($patient_info as $patient) {
            $patient["patient_id"] = (int) $patient["patient_id"];
        }
        return $patient_info;
    }

    public function getDetailCalendar($id) {
        $id = StringHelper::filterString($id);
        $sql = "SELECT * FROM tbl_patient_injection JOIN tbl_sick ON tbl_patient_injection.sick_id = tbl_sick.id WHERE tbl_patient_injection.id = $id";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
    }

    public function updatePatientCalendar($id, $done, $date, $note) {
        $calendar = PatientInjection::model()->findByAttributes(array('id' => $id));
        $calendar->done = $done;
        $calendar->inject_day = $date;
        $calendar->note = $note;

        $calendar->save(FALSE);
    }

    public function getCalendar() {
        $sql = "SELECT tbl_patient_injection.*, tbl_sick.name FROM tbl_patient_injection INNER JOIN tbl_sick ON tbl_patient_injection.sick_id = tbl_sick.id WHERE "
                . "tbl_patient_injection.patient_id = 1";
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
    }

    public function createPatientUser($attr) {
        $flag = FALSE;
        $flag_2 = FALSE;
        $patient_model = new Patient;
        $patient_model->setAttributes($attr);
        if ($patient_model->save(FALSE)) {
            $flag = TRUE;
        }

        $user_patient = new UserPatient;
        $user_patient->user_id = $attr['user_id'];
        $user_patient->patient_id = $patient_model->patient_id;
        if ($user_patient->save(FALSE)) {
            $flag_2 = TRUE;
        }
        if ($flag && $flag_2) {
            return $patient_model->patient_id;
        }
        return FALSE;
    }

    public function updatePatient($patient_id, $patient_name, $last_updated, $relation, $blood) {
        $patient = Patient::model()->findByAttributes(array('patient_id' => $patient_id));
        if ($patient) {
            if ($patient->last_updated < $last_updated) {
                $patient->name = $patient_name;
                $patient->last_updated = $last_updated;
                $patient->relationshipWithUser = $relation;
                $patient->bloodType = $blood;
                if ($patient->save(FALSE)) {
                    ResponseHelper::JsonReturnSuccess("", "Success");
                } else {
                    ResponseHelper::JsonReturnError("", "Server Error");
                }
            } else {
                ResponseHelper::JsonReturnError("", "Cannot modify because of time");
            }
        } else {
            ResponseHelper::JsonReturnError("", "Patient not exist");
        }
    }

    public function updateIS($patient_id, $sick_id, $number, $last_updated, $done, $inject_day, $vac_name, $note) {
        $schedule = PatientInjection::model()->findByAttributes(array('patient_id' => $patient_id, 'sick_id' => $sick_id, 'number' => $number));
        if ($schedule) {
            if ($schedule->last_updated < $last_updated) {
                $schedule->done = $done;
                $schedule->inject_day = $inject_day;
                $schedule->vaccine_name = $vac_name;
                $schedule->note = $note;
                $schedule->last_updated = $last_updated;

                if ($schedule->save(FALSE)) {
                    ResponseHelper::JsonReturnSuccess("", "Success");
                }
            } else {
                ResponseHelper::JsonReturnSuccess("", "Cannot modify because of wrong time");
            }
        } else {
            ResponseHelper::JsonReturnSuccess("", "Schedule not exist");
        }
    }

    public function deletePatient($id) {
        $patient = Patient::model()->findByAttributes(array('patient_id' => $id));
        $patient->delete();
        $patient_injection = PatientInjection::model()->findAllByAttributes(array('patient_id' => $id));
        $patient_remind = MedicineRemind::model()->findAllByAttributes(array('patient_id' => $id));
        foreach ($patient_remind as $item) {
            $item->delete();
        }
        foreach ($patient_injection as $patient) {
            $patient->delete();
        }
        $patient_sick = PatientSick::model()->findAllByAttributes(array('patient_id' => $id));
        foreach ($patient_sick as $patient) {
            $patient->delete();
        }
        $patient_user = UserPatient::model()->findAllByAttributes(array('patient_id' => $id));
        foreach ($patient_user as $patient) {
            $patient->delete();
        }
    }

    public function deleteHeightWeight($id) {
        $model = BiographyStat::model()->findByPk($id);
        if ($model->delete()) {
            return TRUE;
        }
        return FALSE;
    }

    public function createHeightWeight($timestamp, $height, $weight, $id) {
        $exist = BiographyStat::model()->findByAttributes(array('timestamp' => $timestamp));
        if ($exist) {
            $exist->height = $height;
            $exist->weight = $weight;
            $exist->patient_id = $id;
            $exist->timestamp = $timestamp;
            $exist->last_updated = time();
            if ($exist->save(FALSE)) {
                ResponseHelper::JsonReturnSuccess("", "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        } else {
            $model = new BiographyStat;
            $model->height = $height;
            $model->weight = $weight;
            $model->patient_id = $id;
            $model->timestamp = $timestamp;
            $model->last_updated = time();
            if ($model->save(FALSE)) {
                ResponseHelper::JsonReturnSuccess($model->id, "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        }
    }

}
