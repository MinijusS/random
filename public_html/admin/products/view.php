<?php

use Core\Views\Form;
use Core\Views\Link;
use Core\Views\Table;

include '../../../bootloader.php';

print (new \App\Controllers\Admin\ProductController())->index();
