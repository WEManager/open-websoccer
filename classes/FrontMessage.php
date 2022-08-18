<?php

namespace App\Classes;

use Exception;

define('MESSAGE_TYPE_INFO', 'info');
define('MESSAGE_TYPE_WARNING', 'warning');
define('MESSAGE_TYPE_SUCCESS', 'success');
define('MESSAGE_TYPE_ERROR', 'error');

/**
 * Message which will be displayed as an alert on the front page.
 * 
 * @author Ingo Hofmann
 */
class FrontMessage {
	
	/**
	 * @var string message type. Must be MESSAGE_TYPE_INFO|MESSAGE_TYPE_SUCCESS|MESSAGE_TYPE_ERROR
	 */
	public $type;
	
	/**
	 * @var string title which will be highlighted.
	 */
	public $title;
	
	/**
	 * @var string message details.
	 */
	public $message;
	
	/**
	 * 
	 * @param string $type message type. Must be MESSAGE_TYPE_INFO|MESSAGE_TYPE_SUCCESS|MESSAGE_TYPE_WARNING|MESSAGE_TYPE_ERROR
	 * @param string $title title which will be highlighted.
	 * @param string $message message details.
	 * @throws Exception when the type is invalid.
	 */
	public function __construct($type, $title, $message) {
		if ($type !== MESSAGE_TYPE_INFO && $type !== MESSAGE_TYPE_SUCCESS && $type !== MESSAGE_TYPE_ERROR && $type !== MESSAGE_TYPE_WARNING) {
			throw new Exception('unknown FrontMessage type: ' . $type);
		}
		$this->type = $type;
		$this->title = $title;
		$this->message = $message;
	}	
}
