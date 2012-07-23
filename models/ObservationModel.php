<?php

class ObservationModel {
	use CRUDModel;
	
	public $items = array(
			'id' => array( '', 'hidden' ),
			'user_id' => array( '', 'hidden' ),
			'teacher_id' => array( 'Teacher', 'text', 1, 11, true ),
			'date' => array( 'Date', 'text', 1, 11, true ),
			'indicators' => array( '', 'hidden')
		);

	public function __construct() {
		$this->global = false;
		$this->table = 'observations';
	}

	public function create( $items ) {
		if( $this->global === false )
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
		$values = implode(', ', $vals );

		return mysql_query( "INSERT INTO `{$this->table}` ($columns) VALUES($values)" );
	}
}

?>