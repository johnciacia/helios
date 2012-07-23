<?php

namespace Models;

class Teacher {

	use \CRUDModel;

	public $items = array(
		'id' => array( '', 'hidden' ),
		'user_id' => array( '', 'hidden' ),
		'first_name' => array( 'First Name', 'text', 1, 255, true ),
		'last_name' => array( 'Last Name', 'text', 1, 255, true ),
		'teach_id' => array( 'Teacher ID', 'text', 1, 255, true ),
	);

	public function __construct() {
		$this->table = 'teacher';
		$this->global = false;
	}

}