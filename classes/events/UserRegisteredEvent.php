<?php

namespace App\Classes\Events;

use App\Classes\DbConnection;
use App\Classes\I18n;
use App\Classes\WebSoccer;

/**
 * This event is triggered when a new user registers. Either by filling the registration form or by automatic creation
 * through (custom) log-in methods.
 */
class UserRegisteredEvent extends AbstractEvent {
	
	/**
	 * @var int ID of created user.
	 */
	public $userId;
	
	/**
	 * @var string Entered user name. Might be NULL if user has not been created through registration form.
	 */
	public $username;
	
	/**
	 * @var string Entered e-mail address. Might be NULL if user has not been created through registration form.
	 */
	public $email;
	
	/**
	 * 
	 * @param WebSoccer $websoccer Application context.
	 * @param DbConnection $db DB connection.
	 * @param I18n $i18n Messages context.
	 * @param int $userid ID of user.
	 * @param string $username entered user name.
	 * @param string $email entered e-mail address with lower case letters.
	 */
	function __construct(WebSoccer $websoccer, DbConnection $db, I18n $i18n, int $userid, string $username, string $email) {
		parent::__construct($websoccer, $db, $i18n);
		
		$this->userId = $userid;
		$this->username = $username;
		$this->email = $email;
	}
}
