<?php

namespace App;

use Core\Databases\FileDB;
use Core\Router;
use Core\Session;

/**
 * Class App
 */
class App
{
    public static $db;

    public static $session;

    public function __construct()
    {
        self::$db = new FileDB(DB_FILE);
        self::$db->load();
        self::$session = new Session();
    }

    public function __destruct()
    {
        self::$db->save();
    }

    public function run() {
        print Router::run();
    }

}