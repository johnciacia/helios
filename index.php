<?php
require_once( 'config.php' );

mysql_connect( DB_HOST, DB_USERNAME, DB_PASSWORD ) or die( mysql_error() );
mysql_select_db( DB_DATABASE ) or die( mysql_error() );

session_start();
$_SESSION['user_id'] = 1;

switch( $_GET['p'] ) {

	case 'teacher':
		load('teacher');
		break;

	case 'standard':
		load('standard');
		break;

	case 'observation':
		load('observation');
		break;

	default:
		load('index');
}


function load( $controller ) {
	$a = ucfirst($controller) . 'Controller';
	require_once( "controllers/{$a}.php" );
	new $a;
}

class Controller {

	public function __construct() {
		if( ! isset( $_REQUEST['q'] ) ) {
			$this->read();
			return;
		}

		switch( $_REQUEST['q'] ) {
			case 'create':
				$this->create();
				break;
			case 'update':
				$this->update();
				break;
			case 'delete':
				$this->delete();
				break;
			default:
				$this->read();
		}
	}

	public function loadView($view, $args = '', $single = false ) {
		if( $args != '') extract( $args );

		if( $single === true ) {
			require_once( 'views/' . $view );
		} else {
			require_once( 'views/header.php' );
			require_once( 'views/' . $view );
			require_once( 'views/footer.php' );
		}
	}

	public function post_validate( $args ) {
		$set = array();
		foreach( $args as $arg ) {
			if( isset( $_POST[$arg] ) && $_POST[$arg] != '' )
				$set[] = $arg;
		}

		return count($set) == count($args);
	}

	public function validate( $items ) {

		$i = array();
		foreach( $items as $key => $items ) {
			if( '' === $items[0] ) continue;
			if( false === $items[4] ) continue;
			if( ! isset( $_POST[$key] ) ) return false;
			if( strlen( $_POST[$key] ) < $items[2] ) return false;
			if( strlen( $_POST[$key] ) > $items[3] ) return false;

			$i[$key] = $_POST[$key];
		}

		return $i;
	}
}

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

	public function getItem( $item_id ) {
		$item_id = (int)$item_id;
		if( $item_id == 0 ) return false;

		$query = mysql_query( "SELECT * FROM `{$this->table}` WHERE `id` = '$item_id'") or die(mysql_error());
		return mysql_fetch_assoc( $query );
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
		$items = $this->model->items;
		$values = $this->model->getItem( $_GET['id'] );
		foreach( $values as $key => $value )
			$items[$key]['value'] = $value;

		$this->loadView( 'update.php', array( 'items' => $items ) );
	}

	public function delete() {
		$this->model->delete( $_GET['id'] );
		header("Location: ?p={$this->controller}");
	}
}
?>