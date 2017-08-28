# Dropzone Uploader
Dropzone Uploader for [Nette Framework](https://nette.org) and [DropzoneJs](http://www.dropzonejs.com).

[![Build Status](https://travis-ci.org/aleswita/DropzoneUploader.svg?branch=master)](https://travis-ci.org/aleswita/DropzoneUploader)
[![Coverage Status](https://coveralls.io/repos/github/aleswita/DropzoneUploader/badge.svg?branch=master)](https://coveralls.io/github/aleswita/DropzoneUploader?branch=master)

## Installation
The best way to install AlesWita/DropzoneUploader is using [Composer](http://getcomposer.org/):
```sh
# For PHP 7.1, Nette Framework 2.4/3.0 and DropzoneJs 5
$ composer require aleswita/dropzoneuploader
```


## Usage

#### Config
```neon
extensions:
	webloader: AlesWita\DropzoneUploader\Extension

dropzoneuploader:
	dropzoneTemplate: ::constant(AlesWita\DropzoneUploader\Factory::BOOTSTRAP_V4_TEMPLATE)
	uploadDriver:
		driver: AlesWita\DropzoneUploader\UploadDriver\Ftp
		settings:
			url: ftp://user:password@my-ftp.cz
	settings:
		maxFilesize: 1mb
		acceptedFiles:
			- application/vnd.ms-excel
			- application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
		addRemoveLinks: true
	messages:
		dictDefaultMessage: 'Drag & drop files!'
```

#### Presenter
```php
use AlesWita;


final class DropzonePresenter extends Nette\Application\UI\Presenter
{
	/** @var AlesWita\DropzoneUploader\Factory @inject */
	public $dropzoneFactory;

	...
	...

	/**
	 * @return AlesWita\DropzoneUploader\DropzoneUploader
	 */
	protected function createComponentDropzoneForm(): AlesWita\DropzoneUploader\DropzoneUploader {
		$uploader = $this->dropzoneFactory->getDropzoneUploader();

		$uploader->onBeginning[] = function (AlesWita\DropzoneUploader\DropzoneUploader $uploader): void {
			$uploader->setFolder('foo');
		};

		return $uploader;
	}
}
```

#### Template
```latte
{control dropzoneForm}
```

## Result
#### Bootsrap V4 template
Medium, large and extra large devices:

![bootstrap-v4-md-lg-xl](https://raw.githubusercontent.com/aleswita/DropzoneUploader/master/examples/dropzone-bootstrap-v4-md-lg-xl.png)

Small devices:

![bootstrap-v4-sm](https://raw.githubusercontent.com/aleswita/DropzoneUploader/master/examples/dropzone-bootstrap-v4-sm.png)
