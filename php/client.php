<?php
require_once './vendor/autoload.php';

define('APP_PATH', dirname(__FILE__).'/app');
define('LOG_PATH', dirname(__FILE__).'/log');

\App\Client::test();
