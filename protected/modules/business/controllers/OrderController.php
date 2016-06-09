<?php

class OrderController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionListOrderForProviderStaff() {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'phone',
            3 => 'email',
            4 => 'requirement',
            5 => 'created_at',
            6 => 'status',
            7 => 'action',
        );
        //  $request = Yii::app()->request;
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $column = $_REQUEST['order'][0]['column'];
        $order = $_REQUEST['order'][0]['dir'];
        $where = null;
        $criteria = new CDbCriteria;
        if (!empty($_REQUEST['search']['value'])) {
            $criteria->addSearchCondition("name", $_REQUEST['search']['value'], 'true', 'OR');
            $criteria->addSearchCondition("phone", $_REQUEST['search']['value'], 'true', 'OR');
            $criteria->addSearchCondition("email", $_REQUEST['search']['value'], 'true', 'OR');
            $criteria->addSearchCondition("requirement", $_REQUEST['search']['value'], 'true', 'OR');
            $where = true;
        }
        //echo $order;
        $criteria->limit = $length;
        $criteria->offset = $start;
        $criteria->order = "$columns[$column] $order";
        $criteria->condition = 'status = 1';
        // var_dump($start); die;
        $data = OrderMedlatec::model()->findAll($criteria);
        $returnArr = array();
        foreach ($data as $item) {
            $itemArr = array();
            $itemArr['id'] = $item->id;
            $itemArr['name'] = $item->name;
            $itemArr['phone'] = $item->phone;
            $itemArr['email'] = $item->email;
            $itemArr['requirement'] = $item->requirement;
            $itemArr['created_at'] = $item->created_at;
            $itemArr['status'] = $item->status;
            //   $edit_url = Yii::app()->createUrl('order/edit', array('oid' => $item->id));
            $action = '<a data-toggle="modal" data-target="#edit-order-modal"><span class="label label-primary">Sửa</span></a>';
            $action.='';
            $itemArr['action'] = $action;
            $returnArr[] = $itemArr;
        }

        echo json_encode(array('data' => $returnArr, "recordsTotal" => $count,
            "recordsFiltered" => $count));
    }

    public function actionListOrderForMebooStaff() {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'phone',
            3 => 'email',
            4 => 'requirement',
            5 => 'created_at',
            6 => 'status',
            7 => 'action',
        );
        //  $request = Yii::app()->request;
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $column = $_REQUEST['order'][0]['column'];
        $order = $_REQUEST['order'][0]['dir'];
        $where = null;
        $criteria = new CDbCriteria;
        if (!empty($_REQUEST['search']['value'])) {
            $criteria->addSearchCondition("name", $_REQUEST['search']['value'], 'true', 'OR');
            $criteria->addSearchCondition("phone", $_REQUEST['search']['value'], 'true', 'OR');
            $criteria->addSearchCondition("email", $_REQUEST['search']['value'], 'true', 'OR');
            $criteria->addSearchCondition("requirement", $_REQUEST['search']['value'], 'true', 'OR');
            $where = true;
        }
        //echo $order;
        $criteria->limit = $length;
        $criteria->offset = $start;
        $criteria->order = "$columns[$column] $order";
        $criteria->condition = 'status = 1';
        // var_dump($start); die;
        $data = OrderMedlatec::model()->findAll($criteria);
        $returnArr = array();
        foreach ($data as $item) {
            $itemArr = array();
            $itemArr['id'] = $item->id;
            $itemArr['name'] = $item->name;
            $itemArr['phone'] = $item->phone;
            $itemArr['email'] = $item->email;
            $itemArr['requirement'] = $item->requirement;
            $itemArr['created_at'] = $item->created_at;
            $itemArr['status'] = $item->status;
            //   $edit_url = Yii::app()->createUrl('order/edit', array('oid' => $item->id));
            $action = '<a data-toggle="modal" data-target="#edit-order-modal"><span class="label label-primary">Sửa</span></a>';
            $action.='';
            $itemArr['action'] = $action;
            $returnArr[] = $itemArr;
        }

        echo json_encode(array('data' => $returnArr, "recordsTotal" => $count,
            "recordsFiltered" => $count));
    }

    public function actionOrder() {
        $post = StringHelper::filterArrayString($_POST);
        $result = OrderMedlatec::model()->add($post);
        if ($result != FALSE) {
            ResponseHelper::JsonReturnSuccess($result, 'Success');
        } else {
            ResponseHelper::JsonReturnError('', 'Error');
        }
    }

    public function actionGetOrderByUser() {
        $request = Yii::app()->request;
        $user_id = StringHelper::filterString($request->getQuery('user_id'));
        $limit = StringHelper::filterString($request->getQuery('limit'));
        $offset = StringHelper::filterString($request->getQuery('offset'));
        $data = OrderMedlatec::model()->getOrderByUser($user_id, $limit, $offset);
        ResponseHelper::JsonReturnSuccess($data, 'Success');
    }

    public function actionGetResultByUser() {
        $request = Yii::app()->request;
        $user_id = StringHelper::filterString($request->getQuery('user_id'));
        $limit = StringHelper::filterString($request->getQuery('limit'));
        $offset = StringHelper::filterString($request->getQuery('offset'));
        $data = ResultMedlatec::model()->getResultByUser($user_id, $limit, $offset);
        ResponseHelper::JsonReturnSuccess($data, 'Success');
    }

    public function actionGetServices() {
        $data = ServiceMedlatec::model()->findAllByAttributes(array('status' => -3));
        ResponseHelper::JsonReturnSuccess($data, 'Success');
    }

    public function actionPushNotification() {
        
    }

    public function actionGetResultsOfOrder() {
        $request = Yii::app()->request;
        try {
            $order_id = StringHelper::filterString($request->getQuery('order_id'));
            $data = ResultMedlatec::model()->getResultOfOrder($order_id);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (exception $e) {
            var_dump($e->getMessage());
        }
        Yii::app()->end();
    }

    public function actionGetOrderById() {
        $request = Yii::app()->request;
        $order_id = StringHelper::filterString($request->getQuery('order_id'));
        $data = OrderMedlatec::model()->getOrderDetail($order_id);
        ResponseHelper::JsonReturnSuccess($data, 'Success');
    }

    public function actionCancelOrder() {
        $request = Yii::app()->request;
        $order_id = StringHelper::filterString($request->getQuery('order_id'));
        $order = OrderMedlatec::model()->findByPk($order_id);
        $order->status = -1;
        if ($order->save(FALSE)) {
            ResponseHelper::JsonReturnSuccess('', 'Success');
        } else {
            ResponseHelper::JsonReturnError('', 'Error !');
        }
    }

    public function actionGetOrderAndResult() {
        $request = Yii::app()->request;
        $order_id = StringHelper::filterString($request->getQuery('order_id'));
        $data = OrderMedlatec::model()->getOrderAndResult($order_id);
        ResponseHelper::JsonReturnSuccess($data, 'Success');
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
