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
                $google_id = StringHelper::filterString($request->getPost('google_id'));
                $facebook_id = StringHelper::filterString($request->getPost('facebook_id'));
                $user_id = StringHelper::filterString($request->getPost('user_id'));
                $gender = StringHelper::filterString($request->getPost('gender'));
                $facebook_access_token = StringHelper::filterString($request->getPost('facebook_access_token'));
                $photo = StringHelper::filterString($request->getPost('photo'));
                $name = StringHelper::filterString($request->getPost('name'));
                $email = StringHelper::filterString($request->getPost('email'));
                $attr = array('facebook_id' => $facebook_id, 'google_id' => $google_id,
                    'user_id' => $user_id, 'gender' => $gender,
                    'facebook_access_token' => $facebook_access_token, 'photo' => $photo, 'name' => $name,
                    'email' => $email, 'last_updated' => time());
                $user_exist_facebook = User::model()->findByAttributes(array('facebook_id' => $facebook_id));
                $user_exist_google = User::model()->findByAttributes(array('google_id' => $google_id));
                if ($user_exist_facebook && $user_exist_facebook->facebook_id != NULL && $facebook_id != NULL) {
                    $user_exist_facebook->setAttributes($attr);
                    if ($user_exist_facebook->save(FALSE)) {
                        $this->retVal->message = "Success";
                        $this->retVal->user_data = $user_exist_facebook->user_id;
                        $this->retVal->data = $user_exist_facebook->user_id;
                        $this->retVal->status = 1;
                        
                    }
                } else if ($user_exist_google && $user_exist_google->google_id != NULL && $google_id != NULL) {
                    $user_exist_google->setAttributes($attr);
                    if ($user_exist_google->save(FALSE)) {
                        $this->retVal->message = "Success";
                        $this->retVal->user_data = $user_exist_google->user_id;
                         $this->retVal->data = $user_exist_google->user_id;
                        $this->retVal->status = 1;
                    }
                } else {
                    $user_model = new User;
                    $user_model->setAttributes($attr);
                    if ($user_model->save(FALSE)) {
                        $this->retVal->message = "Success";
                        $this->retVal->user_data = $user_model->user_id;
                        $this->retVal->data = $user_model->user_id;
                        $this->retVal->status = 1;
                    }
                }
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionGetUser() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                if (isset($_POST['facebook_id'])) {
                    $facebook_id = StringHelper::filterString($request->getPost('facebook_id'));
                    $user_id = User::model()->findByAttributes(array('facebook_id' => $facebook_id));
                    $data = User::model()->findByAttributes(array('user_id' => $user_id->user_id));
                    $this->retVal->user_data = $data;
                    $this->retVal->data = $data;
                    $this->retVal->status = 1;
                    $this->retVal->message = "Success";
                } else if (isset($_POST['google_id'])) {
                    $google_id = StringHelper::filterString($request->getPost('google_id'));
                    $user_id = User::model()->findByAttributes(array('google_id' => $google_id));
                    $data = User::model()->findByAttributes(array('user_id' => $user_id->user_id));
                    $this->retVal->user_data = $data;
                    $this->retVal->data = $data;
                    $this->retVal->status = 1;
                    $this->retVal->message = "Success";
                } else {
                    $user_id = StringHelper::filterString($request->getPost('user_id'));
                    $data = User::model()->findByAttributes(array('user_id' => $user_id));
                    $this->retVal->user_data = $data;
                    $this->retVal->data = $data;
                    $this->retVal->status = 1;
                    $this->retVal->message = "Success";
                }
            } catch (exception $e) {
                $this->retVal->message = $e->getMessage();
            }
            echo CJSON::encode($this->retVal);
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
