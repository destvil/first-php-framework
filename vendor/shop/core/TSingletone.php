<?php


namespace shop;

trait TSingletone {

    private static $instance;

    public static function instance()
    {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}