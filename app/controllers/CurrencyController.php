<?php

namespace app\controllers;

use app\models\Cart;
use shop\App;

class CurrencyController extends AppController
{
    public function changeAction() {
        $currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
        if($currency && !empty(App::$app->getProperty('currencies')[$currency])) {
            setcookie('currency', $currency, time() + 3600*24*7, '/');
            Cart::recalc(App::$app->getProperty('currencies')[$currency]);
        }
        redirect();
    }
}