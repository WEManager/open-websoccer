<?php

namespace App\Classes;

define('COOKIE_PREFIX', 'ws');

/**
 * Helps handling cookies.
 * 
 * @author Ingo Hofmann
 */
class CookieHelper {

	/**
	 * Creates new cookie.
	 * 
	 * @param string $name cookie name (without application prefix).
	 * @param string $value cookie value.
	 * @param string|NULL $lifetimeInDays lifetime in days or NULL if it shall expire after user session.
	 */
	public static function createCookie($name, $value, $lifetimeInDays = null) {
		$expiry = ($lifetimeInDays != null) ? time() + 86400 * $lifetimeInDays : 0;
		
		setcookie(COOKIE_PREFIX . $name, $value, $expiry);
	}
	
	/**
	 * 
	 * @param string $name cookie name (without application prefix)
	 * @return NULL|sring Cookie value or NULL if there is no cookie with specified name.
	 */
	public static function getCookieValue($name) {
		if (!isset($_COOKIE[COOKIE_PREFIX . $name])) {
			return null;
		}
		
		return $_COOKIE[COOKIE_PREFIX . $name];
	}
	
	/**
	 * Deletes cookie with specified name.
	 * 
	 * @param string $name cookie name  (without application prefix).
	 */
	public static function destroyCookie($name) {
		if (!isset($_COOKIE[COOKIE_PREFIX . $name])) {
			return;
		}
	
		setcookie(COOKIE_PREFIX . $name, '', time()-86400);
	}	
}
