<?php

class IndicatorController extends Controller {
	use CRUDController;

	public function __construct() {
		$this->model = new Models\Indicator();
		$this->controller = 'indicator';

		parent::__construct();
	}

}