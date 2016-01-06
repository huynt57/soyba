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
            header('Content-type: application/json');
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
                foreach ($patient_data as $patient) {
                    $patient["patient_id"] = (int) $patient["patient_id"];
                    // echo $patient["patient_id"];
                }
                $this->retVal->patient_data = $patient_data;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            header('Content-type: application/json');
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
            header('Content-type: application/json');
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionCreatePatientUser() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $attr = StringHelper::filterArrayString($_POST);
                $patient_id = Patient::model()->createPatientUser($attr);
                if ($patient_id) {
                    $this->retVal->message = "Success";
                    $this->retVal->patient_id = $patient_id;
                    $this->retVal->data = $patient_id;
                    $this->retVal->status = 1;
                }
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            header('Content-type: application/json');
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionUpdatePatient() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $patient_name = StringHelper::filterString($request->getPost('patient_name'));
                $patient_id = StringHelper::filterString($request->getPost('patient_id'));
                $last_updated = StringHelper::filterString($request->getPost('last_updated'));
                $blood = StringHelper::filterString($request->getPost('bloodType'));
                $relation = StringHelper::filterString($request->getPost('relationshipWithUser'));

                Patient::model()->updatePatient($patient_id, $patient_name, $last_updated, $relation, $blood);
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }

    public function actionUpdateIS() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $patient_id = StringHelper::filterString($request->getPost('patient_id'));
                $sick_id = StringHelper::filterString($request->getPost('sick_id'));
                $number = StringHelper::filterString($request->getPost('number'));

                $last_updated = StringHelper::filterString($request->getPost('last_updated'));
                $inject_day = StringHelper::filterString($request->getPost('inject_day'));
                $done = StringHelper::filterString($request->getPost('is_done'));
                $vac_name = StringHelper::filterString($request->getPost('vac_name'));
                $note = StringHelper::filterString($request->getPost('note'));

                Patient::model()->updateIS($patient_id, $sick_id, $number, $last_updated, $done, $inject_day, $vac_name, $note);
            } catch (exception $e) {
                var_dump($e->getMessage());
            }

            Yii::app()->end();
        }
    }

    public function actionGetHeightWeight() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $id = StringHelper::filterString($request->getPost('patient_id'));
                $data = BiographyStat::model()->findAllByAttributes(array('patient_id' => $id));
                $this->retVal->data = $data;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            header('Content-type: application/json');
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionDeleteHeightWeight() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $id = StringHelper::filterString($request->getPost('id'));

                if (Patient::model()->deleteHeightWeight($id)) {
                    ResponseHelper::JsonReturnSuccess('', 'Success');
                } else {
                    ResponseHelper::JsonReturnError('', 'Server Error !');
                }
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }

    public function actionCreateHeightWeight() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $id = StringHelper::filterString($request->getPost('patient_id'));
                $height = StringHelper::filterString($request->getPost('height'));
                $weight = StringHelper::filterString($request->getPost('weight'));
                $timestamp = StringHelper::filterString($request->getPost('timestamp'));

                Patient::model()->createHeightWeight($timestamp, $height, $weight, $id);
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }

    public function actionDeleteAPatient() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $id = StringHelper::filterString($request->getPost('patient_id'));
                Patient::model()->deletePatient($id);
                ResponseHelper::JsonReturnSuccess("", "Success");
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
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
