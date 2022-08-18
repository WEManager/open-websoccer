<?php

namespace App\Classes\Skins;

/**
 * Same as DefaultBootstrapSkin, but with green colors.
 * 
 * @author Ingo Hofmann
 */
class GreenBootstrapSkin extends DefaultBootstrapSkin {
	
	/**
	 * @see DefaultBootstrapSkin::getCssSources()
	 */
	public function getCssSources() {
		$dir = $this->_websoccer->getConfig('context_root') . '/css/';
		$files[] = $dir . 'bootstrap_green.css';
		$files[] = $dir . 'websoccer.css';
		$files[] = $dir . 'bootstrap-responsive.min.css';
		
		$files[] = '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css';
	
		if ($this->_websoccer->getPageId() == 'formation'
				|| $this->_websoccer->getPageId() == 'training') {
			$files[] = $dir . 'slider.css';
		}
	
		if ($this->_websoccer->getPageId() == 'formation'
				|| $this->_websoccer->getPageId() == 'youth-formation'
				|| $this->_websoccer->getPageId() == 'teamoftheday') {
			$files[] = $dir . 'formation.css';
			$files[] = $dir . 'bootstrap-switch.css';
		}
		
		return $files;
	}
	
}
