<?php

use App\Classes\I18n;

define('PARAM_ACTION', 'action');
define('PARAM_PAGE', 'page');
define('PARAM_BLOCK', 'block');
define('PARAM_PAGENUMBER', 'pageno');
define('MSG_KEY_ERROR_PAGENOTFOUND', 'error_page_not_found');

require(BASE_FOLDER . '/admin/config/global.inc.php');

// load configuration
include(CONFIGCACHE_FILE_FRONTEND);

// log-in user
$authenticatorClasses = explode(',', $website->getConfig('authentication_mechanism'));

foreach ($authenticatorClasses as $authenticatorClass) {
	$authenticatorClass = trim($authenticatorClass);

	if (!class_exists($authenticatorClass)) {
		throw new Exception('Class not found: ' . $authenticatorClass);
	}

	$authenticator = new $authenticatorClass($website);

	$authenticator->verifyAndUpdateCurrentUser($website->getUser());
}

// load i18n messages
$i18n = I18n::getInstance($website->getConfig('supported_languages'));

if ($website->getUser()->language != null) {
	try {
		$i18n->setCurrentLanguage($website->getUser()->language);
	} catch (Exception $e) {
		// ignore and use default language
	}
}

include(sprintf(CONFIGCACHE_MESSAGES, $i18n->getCurrentLanguage()));
include(sprintf(CONFIGCACHE_ENTITYMESSAGES, $i18n->getCurrentLanguage()));
