<?php
namespace App\Classes;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Template;

/**
 * Clear the template-folder for Twig 2.x,
 * because the Twig clearcache Function doesen�t exits anymore.
 *
 * You can use the function delDir for other directory deleting too.
 *
 * @author Rolf Joseph
 */
function delDir($dir) {
	if(is_dir($dir)){
		$files=scandir($dir);

		foreach($files as$file) {
			if($file!="."&&$file!="..") {
				if(filetype($dir."/".$file)=="dir")delDir($dir."/".$file);
				else unlink($dir."/".$file);
			}
		}
		
		rmdir($dir);
	}
}

define('TEMPLATE_SUBDIR_DEFAULT', 'default');
define('I18N_GLOBAL_NAME', 'i18n');
define('ENVIRONMENT_GLOBAL_NAME', 'env');
define('SKIN_GLOBAL_NAME', 'skin');
define('VIEWHANDLER_GLOBAL_NAME', 'viewHandler');
define('CACHE_FOLDER', BASE_FOLDER . '/cache/templates');

/**
 * Enables skin dependent HTML templating.
 *
 * @author Ingo Hofmann
 */
class TemplateEngine {
	private Environment $_environment;
	private $_skin;

	/**
	 * Initializes the underlying template engine.
	 */
	function __construct(WebSoccer $env, I18n $i18n, ViewHandler $viewHandler = null) {

		$this->_skin = $env->getSkin();

		$this->_initTwig();
		$this->_environment->addGlobal(I18N_GLOBAL_NAME, $i18n);
		$this->_environment->addGlobal(ENVIRONMENT_GLOBAL_NAME, $env);
		$this->_environment->addGlobal(SKIN_GLOBAL_NAME, $this->_skin);
		$this->_environment->addGlobal(VIEWHANDLER_GLOBAL_NAME, $viewHandler);
	}

	/**
	 * Loads the specified template.
	 *
	 * @return Template template instance.
	 */
	public function loadTemplate(string $templateName) {
		return $this->_environment->load($this->_skin->getTemplate($templateName));
	}

	/**
	 * deletes all cached templates.
	 */
	public function clearCache() {
		delDir($_SERVER['DOCUMENT_ROOT'].'/cache/templates');
	}

	/**
	 * Provides the internal Twig environment in order to register extensions, etc.
	 *
	 * @return Environment Twig environment instance.
	 * @since 5.0.0
	 */
	public function getEnvironment() {
		return $this->_environment;
	}

	private function _initTwig() {
		$loader = new FilesystemLoader(TEMPLATES_FOLDER . '/' . TEMPLATE_SUBDIR_DEFAULT);

		$skinSubDir = $this->_skin->getTemplatesSubDirectory();

		if (strlen($skinSubDir) && $skinSubDir !== TEMPLATE_SUBDIR_DEFAULT) {
			$loader->prependPath(TEMPLATES_FOLDER .'/'. $skinSubDir);
		}

		// environment config
		$twigConfig = array(
			'cache' => CACHE_FOLDER,
		);

		$twigConfig['auto_reload'] = TRUE;
		$twigConfig['strict_variables'] = TRUE;
		if (DEBUG) {
		}

		// init
		$this->_environment = new Environment($loader, $twigConfig);
	}
}
