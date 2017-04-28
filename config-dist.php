<?php

$SITE_ADDRESS = 'http://localhost/candlesmag/';
$SITE_ROOT = 'C:/wamp/www/candlesmag/';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'opencart';

// HTTP, HTTPS
define('HTTP_SERVER', $SITE_ADDRESS);
define('HTTPS_SERVER', $SITE_ADDRESS);

// DIR
define('DIR_APPLICATION', $SITE_ROOT.'catalog/');
define('DIR_SYSTEM', $SITE_ROOT.'system/');
define('DIR_IMAGE', $SITE_ROOT.'image/');
define('DIR_LANGUAGE', $SITE_ROOT.'catalog/language/');
define('DIR_TEMPLATE', $SITE_ROOT.'catalog/view/theme/');
define('DIR_CONFIG', $SITE_ROOT.'system/config/');
define('DIR_CACHE', $SITE_ROOT.'system/storage/cache/');
define('DIR_DOWNLOAD', $SITE_ROOT.'system/storage/download/');
define('DIR_LOGS', $SITE_ROOT.'system/storage/logs/');
define('DIR_MODIFICATION', $SITE_ROOT.'system/storage/modification/');
define('DIR_UPLOAD', $SITE_ROOT.'system/storage/upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', $DB_USER);
define('DB_PASSWORD', $DB_PASS);
define('DB_DATABASE', $DB_NAME);
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');
