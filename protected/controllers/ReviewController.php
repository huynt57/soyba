<?php

class ReviewController extends Controller {

    public $retVal;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAddReview() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_id = $request->getPost('user_id');
                $comment = $request->getPost('review');
                $object_id = $request->getPost('object_id');
                $object_type = $request->getPost('object_type');
                $rating = $request->getPost('rating');

                $model = new Review;
                $model->user_id = $user_id;
                $model->review = $comment;
                $model->object_id = $object_id;
                $model->object_type = $object_type;
                $model->rate = $rating;
                $model->time = time();

                if ($model->save(FALSE)) {
                    $this->retVal->mesage = "Success";
                    $this->retVal->data = "";
                    $this->retVal->status = 1;
                } else {
                    $this->retVal->mesage = "Fail";
                    $this->retVal->data = "";
                    $this->retVal->status = 0;
                }
            } catch (Exception $ex) {
                $this->retVal->message = $ex->getMessage();
            }
        }
        echo CJSON::encode($this->retVal);
        Yii::app()->end();
    }

    public function actionGetReview() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;

        try {
            $object_id = $request->getQuery('object_id');
            $object_type = $request->getQuery('object_type');
            $limit = $request->getQuery('limit');
            $offset = $request->getQuery('offset');

            $review = Review::model()->getReview($object_id, $object_type, $limit, $offset);
            $count = $this->countReviewByStar($object_id, $object_type);
            $rating = $this->countRating($object_id, $object_type);
            $this->retVal->mesage = "Success";
            $this->retVal->data = array('review' => $review, 'count' => $count, 'rate' => $rating);
            $this->retVal->status = 1;
        } catch (Exception $ex) {
            $this->retVal->message = $ex->getMessage();
        }

        echo CJSON::encode($this->retVal);
        Yii::app()->end();
    }
    
    public function actionGetObjectStar() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;

        try {
            $object_id = $request->getQuery('object_id');
            $object_type = $request->getQuery('object_type');
            $rating = $this->countRating($object_id, $object_type);
            $count = $this->countReviewByStar($object_id, $object_type);
            $this->retVal->mesage = "Success";
            $this->retVal->data = array('review' => $review, 'count' => $count, 'rate' => $rating);
            $this->retVal->status = 1;
        } catch (Exception $ex) {
            $this->retVal->message = $ex->getMessage();
        }

        echo CJSON::encode($this->retVal);
        Yii::app()->end();
    }

    public function countReviewByStar($object_id, $object_type) {
        $data = array();

        for ($i = 1; $i <= 5; $i++) {
            $elem = array($i . "r" => Review::model()->countByAttributes(array('rate' => $i, "object_id" => $object_id, "object_type" => $object_type)));
            $data = array_merge($data, $elem);
        }
        return $data;
    }

    public function actionUpdateReview() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $review_id = $request->getPost('review_id');
                $content = $request->getPost('content');
                $rate = $request->getPost('rate');
                $model = Review::model()->findByAttributes(array('id' => $review_id));
                if (!empty($rate))
                    $model->rate = $rate;
                if (!empty($content))
                    $model->review = $content;
                if ($model->save(FALSE)) {
                    $this->retVal->status = 1;
                    $this->retVal->data = "";
                    $this->retVal->message = "Success";
                } else {
                    $this->retVal->status = 0;
                    $this->retVal->data = "";
                    $this->retVal->message = "Fail";
                }
            } catch (Exception $ex) {
                $this->retVal->message = $ex->getMessage();
            }
        }
        echo CJSON::encode($this->retVal);
        Yii::app()->end();
    }

    public function countRating($object_id, $object_type) {
        $count = Review::model()->countByAttributes(array("object_id" => $object_id, "object_type" => $object_type));
        $sum = Review::model()->sumRating($object_id, $object_type);
        if ($count == 0) {
            return 0;
        } else {
            return $sum / $count;
        }
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
