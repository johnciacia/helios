<?php

class IndexController extends Controller {

	public function __construct() {
		$this->loadView('header.php');
		echo "Hello, World";
		$this->loadView('footer.php');
	}
}

?>