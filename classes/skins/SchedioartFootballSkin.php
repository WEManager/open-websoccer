<?php

namespace App\Classes\Skins;

/**
 * Fancy skin with football/soccer elements.
 * Designed by Schedio Art (http://www.schedioart.in/).
 * 
 * @author Ingo Hofmann
 */
class SchedioartFootballSkin extends DefaultBootstrapSkin {
	
	/**
	 * @see ISkin::getTemplatesSubDirectory()
	 */
	public function getTemplatesSubDirectory() {
		return 'schedio';
	}
	
	/**
	 * @see ISkin::getCssSources()
	 */
	public function getCssSources() {
	
		$dir = $this->_websoccer->getConfig('context_root') . '/css/';
		
		if (DEBUG) {
			$files[] = $dir . 'schedioart/bootstrap.css';
			$files[] = $dir . 'schedioart/schedioartskin.css';
			$files[] = $dir . 'websoccer.css';
			$files[] = $dir . 'bootstrap-responsive.min.css';
		} else {
			$files[] = $dir . 'schedioart/theme.min.css';
		}
		
		$files[] = '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css';
	
		return $files;
	}
}
