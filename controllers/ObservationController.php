<?php

class ObservationController extends Controller {
	use CRUDController;

	public function __construct() {
		$this->model = new Models\Observation();
		$this->controller = 'observation';

		parent::__construct();
	}

	public function create() {
		if( $items = $this->validate( $this->model->items ) ) {
			$items['indicators'] = $_POST['indicators'];
			$this->model->create( $items );
			header("Location: ?p={$this->controller}");
		}

		$this->model = new Models\Observation();
		$this->standard_model = new Models\Standard();
		$this->element_model = new Models\Element();
		$this->indicator_model = new Models\Indicator();


		$data = array( 
			'standards' => $this->standard_model->read(),
			'items' => $this->model->items );

		$this->loadView( 'add_observation.php', $data );		
	}
}

?>