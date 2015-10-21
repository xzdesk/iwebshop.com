<?php
define('START_TIME', microtime(true));
$iweb = dirname(__FILE__)."/lib/iweb.php";
$config = dirname(__FILE__)."/config/config.php";
require($iweb);
$iwebApp = IWeb::createWebApp($config)->run();
?>