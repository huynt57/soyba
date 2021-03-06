<?php

/**
 * This is the model class for table "tbl_history_remind".
 *
 * The followings are the available columns in table 'tbl_history_remind':
 * @property integer $id
 * @property integer $remind_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $original_time
 * @property integer $taken_time
 */
class HistoryRemind extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_history_remind';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('remind_id, created_at, updated_at, status, original_time, taken_time', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, remind_id, created_at, updated_at, status, original_time, taken_time', 'safe', 'on' => 'search'),
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
            'remind_id' => 'Remind',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'original_time' => 'Original Time',
            'taken_time' => 'Taken Time',
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
        $criteria->compare('remind_id', $this->remind_id);
        $criteria->compare('created_at', $this->created_at);
        $criteria->compare('updated_at', $this->updated_at);
        $criteria->compare('status', $this->status);
        $criteria->compare('original_time', $this->original_time);
        $criteria->compare('taken_time', $this->taken_time);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return HistoryRemind the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getHistoryByPatient($patient_id) {
        $patient = Patient::model()->findByPk($patient_id);
        if ($patient) {
            $reminds = MedicineRemind::model()->findAllByAttributes(array('patient_id' => $patient->patient_id));
            $returnArr = array();
            if ($reminds) {
                foreach ($reminds as $remind) {
                    $history = HistoryRemind::model()->findAllByAttributes(array('remind_id' => $remind->id));
                    $returnArr[] = $history;
                }
                return $returnArr;
            }
        }
    }

    public function add($post) {
        $model = new HistoryRemind;
        $model->setAttributes($post);
        $model->created_at = time();
        $model->updated_at = time();
        if ($model->save(FALSE)) {
            return $model->id;
        }
        return FALSE;
    }

    public function edit($post) {
        $model = HistoryRemind::model()->findByPk($post['id']);
        if ($model) {
            $model->setAttributes($post);
            $model->updated_at = time();
            if ($model->save(FALSE)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function deleteHR($id) {
        $model = HistoryRemind::model()->findByPk($id);
        if ($model->delete()) {
            return TRUE;
        }
        return FALSE;
    }

    public function getAllHistoryOfARemind($remind_id) {
        $model = HistoryRemind::model()->findAllByAttributes(array('remind_id' => $remind_id));
        return $model;
    }

    public function deleteAllHistoryOfARemind($remind_id) {
        $model = HistoryRemind::model()->findAllByAttributes(array('remind_id' => $remind_id));
        $flag = TRUE;
        foreach ($model as $item) {
            if (!$item->delete) {
                $flag = FALSE;
            }
        }
        return $flag;
    }

}
