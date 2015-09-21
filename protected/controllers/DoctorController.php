<?php

class DoctorController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionAddDoctor()
        {
            try {
                $attr = StringHelper::filterArrayString($_POST);
                if(Doctors::model()->addDoctor($attr))
                {
                    ResponseHelper::JsonReturnSuccess("", "Success");
                } else {
                    ResponseHelper::JsonReturnError("", "Server Error");
                }
            } catch (Exception $ex) {
                var_dump($ex->getMessage());
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