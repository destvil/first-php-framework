<?php


namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Product;
use shop\App;

class ProductController extends AppController
{
    public function viewAction() {
        $alias = $this->route['alias'];
        $product = \R::findOne('product', "alias = ? AND status = '1'", [$alias]);
        if(!$product) {
            throw new \Exception('Страница не найдена', 404);
        }
        // запись в куки запрошенного товара
        $p_model = new Product();
        $p_model->setRecentlyViewed($product->id);
        // хлебные крошки
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);

        // связанные товары
        $related = \R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ? LIMIT 3", [$product->id]);

        // просмотреныне товары

        // галерея
        $gallery = \R::findAll('gallery', 'product_id = ?', [$product->id]);
        // модификации
        $mods = \R::findAll('modification', 'product_id = ?', [$product->id]);

        $this->setMeta($product['title'] . ' | ' . App::$app->getProperty('shop_name'), $product['description'] , $product['keywords']);
        $this->set(compact('product', 'related', 'gallery', 'breadcrumbs', 'mods'));
    }
}