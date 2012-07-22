<?php

class Model {

	private $table;
	private $global;
	/**
	 * array( 
	 *	[0] => Title
	 *	[1] => Form Type
	 *	[2] => Min Length
	 *	[3] => Max Length
	 *	[4] => false indicates form field is optional | true indicates form field is mandatory
	 * )
	 */
	private $items;

}