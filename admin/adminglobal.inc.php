<?php

namespace App\Admin;

use App\Classes\I18n;
use App\Classes\SecurityUtil;
use Exception;

define('OVERVIEW_SITE_SUFFIX', '_overview');
define('JOBS_CONFIG_FILE', BASE_FOLDER . '/admin/config/jobs.xml');
define('LOG_TYPE_EDIT', 'edit');
define('LOG_TYPE_DELETE', 'delete');

include(BASE_FOLDER . '/admin/config/global.inc.php');
include(BASE_FOLDER . '/admin/functions.inc.php');
include(CONFIGCACHE_FILE_ADMIN);

// request parameters
$site = (isset($_REQUEST['site'])) ? $_REQUEST['site'] : '';
$show = (isset($_REQUEST['show'])) ? $_REQUEST['show'] : FALSE;
$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : null;

// log in user
if (SecurityUtil::isAdminLoggedIn()) {
	$columns = '*';
	$fromTable = $conf['db_prefix'] .'_admin';
	$whereCondition = 'id = %d';
	$parameters = $_SESSION['userid'];
	$result = $db->querySelect($columns, $fromTable, $whereCondition, $parameters);
	$admin = $result->fetch_array();
	$result->free();
} else {
	header('location: login.php?forwarded=1');
	exit;
}

// include messages
$i18n = I18n::getInstance($website->getConfig('supported_languages'));
if ($admin['lang']) {
	try {
		$i18n->setCurrentLanguage($admin['lang']);
	} catch (Exception $e) {
		// ignore and use default language
	}
}
include(sprintf(CONFIGCACHE_ADMINMESSAGES, $i18n->getCurrentLanguage()));
include(sprintf(CONFIGCACHE_ENTITYMESSAGES, $i18n->getCurrentLanguage()));

header('Content-type: text/html; charset=utf-8');