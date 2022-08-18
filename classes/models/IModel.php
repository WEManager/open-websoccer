<?php

namespace App\Classes\Models;

/**
 * <p>Any model must implement this interface.</p>
 * 
 * <p>Models provide data for templates. They will be assigned to one or more template files through module configuration files (module.xml).</p>
 * 
 * <p><strong>Note:</strong> Model Names must end with 'Model', e.g. 'MyFooModel'.</p>
 */
interface IModel {
	
	/**
	 * @param DbConnection $db database connection
	 * @param I18n $i18n i18n instance.
	 * @param WebSoccer $websoccer Websoccer instance.
	 */
	public function __construct($db, $i18n, $websoccer);
	
	/**
	 * Determines whether the associated view shall be rendered or not.
	 *
	 * @return TRUE if the view shall be displayed. FALSE otherweise.
	 */
	public function renderView();
	
	/**
	 * @return array of template placeholder values (key=placeholder name, value=placeholder value).
	 */
	public function getTemplateParameters();
}

?>