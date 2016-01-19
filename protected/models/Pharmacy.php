<?php

/**
 * This is the model class for table "tbl_pharmacy".
 *
 * The followings are the available columns in table 'tbl_pharmacy':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $laititude
 * @property string $longitude
 * @property string $state
 * @property string $contact_num
 * @property integer $type
 * @property integer $user_id
 * @property string $ward
 * @property string $province
 * @property string $district
 */
class Pharmacy extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_pharmacy';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type, user_id', 'numerical', 'integerOnly' => true),
            array('name, address, laititude, longitude, state, contact_num, ward, province, district', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, address, laititude, longitude, state, contact_num, type, user_id, ward, province, district', 'safe', 'on' => 'search'),
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
            'laititude' => 'Laititude',
            'longitude' => 'Longitude',
            'state' => 'State',
            'contact_num' => 'Contact Num',
            'type' => 'Type',
            'user_id' => 'User',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('laititude', $this->laititude, true);
        $criteria->compare('longitude', $this->longitude, true);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('contact_num', $this->contact_num, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('user_id', $this->user_id);
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
     * @return Pharmacy the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getPharmacy($number, $offset, $keywords) {
        $Criteria = new CDbCriteria;
        $Criteria->select = "*";
        if (!empty($keywords)) {
            foreach ($keywords as $address) {
                $Criteria->addSearchCondition('address', $address);
            }
        }
        if (!empty($number)) {
            $Criteria->limit = $number;
        }
        if (!empty($offset)) {
            $Criteria->offset = $offset;
        }
        $results = Pharmacy::model()->findAll($Criteria);
        return $results;
    }

    public function createPharmacy($attr) {
        $model = new Pharmacy;
        $model->setAttributes($attr);
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
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
            $criteria->addSearchCondition('contact_num', $keywords, TRUE, 'OR', 'LIKE');
        }
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $data = Doctors::model()->findAll($criteria);
        $cnt = count($data);
        return array('cnt' => $cnt, 'data' => $data);
    }

    public function getNearPharmacy($lat, $lng, $limit, $offset) {
        $criteria = new CDbCriteria;
        if (!empty($lat) && !empty($lng)) {
            $criteria->select = "t.*, (2 * (3959 * ATAN2(
          SQRT(
            POWER(SIN((RADIANS(" . $lat . " - `t`.`laititude` ) ) / 2 ), 2 ) +
            COS(RADIANS(`t`.`laititude`)) *
            COS(RADIANS(" . $lat . ")) *
            POWER(SIN((RADIANS(" . $lng . " - `t`.`longitude` ) ) / 2 ), 2 )
          ),
          SQRT(1-(
            POWER(SIN((RADIANS(" . $lat . " - `t`.`laititude` ) ) / 2 ), 2 ) +
            COS(RADIANS(`t`.`laititude`)) *
            COS(RADIANS(" . $lat . ")) *
            POWER(SIN((RADIANS(" . $lng . " - `t`.`longitude` ) ) / 2 ), 2 )
          ))
        )
      )) as
            distance";
            $criteria->having = 'distance < 3';
            $criteria->group = 't.id';
        }
        $criteria->order = 'distance ASC';
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $data = Pharmacy::model()->findAll($criteria);
        return $data;
    }

}
