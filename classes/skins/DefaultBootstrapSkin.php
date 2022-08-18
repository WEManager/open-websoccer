<?php

namespace App\Classes\Skins;

/**
 * The default skin which is based on Twitter Bootstrap.
 * Defines all basic CSS and JavaScript files needed for all components.
 * 
 * @author Ingo Hofmann
 */
class DefaultBootstrapSkin implements ISkin {
	protected $_websoccer;
	
	/**
	 * @param WebSoccer $websoccer request context.
	 */
	public function __construct($websoccer) {
		$this->_websoccer = $websoccer;
	}
	
	/**
	 * @see ISkin::getTemplatesSubDirectory()
	 */
	public function getTemplatesSubDirectory() {
		return 'default';
	}
	
	/**
	 * @see ISkin::getCssSources()
	 */
	public function getCssSources() {
		$files[] = '//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css';
		$files[] = '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css';
		
		$dir = $this->_websoccer->getConfig('context_root') . '/css/';
		$files[] = $dir . 'defaultskin.css';
		$files[] = $dir . 'websoccer.css';
		$files[] = $dir . 'bootstrap-responsive.min.css';
		
		return $files;
	}
	
	/**
	 * @see ISkin::getJavaScriptSources()
	 */
	public function getJavaScriptSources() {
		$dir = $this->_websoccer->getConfig('context_root') . '/js/';
		$files[] = '//code.jquery.com/jquery-1.11.1.min.js';
		
		if (DEBUG) {
			$files[] = $dir . 'bootstrap.min.js';
			$files[] = $dir . 'jquery.blockUI.js';
			$files[] = $dir . 'wsbase.js';
		} else {
			$files[] = $dir . 'websoccer.min.js';
		}
		
		return $files;
	}
	
	/**
	 * @see ISkin::getTemplate()
	 */
	public function getTemplate($templateName) {
		return "{$templateName}.twig";
	}
	
	/**
	 * @see ISkin::getImage()
	 */
	public function getImage($fileName) {
		if (file_exists(BASE_FOLDER . '/img/' . $fileName)) {
			return $this->_websoccer->getConfig('context_root') . '/img/' . $fileName;
		}
		
		return FALSE;
	}
	
	/**
	 * @return string skin name
	 */
	public function __toString() {
		return 'DefaultBootstrapSkin';
	}
}
