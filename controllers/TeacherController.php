<?php

class TeacherController extends Controller {

	use CRUDController;
	public function __construct() {
		require_once('models/Teacher.php');
		$this->model = new Teacher();
		$this->controller = 'teacher';
		parent::__construct();
	}
}