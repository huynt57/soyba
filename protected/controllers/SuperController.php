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

    public function actionUpdateAppDbVer() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionCreatePatientAndSick() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $name = StringHelper::filterString($request->getPost('name'));
                $dob = StringHelper::filterString($request->getPost('dob'));
                $gender = StringHelper::filterString($request->getPost('gender'));
                $user_id = StringHelper::filterString($request->getPost('user_id'));
                $relation = StringHelper::filterString($request->getPost('relationshipWithUser'));
                $blood = StringHelper::filterString($request->getPost('bloodType'));
                $sicks = StringHelper::filterString($request->getPost('sicks'));

                $patient_model = new Patient;
                $patient_model->name = $name;
                $patient_model->dob = $dob;
                $patient_model->gender = $gender;
                $patient_model->last_updated = time();
                $patient_model->bloodType = $blood;
                $patient_model->relationshipWithUser = $relation;
                $patient_model->save(FALSE);

                $user_patient = new UserPatient;
                $user_patient->user_id = $user_id;
                $user_patient->patient_id = $patient_model->patient_id;
                $user_patient->save(FALSE);

                $sick_arr = json_decode($sicks);
                foreach ($sick_arr as $sick) {
                    $model = new PatientSick();
                    $model->patient_id = $user_patient->patient_id;
                    $model->sick_id = $sick;
                    $model->save(FALSE);
                    $this->createScheduleSick($sick, $patient_id);
                }

                $this->retVal->message = "Success";
                $this->retVal->patient_id = $patient_model->patient_id;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function createScheduleSick($sick_id, $patient_id) {
        $sick_infos = InjectionScheduler::model()->findAllByAttributes(array('sick_id' => $sick_id));
        $patient_info = Patient::model()->findByAttributes(array('patient_id' => $patient_id));

        foreach ($sick_infos as $sick_info) {
            $model = new PatientInjection;
            $model->sick_id = $sick_id;
            $model->patient_id = $patient_id;
            $model->number = $sick_info->number;
            $model->done = 0;
            $model->month = $sick_info->month;
            $date = new DateTime($patient_info->dob);
            $date->modify('+' . $sick_info->month . ' month');
            $model->inject_day = $date->format('d-m-Y');
            $model->last_updated = time();
            $model->save(FALSE);
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
