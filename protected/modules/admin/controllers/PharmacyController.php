<?php

class PharmacyController extends Controller {

    public $retVal;

    public function actionIndex() {
        $phars = Pharmacy::model()->findAll();
        $this->render('index', array('phars' => $phars));
    }

    public function actionGetDetail() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $id = StringHelper::filterString($request->getPost('id'));
                $data = Pharmacy::model()->findByAttributes(array('id' => $id));
                $this->retVal->data = $data;
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionDelete() {
        $request = Yii::app()->request;
        $id = $request->getQuery("id");

        $delete = Pharmacy::model()->findByAttributes(array('id' => $id));
        $delete->delete();
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
