<?php

class HistoryRemindController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

<<<<<<< HEAD
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
=======
    public function actionAdd() {
        //  $request = Yii::app()->request;
        try {
            $attr = StringHelper::filterArrayString($_POST);
            if (HistoryRemind::model()->add($attr)) {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Server Error !!');
>>>>>>> d58cb7318a3f20d35f763274fdd13e4053bbf17b
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionEdit() {
<<<<<<< HEAD
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
=======
        $attr = StringHelper::filterArrayString($_POST);
        if (HistoryRemind::model()->edit($attr)) {
            ResponseHelper::JsonReturnSuccess('', 'Success');
        } else {
            ResponseHelper::JsonReturnError('', 'Server Error !!');
>>>>>>> d58cb7318a3f20d35f763274fdd13e4053bbf17b
        }
    }

    public function actionDelete() {
<<<<<<< HEAD
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

=======
        $id = StringHelper::filterArrayString(Yii::app()->request->getPost('id'));
        if (HistoryRemind::model()->edit($id)) {
            ResponseHelper::JsonReturnSuccess('', 'Success');
        } else {
            ResponseHelper::JsonReturnError('', 'Server Error !!');
        }
    }

    public function actionGetAllHistoryOfARemind() {
        $remind_id = StringHelper::filterArrayString(Yii::app()->request->getPost('remind_id'));
        $data = HistoryRemind::model()->getAllHistoryOfARemind($remind_id);
        ResponseHelper::JsonReturnSuccess($data, 'Success');
    }

>>>>>>> d58cb7318a3f20d35f763274fdd13e4053bbf17b
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
