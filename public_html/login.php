<?php

use App\Controllers\Auth\LoginController;

include '../bootloader.php';

print (new LoginController())->index();