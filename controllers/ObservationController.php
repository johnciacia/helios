<?php

class ObservationController extends Controller {
	use CRUDController;

	public function __construct() {
		require_once('models/ObservationModel.php');
		$this->model = new ObservationModel();
		$this->controller = 'observation';

		parent::__construct();


	}

	public function create() {
		if( $items = $this->validate( $this->model->items ) ) {
			$items['indicators'] = $_POST['indicators'];
			$this->model->create( $items );
			header("Location: ?p={$this->controller}");
		}

		require_once('models/ObservationModel.php');
		$this->model = new ObservationModel();

		require_once('models/StandardModel.php');
		$this->standard_model = new Standard();

		require_once('models/Element.php');
		$this->element_model = new Element();

		require_once('models/Indicator.php');
		$this->indicator_model = new Indicator();


		$data = array( 'standards' => $standards = $this->standard_model->read() );

		$this->loadView( 'add_observation.php', $data );		
	}
}

?>