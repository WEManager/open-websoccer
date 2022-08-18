<?php

namespace App\Classes;

use Exception;

define('ALLOWED_EXTENSIONS', 'jpg,jpeg,gif,png');

/**
 * Helps to provide secure file upload.
 * 
 * @author Ingo Hofmann
 */
class FileUploadHelper {

	/**
	 * Securely uploads an image file.
	 * 
	 * @param I18n i18n instance.
	 * @param string $requestParameter request patameter key of file input field.
	 * @param string $targetFilename target file name without slahses, folder name or extension.
	 * @param string $targetDirectory target directory without slashes.
	 * @throws Exception if file is not a valid picture file or is too big.
	 * @return string extension of uploaded file.
	 */
	public static function uploadImageFile($i18n, $requestParameter, $targetFilename, $targetDirectory) {
		
		$filename = $_FILES[$requestParameter]['name'];
		$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
		$allowedExtensions = explode(',', ALLOWED_EXTENSIONS);
		if (!in_array($ext, $allowedExtensions)) {
			throw new Exception($i18n->getMessage('validationerror_imageupload_noimagefile'));
		}
		
		$imagesize = getimagesize($_FILES[$requestParameter]['tmp_name']);
		if ($imagesize === FALSE) {
			throw new Exception($i18n->getMessage('validationerror_imageupload_noimagefile'));
		}
		
		$type = substr($imagesize['mime'], strrpos($imagesize['mime'], '/') + 1);
		if (!in_array($type, $allowedExtensions)) {
			throw new Exception($i18n->getMessage('validationerror_imageupload_noimagefile'));
		}
		
		$targetFilename .= '.' . $ext;
		self::_uploadFile($i18n, $requestParameter, $targetFilename, $targetDirectory);
		return $ext;
	}
	
	private static function _uploadFile($i18n, $requestParameter, $targetFilename, $targetDirectory) {
		$errorcode = $_FILES[$requestParameter]['error'];
		if ($errorcode == UPLOAD_ERR_OK) {
			$tmp_name = $_FILES[$requestParameter]['tmp_name'];
			$name = $targetFilename;
			$uploaded = @move_uploaded_file($tmp_name, UPLOAD_FOLDER . $targetDirectory . '/'. $name);
			if (!$uploaded) {
				throw new Exception($i18n->getMessage('error_file_upload_failed'));
			}
		} else {
			throw new Exception($i18n->getMessage('error_file_upload_failed'));
		}
	}	
}
