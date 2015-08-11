<?php

class PharmacyController extends Controller {

    public $retVal;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetPharmacy() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        try {
            $number = StringHelper::filterString($request->getQuery('number', NULL));
          //  var_dump($number);
            $json = $request->getQuery('keywords', NULL);
            $offset = StringHelper::filterString($request->getQuery('offset', NULL));
            //   $json = '"'.$json.'"';
            $keywords = json_decode($json);

            $Criteria = new CDbCriteria;
            $Criteria->select = "*";
            if (!empty($keywords)) {
                foreach ($keywords as $address) {                 
                    $Criteria->addSearchCondition('address', $address);
                }
            }
            if (!empty($number)) {
                $Criteria->limit = $number;
            }
            if (!empty($offset)) {
                $Criteria->offset = $offset;
            }
        //    var_dump($Criteria);
       //     die();
            $results = Pharmacy::model()->findAll($Criteria);
            $this->retVal->data = $results;
        } catch (exception $e) {
            $this->retVal->message = $e->getMessage();
        }
        echo CJSON::encode($this->retVal);
        Yii::app()->end();
    }

    public function actionGetPharmacyCount() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        try {

            $json = $request->getQuery('keywords');

            $keywords = json_decode($json);

            $Criteria = new CDbCriteria;
            $Criteria->select = "*";
            if (!empty($keywords)) {
                foreach ($keywords as $address) {
                    $Criteria->addSearchCondition('address', $address);
                }
            }
            $results = Pharmacy::model()->findAll($Criteria);
            $this->retVal->count = count($results);
        } catch (exception $e) {
            $this->retVal->message = $e->getMessage();
        }
        echo CJSON::encode($this->retVal);
        Yii::app()->end();
    }

    public function actionAddPharmacyCoordinates() {
        $this->retVal = new stdClass();
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $id = StringHelper::filterString($request->getPost('id'));
                $pharmacy = Pharmacy::model()->findByAttributes(array('id' => $id));
                $lat = StringHelper::filterString($request->getPost('lat'));
                $lng = StringHelper::filterString($request->getPost('lng'));
                $pharmacy->laititude = $lat;
                $pharmacy->longitude = $lng;
                if ($pharmacy->save(FALSE)) {
                    $this->retVal->message = "Success";
                } else {
                    $this->retVal->message = "Server Error";
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
