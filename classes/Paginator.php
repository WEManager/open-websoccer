<?php

namespace App\Classes;

/**
 * Backing the paginator component.
 * 
 * @author Ingo Hofmann
 */
class Paginator {
	
	/**
	 * @var int number of pages.
	 */
	public $pages;
	
	/**
	 * @var int current page number.
	 */
	public $pageNo;
	
	/**
	 * @var int entries per page.
	 */
	public $eps;
	
	private $_parameters;
	
	/**
	 * @return string additional query string to append to URL. Empty string of no paramaters shall be appended.
	 */
	public function getQueryString() {
		if ($this->_parameters != null) {
			return http_build_query($this->_parameters);
		}
		return '';
	}
	
	/**
	 * Adds specified parameter to the query string.
	 * 
	 * @param string $name parameter name
	 * @param string $value parameter value
	 */
	public function addParameter($name, $value) {
		$this->_parameters[$name] = $value;
	}
	
	/**
	 * @param int $hits number of total hits.
	 * @param int $eps number of maximum entries per page.
	 * @param WebSoccer $websoccer environment.
	 */
	public function __construct($hits, $eps, $websoccer) {
		$this->eps = $eps;
		$this->pageNo = max(1, (int) $websoccer->getRequestParameter(PARAM_PAGENUMBER));
		if ($hits % $eps) {
			$this->pages = floor($hits / $eps) + 1;
		} else {
			$this->pages = $hits / $eps;
		}
	}
	
	/**
	 * @return int index of first entry to select.
	 */
	public function getFirstIndex() {
		return ($this->pageNo - 1) * $this->eps;
	}	
}
