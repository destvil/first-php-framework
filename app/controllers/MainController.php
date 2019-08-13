<?php

namespace app\controllers;

use app\models\Main;
use shop\App;

class MainController extends AppController
{

    public function indexAction()
    {
        $brands = \R::find('brand', 'LIMIT 3');
        $hits = \R::find('product', "hit = '1' AND status = '1' LIMIT 8");
        $this->setMeta(App::$app->getProperty('shop_name'), 'shop, test, description', 'Ключевые_слова');
        $m_main = new Main(); // Main model
        // последние просмотренные товары
        $rv_id = $m_main->getRecentlyViewed();;
        $rv_item = null;
        if ($rv_id) {
            $rv_item = \R::find('product', ' id IN (' . \R::genSlots($rv_id) . ') ', $rv_id);
        }
        $this->set(compact('brands', 'hits', 'rv_item', 'rv_id'));
    }
}