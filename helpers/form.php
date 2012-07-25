<?php


function input_type( $item, $id ) {
	switch( $item['type'] ) {
		case 'text':
			$value = isset( $item['value'] ) ? " value='{$item['value']}'" : '';
			return '<input type="text" name="' . $id . '" class="span4"' . $value . ' />';
		case 'password':
			$value = isset( $item['value'] ) ? " value='{$item['value']}'" : '';
			return '<input type="password" name="' . $id . '" class="span4"' . $value . ' />';
		case 'textarea':
			$value = isset( $item['value'] ) ? $item['value'] : '';
			return '<textarea name="' . $id . '" class="span6">' . $value . ' </textarea>';
		case 'dropdown':
			$value = isset( $item['value'] ) ? $item['value'] : '';
			return select( $item['cb_value'](), $id, $value );
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