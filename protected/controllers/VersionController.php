<?php

class VersionController extends Controller {

    public $retVal;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionUpdateVersion() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $app_ver = StringHelper::filterString($request->getPost('app_ver'));
                $db_ver = StringHelper::filterString($request->getPost('db_ver'));
                $model = AppDbVer::model()->findByAttributes(array('id' => 1));
                $model->app_ver = $app_ver;
                $model->db_ver = $db_ver;
                if ($model->save(FALSE)) {
                    $this->retVal->status = 1;
                    $this->retVal->message = "Success";
                } else {
                    $this->retVal->status = 0;
                    $this->retVal->message = "Fail";
                }
                $this->retVal->data = "";
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionGetVersion() {
        try {
            $data = AppDbVer::model()->findAll();
            $this->retVal->data = $data;
            $this->retVal->message = "Success";
            $this->retVal->status = 1;
        } catch (exception $e) {
            $this->retVal->message = $e->getMessage();
        }
        echo CJSON::encode($this->retVal);
        Yii::app()->end();
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
