<?php

/**
 * This file is part of the AlesWita\Components\DropzoneUploader
 * Copyright (c) 2017 Ales Wita (aleswita+github@gmail.com)
 *
 * @phpVersion 7.1.0
 */

declare(strict_types=1);

namespace AlesWita\Components\DropzoneUploader\Tests\Tests;

use AlesWita;
use Nette;
use Tester;

require_once __DIR__ . "/../bootstrap.php";
require_once __DIR__ . "/../../src/uploaddriver/Move.php";


/**
 * @author Ales Wita
 * @license MIT
 */
final class UploadTest extends Tester\TestCase
{
	/**
	 * @return void
	 */
	public function testOne(): void {
		$configurator = new Nette\Configurator();
		$configurator->setTempDirectory(TEMP_DIR);
		$configurator->addConfig(__DIR__ . "/../app/config/config.neon");
		$configurator->addConfig(__DIR__ . "/../app/config/removeTestOne.neon");

		$container = $configurator->createContainer();
		$presenterFactory = $container->getByType("Nette\\Application\\IPresenterFactory");
		$file = new Nette\Http\FileUpload(["name" => "template.latte", "type" => "", "size" => 10, "tmp_name" => __DIR__ . "/../files/template.latte", "error" => 0]);

		$presenter = $presenterFactory->createPresenter("Base");
		$presenter->getTemplate()->setTranslator(new AlesWita\Components\DropzoneUploader\Tests\App\Service\FakeTranslator);
		$presenter->autoCanonicalize = FALSE;
		$request = new Nette\Application\Request("Base", "GET", ["action" => "three", "do" => "dropzoneUploader-remove", "dropzoneUploader-file" => "template.latte"]);
		$response = $presenter->run($request);

		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);
		Tester\Assert::true($response->getSource() instanceof Nette\Application\UI\ITemplate);


		// form check
		$service = $presenter["dropzoneUploader"];
        $form = $presenter["dropzoneUploader"]["form"];

		Tester\Assert::same("foo", $service->getUploadDriver()->getFolder());
	}
}


$test = new UploadTest;
$test->run();
