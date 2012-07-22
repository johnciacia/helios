<?php

class Standard {

	private $table;
	/**
	 * array( 
	 *	[0] => Title
	 *	[1] => Form Type
	 *	[2] => Min Length
	 *	[3] => Max Length
	 *	[4] => false indicates form field is optional | true indicates form field is mandatory
	 * )
	 *
	 *
	 */
	public $items = array(
			'id' => array( '', 'hidden' ),
			'stdnumber' => array( 'Number', 'text', 1, 10, true ),
			'title' => array( 'Standard', 'text', 1, 255, true ),
			'desc' => array( 'Description', 'textarea', 1, 255, true ),
			'moredetail' => array( 'Details', 'textarea', 1, 255, true )
		);


	public function __construct() {
		$this->table = strtolower( __CLASS__ );
		$this->global = false;
	}

	public function create( $items ) {

		if( $this->global === false )
			$items['user_id'] = $_SESSION['user_id'];

		$cols = array(); $columns = '';
		$vals = array(); $values = '';
		foreach( $items as $key => $value ) {
			$cols[] = '`' . $key . '`';
			$vals[] = "'" . mysql_real_escape_string( $value ) . "'";
		}

		$columns = implode( ', ', $cols );
		$values = implode(', ', $vals );

		return mysql_query( "INSERT INTO `{$this->table}` ($columns) VALUES($values)" );
	}

	/** 
	 *
	 */
	public function read( $cols = '' ) {

		$select = ( $cols === '' ) ? '*' : implode( ', ', $cols );
		$where = ( $this->global === false ) ? " WHERE `user_id` = " . $_SESSION['user_id'] : '';

		$query = mysql_query( "SELECT $select FROM `{$this->table}`$where") or die(mysql_error());
		$x = array();
		while( $y = mysql_fetch_assoc( $query ) ) {
			$x[] = $y;
		}
		return $x;
	}

	public function update() {

	}

	/**
	 * Deletes a record
	 *
	 * @param int $id Primary key of the record to delete.
	 * @return bool Returns TRUE on success or FALSE on error.
	 */
	public function delete( $id ) {
		if( $this->global === true && !isset( $_SESSION['user_id'] ) ) return -1;

		
		$id = (int)mysql_real_escape_string( $id );
		if( $id == 0 ) return false;

		if( $this->global === false ) {
			$query = "DELETE FROM `{$this->table}` 
				WHERE `user_id` = '{$_SESSION['user_id']}' 
				AND `id` = '$id'";
		} else {
			$query = "DELETE FROM `{$this->table}` WHERE `id` = '$id'";
		}

		return mysql_query( $query );
	}

}