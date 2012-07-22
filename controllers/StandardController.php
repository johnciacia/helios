<?php

class StandardController extends Controller {
	use CRUDController;
	public function __construct() {
		require_once('models/StandardModel.php');
		$this->model = new Standard();
		$this->model->global = true;
		$this->controller = 'standard';

		parent::__construct();
	}
}