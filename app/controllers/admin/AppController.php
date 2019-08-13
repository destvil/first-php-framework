<?php


namespace app\controllers\admin;

use app\models\AppModel;
use app\models\User;
use shop\base\Controller;

class AppController extends Controller
{
    public $layout = 'admin';
    public function __construct($route)
    {
        parent::__construct($route);
        if(!User::isAdmin() && $route['controller'] != 'Login' && $route['action'] != '') {
            redirect(ADMIN . '/login');

        }
        new AppModel();
    }

    public function getRequest($id = 'id', $get = true) {
        if($get) {
            $data = $_GET;
        } else {
            $data = $_POST;
        }
        $id = !empty($data[$id]) ? $data[$id] : null;
        if(!$id) {
            throw new \Exception('Страница не найдена', 404);
        }
        return $id;
    }
}