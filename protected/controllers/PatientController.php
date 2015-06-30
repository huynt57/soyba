<?php

class PatientController extends Controller {

    public $retVal;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetSickPatient() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $patient_id = StringHelper::filterString($request->getPost('patient_id'));
                $sick_data = PatientSick::model()->findAll(array(
                    'select' => 'sick_id',
                    'condition' => 'patient_id = ' . $patient_id . ''
                ));
                $this->retVal->sick_data = $sick_data;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionGetPatientUser() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_id = StringHelper::filterString($request->getPost('user_id'));
                $patient_data = UserPatient::model()->findAllByAttributes(array('user_id' => $user_id));
                $this->retVal->patient_data = $patient_data;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionGetPatientInjection() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $patient_id = StringHelper::filterString($request->getPost('patient_id'));
                $injection_data = PatientInjection::model()->findAllByAttributes(array('patient_id' => $patient_id));
                $this->retVal->injection_data = $injection_data;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionCreatePatientUser() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $name = StringHelper::filterString($request->getPost('name'));
                $dob = StringHelper::filterString($request->getPost('dob'));
                $gender = StringHelper::filterString($request->getPost('gender'));
                $user_id = StringHelper::filterString($request->getPost('user_id'));
                $patient_id = StringHelper::filterString($request->getPost('patient_id'));

                if ($patient_id == NULL) {
                    $patient_model = new Patient;
                    $patient_model->name = $name;
                    $patient_model->dob = $dob;
                    $patient_model->gender = $gender;
                    $patient_model->save(FALSE);

                    $user_patient = new UserPatient;
                    $user_patient->user_id = $user_id;
                    $user_patient->patient_id = $patient_model->id;
                    $user_patient->save(FALSE);
                } else {

                    $user_patient = new UserPatient;
                    $user_patient->user_id = $user_id;
                    $user_patient->patient_id = $patient_id;

                    $user_patient->save(FALSE);
                }
                $this->retVal->message = "Success";
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionSync() {
        
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
