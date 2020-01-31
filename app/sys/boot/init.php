<?php

ini_set('display_errors', 1);

date_default_timezone_set('Europe/Copenhagen');

spl_autoload_register(function($class) {
    require_once APP . 'sys/lib/modules/' . $class . '.php';
});

require APP . 'sys/boot/functions.php';
require APP . 'sys/boot/session.php';

lastVisit();