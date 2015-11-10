<?php

class HistoryRemindController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAdd() {
        //  $request = Yii::app()->request;
        try {
            $attr = StringHelper::filterArrayString($_POST);
            if (HistoryRemind::model()->add($attr)) {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Server Error !!');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionEdit() {
        $attr = StringHelper::filterArrayString($_POST);
        if (HistoryRemind::model()->edit($attr)) {
            ResponseHelper::JsonReturnSuccess('', 'Success');
        } else {
            ResponseHelper::JsonReturnError('', 'Server Error !!');
        }
    }

    public function actionDelete() {
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
