<?php

/**
 * This file is part of the AlesWita\DropzoneUploader
 * Copyright (c) 2017 Ales Wita (aleswita+github@gmail.com)
 */

declare(strict_types=1);

namespace AlesWita\DropzoneUploader\UploadDriver;

use AlesWita;
use Nette;


/**
 * @author Ales Wita
 * @license MIT
 */
abstract class UploadDriver implements IUploadDriver
{
	/** @var array */
	protected $settings = [];

	/** @var string */
	protected $folder;

	/**
	 * @param array
	 * @return AlesWita\DropzoneUploader\UploadDriver\IUploadDriver
	 */
	public function setSettings(array $settings): AlesWita\DropzoneUploader\UploadDriver\IUploadDriver {
		$this->settings = array_replace($this->settings, $settings);
		return $this;
	}

	/**
	 * @param string|NULL
	 * @return AlesWita\DropzoneUploader\UploadDriver\IUploadDriver
	 */
	public function setFolder(?string $folder): AlesWita\DropzoneUploader\UploadDriver\IUploadDriver {
		if ($folder !== NULL) {
			$this->folder = Nette\Utils\Strings::trim($folder, "\\/");
		}
		return $this;
	}

	/**
	 * @return array
	 */
	public function getSettings(): array {
		return $this->settings;
	}

	/**
	 * @return string|NULL
	 */
	public function getFolder(): ?string {
		return $this->folder;
	}

	/**
	 * @return array
	 */
	abstract function getUploadedFiles(): array;

	/**
	 * @param Nette\Http\FileUpload
	 * @return bool
	 */
	public function upload(Nette\Http\FileUpload $file): bool {
		if (!$file->isOk()) {
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * @param string
	 * @param bool
	 * @return bool
	 */
	abstract function remove(string $file): bool;
}
