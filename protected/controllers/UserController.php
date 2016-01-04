<?php

class UserController extends Controller {

    public $retVal;
    public $title;
    public $layoutPath;
    public $layout;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionLogin() {
        $this->layoutPath = Yii::getPathOfAlias('webroot') . "/themes/classic/views/layouts";
        $this->layout = 'empty';
        $this->render('login');
    }

    public function actionLoginGoogle() {
        
    }

    public function actionCreateUser() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $attr = StringHelper::filterArrayString($_POST);
                $result = User::model()->createUser($attr);
                if ($result) {
                    ResponseHelper::JsonReturnSuccess($result, 'Success');
                } else {
                    ResponseHelper::JsonReturnError('', 'Error');
                }
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }

    public function actionGetUser() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $check = FALSE;
                if (isset($_POST['facebook_id'])) {
                    $facebook_id = StringHelper::filterString($request->getPost('facebook_id'));
                    $user_id = User::model()->findByAttributes(array('facebook_id' => $facebook_id));
                    if ($user_id) {
                        $data = User::model()->findByAttributes(array('user_id' => $user_id->user_id));
                        $check = TRUE;
                    }
                } else if (isset($_POST['google_id'])) {
                    $google_id = StringHelper::filterString($request->getPost('google_id'));
                    $user_id = User::model()->findByAttributes(array('google_id' => $google_id));
                    if ($user_id) {
                        $data = User::model()->findByAttributes(array('user_id' => $user_id->user_id));
                        $check = TRUE;
                    }
                } else if (isset($_POST['user_id'])) {
                    $user_id = StringHelper::filterString($request->getPost('user_id'));
                    if ($user_id) {
                        $data = User::model()->findByAttributes(array('user_id' => $user_id));
                        $check = TRUE;
                    }
                }
                if ($check) {

                    $this->retVal->data = $data;
                    $this->retVal->status = 1;
                    $this->retVal->message = "Success";
                } else {

                    $this->retVal->data = NULL;
                    $this->retVal->status = 0;
                    $this->retVal->message = "User not exist";
                }
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            header('Content-type: application/json');
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionUpdateEmailAndPhone() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $user_id = StringHelper::filterString($request->getPost('user_id'));
                $email = StringHelper::filterString($request->getPost('email'));
                $phone = StringHelper::filterString($request->getPost('phone'));

                $user = User::model()->findByAttributes(array('user_id' => $user_id));
                if ($user) {
                    
                } else {
                    $this->retVal->data = "";
                    $this->retVal->status = 0;
                    $this->retVal->message = "User not exist";
                }
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            header('Content-type: application/json');
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionUpdateInfoUser() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
//                $user_id = StringHelper::filterString($request->getPost('user_id'));
//                $email = StringHelper::filterString($request->getPost('email'));
//                $phone = StringHelper::filterString($request->getPost('phone'));
//                $ward = StringHelper::filterString($request->getPost('ward'));
//                $province = StringHelper::filterString($request->getPost('province'));
//                $district = StringHelper::filterString($request->getPost('district'));
//                $address = StringHelper::filterString($request->getPost('address'));
                $attr = StringHelper::filterArrayString($_POST);

                if (User::model()->updateInfo($attr)) {
                    ResponseHelper::JsonReturnSuccess("", 'Success');
                } else {
                    ResponseHelper::JsonReturnError("", "Something wrong");
                }
            } catch (exception $e) {
                var_dump($e->getMessage());
            }

            Yii::app()->end();
        }
    }

    public function actionAddToken() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $device_token = StringHelper::filterString($request->getPost('device_token'));
                $platform = StringHelper::filterString($request->getPost('platform'));
                $user_id = StringHelper::filterString($request->getPost('user_id'));

                if (DeviceTk::model()->setTokenUser($device_token, $user_id, $platform)) {
                    ResponseHelper::JsonReturnSuccess('', 'Success');
                } else {
                    ResponseHelper::JsonReturnError('', 'Server Error');
                }
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
