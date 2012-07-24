<?php

namespace Models;

class Indicator {
	use \CRUDModel;

	public $items = array(
		'id' => array( 0, '', 'hidden' ),
		'element_id' => array( 1, 'Element', 'text', 1, 10, true ),
		'desc' => array( 1, 'Description', 'textarea', 1, 5000, true ),
	);


	public function __construct() {
		$this->table = 'indicator';
		$this->global = true;
	}

	public function getIndicatorsByElement( $element_id ) {
		$element_id = (int)mysql_real_escape_string( $element_id );
		if( 0 === $element_id ) return false;

		$query = mysql_query( "SELECT * FROM `{$this->table}` WHERE `element_id` = '$element_id'") or die(mysql_error());
		$x = array();
		while( $y = mysql_fetch_assoc( $query ) ) {
			$x[] = $y;
		}
		return $x;
	}

}