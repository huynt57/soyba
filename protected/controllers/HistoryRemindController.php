<?php

class HistoryRemindController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetHistoryByPatient() {
        try {
            $request = Yii::app()->request;
            $patient_id = StringHelper::filterString($request->getQuery('patient_id'));
            $data = HistoryRemind::model()->getHistoryByPatient($patient_id);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionAdd() {
        try {
            $post = StringHelper::filterArrayString($_POST);
            $result = HistoryRemind::model()->add($post);
            if ($result != FALSE) {
                ResponseHelper::JsonReturnSuccess($result, 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Error !');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionEdit() {
        try {
            $post = StringHelper::filterArrayString($_POST);
            $result = HistoryRemind::model()->edit($post);
            if ($result) {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Error !');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionDelete() {

        try {
            $request = Yii::app()->request;
            $history_id = StringHelper::filterString($request->getQuery('history_id'));
            $result = HistoryRemind::model()->delete($history_id);
            if ($result) {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Error !');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetAllHistoryOfARemind() {
        $remind_id = StringHelper::filterArrayString(Yii::app()->request->getPost('remind_id'));
        $data = HistoryRemind::model()->getAllHistoryOfARemind($remind_id);
        ResponseHelper::JsonReturnSuccess($data, 'Success');
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
