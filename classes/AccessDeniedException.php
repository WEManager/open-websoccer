<?php

namespace App\Classes;

use Exception;

/**
 * Exception that occurs when an action or page has been requested which is not granted for the requesting user.
 */
class AccessDeniedException extends Exception {
	
	/**
	 * Creates new exception.
	 * 
	 * @param string $message Message.
	 * @param integer $code Error code.
	 */
	public function __construct($message, $code = 0) {
		parent::__construct($message, $code);
	}	
}
