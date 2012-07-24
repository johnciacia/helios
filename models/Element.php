<?php

namespace Models;

class Element {
	use \CRUDModel;

	public $items = array(
		'id' => array( 
			'display' => false
		),
		'type' => array( 
			'display' => false
		),
		'standard_id' => array(
			'display' => true,
			'label' => 'Standard',
			'type' => 'dropdown',
			'optional' => false,
			'cb_value' => array( __CLASS__, 'cb_value' ),
			'cb_display' => array( __CLASS__, 'cb_display' )
		),
		'number' => array( 
			'display' => true,
			'label' => 'Number',
			'type' => 'text',
			'min' => 1,
			'max' => 10,
			'optional' => false
		),
		'title' => array( 
			'display' => true,
			'label' => 'Element',
			'type' => 'textarea',
			'min' => 1,
			'max' => 5000,
			'optional' => false
		),
		'indicators' => array( 
			'display' => true,
			'label' => 'Indicators',
			'type' => 'textarea',
			'min' => 1,
			'max' => 5000,
			'optional' => false
		)
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

	public static function cb_display( $id ) {
		return $id;
	}

	public static function cb_value() {
		$standard = new Standard();
		return $standard->read();
	}

}