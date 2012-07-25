<?php

namespace Models;

class Indicator {
	use \CRUDModel;

	public $items = array(
		'id' => array( 
			'display' => false
		),
		'element_id' => array(
			'display' => true,
			'label' => 'Element',
			'type' => 'dropdown',
			'optional' => false,
			'cb_value' => array( __CLASS__, 'cb_value' ),
			'cb_display' => array( __CLASS__, 'cb_display' )
		),
		'desc' => array( 
			'display' => true,
			'label' => 'Description',
			'type' => 'text',
			'min' => 1,
			'max' => 5000,
			'optional' => false
		)
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

	public static function cb_display( $id ) {
		$element = new Element();
		return $id;
		// return $element->getTitleById( $id );
	}

	public static function cb_value() {
		$element = new Element();
		return $element->read();
	}
}