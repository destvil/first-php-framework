<?php

namespace app\controllers\admin;

use shop\App;
use shop\libs\Pagination;

class OrdersController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = App::$app->getProperty('pagination_orders');
        $order_count = \R::count('order');
        $pagination = new Pagination($page, $perpage, $order_count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order` . `id`, `order` . `user_id`, `order` . `status`, `order` . `date`, `order` . `update_at`, `order` . `currency`, `user` . `name`, ROUND(SUM(`order_product` . `price`), 2) AS `sum` FROM `order` JOIN `user` ON `order` . `user_id` = `user` . `id` JOIN `order_product` ON `order` . `id` = `order_product` . `order_id` GROUP BY `order` . `id` ORDER BY `order` . `status`, `order` . `id` LIMIT $start, $perpage");
        $this->setMeta('Список заказов');
        $this->set(compact('orders', 'pagination', 'order_count'));
    }

    public function viewAction()
    {
        $order_id = (int)$this->getRequest('id');
        $order = \R::getRow("SELECT `order` . *, `user` . `name`, ROUND(SUM(`order_product` . `price`), 2) AS `sum` FROM `order` JOIN `user` ON `order` . `user_id` = `user` . `id` JOIN `order_product` ON `order` . `id` = `order_product` . `order_id` WHERE `order` . `id` = ? GROUP BY `order` . `id` ORDER BY `order` . `status`, `order` . `id` LIMIT 1", [$order_id]);
        if(!$order) {
            throw new \Exception('Страница не найдена', 404);
        }
        $order_products = \R::getAll("SELECT order_product.*, product.alias FROM order_product INNER JOIN product ON order_product.product_id = product.id WHERE order_product.order_id = ?", [$order_id]);
        $this->setMeta('Подробности заказа №' . $order_id);
        $this->set(compact('order', 'order_products'));
    }

    public function changeAction()
    {
        $order_id = $this->getRequest('id');
        $status = !empty($_POST['status']) ? 2 : 1;
        $order = \R::load('order', $order_id);
        if(!$order) {
            throw new \Exception('Страница не найдена', 404);
        }
        $order->status = $status;
        $order->note = 'Измененный заказ №' . $order_id;
        $order->update_at = date("Y-m-d H:i:s");
        if(\R::store($order) == $order_id) {
            $_SESSION['success'] = 'Изменения сохранены';
        } else {
            $_SESSION['error'] = 'Произошла ошибка';
        }
        redirect();

    }

    public function deleteAction()
    {
        $order_id = $this->getRequest('id');
        $order = \R::load('order', $order_id);
        \R::trash($order);
        $_SESSION['success'] = 'Заказ удалён';
        redirect(ADMIN . '/orders/');
    }
}