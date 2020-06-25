<?php

use App\Controllers\Auth\RegisterController;

include '../bootloader.php';

print (new RegisterController())->index();