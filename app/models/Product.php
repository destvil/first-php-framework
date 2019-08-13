<?php

namespace app\models;

class Product extends AppModel
{
    public function setRecentlyViewed($id)
    {
        $recentlyViewed = $this->getAllRecentlyViewed();
        if(!$recentlyViewed) {
            setcookie('recentlyViewed', $id, time() + 3600 * 48, '/');
        } else {
            $recentlyViewed = explode('.', $recentlyViewed);
            if(!in_array($id, $recentlyViewed)) {
                $recentlyViewed[] = $id;
                $recentlyViewed = implode('.', $recentlyViewed);
                setcookie('recentlyViewed', $recentlyViewed, time() + 3600 * 48, '/');
            } else {
                array_splice($recentlyViewed, array_search($id, $recentlyViewed), 1);
                array_push($recentlyViewed, $id);
                $recentlyViewed = implode('.', $recentlyViewed);
                setcookie('recentlyViewed', $recentlyViewed, time() + 3600 * 48, '/');
            }
        }
    }

    public function getAllRecentlyViewed()
    {
        if(!empty($_COOKIE['recentlyViewed'])) {
            return $_COOKIE['recentlyViewed'];
        }
        return false;
    }
}