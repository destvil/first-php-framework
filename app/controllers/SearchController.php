<?php


namespace app\controllers;


use shop\App;

class SearchController extends AppController
{
    public function indexAction()
    {
        $query = !empty(trim($_GET['s'])) ? trim($_GET['s']) : null;
        if($query) {
            $products = \R::find('product', "WHERE status = '1' AND title LIKE ?", ["%{$query}%"]);
        }
        $this->setMeta('Поиск по: ' . hsc($query) . ' | ' . App::$app->getProperty('shop_name'));
        $this->set(compact('products', 'query'));
    }

    public function typeaheadAction()
    {
        if ($this->isAjax()) {
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if($query) {
                $products = \R::getAll('SELECT id, title FROM product WHERE status = "1" AND title LIKE ? LIMIT 7', ["%{$query}%"]);
                echo json_encode($products);
            }
        }
        die;
    }
}