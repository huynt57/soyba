<?php

class UserController extends Controller {

    public $retVal;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionCreateUser() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $facebook_id = StringHelper::filterString($request->getPost('facebook_id'));
                $google_id = StringHelper::filterString($request->getPost('google_id'));
                $dob = StringHelper::filterString($request->getPost('dob'));
                $user_id = StringHelper::filterString($request->getPost('user_id'));
                $gender = StringHelper::filterString($request->getPost('gender'));
                $facebook_access_token = StringHelper::filterString($request->getPost('facebook_access_token'));
                $photo = StringHelper::filterString($request->getPost('photo'));

                $attr = array('facebook_id' => $facebook_id, 'google_id' => $google_id,
                    'dob' => $dob, 'user_id' => $user_id, 'gender' => $gender,
                    'facebook_access_token' => $facebook_access_token, 'photo' => $photo);

                $user_model = new User;
                $user_model->setAttributes($attr, FALSE);
                $user_model->save(FALSE);
                $this->retVal->message = "Success";
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
