<?php
require_once './vendor/autoload.php';

define('APP_PATH', dirname(__FILE__).'/app');
define('LOG_PATH', dirname(__FILE__).'/log');

//启动服务,等待客户端调用
\App\Run::run();

