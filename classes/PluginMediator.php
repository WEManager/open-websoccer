<?php

namespace App\Classes;

use App\Classes\Events\AbstractEvent;
use Exception;

/**
 * Mediator between plugins (event listeners) and application core.
 * Identifies existing event listeners and dispatches events to them.
 * 
 * Event listeners must be configured at any module.xml like following:
 * 
 * <code>
 * &lt;eventlistener event="{class name of event}" class="{class name of listener}" method="{listener function name}" /&gt;
 * </code>
 * 
 * @author Ingo Hofmann
 */
class PluginMediator {
	private static $_eventlistenerConfigs;
	
	/**
	 * Notifies listeners about the specified event.
	 * 
	 * @param AbstractEvent $event event instance holding data for listeners.
	 * @throws Exception if the configured listener function does not exist or if this function throws an Exception.
	 */
	public static function dispatchEvent(AbstractEvent $event) {
		if (self::$_eventlistenerConfigs == null) {
			include(CONFIGCACHE_EVENTS);
			if (isset($eventlistener)) {
				self::$_eventlistenerConfigs = $eventlistener;
			} else {
				self::$_eventlistenerConfigs = array();
			}
		}
		
		// any event listener configured?
		if (!count(self::$_eventlistenerConfigs)) {
			return;
		}
		
		// get available configurations for this event.
		$eventName = get_class($event);
		if (!isset(self::$_eventlistenerConfigs[$eventName])) {
			return;
		}
		
		// call listeners
		$eventListeners = self::$_eventlistenerConfigs[$eventName];
		foreach ($eventListeners as $listenerConfigStr) {
			$listenerConfig = json_decode($listenerConfigStr, TRUE);
			
			if (method_exists($listenerConfig['class'], $listenerConfig['method'])) {
				call_user_func($listenerConfig['class'] . '::' . $listenerConfig['method'], $event);
			} else {
				throw new Exception('Configured event listener must have function: ' . $listenerConfig['class'] . '::' . $listenerConfig['method']);
			}		
		}
	}	
}
