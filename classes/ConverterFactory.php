<?php

namespace App\Classes;

use Exception;

/**
 * Creates converters. See IConverter interface.
 * 
 * @author Ingo Hofmann
 */
class ConverterFactory {
	private static $_createdConverters;

	/**
	 * Instanciates and provides converter with specified class name, if it exists.
	 * 
	 * @param WebSoccer $website Application context.
	 * @param I18n $i18n I18n context.
	 * @param string $converter converter class name.
	 * @throws Exception if converter cannot be found.
	 * @return IConverter converter instance.
	 */
	public static function getConverter($website, $i18n, $converter) {
		
		if (isset(self::$_createdConverters[$converter])) {
			return self::$_createdConverters[$converter];
		}
		
		if (class_exists($converter)) {
			$converterInstance = new $converter($i18n, $website);
			self::$_createdConverters[$converter] = $converterInstance;
			return $converterInstance;
		}
		
		throw new Exception("Converter not found: " . $converter);
	}	
}
