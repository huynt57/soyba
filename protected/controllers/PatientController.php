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
                $patient_data = Patient::model()->getPatientInfo($user_id);
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

                $patient_model = new Patient;
                $patient_model->name = $name;
                $patient_model->dob = $dob;
                $patient_model->gender = $gender;
                $patient_model->save(FALSE);

                $user_patient = new UserPatient;
                $user_patient->user_id = $user_id;
                $user_patient->patient_id = $patient_model->patient_id;
                $user_patient->save(FALSE);

                $this->retVal->message = "Success";
                $this->retVal->patient_id = $patient_model->patient_id;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionUpdatePatient() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $patient_name = StringHelper::filterString($request->getPost('patient_name'));
                $patient_id = StringHelper::filterString($request->getPost('patient_id'));
                $last_updated = StringHelper::filterString($request->getPost('ast_updated'));
                $patient = Patient::model()->findByAttributes(array('id' => $patient_id));
                if ($patient) {
                    if ($patient->last_updated < $last_updated) {
                        $patient->name = $patient_name;
                        $this->retVal->message = "Success";
                    } else {
                        $this->retVal->message = "Cannot modify because of time";
                    }
                } else {
                    $this->retVal->message = "Patient not exist";
                }
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionUpdateIS() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $id = StringHelper::filterString($request->getPost('injection_schedule_id'));

                $last_updated = StringHelper::filterString($request->getPost('last_updated'));
                $inject_day = StringHelper::filterString($request->getPost('inject_day'));
                $done = StringHelper::filterString($request->getPost('done'));
                $vac_name = StringHelper::filterString($request->getPost('vac_name'));
                $note = StringHelper::filterString($request->getPost('note'));
                if ($schedule) {
                    if ($schedule->last_updated < $last_updated) {
                        $schedule->done = $done;
                        $schedule->inject_day = $inject_day;
                        $schedule->vaccine_name = $vac_name;
                        $schedule->note = $note;
                        $schedule->last_updated = $last_updated;

                        $schedule->save(FALSE);
                        $this->retVal->message = "Success";
                    } else {
                        $this->retVal->message = "Cannot modify because of time";
                    }
                } else {
                    $this->retVal->message = "Schedule not exist";
                }
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
