<?php

include '../../bootloader.php';

print (new \App\Controllers\User\OrderIndexController())->index();