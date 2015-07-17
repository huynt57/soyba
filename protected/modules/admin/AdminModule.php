<?php

class AdminModule extends CWebModule {

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));
        $this->layoutPath = Yii::getPathOfAlias('webroot') . "/themes/classic/views/layouts";

        $this->layout = 'admin';
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            $controller->layout = 'admin';
            if ($action->id != "login") {
                if (Yii::app()->session['username'] == "") {
                    //  die();
                //    $controller->redirect(Yii::app()->createUrl('admin/home/login'));
                } else {
                    return true;
                }
            }
            return true;
        } else {
            return false;
        }
    }

}
