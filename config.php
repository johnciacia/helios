<?php

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'helios');

error_reporting( E_ALL );

function pp( $a ) {
	echo "<pre>" . print_r( $a, true ) . "</pre>";
}
?>
