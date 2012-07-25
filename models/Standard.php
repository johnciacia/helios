<?php

namespace Models;

class Standard {
	use \CRUDModel;

	public $items = array(
		'id' => array( 
			'display' => false
		),
		'stdnumber' => array( 
			'display' => true,
			'label' => 'Number',
			'type' => 'text',
			'min' => 1,
			'max' => 10,
			'optional' => false
		),
		'title' => array( 
			'display' => true,
			'label' => 'Standard',
			'type' => 'text',
			'min' => 1,
			'max' => 255,
			'optional' => false
		),
		'desc' => array( 
			'display' => true,
			'label' => 'Description',
			'type' => 'text',
			'min' => 1,
			'max' => 5000,
			'optional' => false
		),
		'moredetail' => array( 
			'display' => true,
			'label' => 'Details',
			'type' => 'text',
			'min' => 1,
			'max' => 5000,
			'optional' => false
		)
	);


	public function __construct() {
		$this->table = 'standard';
		$this->global = true;
	}

	public function getTitleById( $id ) {
		$item = $this->getItem( $id );
		return $item->title;
	}
}