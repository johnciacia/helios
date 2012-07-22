<?php

class ObservationModel {

	public function add_observation() {
		
	}

	public function get_standards() {
		$query = mysql_query( "SELECT * FROM `standards`" ) or die(mysql_error());
		$standards = array();
		while( $standard = mysql_fetch_array( $query ) ) {
			$standards[] = $standard;
		}
		return $standards;
	}

	public function get_indicators($element_id) {
		$query = mysql_query( "SELECT * FROM `indicators` WHERE `element_id` = '$element_id'" ) or die(mysql_error());
		$indicators = array();
		while( $indicator = mysql_fetch_array( $query ) ) {
			$indicators[] = $indicator;
		}
		return $indicators;
	}

	public function get_elements( $standard_id ) {
		$standard_id = (int)$standard_id;
		if( $standard_id == 0 ) return false;

		$query = mysql_query( "SELECT * FROM `elements` WHERE `standard_id` = '$standard_id'" ) or die(mysql_error());
		$elements = array();
		while( $standard = mysql_fetch_array( $query ) ) {
			$elements[] = $standard;
		}
		return $elements;		
	}


}

?>