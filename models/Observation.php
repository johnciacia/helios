<?php

namespace Models;

class Observation {
	use \CRUDModel;
	
	public $items = array(
		'id' => array( 
			'display' => false
		),
		'user_id' => array( 
			'display' => false
		),
		'element_id' => array(
			'display' => false
		),
		'teacher_id' => array(
			'display' => true,
			'label' => 'Teacher',
			'type' => 'dropdown',
			'optional' => false,
			'cb_value' => array( __CLASS__, 'cb_teacher_value' ),
			'cb_display' => array( __CLASS__, 'cb_teacher_display' )
		),
		'date' => array( 
			'display' => true,
			'label' => 'Date',
			'type' => 'text',
			'min' => 1,
			'max' => 255,
			'optional' => false
		),
		'indicators' => array( 
			'display' => false,
			'label' => 'Indicators',
			'type' => 'table',
			'optional' => true,
		)
	);

	public function __construct() {
		$this->global = false;
		$this->table = 'observations';
	}

	public function create( $items ) {
		if( false === $this->global )
			$items['user_id'] = $_SESSION['user_id'];

		$cols = array(); $columns = '';
		$vals = array(); $values = '';
		foreach( $items as $key => $value ) {
			$cols[] = '`' . $key . '`';
			if( 'indicators' == $key ) {
				$vals[] = "'" . json_encode( $value ) . "'";
			} else
				$vals[] = "'" . mysql_real_escape_string( $value ) . "'";
		}

		$columns = implode( ', ', $cols );
		$values = implode( ', ', $vals );

		return mysql_query( "INSERT INTO `{$this->table}` ($columns) VALUES($values)" );
	}

	public static function cb_teacher_display( $id ) {
		$obj = new Teacher();
		return $obj->getTeacherById( $id );
	}

	public static function cb_teacher_value() {
		$obj = new Teacher();
		$values = $obj->read();
		foreach( $values as &$value )
			$value->title = $value->first_name . ' ' . $value->last_name;

		return $values;
	}
}

?>