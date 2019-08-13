<?php


namespace app\controllers\admin;

use app\models\admin\Product;
use app\models\AppModel;
use shop\App;
use shop\libs\Pagination;

class ProductController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('product');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $products = \R::getAll("SELECT product.*, category.title AS cat FROM product JOIN category ON category.id = product.category_id ORDER BY product.title LIMIT $start, $perpage");
        $this->setMeta('Список товаров');
        $this->set(compact('products', 'pagination', 'count'));
    }

    public function editAction()
    {
        if(!empty($_POST)) {
            $id = $this->getRequest('id', false);
            $product = new Product();
            $data = $_POST;
            $product->load($data);
            $product->attributes['status'] = $product->attributes['status'] ? 2 : 1;
            $product->attributes['hit'] = $product->attributes['hit'] ? 2 : 1;
            $product->attributes['alias'] = AppModel::createAlias('product', 'alias', $data['title'], $id);
            $product->getImg();
            if(!$product->validate($data)) {
                $product->getErrors();
                redirect();
            }
            if($product->update('product', $id)) {
                $product->editFilter($id, $data);
                $product->editRelatedProduct($id, $data);
                $product->editImg($id);
                $product->editGallery($id);
                $_SESSION['success'] = 'Товар добавлен';
            }
            redirect();

        }
        $id = $this->getRequest('id');
        $product = \R::load('product', $id);
        App::$app->setProperty('parent_id', $product->category_id);
        $filter = \R::getCol('SELECT attr_id FROM attribute_product WHERE product_id = ?', [$id]);
        $related_product = \R::getAll("SELECT related_product.related_id, product.title FROM related_product JOIN product ON related_product.related_id = product.id WHERE related_product.product_id = ?", [$id]);
        $gallery = \R::getCol('SELECT img FROM gallery WHERE product_id = ?', [$id]);
        $this->setMeta("Редактирование товара: {$product->title}");
        $this->set(compact('product', 'filter', 'related_product', 'gallery'));
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            $product = new Product();
            $data = $_POST;
            $product->load($data);
            $product->attributes['status'] = $product->attributes['status'] ? 2 : 1;
            $product->attributes['hit'] = $product->attributes['hit'] ? 2 : 1;
            $product->getImg();

            if (!$product->validate($data)) {
                $product->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }
            if ($id = $product->save('product')) {
                $product->createDir($id);
                $product->editImg($id);
                $product->editGallery($id);
                $product->attributes['alias'] = AppModel::createAlias('product', 'alias', $data['title'], $id);
                $product->update('product', $id);
                $product->editFilter($id, $data);
                $product->editRelatedProduct($id, $data);
                $_SESSION['success'] = 'Товар добавлен';
            }
            redirect();
        }

        if ($this->isAjax()) {
            if ($_FILES['file']['name']) {
                if (!$_FILES['file']['error']) {
                    $name = md5(rand(100, 200));
                    $ext = explode('.', $_FILES['file']['name']);
                    $filename = $name . '.' . $ext[1];
                    $destination = WWW . '/upload/images/downloads/' . $filename; //change this directory
                    $location = $_FILES["file"]["tmp_name"];
                    move_uploaded_file($location, $destination);
                    echo '/public/upload/images/downloads/' . $filename;//change this URL
                } else {
                    echo $message = 'Ошибка! Ваша загрузка вызвала следующую ошибку: ' . $_FILES['file']['error'];
                }
            }
            die;
        }

        $this->setMeta('Новый товар');
    }

    public function deleteAction()
    {
        $id = $this->getRequest('id');
        $user = \R::loadAll('user', $id);
        if(!$user['id']) {
            $_SESSION['error'] = 'Произошла ошибка';
            redirect();
        }
        \R::trash($user);
        $_SESSION['success'] = 'Товар удалён';
        redirect();
    }

    public function relatedProductAction()
    {
        $q = isset($_GET['q']) ? $_GET['q'] : '';
        $data['items'] = [];
        $products = \R::getAssoc('SELECT id, title FROM product WHERE title LIKE ? LIMIT 10', ["%{$q}%"]);
        if($products) {
            $i = 0;
            foreach ($products as $id => $title) {
                $data['items'][$i]['id'] = $id;
                $data['items'][$i]['text'] = $title;
                $i++;
            }
        }
        echo json_encode($data);
        die;
    }

    public function addImageAction()
    {
        if(isset($_GET['upload'])) {
           if($_POST['name'] == 'single') {
               $wmax = App::$app->getProperty('img_width');
               $hmax = App::$app->getProperty('img_height');
           }
           else if($_POST['name'] == 'multi') {
               $wmax = App::$app->getProperty('gallery_width');
               $hmax = App::$app->getProperty('gallery_height');
           } else {
               throw new \Exception('Страница не найдена', 404);
           }
           $name = $_POST['name'];
           $product = new Product();
           $product->uploadImg($name, $wmax, $hmax);
        }
    }

    public function deleteImageAction()
    {
        if(isset($_GET['img_del']) && isset($_GET['img_type'])) {
            $product = new Product();
            $product->deleteImage($_GET['img_del'], $_GET['img_type']);
        }
    }

}