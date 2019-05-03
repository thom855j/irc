<?php 

// Load sys
require dirname(__FILE__) . '/app/sys/boot/init.php';

// Load modules
require APP . 'sys/lib/modules/encryptor.php';


if(isset($_POST['input']) && $_GET['action'] == 'login'){

	// Load login script
	require APP . 'sys/lib/scripts/auth.php';
}

if(session()['auth'] && $_GET['action'] == 'input'){

	// Load input script
	require APP . 'sys/lib/scripts/input.php';
}

if(session()['auth'] && $_GET['action'] == 'request'){

	// Load request script
	require APP . 'sys/lib/scripts/request.php';
}

if(session()['auth'] && $_GET['action'] == 'logout'){ 

	// Load logout script
	require APP . 'sys/lib/scripts/logout.php';
}


