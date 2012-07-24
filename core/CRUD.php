<?php

trait CRUDModel {
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
		$values = implode( ', ', $vals );

		return mysql_query( "INSERT INTO `{$this->table}` ($columns) VALUES($values)" );
	}

	/** 
	 *
	 */
	public function read( $cols = '' ) {
		$select = ( $cols === '' ) ? '*' : implode( ', ', $cols );
		$where = ( $this->global === false ) ? " WHERE `user_id` = " . $_SESSION['user_id'] : '';

		$query = mysql_query( "SELECT $select FROM `{$this->table}`$where") or die(mysql_error());
		$ret = array();
		while( $row = mysql_fetch_assoc( $query ) ) {
			$obj = new self;
			foreach( $row as $col => $val ) {
				$obj->items[$col]['value'] = $val;
				$obj->$col = $val;
			}

			$ret[] = $obj;	
		}

		return $ret;
	}

	public function getItem( $item_id ) {
		$item_id = (int)$item_id;
		if( $item_id == 0 ) return false;

		$query = mysql_query( "SELECT * FROM `{$this->table}` WHERE `id` = '$item_id'") or die(mysql_error());
		$res = mysql_fetch_assoc( $query );

		$obj = new self;

		foreach( $res as $key => $value ) {
			$obj->$key = $value;
			$obj->items[$key]['value'] = $value;
		}

		return $obj;
	}

	public function update( $id, $items ) {
		$id = (int)$id;

		$sets = array();
		$set = '';
		foreach( $items as $key => $value ) {
			$sets[] = "`$key` = '" . mysql_real_escape_string($value) . "'";
		}
		$set = implode( ', ', $sets );

		$query = "UPDATE `{$this->table}` SET $set WHERE `id` = '$id'";

		return mysql_query( $query ) or die(mysql_error());
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

trait CRUDController {
	public function create() {
		if( $items = $this->validate( $this->model->items ) ) {
			$this->model->create( $items );
			header("Location: ?p={$this->controller}");
		}

		$data = array( 'items' => $this->model->items );
		$this->loadView( 'add.php', $data );
	}

	public function read() {
		$data = array(
			'items' => $this->model->read(),
			'headings' => $this->model->items,
		);

		$this->loadView( 'read.php', $data );
	}

	public function update() {
		if( $items = $this->validate( $this->model->items ) ) {
			$this->model->update( $_GET['id'], $items );
			header("Location: ?p={$this->controller}");
		}

		$obj = $this->model->getItem( $_GET['id'] );
		$this->loadView( 'update.php', array( 'items' => $obj->items ) );
	}

	public function delete() {
		$this->model->delete( $_GET['id'] );
		header("Location: ?p={$this->controller}");
	}
}