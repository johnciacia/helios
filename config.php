<?php

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'helios');

error_reporting( E_ALL );

function pp( $a ) {
	echo "<pre>" . print_r( $a, true ) . "</pre>";
}

function __autoload( $class_name ) {
	$path = explode( '\\', $class_name );
	$class = array_pop( $path );
	$path = strtolower(implode( DIRECTORY_SEPARATOR, $path ));

	require_once( "$path/{$class}.php" );	
	
}
?>
