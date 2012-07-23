<?php

namespace Models;

class Element {
	use \CRUDModel;

	public $items = array(
		'id' => array( '', 'hidden' ),
		'standard_id' => array( '', 'hidden' ),
		'type' => array( '', 'hidden' ),
		'number' => array( 'Number', 'text', 1, 10, true ),
		'title' => array( 'Standard', 'textarea', 1, 5000, true ),
		'indicators' => array( 'Indicators', 'textarea', 1, 5000, true )
	);

	public $relations = array(
		'standard' => array( 'Standard', 'standard_id' )
	);

	public function __construct() {
		$this->table = 'element';
		$this->global = true;
	}

	public function getElementsByStandard( $standard_id ) {
		$standard_id = (int)mysql_real_escape_string( $standard_id );
		if( 0 === $standard_id ) return false;

		$query = mysql_query( "SELECT * FROM `{$this->table}` WHERE `standard_id` = '$standard_id'") or die(mysql_error());
		$x = array();
		while( $y = mysql_fetch_assoc( $query ) ) {
			$x[] = $y;
		}
		return $x;
	}

	public function standard( $id = '' ) {
		if( $id == '' )
			$id = $this->standard_id;

		$class = 'models\\'. $this->relations['standard'][0];
		$obj = new $class;
		return $obj->getItem( $id );
	}

}