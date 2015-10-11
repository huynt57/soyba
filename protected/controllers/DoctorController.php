<?php

class DoctorController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAddDoctor() {
        try {
            $attr = StringHelper::filterArrayString($_POST);
            Doctors::model()->addDoctor($attr);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetDoctor() {
        try {
            $request = Yii::app()->request;
            $limit = StringHelper::filterString($request->getQuery('number'));
            $offset = StringHelper::filterString($request->getQuery('offset'));
            $result = Doctors::model()->getDoctor($limit, $offset);
            ResponseHelper::JsonReturnSuccess($result, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetDoctorByUser() {
        try {
            $request = Yii::app()->request;
            $limit = StringHelper::filterString($request->getQuery('number'));
            $offset = StringHelper::filterString($request->getQuery('offset'));
            $user_id = StringHelper::filterString($request->getQuery('user_id'));
            $result = Doctors::model()->getDoctorByUser($limit, $offset, $user_id);
            ResponseHelper::JsonReturnSuccess($result, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
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
