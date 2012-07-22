<?php

class TeacherController extends Controller {

	use CRUDController;
	public function __construct() {
		require_once('models/TeacherModel.php');
		$this->model = new TeacherModel();
		$this->controller = 'teacher';
		parent::__construct();
	}
}