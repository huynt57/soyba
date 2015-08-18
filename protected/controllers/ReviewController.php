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
                $model->comment = $comment;
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

            $review = Review::model()->findAllByAttributes(array('object_id' => $object_id, 'object_type' => $object_type));
            $count = $this->countReviewByStar();
            $rating = $this->countRating();
            $this->retVal->mesage = "Success";
            $this->retVal->data = array('review' => $review, 'count' => $count, 'rating' => $rating);
            $this->retVal->status = 1;
        } catch (Exception $ex) {
            $this->retVal->message = $ex->getMessage();
        }

        echo CJSON::encode($this->retVal);
        Yii::app()->end();
    }

    public function countReviewByStar() {
        $data = array();
        for ($i = 1; $i <= 5; $i++) {
            $data = array($i => Review::model()->count(array('rating' => $i)));
        }
        return $data;
//        $five = Review::model()->count(array('rating' => 5));
//        $four = Review::model()->count(array('rating' => 4));
//        $three = Review::model()->count(array('rating' => 3));
//        $two = Review::model()->count(array('rating' => 2));
//        $one = Review::model()->count(array('rating' => 1));
//
//        return array('five' => $five, 'four' => $four, 'three' => $three
//            , 'two' => $two, 'one' => $one);
    }

    public function countRating() {
        $count = Review::model()->count();
        $sum = Review::model()->sumRating();
        return $sum / $count;
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
