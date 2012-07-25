<?php

namespace Models;

class Teacher {
	use \CRUDModel;

	public $items = array(
		'id' => array( 
			'display' => false
		),
		'user_id' => array( 
			'display' => false 
		),
		'first_name' => array( 
			'display' => true,
			'label' => 'First Name',
			'type' => 'text',
			'min' => 1,
			'max' => 255,
			'optional' => false
		),
		'last_name' => array( 
			'display' => true,
			'label' => 'Last Name',
			'type' => 'text',
			'min' => 1,
			'max' => 255,
			'optional' => false
		),
		'teach_id' => array( 
			'display' => true,
			'label' => 'Teacher ID',
			'type' => 'text',
			'min' => 1,
			'max' => 255,
			'optional' => false
		),
	);

	public function __construct() {
		$this->table = 'teacher';
		$this->global = false;
	}

	public function getTeacherById( $id ) {
		$obj = $this->getItem( $id );
		return $obj->first_name . ' ' . $obj->last_name;
	}
}