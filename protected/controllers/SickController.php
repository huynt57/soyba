<?php

class SickController extends Controller {

    public $retVal;

    public function actionIndex() {
        $this->render('index');
    }

    public function createSickUser() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $patient_id = StringHelper::filterString($request->getPost('patient_id'));
                $sicks = StringHelper::filterString($request->getPost('sicks'));

                $sick_arr = explode(",", $sicks);
                foreach ($sick_arr as $sick) {
                    $model = new PatientSick();
                    $model->patient_id = $patient_id;
                    $model->sick_id = $sick;
                    $model->save(FALSE);
                }

                $this->retVal->message = "Success";
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
