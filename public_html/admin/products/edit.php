<?php

use App\Controllers\Admin\ProductController;

include '../../../bootloader.php';

print (new ProductController())->edit();