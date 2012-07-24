<?php
require_once( './config.php' );
require_once( './core/controller.php' );
require_once( './core/model.php' );
require_once( './core/CRUD.php' );

mysql_connect( DB_HOST, DB_USERNAME, DB_PASSWORD ) or die( mysql_error() );
mysql_select_db( DB_DATABASE ) or die( mysql_error() );

session_start();
$_SESSION['user_id'] = 1;

$p = isset( $_GET['p'] ) ? $_GET['p'] : '';
switch( $p ) {

	case 'teacher':
		load('teacher');
		break;

	case 'standard':
		load('standard');
		break;

	case 'element':
		load('element');
		break;

	case 'indicator':
		load('indicator');
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

function input_type( $item, $id ) {
	switch( $item['type'] ) {
		case 'text':
			$value = isset( $item['value'] ) ? " value='{$item['value']}'" : '';
			return '<input type="text" name="' . $id . '" class="span4"' . $value . ' />';
		case 'textarea':
			$value = isset( $item['value'] ) ? $item['value'] : '';
			return '<textarea name="' . $id . '" class="span6">' . $value . ' </textarea>';
		case 'dropdown':
			return select( $item['cb_value'](), $id, $item['value'] );
	}
}

function select( $values, $id, $default = '' ) {
	$out = "<select class='span4' name='$id'>";
	foreach( $values as $value ) {
		if( $default == $value->id )
			$out .= "<option value='{$value->id}' selected>{$value->title}</option>";
		else
			$out .= "<option value='{$value->id}'>{$value->title}</option>";
	}
	return $out . "</select>";
}