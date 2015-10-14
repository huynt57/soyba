<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $user_id
 * @property string $facebook_id
 * @property string $google_id
 * @property string $gender
 * @property string $facebook_access_token
 * @property string $photo
 * @property string $last_updated
 * @property string $email
 * @property string $name
 * @property string $description
 * @property string $ward
 * @property string $province
 * @property string $district
 * @property string $address
 * @property string $phone
 */
class User extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('facebook_id, google_id, gender, photo, ward, province, district, phone', 'length', 'max' => 255),
            array('facebook_access_token', 'length', 'max' => 500),
            array('last_updated, email, name', 'length', 'max' => 200),
            array('description, address', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, facebook_id, google_id, gender, facebook_access_token, photo, last_updated, email, name, description, ward, province, district, address, phone', 'safe', 'on' => 'search'),
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
            'user_id' => 'User',
            'facebook_id' => 'Facebook',
            'google_id' => 'Google',
            'gender' => 'Gender',
            'facebook_access_token' => 'Facebook Access Token',
            'photo' => 'Photo',
            'last_updated' => 'Last Updated',
            'email' => 'Email',
            'name' => 'Name',
            'description' => 'Description',
            'ward' => 'Ward',
            'province' => 'Province',
            'district' => 'District',
            'address' => 'Address',
            'phone' => 'Phone',
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

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('facebook_id', $this->facebook_id, true);
        $criteria->compare('google_id', $this->google_id, true);
        $criteria->compare('gender', $this->gender, true);
        $criteria->compare('facebook_access_token', $this->facebook_access_token, true);
        $criteria->compare('photo', $this->photo, true);
        $criteria->compare('last_updated', $this->last_updated, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('ward', $this->ward, true);
        $criteria->compare('province', $this->province, true);
        $criteria->compare('district', $this->district, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('phone', $this->phone, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function updateInfo($attr) {
        $model = User::model()->findByPk($attr['user_id']);
        if ($model) {
            $model->setAttributes($attr);
            if ($model->save(FALSE)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
