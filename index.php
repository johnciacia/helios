<?php
require_once( 'config.php' );

mysql_connect( DB_HOST, DB_USERNAME, DB_PASSWORD ) or die( mysql_error() );
mysql_select_db( DB_DATABASE ) or die( mysql_error() );

session_start();
$_SESSION['user_id'] = 1;

switch( $_GET['p'] ) {

	case 'teacher':
		load('teacher');
		break;

	case 'standard':
		load('standard');
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

class Controller {

	public function __construct() {
		if( ! isset( $_REQUEST['q'] ) ) {
			$this->read();
			return;
		}

		switch( $_REQUEST['q'] ) {
			case 'create':
				$this->create();
				break;
			case 'update':
				$this->update();
				break;
			case 'delete':
				$this->delete();
				break;
			default:
				$this->read();
		}
	}

	public function loadView($view, $args = '') {
		if( $args != '') extract( $args );
		require_once( 'views/' . $view );
	}

	public function post_validate( $args ) {
		$set = array();
		foreach( $args as $arg ) {
			if( isset( $_POST[$arg] ) && $_POST[$arg] != '' )
				$set[] = $arg;
		}

		return count($set) == count($args);
	}

	public function validate( $items ) {

		$i = array();
		foreach( $items as $key => $items ) {
			if( 'id' === $key ) continue;
			if( false === $items[4] ) continue;
			if( ! isset( $_POST[$key] ) ) return false;
			if( strlen( $_POST[$key] ) < $items[2] ) return false;
			if( strlen( $_POST[$key] ) > $items[3] ) return false;

			$i[$key] = $_POST[$key];
		}

		return $i;
	}
}
?>