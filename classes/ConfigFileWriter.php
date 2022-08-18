<?php

namespace App\Classes;

/**
 * Writes entries into the global config file (defined in global constant GLOBAL_CONFIG_FILE).
 * 
 * @author Ingo Hofmann
 */
class ConfigFileWriter {

	private static $_instance;
	private $_settings;
	
	/**
	 * Provides request's only instance of this class.
	 * 
	 * @param array $settings existing settings.
	 * @return the only instance during current request.
	 */
	public static function getInstance($settings) {
        if(self::$_instance == NULL) {
			self::$_instance = new ConfigFileWriter($settings);
		}
        return self::$_instance;
    }
    
    /**
     * Updates or adds the passed settings in the global config file.
     * 
     * @param array $newSettings array of settings to update or add.
     */
    public function saveSettings($newSettings) {
    	
    	// update or add values
    	foreach($newSettings as $settingId => $settingValue) {
    		$this->_settings[$settingId] = $settingValue;
    	}
    	
    	$this->_writeToFile();
    }
    
    private function _writeToFile() {
    	$content = "<?php" . PHP_EOL;
    	
    	foreach ($this->_settings as $id => $value) {
    		$content .= "\$conf[\"". $id . "\"] = \"". addslashes($value) ."\";". PHP_EOL;
    	}
    	
    	$content .= "?>";
    	
    	$fw = new FileWriter(GLOBAL_CONFIG_FILE);
    	$fw->writeLine($content);
    	$fw->close();
    }
    
    // hide constructor
    private function __construct($settings) {
    	$this->_settings = $settings;
    }
}
