<?php

/**
 * This file is part of the AlesWita\Components\DropzoneUploader
 * Copyright (c) 2017 Ales Wita (aleswita+github@gmail.com)
 */

declare(strict_types=1);

namespace AlesWita\Components\DropzoneUploader;

use AlesWita;


/**
 * @author Ales Wita
 * @license MIT
 */
class Factory
{
	// default dropzone templates
	const DROPZONE_DEFAULT_TEMPLATE = __DIR__ . "/templates/default.latte";
	const DROPZONE_BOOTSTRAP_V4_TEMPLATE = __DIR__ . "/templates/bootstrap_v4.latte";

	/** @var string */
	private $dropzoneTemplate = self::DROPZONE_DEFAULT_TEMPLATE;

	/** @var AlesWita\Components\DropzoneUploader\UploadDriver\IUploadRiver */
	private $uploadDriver;

	/** @var array */
	private $settings = [];

	/** @var array */
	private $messages = [];

	/**
	 * @param string
	 * @return self
	 */
	public function setDropzoneTemplate(string $template): self {
		$this->dropzoneTemplate = $template;
		return $this;
	}

	/**
	 * @param AlesWita\Components\DropzoneUploader\UploadDriver\IUploadDriver
	 * @return self
	 */
	public function setUploadDriver(UploadDriver\IUploadDriver $driver): self {
		$this->uploadDriver = $driver;
		return $this;
	}

	/**
	 * @param array
	 * @return self
	 */
	public function setSettings(array $settings): self {
		$this->settings = $settings;
		return $this;
	}

	/**
	 * @param array
	 * @return self
	 */
	public function setMessages(array $messages): self {
		$this->messages = $messages;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDropzoneTemplate(): string {
		return $this->dropzoneTemplate;
	}

	/**
	 * @return AlesWita\Components\DropzoneUploader\UploadDriver\IUploadDriver
	 */
	public function getUploadDriver(): AlesWita\Components\DropzoneUploader\UploadDriver\IUploadDriver {
		return $this->uploadDriver;
	}

	/**
	 * @return array
	 */
	public function getSettings(): array {
		return $this->settings;
	}

	/**
	 * @return array
	 */
	public function getMessages(): array {
		return $this->messages;
	}

	/**
	 * @return AlesWita\Components\DropzoneUploader\DropzoneUploader
	 */
	public function getDropzoneUploader(): AlesWita\Components\DropzoneUploader\DropzoneUploader {
		$dropzoneUploader = new DropzoneUploader;

        $dropzoneUploader->setDropzoneTemplate($this->dropzoneTemplate)
			->setUploadDriver($this->uploadDriver)
			->setSettings($this->settings)
			->setMessages($this->messages);

		return $dropzoneUploader;
	}
}
