<?php

namespace App\Classes\Actions;

use App\Classes\DbConnection;
use App\Classes\I18n;
use App\Classes\WebSoccer;

/**
 * <p>Any controller must implement this interface.</p>
 * <p><strong>Note:</strong> Controller Names must end with 'Controller', e.g. 'MyFooController'.</p>
 */
interface IActionController {
	
	/**
	 * @param I18n $i18n i18n instance.
	 * @param WebSoccer $websoccer Websoccer instance.
	 * @param DbConnnection $db DB connection.
	 */
	public function __construct(I18n $i18n, WebSoccer $websoccer, DbConnection $db);
	
	/**
	 * Execute action.
	 * 
	 * @param array $parameters validated request parameters.
	 * @return string target page-ID or <code>null</code> if user shall remain on same page.
	 * @throws Exception when action failed. Basic parameter validation is not required in case parameters are properly configured at module.xml.
	 */
	public function executeAction($parameters);
	
}

?>