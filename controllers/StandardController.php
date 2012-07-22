<?php

class StandardController extends Controller {
	
	public function __construct() {
		require_once('models/StandardModel.php');
		$this->model = new Standard();
		$this->model->global = true;
		$this->controller = 'standard';

		parent::__construct();
	}

	public function create() {

		if( $items = $this->validate( $this->model->items ) ) {
			$this->model->create( $items );
			header("Location: ?p={$this->controller}");
		}

		$data = array( 'items' => $this->model->items );

		$this->loadView( 'header.php' );
		$this->loadView( 'add.php', $data );
		$this->loadView( 'footer.php' );
	}

	public function read() {
		$values = $this->model->read();

		$data = array(
			'items' => $values,
			'headings' => $this->model->items,
		);

		$this->loadView( 'header.php' );
		$this->loadView( 'read.php', $data );
		$this->loadView( 'footer.php' );
	}

	public function update() {

	}

	public function delete() {
		$this->model->delete( $_GET['id'] );
		header("Location: ?p={$this->controller}");
	}

}