<?php

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

	public function loadView($view, $args = '', $single = false ) {
		if( $args != '') extract( $args );

		if( $single === true ) {
			require_once( 'views/' . $view );
		} else {
			require_once( 'views/header.php' );
			require_once( 'views/' . $view );
			require_once( 'views/footer.php' );
		}
	}



	public function validate( $items ) {

		$i = array();
		foreach( $items as $key => $items ) {
			if( 0 === $items[0] ) continue;
			if( false === $items[5] ) continue;

			if( 2 === $items[0] ) {
				if( ! isset( $_POST[$key] ) ) return false;
				else {
					$i[$key] = $_POST[$key];
					continue;
				}
			}

			if( ! isset( $_POST[$key] ) ) return false;
			if( strlen( $_POST[$key] ) < $items[3] ) return false;
			if( strlen( $_POST[$key] ) > $items[4] ) return false;

			$i[$key] = $_POST[$key];
		}

		return $i;
	}
}