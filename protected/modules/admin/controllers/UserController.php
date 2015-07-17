<?php

class UserController extends Controller {

    public $retVal;
    
    public function actionIndex() {
        $users = User::model()->findAll();
        $this->render('index', array('users' => $users));
    }

    public function actionDelete() {
        $request = Yii::app()->request;
        $user_id = $request->getQuery("user_id");

        $delete_user = User::model()->findByAttributes(array("user_id" => $user_id));
        $delete_user->delete();

        $patients = UserPatient::model()->findAllByAttributes(array("user_id" => $user_id));
        foreach ($patients as $patient) {
            $patient_del = Patient::model()->findByAttributes(array("patient_id" => $patient->patient_id));
            $patient_del->delete();

            $patient_sick_del = PatientSick::model()->findByAttributes(array("patient_id" => $patient->patient_id));
            $patient_sick_del->delete();

            $patient_inject_del = PatientInjection::model()->findByAttributes(array("patient_id" => $patient->patient_id));
            $patient_inject_del->delete();
        }

        $this->redirect(Yii::app()->createUrl('admin/user'));
    }

    public function actionDetail() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $id = StringHelper::filterString($request->getPost('id'));
                $patient_info = Patient::model()->getPatientInfo($id);
                $this->retVal->patient_info = $patient_info;
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
