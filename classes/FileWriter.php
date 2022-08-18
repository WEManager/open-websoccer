<?php

namespace App\Classes;

use Exception;

/**
 * Writes into files. Supports both truncating and appending.
 *
 * @author Ingo Hofmann
 */
class FileWriter {

	private string $file;
	private $_filePointer;

	/**
	 * Opens a file for writing. If the file does not exist, it gets created.
	 *
	 * @param string $file file name
	 * @param boolean $truncateExistingFile if TRUE and the file already exists the file gets truncated (previous content getting deleted).
	 * @throws Exception if file could not be created.
	 */
	function __construct(string $file, $truncateExistingFile = true) {
		$this->file = $file;
		$this->_filePointer = @fopen($file, ($truncateExistingFile) ? 'w' : 'a');

		if ($this->_filePointer === FALSE) {
			throw new Exception('Could not create or open file '. $file .'! Verify that the file or its folder is writable.');
		}
	}

	/**
	 * Writes a new line into the opened file.
	 *
	 * @param string $line string to write, without line break.
	 * @throws Exception if line could not be written.
	 */
	public function writeLine($line) {
		if (@fwrite($this->_filePointer, $line . PHP_EOL) === FALSE) {
			throw new Exception("Could not write line '{$line}' into file {$this->file}!");
		}
	}

	/**
	 * closes file writer.
	 */
	public function close() {
		if ($this->_filePointer) {
			@fclose($this->_filePointer);
		}
	}
}

