<?php

/**
 * This is the model class for table "tbl_provider".
 *
 * The followings are the available columns in table 'tbl_provider':
 * @property integer $provider_id
 * @property string $provider_name
 * @property string $provider_address
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $provider_description
 * @property string $email
 * @property string $phone
 * @property string $fax
 * @property string $image
 */
class Provider extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_provider';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_at, updated_at', 'numerical', 'integerOnly' => true),
            array('provider_name, email, phone, fax, image', 'length', 'max' => 255),
            array('provider_address, provider_description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('provider_id, provider_name, provider_address, created_at, updated_at, provider_description, email, phone, fax, image', 'safe', 'on' => 'search'),
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
            'provider_id' => 'Provider',
            'provider_name' => 'Provider Name',
            'provider_address' => 'Provider Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'provider_description' => 'Provider Description',
            'email' => 'Email',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'image' => 'Image',
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

        $criteria->compare('provider_id', $this->provider_id);
        $criteria->compare('provider_name', $this->provider_name, true);
        $criteria->compare('provider_address', $this->provider_address, true);
        $criteria->compare('created_at', $this->created_at);
        $criteria->compare('updated_at', $this->updated_at);
        $criteria->compare('provider_description', $this->provider_description, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('image', $this->image, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Provider the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function add($post) {
        $model = new Provider;
        $model->setAttributes($post);
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function registerStaff($post) {
        $model = new ProviderStaff();
        $model->setAttributes($post);
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

}
