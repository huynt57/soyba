<?php

class MedicineRemindController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAddRemind() {
        try {
            $post = StringHelper::filterArrayString($_POST);
            if (MedicineRemind::model()->addRemind($post)) {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Error !');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetMedicineRemindOfPatient() {
        try {
            $request = Yii::app()->request;
            $patient_id = StringHelper::filterArrayString($request->getPost('patient_id'));
            $data = MedicineRemind::model()->getMedicineRemindOfPatient($patient_id);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionDeleteRemind() {
        try {
            $request = Yii::app()->request;
            $remind_id = StringHelper::filterArrayString($request->getPost('remind_id'));
            if (MedicineRemind::model()->deleteRemind($remind_id)) {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Error !');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
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
