<?php

use App\Controllers\User\CatalogController;

include '../bootloader.php';

print (new CatalogController())->index();