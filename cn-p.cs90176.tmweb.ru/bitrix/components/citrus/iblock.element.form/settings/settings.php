<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_js.php");

use Bitrix\Main\SystemException;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$request = \Bitrix\Main\HttpApplication::getInstance()->getContext()->getRequest();
try
{

	$componentName = $request->get('component_name');
	if (null === $componentName || strlen($componentName) <= 0)
	{
		throw new SystemException(Loc::getMessage('CITRUS_FORM_MISSING_COMPONENT_NAME'));
	}

	if (!CComponentEngine::checkComponentName($componentName))
	{
		throw new SystemException(Loc::getMessage('CITRUS_FORM_WRONG_COMPONENT_NAME'));
	}

	$src_path = $request->get('src_path');
	if (null === $src_path || strlen($src_path) <= 0)
	{
		throw new SystemException(Loc::getMessage('CITRUS_FORM_MISSING_COMPONENT_PATH'));
	}

	$io = CBXVirtualIo::GetInstance();
	$abs_path = $io->RelativeToAbsolutePath($src_path);
	$f = $io->GetFile($abs_path);
	$componentPath = $f->GetContents();
	if (!$componentPath || $componentPath == "")
	{
		throw new SystemException(Loc::getMessage('CITRUS_FORM_FAILED_TO_GET_COMPONENT_SOURCE'));
	}

	$src_line = $request->get('src_line');

	$arComponent = PHPParser::FindComponent($componentName, $componentPath, $src_line);
	if (!isset($arComponent["DATA"]["PARAMS"]["FIELDS"]))
	{
		$arData = array();
	}
	else
	{
		$arData = $arComponent["DATA"]["PARAMS"]["FIELDS"];

		/**
		 * Dlya sohraneniya obratnoy sovmestimosti: v starih versiyah polya peredaavalisy v serializovannom vide
		 */
		if (is_string($arData))
		{
			/**
			 * Dlya tirazhnih resheniy, sobrannih v kodirovke otlichnoy ot kodirovki sayta, serializovanniy massiv
			 * s demo-dannimi okazhetsya ne korrektnim   pereschitaem dlinu strok v serializovannoy stroke
			 */
			if (defined('BX_UTF') && BX_UTF === true && function_exists('mb_strlen'))
			{
                $arData = preg_replace_callback('!s:(\d+):"(.*?)";!s', function ($matches) {
                    return 's:' . mb_strlen($matches[2], 'latin1') . ':"' . $matches[2] .'";';
                }, $arData);
            }
			$arData = unserialize($arData);
		}

		if (!is_array($arData))
		{
			throw new SystemException('Incorrect FIELDS parameter passed');
		}
	}

	CBitrixComponent::includeComponentClass($componentName);
	if (class_exists('CBCitrusIBAddFormComponent'))
	{
		$obj = new CBCitrusIBAddFormComponent;
	}
	else
	{
		throw new SystemException('Class CBCitrusIBAddFormComponent not found');
	}


	foreach ($arData as &$arItem)
	{
		if (isset($arItem['GROUP_FIELD']))
		{
			$arItem['GROUP_FIELD'] = $arItem['GROUP_FIELD'] == 'true' ? true : false;
		}

		if (isset($arItem['ENUM']))
		{
			unset($arItem);
		}

		foreach ($arItem as &$fieldVal)
		{
			if (is_string($fieldVal) || is_numeric($fieldVal) || is_bool($fieldVal))
			{
				continue;
			}

			$argStr = preg_replace('/[\t\r\n]/', '', var_export($fieldVal, true));
			$fieldVal = "={" . $argStr . "}";
		}

		$arItem['ACTIVE'] = true;
		$arItem['HIDE_FIELD'] = $arItem['HIDE_FIELD'] == 'true' ? true : false;
		$arItem['IS_REQUIRED'] = $arItem['IS_REQUIRED'] == 'true' ? true : false;
	}

	// poluchim dostupnie polya
	$arFields = $obj->GetDefaultFields($request->get('iblock_id'));
	if (is_array($arData) && is_array($arFields))
	{
		$arMissingFields = array_diff_key($arFields, $arData);
		foreach ($arMissingFields as $code => &$field)
		{
			$field['ACTIVE'] = false;
			$arData[$code] = $field;
		}
	}
	else
	{
		$arData = $arFields;
	}
	echo \Bitrix\Main\Web\Json::encode($arData);
}
catch (SystemException $ex)
{
	echo \Bitrix\Main\Web\Json::encode(array(
		'succes' => false,
		'message' => $ex->getMessage(),
	));
	CHTTP::SetStatus("500 Internal Server Error");
}