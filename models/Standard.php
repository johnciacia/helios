<?php

namespace Models;

class Standard {
	use \CRUDModel;

	public $items = array(
			'id' => array( '', 'hidden' ),
			'stdnumber' => array( 'Number', 'text', 1, 10, true ),
			'title' => array( 'Standard', 'text', 1, 255, true ),
			'desc' => array( 'Description', 'textarea', 1, 5000, true ),
			'moredetail' => array( 'Details', 'textarea', 1, 5000, true )
		);


	public function __construct() {
		$this->table = 'standard';
		$this->global = true;
	}

}