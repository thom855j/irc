<?php

require_once dirname(__FILE__) . '/app/sys/boot/init.php';


//session_clear(APP . );

if(file_exists(APP . 'sys/var/www/' . $_GET['id'] . '.php')) {

	require_once(APP . 'sys/var/www/templates/header.php');

	require_once(APP . 'sys/var/www/' . $_GET['id'] . '.php');

	require_once(APP . 'sys/var/www/templates/footer.php');

} elseif( session()['auth'] ) {

    require_once(APP . 'sys/var/www/templates/header.php');

	require_once(APP . 'sys/var/www/terminal.php');

	require_once(APP . 'sys/var/www/templates/footer.php');

} else {

    require_once(APP . 'sys/var/www/templates/header.php');

	require_once(APP . 'sys/var/www/login.php');

	require_once(APP . 'sys/var/www/templates/footer.php');

}