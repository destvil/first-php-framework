<?php


namespace app\controllers\admin;


use app\models\admin\Users;
use shop\libs\Pagination;

class UsersController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 20;
        $count = \R::count('user');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $users = \R::findAll('user', "LIMIT $start, $perpage");
        $this->setMeta('Список пользователей');
        $this->set(compact('users', 'pagination', 'count'));
    }

    public function addAction()
    {
        $this->setMeta('Добавление пользователя');
    }

    public function editAction()
    {
        if(!empty($_POST)) {
            $id = $this->getRequest('id', false);
            $user = new Users();
            $data = $_POST;
            $user->load($data);
            if(!$user->attributes['password']) {
                unset($user->attributes['password']);
            } else {
                $user->attributes['password'] = password_hash($user->attributes['password'] , PASSWORD_DEFAULT);
            }
            if(!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                redirect();
            }
            if($user->update('user', $id)) {
                $_SESSION['success'] = 'Изменения сохранены';
            }
            redirect();
        }
        $user_id = $this->getRequest('id');
        $user = \R::load('user', $user_id);

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $order_count = \R::count('order', "user_id = ?", [$user_id]);
        $pagination = new Pagination($page, $perpage, $order_count);
        $start = $pagination->getStart();

        $user_orders = \R::getAll("SELECT `order` . `id`, `order` . `user_id`, `order` . `status`, `order` . `date`, `order` . `update_at`, `order` . `currency`, ROUND(SUM(`order_product` . `price`), 2) AS `sum` FROM `order` JOIN `order_product` ON `order` . `id` = `order_product` . `order_id` WHERE user_id = {$user_id} GROUP BY `order` . `id` ORDER BY `order` . `status`, `order` . `id` DESC LIMIT $start, $perpage");



        $this->setMeta("Редактирование профиля пользователя {$user['login']}");
        $this->set(compact('user', 'user_orders', 'pagination', 'order_count'));
    }

    public function deleteAction()
    {
        $id = $this->getRequest('id');
        //$data = \R::findMulti('user, order, order_product', 'SELECT `user`.*, `order`.*, order_product.* FROM `user` LEFT JOIN `order` ON `order`.user_id = `user`.id LEFT JOIN order_product ON order_product.order_id = `order`.id WHERE `user`.id = ?', [$id]);
        $user = \R::load('user', $id);
        if(!$user['id']) {
            $_SESSION['error'] = 'Произошла ошибка';
            redirect();
        }
        \R::trash($user);
        $_SESSION['success'] = 'Пользователь удалён';
        redirect();
    }

}