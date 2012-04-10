<?php

class ApiController extends Controller {

	const APPLICATION_ID = 'HELIOS';

	private $format = 'json';

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array();
	}

	public function actionIndex() {
		$this->_sendResponse( 200, sprintf( 'No action specified' ) );
	}

	public function actionList() {
		$this->_checkAuth();
		switch( $_GET['model'] ) {
			case 'rubric':
				$models = Rubric::model()->findAll();
				break;
			default:
				$this->_sendResponse( 501, sprintf( 'Error: Action not implemented' ) );
				exit;
		}

		if( is_null( $models ) ) {
			$this->_sendResponse( 200, sprintf( 'No items where found for model <b>%s</b>' , $_GET['model'] ) );
		} else {
			$rows = array();
			foreach( $models as $model )
				$rows[] = $model->attributes;

			$this->_sendResponse( 200, CJSON::encode( $rows ) );
		}
	}

	/**
	 * @access public
	 * @return void
	 */
	public function actionView() {

	}

	/**
	 * @access public
	 * @return void
	 */
	public function actionCreate() {

	}

	/**
	 * @access public
	 * @return void
	 */
	public function actionUpdate() {

	}

	/**
	 * @access public
	 * @return void
	 */
	public function actionDelete() {

	}

	/**
	 * Sends the API response 
	 * 
	 * @param int $status 
	 * @param string $body 
	 * @param string $content_type 
	 * @access private
	 * @return void
	 */
	private function _sendResponse( $status = 200, $body = '', $content_type = 'text/html' )
	{
		header( 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage( $status ) );
		header( 'Content-type: ' . $content_type );

		if( '' !== $body ) {
			echo $body;
			exit;
		} else {
			$message = '';
			switch( $status ) {
				case 401:
					$message = 'You must be authorized to view this page.';
					break;
				case 404:
					$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
					break;
				case 500:
					$message = 'The server encountered an error processing your request.';
					break;
				case 501:
					$message = 'The requested method is not implemented.';
					break;
			}

			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
			$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
						<html>
							<head>
								<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
								<title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
							</head>
							<body>
								<h1>' . $this->_getStatusCodeMessage($status) . '</h1>
								<p>' . $message . '</p>
								<hr />
								<address>' . $signature . '</address>
							</body>
						</html>';
			echo $body;
			exit;
		}
	}

	/**
	 * Get the message for a status code
	 * 
	 * @param mixed $status 
	 * @access private
	 * @return string
	 */
	private function _getStatusCodeMessage($status)
	{
		$codes = array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => '(Unused)',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported'
		);

		return ( isset( $codes[$status] ) ) ? $codes[$status] : '';
	}

	/**
	 * @access private
	 * @return void
	 */
	private function _checkAuth() {

		if( ! ( isset( $_SERVER['HTTP_X_' . self::APPLICATION_ID . '_USERNAME'] ) && 
			    isset( $_SERVER['HTTP_X_' . self::APPLICATION_ID . '_PASSWORD'] ) ) ) {
			$this->_sendResponse(401);
		}

		
		$username = $_SERVER['HTTP_X_' . self::APPLICATION_ID . '_USERNAME'];
		$password = $_SERVER['HTTP_X_' . self::APPLICATION_ID . '_PASSWORD'];
		$id = new UserIdentity( $username, $password );
		$id->authenticate();

		if( $id->errorCode === UserIdentity::ERROR_NONE ) {
			return;
		}

		$this->_sendResponse( 401, 'Error: Unable to authenticate' );
	}

	/**
	 * @param mixed $model 
	 * @param mixed $array Data to be encoded
	 * @access private
	 * @return string
	 */
	private function _getObjectEncoded( $model, $array )
	{
		if( isset( $_GET['format'] ) )
			$this->format = $_GET['format'];

		if( 'json' == $this->format ) {
			return CJSON::encode( $array );
		} elseif( $this->format == 'xml' ) {
			$result = '<?xml version="1.0">';
			$result .= "\n<$model>\n";
			foreach( $array as $key => $value )
				$result .= "\t<$key>" . utf8_encode($value) . "</$key>\n"; 
			$result .= '</' . $model . '>';
			return $result;
		} else {
			return '';
		}
	}
}