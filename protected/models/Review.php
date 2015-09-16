<?php

/**
 * This is the model class for table "tbl_review".
 *
 * The followings are the available columns in table 'tbl_review':
 * @property integer $id
 * @property integer $object_id
 * @property integer $object_type
 * @property integer $user_id
 * @property string $review
 * @property integer $time
 * @property integer $rate
 */
class Review extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_review';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('object_id, object_type, user_id, time, rate', 'numerical', 'integerOnly' => true),
            array('review', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, object_id, object_type, user_id, review, time, rate', 'safe', 'on' => 'search'),
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
            'object_id' => 'Object',
            'object_type' => 'Object Type',
            'user_id' => 'User',
            'review' => 'Review',
            'time' => 'Time',
            'rate' => 'Rate',
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
        $criteria->compare('object_id', $this->object_id);
        $criteria->compare('object_type', $this->object_type);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('review', $this->review, true);
        $criteria->compare('time', $this->time);
        $criteria->compare('rate', $this->rate);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Review the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function sumRating($object_id, $object_type) {
        $sql = "SELECT SUM(rate) FROM tbl_review WHERE object_id = $object_id AND object_type = $object_type";
        $sum = Yii::app()->db->createCommand($sql)->queryScalar();
        return $sum;
    }

    public function getReview($object_id, $object_type, $limit, $offset) {
        $sql = "SELECT tbl_review.* , tbl_user.name, tbl_user.photo FROM tbl_review INNER JOIN tbl_user ON tbl_review.user_id = tbl_user.user_id WHERE tbl_review.object_id = $object_id"
                . " AND tbl_review.object_type = $object_type LIMIT $offset, $limit";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    public function addReview($user_id, $object_id, $comment, $rating, $object_type) {
        $check = Review::model()->findByAttributes(array('user_id' => $user_id, 'object_id' => $object_id, 'object_type' => $object_type));
        if ($check) {
            $check->review = $comment;
            $check->rate = $rating;
            $check->time = time();
            if ($check->save(FALSE)) {
                ResponseHelper::JsonReturnSuccess($check, "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Failed");
            }
        } else {
            $model = new Review;
            $model->user_id = $user_id;
            $model->review = $comment;
            $model->object_id = $object_id;
            $model->object_type = $object_type;
            $model->rate = $rating;
            $model->time = time();
            if ($model->save(FALSE)) {
                ResponseHelper::JsonReturnSuccess($model, "Success");
            } else {
                 ResponseHelper::JsonReturnError("", "Failed");
            }
        }
    }

}
