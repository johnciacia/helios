<?php

class TeacherModel {

	/**
	 * @todo: update all querys to use the proper user_id
	 */

	public function __construct() {

	}

	/**
	 * @todo: return proper boolean value
	 */
	public function add_teacher( $first_name, $last_name, $teach_id) {
		$first_name = mysql_real_escape_string($first_name);
		$last_name = mysql_real_escape_string($last_name);
		$teach_id = (int)mysql_real_escape_string($teach_id);
		mysql_query( "INSERT INTO `teacher` (user_id, first_name, last_name, teach_id) VALUES(".$_SESSION['user_id'].", '$first_name', '$last_name', '$teach_id')") or die(mysql_error());
		return true;
	}

	public function get_teachers() {
		$query = mysql_query( "SELECT * FROM `teacher` WHERE `user_id` = " . $_SESSION['user_id']) or die(mysql_error());
		$teachers = array();
		while( $teacher = mysql_fetch_array( $query ) ) {
			$teachers[] = $teacher;
		}
		return $teachers;
	}

	public function delete_teacher($teacher_id) {
		$teacher_id = (int)mysql_real_escape_string($teacher_id);
		if( $teacher_id == 0 ) return false;

		$query = mysql_query( "DELETE FROM `teacher` WHERE `user_id` = '".$_SESSION['user_id']."' AND `id` = '$teacher_id'") or die(mysql_error());
		return true;
	}

	public function get_teacher( $teacher_id ) {
		$teacher_id = (int)$teacher_id;
		if( $teacher_id == 0 ) return false;

		$query = mysql_query( "SELECT * FROM `teacher` WHERE `id` = '$teacher_id'") or die(mysql_error());
		return mysql_fetch_assoc( $query );
	}

	public function update_teacher( $id, $first_name, $last_name, $teach_id ) {
		$id = (int)$id;
		$teach_id = (int)$teach_id;
		$first_name = mysql_real_escape_string($first_name);
		$last_name = mysql_real_escape_string($last_name);

		$query = mysql_query( "UPDATE `teacher` SET `first_name` = '$first_name', `last_name` = '$last_name', `teach_id` = '$teach_id' WHERE `id` = '$id'") or die(mysql_error());
	}

}

?>