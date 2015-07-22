<?php

class SuperController extends Controller {

    public $retVal;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionNuclearPower() {
        $patient = Patient::model()->deleteAll();


        $patient_injection = PatientInjection::model()->deleteAll();


        $patient_sick = PatientSick::model()->deleteAll();


        $patient_user = UserPatient::model()->deleteAll();
          Yii::app()->end();
    }

    public function actionSuperAPI() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_id = StringHelper::filterString($request->getPost('user_id'));
                $patient_data = Patient::model()->getPatientInfo($user_id);
                $sick_data = array();
                $inject_data = array();
                foreach ($patient_data as $patient) {
                    $sick = PatientSick::model()->findAllByAttributes(array('patient_id' => $patient["patient_id"]));
                    // var_dump($sick);
                    $inject = PatientInjection::model()->findAllByAttributes(array('patient_id' => $patient["patient_id"]));
                   // var_dump($inject);
                    array_push($inject_data, $inject);
                    array_push($sick_data, $sick);
                    // die();
                }
                $this->retVal->patient_data = $patient_data;
                $this->retVal->sick_data = $sick_data;
                $this->retVal->inject_data = $inject_data;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
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
