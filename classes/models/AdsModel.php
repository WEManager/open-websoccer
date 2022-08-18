<?php

namespace App\Classes\Models;

/**
 * Provides current absences information for user.
 */
class AdsModel implements IModel {
	private $_db;
	private $_i18n;
	private $_websoccer;
	
	public function __construct($db, $i18n, $websoccer) {
		$this->_db = $db;
		$this->_i18n = $i18n;
		$this->_websoccer = $websoccer;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see IModel::renderView()
	 */
	public function renderView() {
		return (
			$this->_websoccer->getUser()->premiumBalance == 0 ||
			!$this->_websoccer->getConfig('frontend_ads_hide_for_premiumusers')
		);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see IModel::getTemplateParameters()
	 */
	public function getTemplateParameters() {
		return array();
	}
	
}
