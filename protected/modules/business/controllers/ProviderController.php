<?php

class ProviderController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    
    public function actionGetProvider()
    {
        
    }
    
    public function actionRegister() {
        $image_preview = null;
        $post = StringHelper::filterArrayString($_POST);
        if ($_FILES['image']['error'] != 4) {
            $image_preview = UploadHelper::getUrlUploadSingleImage($_FILES['image'], 'service_image');
            $post['image'] = $image_preview;
        }
        if (Provider::model()->add($post)) {
            ResponseHelper::JsonReturnSuccess('', 'Success');
        } else {
            ResponseHelper::JsonReturnError('', 'Error');
        }
    }

    public function actionRegisterStaff() {
        $image_preview = null;
        $post = StringHelper::filterArrayString($_POST);
        if ($_FILES['image']['error'] != 4) {
            $image_preview = UploadHelper::getUrlUploadSingleImage($_FILES['image'], 'service_image');
            $post['avatar'] = $image_preview;
        }
        if (Provider::model()->registerStaff($post)) {
            ResponseHelper::JsonReturnSuccess('', 'Success');
        } else {
            ResponseHelper::JsonReturnError('', 'Error');
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
