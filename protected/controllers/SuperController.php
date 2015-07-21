<?php

class SuperController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionNuclearPower() 
        {
            $patient = Patient::model()->findAll();
            $patient->delete();
            
            $patient_injection = PatientInjection::model()->findAll();
            $patient_injection->delete();
            
            $patient_sick = PatientSick::model()->findAll();
            $patient_sick->delete();
            
            $patient_user = UserPatient::model()->findAll();
            $patient_user->delete();
        }
        
        public function actionSuperAPI()
        {
            
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