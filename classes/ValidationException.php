<?php

namespace App\Classes;

use Exception;

/**
 * Indicates form validation failures.
 * 
 * @author Ingo Hofmann
 */
class ValidationException extends Exception {
	
	private $_messages;
	
	/**
  * @param array $messages array of messages which describe a failed validation.
  */
  public function __construct($messages) {
    $this->_messages = $messages;
    parent::__construct('Validation failed');
  }
  
  /**
   * @return array Array of validation messages.
   */
  public function getMessages() {
    return $this->_messages;
  }
}
