<?php
declare(strict_types=1);
session_start();

define('ROOT', __DIR__);
define('DB_FILE', ROOT . '/app/data/db.json');
define('HASH_SALT', '$2a$07$minijusavickaszjbszjbs$');

//Loading core functions
require 'core/functions/form/core.php';
require 'core/functions/form/validators.php';
require 'core/functions/file.php';
require 'core/functions/html.php';
require 'core/functions/auth.php';

//Loading project specific functions
require 'app/functions/form/functions.php';
require 'vendor/autoload.php';

$app = new App\App();
