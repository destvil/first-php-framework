<?php

namespace app\controllers\admin;

use shop\App;

class MainController extends AppController
{
    public function indexAction()
    {
        $count = [
            'newOrders' => \R::count('order', "status = '0'"),
            'users' => \R::count('user'),
            'products' => \R::count('product'),
            'categories' => \R::count('category')
        ];
        $this->set(compact('count'));
        $this->setMeta('Админ-панель | ' . App::$app->getProperty('shop_name'));
    }
}