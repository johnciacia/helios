<?php

class StandardController extends Controller {
	use CRUDController;
	public function __construct() {
		$this->model = new Models\Standard();
		$this->model->global = true;
		$this->controller = 'standard';

		parent::__construct();
	}
}