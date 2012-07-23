<?php

class TeacherController extends Controller {

	use CRUDController;
	public function __construct() {
		$this->model = new Models\Teacher();
		$this->controller = 'teacher';
		parent::__construct();
	}
}