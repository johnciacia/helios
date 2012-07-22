<?php

class ObservationController extends Controller {
	
	public function __construct() {
		require_once('models/ObservationModel.php');
		$this->model = new ObservationModel();


		$this->addObservation();
	}


	public function addObservation() {

		$standards = $this->model->get_standards();
		$args = array( 'standards' => $standards, 'model' => $this->model );

		$this->loadView('header.php');
		$this->loadView('add_observation.php', $args );
		$this->loadView('footer.php');
	}

	public function editObservation() {

	}

	public function listObservations() {
		
	}

	public function deleteObservation() {
		
	}
}

?>