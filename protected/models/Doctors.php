<?php

/**
 * This is the model class for table "tbl_doctors".
 *
 * The followings are the available columns in table 'tbl_doctors':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $status
 * @property string $phone
 * @property string $email
 * @property string $specialist
 * @property string $register_number
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property double $lat
 * @property double $lng
 * @property string $ward
 * @property string $district
 * @property string $province
 * @property integer $user_id
 */
class Doctors extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_doctors';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status, created_at, updated_at, user_id', 'numerical', 'integerOnly' => true),
            array('lat, lng', 'numerical'),
            array('phone, email, specialist, register_number', 'length', 'max' => 255),
            array('ward, district, province', 'length', 'max' => 11),
            array('name, address, description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, address, status, phone, email, specialist, register_number, description, created_at, updated_at, lat, lng, ward, district, province, user_id', 'safe', 'on' => 'search'),
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
            'address' => 'Address',
            'status' => 'Status',
            'phone' => 'Phone',
            'email' => 'Email',
            'specialist' => 'Specialist',
            'register_number' => 'Register Number',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'ward' => 'Ward',
            'district' => 'District',
            'province' => 'Province',
            'user_id' => 'User',
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
        $criteria->compare('address', $this->address, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('specialist', $this->specialist, true);
        $criteria->compare('register_number', $this->register_number, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('created_at', $this->created_at);
        $criteria->compare('updated_at', $this->updated_at);
        $criteria->compare('lat', $this->lat);
        $criteria->compare('lng', $this->lng);
        $criteria->compare('ward', $this->ward, true);
        $criteria->compare('district', $this->district, true);
        $criteria->compare('province', $this->province, true);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Doctors the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addDoctor($attr) {
        $model = new Doctors();
        $model->setAttributes($attr);
        $model->updated_at = time();
        $model->created_at = time();
        $model->status = 0;
        if ($model->save(FALSE)) {
            ResponseHelper::JsonReturnSuccess($model->id, "Success");
        } else {
            ResponseHelper::JsonReturnError("", "Server Error");
        }
    }

    public function getDoctor($limit, $offset) {
        $criteria = new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $result = Doctors::model()->findAll($criteria);
        return $result;
    }

    public function getDoctorByUser($limit, $offset, $user_id) {
        $criteria = new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $criteria->condition = "user_id = $user_id";
        $result = Doctors::model()->findAll($criteria);
        return $result;
    }

}
