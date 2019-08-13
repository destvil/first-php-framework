<?php


namespace app\controllers\admin;


use shop\Cache;

class CacheController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Кэширование');
    }

    public function deleteAction()
    {
        $key = isset($_GET['key']) ? $_GET['key'] : null;
        $cache = Cache::instance();
        switch ($key) {
            case 'category':
                $cache->delete('cats');
                $cache->delete('ishop_menu');
                break;
            case 'filter':
                $cache->delete('filter_group');
                $cache->delete('filter_attrs');
                break;
            default:
                throw new \Exception('Страница не найдена', 404);
        }
        $_SESSION['success'] = 'Выбранный кэш удалён';
        redirect();
    }
}