<?php

use App\Controllers\Admin\OrdersController;
use Core\Views\Table;

include '../../../bootloader.php';

print (new OrdersController())->edit();