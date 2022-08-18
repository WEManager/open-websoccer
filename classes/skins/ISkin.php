<?php

namespace App\Classes\Skins;

/**
 * Any skin must implement this interface.
 * 
 * A skin controls which resources (CSS, JavaScript, Template Files) have to be taken for the website presentation.
 * 
 * <strong>Note:</strong> Skin Class Names must end with 'Skin', e.g. 'MyFooSkin'.
 * 
 * @author Ingo Hofmann
 */
interface ISkin {
	
	/**
	 * @param WebSoccer $websoccer WebSoccer context instance.
	 */
	public function __construct($websoccer);
	
	/**
	 * @return string Name of sub directory where templates are located.
	 */
	public function getTemplatesSubDirectory();
	
	/**
	 * @return array of absolute paths to CSS files which shall be loaded.
	 */
	public function getCssSources();
	
	/**
	 * @return array of absolute paths to JavaScript files which shall be loaded.
	 */
	public function getJavaScriptSources();
	
	/**
	 * Provides the file name of specified template name. Usually, it is just the template name plus file extension, but the
	 * implementation could map particular templates to another file.
	 * 
	 * @param string $templateName name of template to load, without file extension.
	 * @return sring Name of template file to load.
	 */
	public function getTemplate($templateName);
	
	/**
	 * 
	 * @param string $fileName Name of image file to load.
	 * @return string absolute path to the specified image for usage in output file.
	 */
	public function getImage($fileName);
}
