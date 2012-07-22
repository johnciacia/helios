<?php
require_once( './config.php' );
require_once( './core/controller.php' );
require_once( './core/model.php' );
require_once( './core/CRUD.php' );

mysql_connect( DB_HOST, DB_USERNAME, DB_PASSWORD ) or die( mysql_error() );
mysql_select_db( DB_DATABASE ) or die( mysql_error() );

session_start();
$_SESSION['user_id'] = 1;

$p = isset( $_GET['p'] ) ? $_GET['p'] : '';
switch( $p ) {

	case 'teacher':
		load('teacher');
		break;

	case 'standard':
		load('standard');
		break;

	case 'element':
		load('element');
		break;

	case 'indicator':
		load('indicator');
		break;

	case 'observation':
		load('observation');
		break;

	default:
		load('index');
}


function load( $controller ) {
	$a = ucfirst($controller) . 'Controller';
	require_once( "controllers/{$a}.php" );
	new $a;
}