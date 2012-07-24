<?php

class IndexController extends Controller {

	public function __construct() {
		$this->loadView('header.php');
		$this->loadView('footer.php');
		$element = new Models\Element();
		$e = $element->getItem( 1 );
		pp( $e->standard );
	}


}

?>