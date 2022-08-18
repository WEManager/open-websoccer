<?php

namespace App\Classes;

use App\Classes\FacebookSDK\Facebook;
use App\Classes\FacebookSDK\FacebookApiException;

// require_once(BASE_FOLDER . '/classes/facebooksdk/facebook.php');

/**
 * Provides access to the Facebook PHP SDK.
 * 
 * @author Ingo Hofmann
 */
class FacebookSdk {

	private static $_instance;
	
	private $_facebook;
	private $_websoccer;
	private $_userEmail;
	
	/**
	 * Creates or returns the only instance of this class.
	 * 
	 * @param WebSoccer $websoccer Application context.
	 * @return FacebookSdk the only instance during current request.
	 */
	public static function getInstance(WebSoccer $websoccer) {
		if(self::$_instance == NULL) {
			self::$_instance = new FacebookSdk($websoccer);
		}
		return self::$_instance;
	}
	
	// hide constructor (Singleton implementation)
	// inits SDK.
	private function __construct(WebSoccer $websoccer) {
		$this->_websoccer = $websoccer;
		$this->_facebook = new Facebook(array(
				'appId' => $websoccer->getConfig('facebook_appid'),
				'secret' => $websoccer->getConfig('facebook_appsecret')
				));
	}
	
	/**
	 * Build secure log-in URL which forwards user to Facebook in order to connect to application.
	 * 
	 * @return string Log-In URL.
	 */
	public function getLoginUrl() {
		return $this->_facebook->getLoginUrl(array(
				'scope' => 'email',
				'redirect_uri' => $this->_websoccer->getInternalActionUrl('facebook-login', null, 'home', TRUE)
				));
	}
	
	/**
	 * Build log-out URL which user needs to visit when he wants to log out.
	 * 
	 * @return string Logout URL.
	 */
	public function getLogoutUrl() {
		return $this->_facebook->getLogoutUrl(array(
				'next' => $this->_websoccer->getInternalActionUrl('facebook-logout', null, 'home', TRUE)
		));
	}
	
	/**
	 * Checks if user is logged in and returns his e-mail address if so.
	 * 
	 * @return string If user is logged in, his e-mail address. Otherwise empty string.
	 */
	public function getUserEmail() {
		if ($this->_userEmail == NULL) {
			
			$userId = $this->_facebook->getUser();
			
			if ($userId) {
				
				// check user session for e-mail
				if (isset($_SESSION['fbemail'])) {
					$this->_userEmail = $_SESSION['fbemail'];
					return $this->_userEmail;
				}
				
				// it is possible that we have a user ID although user is logged out. 
				// Hence, check for exception which indicates this situation.
				try {
					
					// query e-mail and save in session
					$fql = 'SELECT email from user where uid = ' . $userId;
					$ret_obj = $this->_facebook->api(array(
							'method' => 'fql.query',
							'query' => $fql,
					));
					$this->_userEmail = $ret_obj[0]['email'];
					$_SESSION['fbemail'] = $this->_userEmail;
					
				} catch(FacebookApiException $e) {
					$this->_userEmail = '';
				}
				
				// user is not logged in
			} else {
				$this->_userEmail = '';
			}
			
		}
		return $this->_userEmail;
	}
	
	/**
	 * Destroy current session. Required for logging out user.
	 */
	public function destroySession() {
		$this->_facebook->destroySession();
	}
}
