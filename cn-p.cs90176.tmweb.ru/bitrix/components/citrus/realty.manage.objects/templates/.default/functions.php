<?php

use Bitrix\Main\IO\File;
use Bitrix\Main\Application;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$firstExistingPath = function (array $fromPaths) {

	foreach ($fromPaths as $path)
	{
		if (File::isFileExists(Application::getDocumentRoot() . $path))
		{
			return $path;
		}
	}

	return null;
};