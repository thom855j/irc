<?php

define('APP', dirname(__DIR__) . '/app/');

require_once APP . 'sys/boot/init.php';


if(file_exists(APP . 'sys/var/www/' . Request::get('id') . '.php')) {

	require_once(APP . 'sys/var/www/templates/header.php');

	require_once(APP . 'sys/var/www/' . Request::get('id') . '.php');

	require_once(APP . 'sys/var/www/templates/footer.php');

} elseif( Session::exists('auth') ) {

    require_once(APP . 'sys/var/www/templates/header.php');

	require_once(APP . 'sys/var/www/terminal.php');

	require_once(APP . 'sys/var/www/templates/footer.php');

} else {

    require_once(APP . 'sys/var/www/templates/header.php');

	require_once(APP . 'sys/var/www/login.php');

	require_once(APP . 'sys/var/www/templates/footer.php');

}