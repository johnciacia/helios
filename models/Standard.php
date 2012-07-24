<?php

namespace Models;

class Standard {
	use \CRUDModel;

	public $items = array(
		'id' => array( 0, '', 'hidden' ),
		'stdnumber' => array( 1, 'Number', 'text', 1, 10, true ),
		'title' => array( 1, 'Standard', 'text', 1, 255, true ),
		'desc' => array( 1, 'Description', 'textarea', 1, 5000, true ),
		'moredetail' => array( 1, 'Details', 'textarea', 1, 5000, true )
	);


	public function __construct() {
		$this->table = 'standard';
		$this->global = true;
	}
}