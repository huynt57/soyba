<?php

class SickController extends Controller {
    
    public function actionIndex() {
        $this->render('index');
    }

    public function actionCreateSickUser() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $patient_id = StringHelper::filterString($request->getPost('patient_id'));
                $sicks = StringHelper::filterString($request->getPost('sicks'));

                Sick::model()->createSickUser($sicks, $patient_id);
                ResponseHelper::JsonReturnSuccess("", "Success");
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionUpdateSickPatient() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $patient_id = StringHelper::filterString($request->getPost('patient_id'));
                $sicks = StringHelper::filterString($request->getPost('sicks'));

                Sick::model()->updateSickPatient($sicks, $patient_id);
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
