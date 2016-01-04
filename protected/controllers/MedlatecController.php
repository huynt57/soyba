<?php

class MedlatecController extends Controller {

    public function actionIndex() {
        $this->render('index');
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
        $data = ServiceMedlatec::model()->findAll();
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
