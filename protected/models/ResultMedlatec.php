<?php

/**
 * This is the model class for table "tbl_result_medlatec".
 *
 * The followings are the available columns in table 'tbl_result_medlatec':
 * @property integer $id
 * @property string $patient_name
 * @property integer $service
 * @property string $time
 * @property string $doctor
 * @property string $diagnose
 * @property string $file
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $order_id
 * @property integer $provider_id
 */
class ResultMedlatec extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_result_medlatec';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('service, status, created_at, updated_at, order_id, provider_id', 'numerical', 'integerOnly' => true),
            array('patient_name, time, doctor', 'length', 'max' => 255),
            array('diagnose, file', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, patient_name, service, time, doctor, diagnose, file, status, created_at, updated_at, order_id, provider_id', 'safe', 'on' => 'search'),
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
            'patient_name' => 'Patient Name',
            'service' => 'Service',
            'time' => 'Time',
            'doctor' => 'Doctor',
            'diagnose' => 'Diagnose',
            'file' => 'File',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'order_id' => 'Order',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('patient_name', $this->patient_name, true);
        $criteria->compare('service', $this->service);
        $criteria->compare('time', $this->time, true);
        $criteria->compare('doctor', $this->doctor, true);
        $criteria->compare('diagnose', $this->diagnose, true);
        $criteria->compare('file', $this->file, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('created_at', $this->created_at);
        $criteria->compare('updated_at', $this->updated_at);
        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('provider_id', $this->provider_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ResultMedlatec the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function parseResult($result) {
        $itemArr = array();
        $attrLabel = $this->attributeLabels();
        foreach ($attrLabel as $key => $value) {
            $itemArr[$key] = $result->$key;
            $itemArr['files'] = ResultFile::model()->findAllByAttributes(array('result_id' => $result->id));
        }
        return $itemArr;
    }

    public function getResultOfOrder($order_id) {
        $results = ResultMedlatec::model()->findAllByAttributes(array('order_id' => $order_id));
        $returnArr = array();
        foreach ($results as $item) {
            $itemArr = $this->parseResult($item);
            $returnArr[] = $itemArr;
        }
        return $returnArr;
    }

    public function getResultByUser($user_id, $limit, $offset) {
//        $orders = OrderMedlatec::model()->findAllByAttributes(array('user_id' => $user_id));
//        $returnArr = array();
//        foreach ($orders as $order) {
//            $itemArr = array();
//            $itemArr = ResultMedlatec::model()->findByAttributes(array('order_id' => $order->id));
//            if (!empty($itemArr)) {
//                $returnArr[] = $itemArr;
//            }
//        }
        $criteria = new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $criteria->join = "JOIN tbl_order_medlatec o where t.id = o.order_id";
        $criteria->select = "t.*, o.*";
        $criteria->condition = "o.user_meboo = $user_id";
        $returnArr = ResultMedlatec::model()->findAll($criteria);
        return $returnArr;
    }

}
