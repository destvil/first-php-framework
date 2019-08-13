<?php


namespace app\models\admin;


use app\models\AppModel;

class Product extends AppModel
{
    public $attributes = [
        'title' => '',
        'category_id' => '',
        'keywords' => '',
        'description' => '',
        'price' => '',
        'old_price' => '',
        'content' => '',
        'status' => '',
        'hit' => '',
        'alias' => '',
        'img' => 'no_image.jpg',
    ];

    public $rules = [
        'required' => [
            ['title'],
            ['category_id'],
            ['price']
        ],
        'integer' => [
            ['category_id']
        ],
        'numeric' => [
            ['price'],
            ['old_price']
        ]
    ];

    public function createDir($id) {
        if(!file_exists(WWW . '/images/products/' . $id)) {
            mkdir(WWW . '/images/products/' . $id, 0700);
        }
    }

    public function editRelatedProduct($id, $data) {
        $related_product = \R::getCol('SELECT related_id FROM related_product WHERE product_id = ?', [$id]);
        if(empty($data['related']) && !empty($related_product)) {
            \R::exec("DELETE FROM related_product WHERE product_id = ?", [$id]);
            return;
        }
        // если добавляются связанные товары
        if(empty($related_product) && !empty($data['related'])) {
            $sql_part = '';
            foreach ($data['related'] as $v) {
                $v = (int)$v;
                $sql_part .= "($id, $v),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO related_product (product_id, related_id) VALUES $sql_part");
            return;
        }
        // если изменились связанные товары - удалим и запишем новые
        if(!empty($data['related'])) {
            $result = array_diff($related_product, $data['related']);
            if(!empty($result) || count($related_product) != count($data['related'])) {
                \R::exec("DELETE FROM related_product WHERE product_id = ?", [$id]);
                $sql_part = '';
                foreach ($data['related'] as $v) {
                    $v = (int)$v;
                    $sql_part .= "($id, $v),";
                }
                $sql_part = rtrim($sql_part, ',');
                \R::exec("INSERT INTO related_product (product_id, related_id) VALUES $sql_part");
            }
            return;
        }
    }

    public function editFilter($id, $data)
    {
        $data['attrs'] = array_diff($data['attrs'], [0]);
        $filter = \R::getCol('SELECT attr_id FROM attribute_product WHERE product_id = ?', [$id]);
        // если менеджер убрал фильтры - удаляем их
        if(empty($data['attrs']) && !empty($filter)) {
            \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);
            return;
        }
        // если фильтры добавляются
        if(empty($filter) && !empty($data['attrs'])) {
            $sql_part = '';
            foreach ($data['attrs'] as $v) {
                $sql_part .= "($v, $id),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO attribute_product (attr_id, product_id) VALUES $sql_part");
            return;
        }
        // если изменились фильтры - удалим и запишем новые
        if(!empty($data['attrs'])) {
            $result = array_diff($data['attrs'],$filter);
            if(isset($result)) {
                \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);
                $sql_part = '';
                foreach ($data['attrs'] as $v) {
                    $sql_part .= "($v, $id),";
                }
                $sql_part = rtrim($sql_part, ',');
                \R::exec("INSERT INTO attribute_product (attr_id, product_id) VALUES $sql_part");
            }
            return;
        }
    }

    public function getImg()
    {
        if(!empty($_SESSION['single'])) {
            $this->attributes['img'] = $_SESSION['single'];
        }
    }

    public function editImg($id)
    {
        if(!empty($_SESSION['single']) && !empty($_SESSION['old_single']) && $_SESSION['single'] != $_SESSION['old_single']) { // Если не пустые массивы и их значения не совпадают,то удаляем старое изображение и добавляем новое.
            if (file_exists(WWW . '/images/products/'. $id . '/' . $_SESSION['old_single'])) {
                unlink(WWW . '/images/products/'. $id . '/' . $_SESSION['old_single']);
            }
            rename(WWW . '/images/upload/' . $_SESSION['single'], WWW . '/images/products/' . $id . '/' . $_SESSION['single']);
            unset($_SESSION['single'],$_SESSION['single']);
            return;
        }

        if(!empty($_SESSION['old_single'])) {
            if (file_exists(WWW . '/images/products/'. $id . '/' . $_SESSION['old_single']))
                unlink(WWW . '/images/products/' . $id . '/' . $_SESSION['old_single']);
            unset($_SESSION['single'],$_SESSION['single']);
            return;
        }

        if(!empty($_SESSION['single'])) {
            rename(WWW . '/images/upload/' . $_SESSION['single'], WWW . '/images/products/' . $id . '/' . $_SESSION['single']);
            unset($_SESSION['single'],$_SESSION['single']);
            return;
        }
    }

    public function editGallery($id)
    {
        // Вычисляем старые и новые изображения ,а также удаляем старые из БД
        $gallery = \R::getAssoc("SELECT gallery.id,gallery.img FROM gallery WHERE product_id = ?", [$id]);
        if(!isset($_SESSION['multi'])) {
            return;
        }
        if(empty($_SESSION['multi']) && !empty($gallery)) {
            \R::exec("DELETE FROM gallery WHERE product_id = ?", [$id]);
        }

        $old_image = array_diff($gallery,$_SESSION['multi']);
        if(!empty($old_image)) {
            $old_image_bean = \R::loadAll('gallery', array_keys($old_image));
            \R::trashAll($old_image_bean); // удаляем старые записи из бд
        }
        //Удаляем старые изображения из директории
        foreach ($old_image as $image) {
            if (file_exists(WWW . '/images/products/'. $id . '/' . $image)) {
                unlink(WWW . '/images/products/'. $id . '/' . $image);
            }
        }

        $new_image = array_diff($_SESSION['multi'],$gallery);
        if(!empty($new_image)) {
            // Добавляем в БД галереи новые записи
            $sql_part = '';
            foreach ($new_image as $k => $image) {
                if (!file_exists(WWW . '/images/upload/' . $image)) {
                    unset($new_image[$k]);
                    continue;
                }
                $sql_part .= "('{$image}', $id),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO gallery (img, product_id) VALUES $sql_part");
            // Переносим новые изображение в директорию продукта
            foreach ($new_image as $image) {
                rename(WWW . '/images/upload/' . $image, WWW . '/images/products/' . $id . '/' . $image);
            }
        }
        unset($_SESSION['multi']);
    }

    function moveImages($id)
    {
        $curr_path = WWW . '/images/upload/';
        $new_path = WWW . '/images/products/' . $id . '/';
        if(!file_exists($new_path)) {
            mkdir($new_path, 0700);
        }
        if(file_exists($curr_path . $_SESSION['single'])) {
            rename($curr_path . $_SESSION['single'], $new_path . $_SESSION['single']);
        }
        foreach ($_SESSION['multi'] as $v) {
            if(file_exists($curr_path . $v)) {
                rename($curr_path . $v, $new_path . $v);
            }
        }
        unset($_SESSION['single'],$_SESSION['multi']);
    }

    public function updateGallery($id) {
        // Вычисляем старые и новые изображения ,а также удаляем старые из БД
        $product_gallery = \R::getAssoc("SELECT gallery.id,gallery.img FROM gallery WHERE product_id = $id");
        $new_image = array_diff($_SESSION['multi'],$product_gallery);
        $old_image = array_diff($product_gallery,$_SESSION['multi']);
        $old_image_id = array_keys($old_image);
        $old_image_bean = \R::loadAll('gallery', $old_image_id);
        \R::trashAll($old_image_bean); // удаляем старые записи из бд

        //Удаляем старые изображения из директории
        foreach ($old_image as $image) {
            if (file_exists(WWW . '/images/products/'. $id . '/' . $image)) {
                unlink(WWW . '/images/products/'. $id . '/' . $image);
            }
        }

        if(!empty($new_image)) {
            // Добавляем в БД галереи новые записи
            $sql_part = '';
            foreach ($new_image as $k => $image) {
                if (!file_exists(WWW . '/images/upload/' . $image)) {
                    unset($new_image[$k]);
                    continue;
                }
                $sql_part .= "('{$image}', $id),";
            }

            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO gallery (img, product_id) VALUES $sql_part");
            // Переносим новые изображение в директорию продукта
            foreach ($new_image as $image) {
                rename(WWW . '/images/upload/' . $image, WWW . '/images/products/' . $id . '/' . $image);
            }
        }
    }

    public function saveGallery($id) {
        if(!empty($_SESSION['multi'])) {
            $sql_part = '';
            for($i = 0; $i < count($_SESSION['multi']); $i++) {
                if (!file_exists(WWW . '/images/upload/' . $_SESSION['multi'][$i])) {
                    unset($_SESSION['multi'][$i]);
                    continue;
                }
                $sql_part .= "('{$_SESSION['multi'][$i]}', $id),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO gallery (img, product_id) VALUES $sql_part");
        }
    }

    public function deleteImage($name, $type)
    {
        if(preg_match('/^[\w,\s-]+\.[A-Za-z]{1,}$/', $name)) {
            if ($type == 'single') {
                unlink(WWW . '/images/upload/' . $name);
                unset($_SESSION['single']);
            } else if ($type == 'multi') {
                unlink(WWW . '/images/upload/' . $name);
                $_SESSION['multi'] = array_diff($_SESSION['multi'], [$name]);
            }
            $res = array("success" => "Удаление завершено");
        } else {
            $res = array("error" => "Произошла ошибка при удалении файла");
        }
        exit(json_encode($res));
    }

    public function uploadImg($name, $wmax, $hmax)
    {
        $uploaddir = WWW . '/images/upload/';
        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
        $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
        if($_FILES[$name]['size'] > 1048576){
            $res = array("error" => "Ошибка! Максимальный вес файла - 1 Мб!");
            exit(json_encode($res));
        }
        if($_FILES[$name]['error']){
            $res = array("error" => "Ошибка! Возможно, файл слишком большой.");
            exit(json_encode($res));
        }
        if(!in_array($_FILES[$name]['type'], $types)){
            $res = array("error" => "Допустимые расширения - .gif, .jpg, .png");
            exit(json_encode($res));
        }
        $new_name = md5(time()).".$ext";
        $uploadfile = $uploaddir.$new_name;
        if(@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)){
            if($name == 'single'){
                $_SESSION['single'] = $new_name;
            }else{
                $_SESSION['multi'][] = $new_name;
            }
            self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
            $res = array("file" => $new_name);
            exit(json_encode($res));
        }
    }

    /**
     * @param string $target путь к оригинальному файлу
     * @param string $dest путь сохранения обработанного файла
     * @param string $wmax максимальная ширина
     * @param string $hmax максимальная высота
     * @param string $ext расширение файла
     */
    public static function resize($target, $dest, $wmax, $hmax, $ext)
    {
        list($w_orig, $h_orig) = getimagesize($target);
        $ratio = $w_orig / $h_orig; // =1 - квадрат, <1 - альбомная, >1 - книжная

        if(($wmax / $hmax) > $ratio){
            $wmax = $hmax * $ratio;
        }else{
            $hmax = $wmax / $ratio;
        }

        $img = "";
        // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
        switch($ext){
            case("gif"):
                $img = imagecreatefromgif($target);
                break;
            case("png"):
                $img = imagecreatefrompng($target);
                break;
            default:
                $img = imagecreatefromjpeg($target);
        }
        $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

        if($ext == "png"){
            imagesavealpha($newImg, true); // сохранение альфа канала
            $transPng = imagecolorallocatealpha($newImg,0,0,0,127); // добавляем прозрачность
            imagefill($newImg, 0, 0, $transPng); // заливка
        }

        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение
        switch($ext){
            case("gif"):
                imagegif($newImg, $dest);
                break;
            case("png"):
                imagepng($newImg, $dest);
                break;
            default:
                imagejpeg($newImg, $dest);
        }
        imagedestroy($newImg);
    }

}