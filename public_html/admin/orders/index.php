<?php

include '../../../bootloader.php';

print (new \App\Controllers\Admin\OrdersController())->index();