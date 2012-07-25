<?php

class IndexController extends Controller {

	public function __construct() {

		if( isset( $_SESSION['active'] ) ) {
			$this->dashboard();
		} else {
			$this->login();
		}
	}

	public function dashboard() {
		echo "Hello, " . $_SESSION['display_name'];
		$this->loadView('header.php');
	}

	public function login() {
		if( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
			$username = mysql_real_escape_string( $_POST['username'] );
			$password = sha1( $_POST['password'] );
			$query = mysql_query( "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'" );
			if( mysql_num_rows( $query ) == 1 ) {
				$row = mysql_fetch_assoc( $query );

				$_SESSION['active'] = true;
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['last_name'] = $row['last_name'];
				$_SESSION['display_name'] = $row['display_name'];
				$_SESSION['level'] = $row['level'];

				header( 'Location: index.php' );
			}

		}
		$this->loadView( 'login.php' );
	}


}

?>