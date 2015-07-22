<?php

class SickController extends Controller {

    public $retVal;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionCreateSickUser() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $patient_id = StringHelper::filterString($request->getPost('patient_id'));
                $sicks = StringHelper::filterString($request->getPost('sicks'));

                $sick_arr = json_decode($sicks);
                foreach ($sick_arr as $sick) {
                    $model = new PatientSick();
                    $model->patient_id = $patient_id;
                    $model->sick_id = $sick;
                    $model->save(FALSE);
                    $this->createScheduleSick($sick, $patient_id);
                }

                $this->retVal->message = "Success";
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
