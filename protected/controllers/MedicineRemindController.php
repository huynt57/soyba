<?php

class MedicineRemindController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAddRemind() {
        try {
            $post = StringHelper::filterArrayString($_POST);
            $remind_id = MedicineRemind::model()->addRemind($post);
            if ($remind_id != FALSE) {
                ResponseHelper::JsonReturnSuccess($remind_id, 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Error !');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionEditRemind() {
        try {
            $post = StringHelper::filterArrayString($_POST);
            $remind_id = StringHelper::filterString(Yii::app()->request->getPost('remind_id'));
            if (MedicineRemind::model()->editRemind($remind_id, $post)) {
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
            $patient_id = StringHelper::filterString($request->getQuery('patient_id'));
            $data = MedicineRemind::model()->getMedicineRemindOfPatient($patient_id);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionDeleteRemind() {
        try {
            $request = Yii::app()->request;
            $remind_id = StringHelper::filterString($request->getPost('remind_id'));
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
