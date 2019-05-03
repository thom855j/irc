<?php

ini_set('display_errors', 1);

/** @var string Directory containing all of the site's files */

define('APP', dirname(__DIR__) . '/' . '../');

date_default_timezone_set('Europe/Copenhagen');

require APP . 'sys/boot/functions.php';
require APP . 'sys/boot/session.php';

lastVisit();