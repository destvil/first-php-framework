<?php

namespace app\models;

class Main
{
    public function getRecentlyViewed()
    {
        if(!empty($_COOKIE['recentlyViewed'])) {
            $recentlyViewed = $this->getAllRecentlyViewed();
            $recentlyViewed = explode('.', $recentlyViewed);
            return array_reverse(array_slice($recentlyViewed, -4));
        }
        return false;
    }

    public function getAllRecentlyViewed()
    {
        if(!empty($_COOKIE['recentlyViewed'])) {
            return $_COOKIE['recentlyViewed'];
        }
        return false;
    }
}