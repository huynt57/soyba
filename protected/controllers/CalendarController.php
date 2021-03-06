<?php

class CalendarController extends Controller {

    public $title;
    public $layoutPath;
    public $layout;
    public $retVal;

    public function actionIndex() {
        $this->layoutPath = Yii::getPathOfAlias('webroot') . "/themes/classic/views/layouts";
        $this->layout = 'calendar';
        $this->render('index');
    }

    public function rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    public function actionGetCalendar() {
        $calendars = Patient::model()->getCalendar();
        foreach ($calendars as $i => $calendar) {

            $calendars[$i]["start"] = date("Y-m-d", strtotime($calendars[$i]["inject_day"]));
            $calendars[$i]["end"] = "";
            $calendars[$i]["title"] =  $calendars[$i]["name"];
            if ($calendars[$i]["done"] == 0) {
                $calendars[$i]["color"] = "#E29E19";
            } else {
                $calendars[$i]["color"] = "#80AC2E";
            }
        }
        echo CJSON::encode($calendars);
        Yii::app()->end();
    }

    public function actionUpdateCalendar() {
        $this->retVal = new stdClass;
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $update = StringHelper::filterString($request->getPost('start'));
                $id = StringHelper::filterString($request->getPost('id'));
                $model = PatientInjection::model()->findByAttributes(array('id' => $id));
                $model->inject_day = $update;
                $model->save();
            } catch (Exception $ex) {
                $this->retVal->message = $ex->getMessage();
            }
        }
        echo CJSON::encode($this->retVal);
        Yii::app()->end();
    }

    public function actionGetDetailCalendar() {
        $this->retVal = new stdClass;
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $id = StringHelper::filterString($request->getPost('id'));
                $data = Patient::model()->getDetailCalendar($id);
                $this->retVal->data = $data;
            } catch (Exception $ex) {
                $this->retVal->message = $ex->getMessage();
            }
        }
        echo CJSON::encode($this->retVal);
        Yii::app()->end();
    }

    public function actionUpdateDetailCalendar() {
        $this->retVal = new stdClass;
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $id = StringHelper::filterString($request->getPost('id'));
                //   $name = StringHelper::filterString($request->getPost('name'));
                $date = StringHelper::filterString($request->getPost('date'));
                $note = StringHelper::filterString($request->getPost('note'));
                $done = StringHelper::filterString($request->getPost('done'));

                Patient::model()->updatePatientCalendar($id, $done, $date, $note);
            } catch (Exception $ex) {
                $this->retVal->message = $ex->getMessage();
            }
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
