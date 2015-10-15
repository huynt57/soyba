<?php

class ClinicController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetClinic() {
        try {
            $request = Yii::app()->request;
            $limit = StringHelper::filterString($request->getQuery('number'));
            $offset = StringHelper::filterString($request->getQuery('offset'));
            $data = Clinics::model()->getClinics($limit, $offset);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionSearchClinicByAddressAndKeywords() {
        try {
            $request = Yii::app()->request;
            $ward = StringHelper::filterString($request->getQuery('ward'));
            $district = StringHelper::filterString($request->getQuery('district'));
            $province = StringHelper::filterString($request->getQuery('province'));
            $limit = StringHelper::filterString($request->getQuery('number'));
            $offset = StringHelper::filterString($request->getQuery('offset'));
            $keywords = StringHelper::filterString($request->getQuery('keywords'));
            $data = Clinics::model()->searchByAddressAndKeywords($province, $district, $ward, $limit, $offset, $keywords);
            header('Content-type: application/json');
            echo CJSON::encode(array('status' => 1, 'count' => $data['cnt'], 'data' => $data['data'], 'message' => 'Success'));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionCountRecord() {
        try {
            $request = Yii::app()->request;
            $data = count(Clinics::model()->findAll());
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
