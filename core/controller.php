<?php

class Controller {

	public function __construct() {
		$q = isset( $_REQUEST['q'] ) ? $_REQUEST['q'] : '';
		switch( $q ) {
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
			if( false === $items['display'] ) continue;
			if( true === $items['optional'] ) continue;

			if( ! isset( $_POST[$key] ) ) 
				return false;

			if( isset( $items['max'] ) && strlen( $_POST[$key] ) > $items['max'] ) 
				return false;

			if( isset( $items['min'] ) && strlen( $_POST[$key] ) < $items['min'] ) 
				return false;


			$i[$key] = $_POST[$key];
		}

		return $i;
	}
}