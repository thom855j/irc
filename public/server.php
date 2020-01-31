<?php 

define('APP', dirname(__DIR__) . '/app/');


// Load sys
require APP . 'sys/boot/init.php';

// Load modules
require APP . 'sys/lib/modules/encryptor.php';


if(Request::get('input') && Request::get('action') == 'login'){

	// Load login script
	require APP . 'sys/lib/scripts/auth.php';
}

if(Session::exists('auth') && Request::get('action') == 'input'){

	// Load input script
	require APP . 'sys/lib/scripts/input.php';
}

if(Session::exists('auth') && Request::get('action') == 'request'){

	// Load request script
	require APP . 'sys/lib/scripts/request.php';
}

if(Session::exists('auth') && Request::get('action') == 'logout'){ 

	// Load logout script
	require APP . 'sys/lib/scripts/logout.php';
}


