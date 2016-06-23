<?php

/**
 * This is the model class for table "tbl_clinics".
 *
 * The followings are the available columns in table 'tbl_clinics':
 * @property integer $clinic_id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $lat
 * @property string $lng
 * @property string $ward
 * @property string $province
 * @property string $district
 */
class Clinics extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_clinics';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, phone, lat, lng, ward, province, district', 'length', 'max' => 255),
            array('address', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('clinic_id, name, address, phone, lat, lng, ward, province, district', 'safe', 'on' => 'search'),
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
            'clinic_id' => 'Clinic',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'ward' => 'Ward',
            'province' => 'Province',
            'district' => 'District',
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

        $criteria->compare('clinic_id', $this->clinic_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('lat', $this->lat, true);
        $criteria->compare('lng', $this->lng, true);
        $criteria->compare('ward', $this->ward, true);
        $criteria->compare('province', $this->province, true);
        $criteria->compare('district', $this->district, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Clinics the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getClinics($limit, $offset) {
        $retVal = array();
        $criteria = new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $criteria->order = 'clinic_id DESC';
        $data = Clinics::model()->findAll($criteria);
        $attrs = $this->attributeLabels();
        foreach($data as $item)
        {
            $itemArr = array();
            foreach($attrs as $key => $value)
            {
                $itemArr[$key] = $item->$key;
            }
            $itemArr['stars'] = Review::model()->sumRating($item->clinic_id, 3);
            $itemArr['reviews'] = Review::model()->countReview($item->clinic_id, 3);
            $retVal[] = $itemArr;
        }
        return $retVal;
    }

    public function searchByAddressAndKeywords($province, $district, $ward, $limit, $offset, $keywords) {
        $criteria = new CDbCriteria;
        if (!empty($province)) {
            $criteria->addCondition("province=$province");
        }
        if (!empty($ward)) {
            $criteria->addCondition("ward=$ward");
        }
        if (!empty($district)) {
            $criteria->addCondition("district=$district");
        }
        if (!empty($keywords)) {
            $criteria->addSearchCondition('name', $keywords, TRUE, 'OR', 'LIKE');
            $criteria->addSearchCondition('address', $keywords, TRUE, 'OR', 'LIKE');
        }
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $criteria->order = 'clinic_id DESC';
        $data = Clinics::model()->findAll($criteria);
        $cnt = count($data);
        return array('cnt' => $cnt, 'data' => $data);
    }

}
