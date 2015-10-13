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

    public function actionCountRecord() {
        try {
            $data = Doctors::model()->findAll();
            $cnt = count($data);
            ResponseHelper::JsonReturnSuccess($cnt, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionCountRecordByUser() {
        try {
            $request = Yii::app()->request;
            $user_id = StringHelper::filterString($request->getPost('user_id'));
            $data = Doctors::model()->findAllByAttributes(array('user_id' => $user_id));
            $cnt = count($data);
            ResponseHelper::JsonReturnSuccess($cnt, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionSearchByKeywords() {
        try {
            $request = Yii::app()->request;
            $keywords = StringHelper::filterString($request->getPost('$keywords'));
            $data = Doctors::model()->searchByKeywords($keywords);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetDoctorByProvince() {
        try {
            $request = Yii::app()->request;
            $province = StringHelper::filterString($request->getQuery('province'));
            $data = Doctors::model()->findByProvince($province);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetDoctorByDistrict() {
        try {
            $request = Yii::app()->request;
            $district = StringHelper::filterString($request->getQuery('district'));
            $data = Doctors::model()->findByDistrict($district);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetDoctorByWard() {
        try {
            $request = Yii::app()->request;
            $ward = StringHelper::filterString($request->getQuery('ward'));
            $data = Doctors::model()->findByWard($ward);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
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
