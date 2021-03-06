<?php

/**
 * This is the model class for table "tbl_order_medlatec".
 *
 * The followings are the available columns in table 'tbl_order_medlatec':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $ward
 * @property string $province
 * @property string $district
 * @property string $requirement
 * @property integer $status
 * @property integer $active
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_meboo
 * @property integer $service_id
 * @property integer $time_confirm
 * @property integer $time_meet
 * @property string $price
 * @property string $identity
 * @property integer $provider_id
 */
class OrderMedlatec extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_order_medlatec';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status, active, created_at, updated_at, user_meboo, service_id, time_confirm, time_meet, provider_id', 'numerical', 'integerOnly' => true),
            array('name, phone, email, ward, province, district, identity', 'length', 'max' => 255),
            array('address, requirement, price', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, phone, email, address, ward, province, district, requirement, status, active, created_at, updated_at, user_meboo, service_id, time_confirm, time_meet, price, identity, provider_id', 'safe', 'on' => 'search'),
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
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'ward' => 'Ward',
            'province' => 'Province',
            'district' => 'District',
            'requirement' => 'Requirement',
            'status' => 'Status',
            'active' => 'Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_meboo' => 'User Meboo',
            'service_id' => 'Service',
            'time_confirm' => 'Time Confirm',
            'time_meet' => 'Time Meet',
            'price' => 'Price',
            'identity' => 'Identity',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('ward', $this->ward, true);
        $criteria->compare('province', $this->province, true);
        $criteria->compare('district', $this->district, true);
        $criteria->compare('requirement', $this->requirement, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('active', $this->active);
        $criteria->compare('created_at', $this->created_at);
        $criteria->compare('updated_at', $this->updated_at);
        $criteria->compare('user_meboo', $this->user_meboo);
        $criteria->compare('service_id', $this->service_id);
        $criteria->compare('time_confirm', $this->time_confirm);
        $criteria->compare('time_meet', $this->time_meet);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('identity', $this->identity, true);
        $criteria->compare('provider_id', $this->provider_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrderMedlatec the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function add($post) {
        $model = new OrderMedlatec;
        $model->setAttributes($post);
        //$order->time_meet = StringHelper::dateToTime($post['time_meet']);
        //$order->time_confirm = StringHelper::dateToTime($post['time_confirm']);
        $model->created_at = time();
        $model->updated_at = time();
        $model->time_meet = time();
        $model->time_confirm = time();
        if ($model->save(FALSE)) {
            MailQueue::model()->addMailQueue('Có một đơn đặt hàng mới dịch vụ medlatec', 'hotro@meboo.vn', 'meboo admin', 'huynt57@gmail.com', 'Có một đơn đặt hàng mới dịch vụ medlatec');
            return $model->id;
        }
        return FALSE;
    }

    public function getOrderByUser($user_id, $limit, $offset) {
        $criteria = new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $criteria->condition = "user_meboo = $user_id";
        $data = OrderMedlatec::model()->findAll($criteria);
        $returnArr = array();
        $attrLabel = $this->attributeLabels();
        foreach ($data as $item) {
            $itemArr = array();
            foreach ($attrLabel as $key => $value) {
                $itemArr[$key] = $item->$key;
            }
            $service = ServiceMedlatec::model()->findByPk($item->service_id);
            if (!empty($service)) {
                $service_name = $service->service_name;
            } else {
                $service_name = null;
            }
            $itemArr['service_name'] = $service_name;
            $returnArr[] = $itemArr;
        }
        return $returnArr;
    }

    public function getOrderDetail($order_id) {
        $order = OrderMedlatec::model()->findByPk($order_id);
        $attrs = $this->attributeLabels();
        $itemArr = array();
        foreach ($attrs as $key => $value) {
            $itemArr[$key] = $order->$key;
        }
        $service = ServiceMedlatec::model()->findByPk($order->service_id);

        if (!empty($service)) {
            $service_name = $service->service_name;
        } else {
            $service_name = null;
        }
        $itemArr['service_name'] = $service_name;

        return $itemArr;
    }

    public function getOrderAndResult($order_id) {
        $order_info = $this->getOrderDetail($order_id);
        $result_info = ResultMedlatec::model()->getResultOfOrder($order_id);
        return array('order_info' => $order_info, 'result_info' => $result_info);
    }

}
