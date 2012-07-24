<?php

namespace Models;

class Teacher {
	use \CRUDModel;

	public $items = array(
		'id' => array( 0, '', 'hidden' ),
		'user_id' => array( 0, '', 'hidden' ),
		'first_name' => array( 1, 'First Name', 'text', 1, 255, true ),
		'last_name' => array( 1, 'Last Name', 'text', 1, 255, true ),
		'teach_id' => array( 1, 'Teacher ID', 'text', 1, 255, true ),
	);

	public function __construct() {
		$this->table = 'teacher';
		$this->global = false;
	}

}