<?php

namespace App\Classes;

/**
 * Defines what a user authentication mechanism must implement.
 * 
 * @author Ingo Hofmann
 */
interface IUserAuthentication {
	
	/**
	 * @param WebSoccer $website request context.
	 */
	public function __construct(WebSoccer $website);
	
	/**
	 * Checks if the current user is authenticated and updates the user information accordingly.
	 * 
	 * @param User $currentUser instance of current user to be updated.
	 */
	public function verifyAndUpdateCurrentUser(User $currentUser);
	
	/**
	 * Invalidates the user session and sets user as guest by unsetting the user-ID.
	 * 
	 * @param User $currentUser
	 */
	public function logoutUser(User $currentUser);	
}
