<?php

/**
 * This is the model class for table "tbl_provider_service".
 *
 * The followings are the available columns in table 'tbl_provider_service':
 * @property integer $id
 * @property string $service_name
 * @property integer $service_price
 * @property string $service_description
 * @property string $service_adorable
 * @property integer $provider_id
 * @property string $service_image
 */
class ProviderService extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_provider_service';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id', 'required'),
            array('id, service_price, provider_id', 'numerical', 'integerOnly' => true),
            array('service_name, service_image', 'length', 'max' => 255),
            array('service_description, service_adorable', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, service_name, service_price, service_description, service_adorable, provider_id, service_image', 'safe', 'on' => 'search'),
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
            'service_name' => 'Service Name',
            'service_price' => 'Service Price',
            'service_description' => 'Service Description',
            'service_adorable' => 'Service Adorable',
            'provider_id' => 'Provider',
            'service_image' => 'Service Image',
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
        $criteria->compare('service_name', $this->service_name, true);
        $criteria->compare('service_price', $this->service_price);
        $criteria->compare('service_description', $this->service_description, true);
        $criteria->compare('service_adorable', $this->service_adorable, true);
        $criteria->compare('provider_id', $this->provider_id);
        $criteria->compare('service_image', $this->service_image, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProviderService the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function add($post) {
        $model = new ServiceMedlatec;
        $model->setAttributes($post);
        $model->created_at = time();
        $model->updated_at = time();
        $model->active = 0;
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }

    public function update($post) {
        $model = ProviderService::model()->findByPk($post['service_id']);
        if ($model) {
            $model->setAttributes($post);
            if ($model->save(FALSE)) {
                return TRUE;
            }
        }
        return FALSE;
    }

}
