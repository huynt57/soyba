<?php

class CrawlerController extends Controller {

    public function actionIndex() {
        $i = 1;

        for ($i = 1; $i < 2; $i++) {
            $simpleHTML = new SimpleHTMLDOM;
            $html = $simpleHTML->file_get_html("http://www.healthfamily.co/danh-sach-nha-thuoc-hieu-thuoc?p=$i&r=100#.VavHvXj0HuU");
            foreach ($html->find('div.h125') as $element)
            {
                $name = $element->find('h3 a')->innertext;
              //  $address = $element->find('p.date-time', 0)->innertext;
                $pharmacy = new Pharmacy;
                $pharmacy->name = $name;
                $pharmacy->address = "";
                $pharmacy->save(FALSE);
            }
            
            
        }
        $this->render('index');
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
