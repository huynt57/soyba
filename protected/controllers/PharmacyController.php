<?php

class PharmacyController extends Controller {

    public $retVal;

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetPharmacy() {
        $request = Yii::app()->request;
        try {
            $number = StringHelper::filterString($request->getQuery('number', NULL));
            $json = $request->getQuery('keywords', NULL);
            $offset = StringHelper::filterString($request->getQuery('offset', NULL));
            $keywords = json_decode($json);
            $data = Pharmacy::model()->getPharmacy($number, $offset, $keywords);
            ResponseHelper::JsonReturnSuccess($data, "Success");
        } catch (exception $e) {
            var_dump($e->getMessage());
        }
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
        header('Content-type: application/json');
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
            header('Content-type: application/json');
            echo CJSON::encode($this->retVal);
            Yii::app()->end();
        }
    }

    public function actionCreatePharmacy() {
        try {
            $attr = StringHelper::filterArrayString($_POST);
            if (Pharmacy::model()->createPharmacy($attr)) {
                ResponseHelper::JsonReturnSuccess("", "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Error");
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionCountRecord() {
        try {
            $data = Pharmacy::model()->findAll();
            $cnt = count($data);
            ResponseHelper::JsonReturnSuccess($cnt, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionCountRecordByUser() {
        try {
            $request = Yii::app()->request;
            $user_id = StringHelper::filterString($request->getPost('user_id'));
            $data = Pharmacy::model()->findAllByAttributes(array('user_id' => $user_id));
            $cnt = count($data);
            ResponseHelper::JsonReturnSuccess($cnt, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetPharmacyByUser() {
        try {
            $request = Yii::app()->request;
            $user_id = StringHelper::filterString($request->getQuery('user_id'));
            $data = Pharmacy::model()->findAllByAttributes(array('user_id' => $user_id));
            ResponseHelper::JsonReturnSuccess($data, 'Successss');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionSearcPharmacyByAddressAndKeywords() {
        try {
            $request = Yii::app()->request;
            $ward = StringHelper::filterString($request->getQuery('ward'));
            $district = StringHelper::filterString($request->getQuery('district'));
            $province = StringHelper::filterString($request->getQuery('province'));
            $limit = StringHelper::filterString($request->getQuery('number'));
            $offset = StringHelper::filterString($request->getQuery('offset'));
            $keywords = StringHelper::filterString($request->getQuery('keywords'));
            $data = Pharmacy::model()->searchByAddressAndKeywords($province, $district, $ward, $limit, $offset, $keywords);

            header('Content-type: application/json');
            echo CJSON::encode(array('status' => 1, 'count' => $data['cnt'], 'data' => $data['data'], 'message' => 'Success'));
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
