<?php

class ElementController extends Controller {
	use CRUDController;

	public function __construct() {
		$this->model = new Models\Element();
		$this->controller = 'element';

		parent::__construct();
	}

}