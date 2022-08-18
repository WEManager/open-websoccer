<?php

namespace App\Classes;

/**
 * Helps building a breadcrumb navigation.
 * 
 * @author Ingo Hofmann
 */
class BreadcrumbBuilder {
	
	/**
	 * Provides the breadcrump path to the specified page ID according to the hierarchical pages configuration at module.xml.
	 * 
	 * @param WebSoccer $website Websoccer context.
	 * @param I18n $i18n Messages context
	 * @param array $pages Array of all available pages configurations.
	 * @param string $currentPageId current page ID.
	 * @return array Array of page items with key=pageId, value=Navigation label; hierarchically sorted.
	 */
	public static function getBreadcrumbItems($website, $i18n, $pages, $currentPageId) {
		if (!isset($pages[$currentPageId])) {
			return;
		}
		
		$items = array();
		
		$nextPageId = $currentPageId;
		while($nextPageId) {
			$pageConfig = json_decode($pages[$nextPageId], TRUE);
			$items[$nextPageId] = $i18n->getNavigationLabel($nextPageId);
			
			if (isset($pageConfig['parentItem']) && strlen($pageConfig['parentItem'])) {
				$nextPageId = $pageConfig['parentItem'];
			} else {
				$nextPageId = FALSE;
			}
		}
		
		return array_reverse($items);
	}	
	
}

?>
