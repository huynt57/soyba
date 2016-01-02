<?php

/**
 * This is the model class for table "tbl_device_tk".
 *
 * The followings are the available columns in table 'tbl_device_tk':
 * @property integer $id
 * @property string $device_token
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $time_to_live
 * @property integer $status
 * @property integer $user_id
 * @property string $platform
 */
class DeviceTk extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_device_tk';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_at, updated_at, time_to_live, status, user_id', 'numerical', 'integerOnly' => true),
            array('platform', 'length', 'max' => 255),
            array('device_token', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, device_token, created_at, updated_at, time_to_live, status, user_id, platform', 'safe', 'on' => 'search'),
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
            'device_token' => 'Device Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'time_to_live' => 'Time To Live',
            'status' => 'Status',
            'user_id' => 'User',
            'platform' => 'Platform',
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
        $criteria->compare('device_token', $this->device_token, true);
        $criteria->compare('created_at', $this->created_at);
        $criteria->compare('updated_at', $this->updated_at);
        $criteria->compare('time_to_live', $this->time_to_live);
        $criteria->compare('status', $this->status);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('platform', $this->platform, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DeviceTk the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function setTokenUser($token, $user_id) {
        $check = DeviceTk::model()->findByAttributes(array('device_token' => $token));
        if ($check) {
            $check->device_token = $token;
            $check->user_id = $user_id;
            $check->updated_at = time();
            if ($check->save(FALSE)) {
                return TRUE;
            }
        } else {
            $model = new DeviceTk;
            $model->device_token = $token;
            $model->updated_at = time();
            $model->user_id = $user_id;
            $model->created_at = time();
            if ($model->save(FALSE)) {
                return TRUE;
            }
        }

        return FALSE;
    }

}
