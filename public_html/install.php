<?php
include '../bootloader.php';

App\App::$db->createTable('users');
App\App::$db->createTable('pixels');
App\App::$db->createTable('drinks');
App\App::$db->createTable('orders');
App\App::$db->createTable('items');
