<?php

class PatientController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionDetail() {
        $request = Yii::app()->request;
        $patient_id = $request->getQuery("patient_id");

        $patient_info = Patient::model()->getPatientDetail($patient_id);
     
        // echo CJSON::encode($patient_info);
        $this->render('detail', array('patient_info' => $patient_info));
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
