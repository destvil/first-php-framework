<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\User;
use shop\App;

class CartController extends AppController
{
    public function addAction()
    {
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $mod_id = !empty($_GET['mod']) ? (int)$_GET['mod'] : null;
        $product = null;
        $mod = null;
        if ($id) {
            $product = \R::findOne('product', 'id = ?', [$id]);
            if (!$product) return false;
            if ($mod_id) {
                $mod = \R::findOne('modification', 'id = ? AND product_id = ?', [$mod_id, $id]);
            }
        }
        $cart = new Cart();
        $cart->addToCart($product, $qty, $mod);
        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function showAction()
    {
        $this->loadView('cart_modal');
    }

    public function deleteAction()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        if (isset($_SESSION['cart'][$id])) {
            $cart = new Cart();
            $cart->deleteItem($id);
        }
        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function clearAction()
    {
        Cart::deleteAllItem();
        $this->loadView('cart_modal');
    }

    public function viewAction()
    {
        $this->setMeta('Оформление заказа');
    }

    public function checkoutAction()
    {
        if (!empty($_POST)) {
            if (!User::isAuthorized()) {
                $_SESSION['error'] = 'Для продолжения необходимо авторизироваться';
                redirect(PATH . '/user/login');
            }
            // сохранение заказа
            if (!isset($_SESSION['user']['id'], $_SESSION['user']['email'])) {
                $_SESSION['error'] = 'Произошла ошибка при оформлении заказа,попробуйте позже.';
                redirect();
            }
            $data['user_id'] = $_SESSION['user']['id'];
            $data['currency'] = $_SESSION['cart.currency']['code'];
            $data['note'] = !empty($_POST['note']) ? trim(hsc($_POST['note'])) : '';
            $user_email = $_SESSION['user']['email'];
            $order = new Order();
            $order->load($data);
            if ($order_id = $order->saveOrder()) {
                $_SESSION['success'] = 'Ваш заказ успешно оформлен! В ближайшее время с Вами свяжется менеджер для согласования заказа';
            } else {
                $_SESSION['error'] = 'Произошла ошибка!';
                redirect();
            }
            //Order::mailOrder($order_id, $user_email); // Отправка email менеджеру и клиенту
            //mailOrder::deleteAllItem(); // Очистка корзины
        }
        redirect(PATH);
    }

}