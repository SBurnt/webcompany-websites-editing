<?php

/** @var CBCitrusIBAddFormComponent $this Tekushtiy vizvanniy komponent */
/** @var array $arResult Massiv rezulytatov raboti komponenta */
/** @var array $arParams Massiv vhodyashtih parametrov komponenta, mozhet ispolyzovatysya dlya ucheta zadannih parametrov pri vivode shablona (naprimer, otobrazhenii detalynih izobrazheniy ili ssilok). */
/** @var string $componentName Imya vizvannogo komponenta
/** @var string $componentPath Puty k papke s komponentom ot DOCUMENT_ROOT
/** @var string $componentTemplate Shablon vizvannogo komponenta
/** @var string $parentComponentName
/** @var string $parentComponentPath
/** @var string $parentComponentTemplate
/** @var string $templateFile Puty k shablonu otnositelyno kornya sayta, naprimer /bitrix/components/bitrix/iblock.list/templates/.default/template.php) */
/** @var string $templateName Imya shablona komponenta (naprimer: .default) */
/** @var string $templateFolder Puty k papke s shablonom ot DOCUMENT_ROOT (naprimer /bitrix/components/bitrix/iblock.list/templates/.default) */
/** @var array $templateData Massiv dlya zapisi, obratite vnimanie, takim obrazom mozhno peredaty dannie iz template.php v fayl component_epilog.php, prichem eti dannie popadayut v kesh, t.k. fayl component_epilog.php ispolnyaetsya na kazhdom hite */
/** @var CMain $APPLICATION */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

require(__DIR__ . '/func.php');

$arErrors = Array();
$arResult = Array();
$arResult['OLD_VALUE'] = array();

$arParamsForId = $arParams;
unset($arParamsForId["URL_SUCCESS_PAGE"]);
$arResult["FORM_ID"] = md5(serialize($arParamsForId));

$arParams['SUBMIT_TEXT'] = trim($arParams["SUBMIT_TEXT"]);
if (empty($arParams["SUBMIT_TEXT"]))
{
	$arParams['SUBMIT_TEXT'] = GetMessage("CIEE_SUBMIT_TEXT_DEFAULT");
}

$arParams['NOT_CREATE_ELEMENT'] = $arParams["NOT_CREATE_ELEMENT"] == "Y" ? "Y" : "N";
$arParams['SEND_MESSAGE'] = $arParams["SEND_MESSAGE"] == "Y" ? "Y" : "N";
$arParams['CREATE_USER'] = $arParams["CREATE_USER"] == "Y" ? "Y" : "N";

$arParams["PROPERTY_CODE"] = strlen($arParams["PROPERTY_CODE"]) <= 0 ? "" : htmlspecialcharsbx(trim($arParams["PROPERTY_CODE"]));

if (strlen($arParams['URL_CUR_PAGE']) <= 0)
{
	$arParams['URL_CUR_PAGE'] = $APPLICATION->GetCurPage();
}
else
{
	$arParams['URL_CUR_PAGE'] = trim($arParams['URL_CUR_PAGE']);
}

if (strlen($arParams["ANCHOR_ID"]) > 0)
{
	$arParams['URL_CUR_PAGE'] .= "#" . $arParams["ANCHOR_ID"];
}

if (strlen($arParams['URL_SUCCESS_PAGE']) <= 0)
{
	$arParams['URL_SUCCESS_PAGE'] = $APPLICATION->GetCurPageParam("success_{$arResult["FORM_ID"]}=true",
		array("success_{$arResult["FORM_ID"]}"));
}
else
{
	$arParams['URL_SUCCESS_PAGE'] = trim($arParams['URL_SUCCESS_PAGE']);
}

if (!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("CIEE_IBLOCK_MODULE_NOT_INSTALLED"));

	return;
}

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = (int)$arParams["IBLOCK_ID"];

if (isset($_POST['IBLOCK_ID']) && $_POST['IBLOCK_ID'] > 0)
{
	if ((int)$_POST['IBLOCK_ID'] != $arParams["IBLOCK_ID"])
	{
		return false;
	}
}
if (isset($_POST['PARENT_SECTION']) && $_POST['PARENT_SECTION'] > 0)
{
	if ((int)$_POST['PARENT_SECTION'] != $arParams["PARENT_SECTION"])
	{
		return false;
	}
}

if ($arParams["IBLOCK_ID"] <= 0)
{
	ShowError(GetMessage('IBLOCK_ID_NOT_FOUND'));

	return false;
}

$arParams['PARENT_SECTION'] = (int)$arParams['PARENT_SECTION'];

$arParams["PARENT_SECTION_CODE"] = trim($arParams["PARENT_SECTION_CODE"]);
if (strlen($arParams["PARENT_SECTION_CODE"]) <= 0)
{
	$arParams["PARENT_SECTION_CODE"] = false;
}

if (isset($arParams['FIELDS']))
{
	/**
	 * Dlya sohraneniya obratnoy sovmestimosti: v starih versiyah polya peredaavalisy v serializovannom vide
	 */
	if (is_string($arParams['FIELDS']))
	{
		/**
		 * Dlya tirazhnih resheniy, sobrannih v kodirovke otlichnoy ot kodirovki sayta, serializovanniy massiv
		 * s demo-dannimi okazhetsya ne korrektnim   pereschitaem dlinu strok v serializovannoy stroke
		 */
		if (defined('BX_UTF') && BX_UTF === true && function_exists('mb_strlen'))
		{
			// #33525 (https://bugs.php.net/bug.php?id=52144)
			if (!function_exists('CIEE_preg_replace_callback')) {
				function CIEE_preg_replace_callback($matches) {
					return 's:' . mb_strlen($matches[2], 'latin1') . ':"' . $matches[2] .'";';
				}
			}
			$arParams['~FIELDS'] = preg_replace_callback('!s:(\d+):"(.*?)";!s', 'CIEE_preg_replace_callback', $arParams['~FIELDS']);
		}
		$arParams['FIELDS'] = unserialize($arParams['~FIELDS']);
		if (!is_array($arParams['FIELDS']))
		{
			$arParams['FIELDS'] = CIEE_GetDefaultFields($arParams["IBLOCK_ID"], true);
		}
	}

	if (!is_array($arParams['FIELDS']))
	{
		trigger_error('Incorrect FIELDS parameter passed to ' . $this->getName(), E_USER_ERROR);
	}
}
else
{
	$arParams['FIELDS'] = CIEE_GetDefaultFields($arParams["IBLOCK_ID"], true);
}

$arParams["USE_CAPTCHA"] = array_key_exists('CAPTCHA', $arParams['FIELDS']);

if (strlen($arParams['ERROR_LIST_MESSAGE']) <= 0)
{
	$arParams['ERROR_LIST_MESSAGE'] = GetMessage('CIEE_ERROR_LIST_MESSAGE');
}

if (strlen($arParams['SUCCESS_ADD_MESSAGE']) <= 0)
{
	$arParams['SUCCESS_ADD_MESSAGE'] = GetMessage('CIEE_SUCCESS_MESSAGE');
}

$COL_COUNT = (int)$arParams["DEFAULT_INPUT_SIZE"];
if ($COL_COUNT < 1)
{
	$COL_COUNT = 30;
}

$arParams['EDIT_ELEMENT'] = $arParams['EDIT_ELEMENT'] == "Y" ? "Y" : "N";

$arParams['ELEMENT_ID'] = (int)$arParams['ELEMENT_ID'];
if ($arParams['ELEMENT_ID'] <= 0)
{
	$arParams['ELEMENT_ID'] = false;
}

$arParams['AJAX'] = $arParams['AJAX'] == "Y" ? "Y" : "N";

if ($arParams['AJAX'] == "Y")
{
	CUtil::JSPostUnescape();
}

/**
 * dobavim novuyu knopku v nastroyki komponenta,
 * ona pozvolit nam dobavity noviy tip pochtovogo shablona
 */
if ($APPLICATION->GetShowIncludeAreas())
{
    $curPagePath = $APPLICATION->GetCurPageParam('showDialog=1');
    $buttonParams = Array(
        "title" => GetMessage("CIEE_ADD_FORM_MAIL_EVENT"),
        'head' => '',
        'content' => '',
        'icon' => '',
        'resize_id' => '',
        'width' => '780',
        'height' => '370',
        'min_width' => '480',
        'min_height' => '270',
        'draggable' => true,
        'resizable' => true,
    );
    $buttonUrl = $APPLICATION->GetCurPageParam('showDialog=1&' . bitrix_sessid_get(), Array('showDialog', 'sessid'));
    $this->addIncludeAreaIcon(array(
        'URL' => 'javascript:' . $APPLICATION->GetPopupLink(Array(
                "URL" => $buttonUrl,
                "PARAMS" => $buttonParams,
            )),
        'TITLE' => GetMessage("CIEE_ADD_FORM_MAIL_EVENT"),
    ));

    require(__DIR__ . '/mailevent.php');
}

// poluchim spisok dostupnih poley infobloka
$arResult["ITEMS"] = CIEE_GetDefaultFields($arParams["IBLOCK_ID"], true, true);
$arParams['FIELDS']['FZ152'] = array();

if (is_array($arResult["ITEMS"]))
{
	// uberem vse polya kotorie ne nuzhno vivodity v forme
	$arResult["ITEMS"] = array_intersect_key($arResult['ITEMS'], $arParams['FIELDS']);

	// dobavim nedostayushtie polya, i zamenim sushtestvuyushtie esli eto neobhodimo
	foreach ($arResult["ITEMS"] as $code => &$fieldsValue)
	{
		$fieldsValue = array_merge($fieldsValue, $arParams['FIELDS'][$code]);
		$fieldsValue['NAME'] = $arParams['FIELDS'][$code]['TITLE'];
	}

	foreach ($arResult["ITEMS"] as $code => $propInfo)
	{
		// ustanovim znacheniya po umolchaniyu (esli oni esty)
		if (isset($propInfo['DEFAULT_VALUE']))
		{
			$arResult['OLD_VALUE'][$code] = $propInfo['DEFAULT_VALUE'];
		}
	}

	// otsortiruem v neobhodimom poryadke
	$arSummFilds = $arResult['ITEMS'];
	$arResult['ITEMS'] = array();

	foreach ($arParams['FIELDS'] as $fieldsCode => $value)
	{
		if (is_string($value['VALIDRULE']))
		{
			$value['VALIDRULE'] = explode('|', $value['VALIDRULE']);
		}

		$value['HIDE_FIELD'] = $value['HIDE_FIELD'] == 'true' ? true : false;
		$value['IS_REQUIRED'] = $value['IS_REQUIRED'] == 'true' ? true : false;
		$value['ACTIVE'] = $value['ACTIVE'] == 'true' ? true : false;

		if (!isset($value["READ_ONLY"]) || !$value["READ_ONLY"])
		{
			if (isset($arSummFilds[$fieldsCode]))
			{
				if (is_string($arSummFilds[$fieldsCode]['VALIDRULE']))
				{
					$arSummFilds[$fieldsCode]['VALIDRULE'] = explode('|', $arSummFilds[$fieldsCode]['VALIDRULE']);
				}

				$arSummFilds[$fieldsCode]['HIDE_FIELD'] = $arSummFilds[$fieldsCode]['HIDE_FIELD'] == 'true' ? true : false;
				$arSummFilds[$fieldsCode]['IS_REQUIRED'] = $arSummFilds[$fieldsCode]['IS_REQUIRED'] == 'true' ? true : false;
				$arSummFilds[$fieldsCode]['ACTIVE'] = $arSummFilds[$fieldsCode]['ACTIVE'] == 'true' ? true : false;

				$arResult['ITEMS'][$fieldsCode] = $arSummFilds[$fieldsCode];
			}
			else
			{
				$arResult['ITEMS'][$fieldsCode] = $value;
			}
		}
	}

	if ($arParams['EDIT_ELEMENT'] == "Y" && $arParams['ELEMENT_ID'] > 0)
	{
		$arResult['OLD_VALUE'] = $this->GetOldData($arResult);
	}

	// obrabotaem dannie poluchennie iz formi
	if (
		(array_key_exists('FORM_ID', $_REQUEST) && $arResult["FORM_ID"] == $_REQUEST['FORM_ID'])
		&&
		(
			($_SERVER['REQUEST_METHOD'] == 'POST' && check_bitrix_sessid())
			|| ($arParams['AJAX'] == "Y")
		)
	)
	{
		// proverim pravilyno li vveli slovo s kartinki (CAPTCHA)
		if ($arParams["USE_CAPTCHA"])
		{
			if (!$APPLICATION->CaptchaCheckCode($_REQUEST["captcha_word"], $_REQUEST["captcha_sid"]))
			{
				$arErrors["CAPTCHA"] = GetMessage("CIEE_IBLOCK_FORM_WRONG_CAPTCHA");
			}
		}
		elseif (isset($_REQUEST['PROPERTY']) && is_array($_REQUEST['PROPERTY']) && array_key_exists('GIFT', $_REQUEST['PROPERTY']))
		{
			$arErrors[] = GetMessage("CIEE_SPAM_ERROR_MESSAGE");
		}

		$typeList = array('N', 'L', 'E', 'G');
		$arUpdateFieldValues = $arUpdatePropertyValues = array();

		foreach ($arResult["ITEMS"] as $code => $info)
		{
			if ($code == 'CAPTCHA')
			{
				continue;
			}
			$fieldname = $info['NAME'] ? $info['NAME'] : $info['PLACEHOLDER'];
			if (!array_key_exists($code, $_REQUEST['PROPERTY']) && $info['PROPERTY_TYPE'] != 'F')
			{
				if ($info['IS_REQUIRED'])
				{
					if (strlen($fieldname) > 0)
					{
						$arErrors[$code] = GetMessage('NOT_DEFINED_REQUIRED_FIELD', array("#FIELD#" => $fieldname));
					}
					else
					{
						$arErrors[$code] = GetMessage('NOT_DEFINED_REQUIRED_FIELD_EMPTY');
					}
				}
				continue;
			}

			$fieldsValue = $_REQUEST['PROPERTY'][$code];

			if ($info['PROPERTY_TYPE'] == 'F')
			{
				$arFiles = $_FILES['PROPERTY']['tmp_name'][$code];
				$fieldsValue = array_diff($arFiles, array(''));

				if (empty($fieldsValue) && $info['IS_REQUIRED'])
				{
					if (strlen($fieldname) > 0)
					{
						$arErrors[$code] = GetMessage('NOT_DEFINED_REQUIRED_FIELD', array("#FIELD#" => $fieldname));
					}
					else
					{
						$arErrors[$code] = GetMessage('NOT_DEFINED_REQUIRED_FIELD_EMPTY');
					}
				}
			}
			elseif ($info['MULTIPLE'] == "Y")
			{
				$fieldsValue = array_diff($fieldsValue, array('', '0'));
				if (empty($fieldsValue) && $info['IS_REQUIRED'])
				{
					if (strlen($fieldname) > 0)
					{
						$arErrors[$code] = GetMessage('NOT_DEFINED_REQUIRED_FIELD', array("#FIELD#" => $fieldname));
					}
					else
					{
						$arErrors[$code] = GetMessage('NOT_DEFINED_REQUIRED_FIELD_EMPTY');
					}
				}
			}
			elseif ($info['MULTIPLE'] == "N" && strlen($fieldsValue) <= 0 && $info['IS_REQUIRED'])
			{
				if (strlen($fieldname) > 0)
				{
					$arErrors[$code] = GetMessage('NOT_DEFINED_REQUIRED_FIELD', array("#FIELD#" => $fieldname));
				}
				else
				{
					$arErrors[$code] = GetMessage('NOT_DEFINED_REQUIRED_FIELD_EMPTY');
				}
			}
			elseif (in_array($info['PROPERTY_TYPE'], $typeList) && (int)$fieldsValue <= 0 && $info['IS_REQUIRED'])
			{
				if (strlen($fieldname) > 0)
				{
					$arErrors[$code] = GetMessage('NOT_COMPLETED_REQUIRED_FIELD', array("#FIELD#" => $fieldname));
				}
				else
				{
					$arErrors[$code] = GetMessage('NOT_COMPLETED_REQUIRED_FIELD_EMPTY');
				}
			}

			if (isset($arErrors[$code]))
			{
				continue;
			}

			if (is_array($fieldsValue))
			{
				foreach ($fieldsValue as $id => $value)
				{
					if ($info['PROPERTY_TYPE'] == 'F')
					{
						$filePath = $value;
						if (is_uploaded_file($filePath))
						{
							$arFile = CFile::MakeFileArray($filePath);
							$arFile["name"] = $_FILES['PROPERTY']['name'][$code][$id];
							$fieldsValue[$id] = $arFile;
						}
					}
					elseif (in_array($info['PROPERTY_TYPE'], $typeList) && (int)$value > 0)
					{
						$fieldsValue[$id] = (int)$value;
					}
					elseif (!in_array($info['PROPERTY_TYPE'], $typeList) && strlen($value) > 0)
					{
						$fieldsValue[$id] = trim($value);
					}
				}
			}
			else
			{
				if (strlen($info['USER_TYPE']) > 0)
				{
					switch ($info['USER_TYPE'])
					{
						case 'HTML':
							$fieldsValue = array(
								"VALUE" => array(
									"TEXT" => htmlspecialcharsbx(trim($fieldsValue)),
									"TYPE" => "text",
								),
							);
							break;
						default:
							$fieldsValue = htmlspecialcharsbx(trim($fieldsValue));
					}
				}
				else
				{
					$fieldsValue = in_array($info['PROPERTY_TYPE'],
						$typeList) ? (int)$fieldsValue : trim($fieldsValue);
				}
			}

			if ($info['MULTIPLE'] == "Y" && !empty($fieldsValue))
			{
				$fieldsValue = array_values($fieldsValue);
				!isset($info['PROPERTY_ID']) ? $arUpdateFieldValues[$code] = $fieldsValue : $arUpdatePropertyValues[$code] = $fieldsValue;
			}
			elseif ($info['PROPERTY_TYPE'] == 'F' && !empty($fieldsValue))
			{
				$fieldsValue = array_shift($fieldsValue);
				!isset($info['PROPERTY_ID']) ? $arUpdateFieldValues[$code] = $fieldsValue : $arUpdatePropertyValues[$code] = $fieldsValue;
			}
			elseif (in_array($info['PROPERTY_TYPE'], $typeList) && (int)$fieldsValue > 0)
			{
				!isset($info['PROPERTY_ID']) ? $arUpdateFieldValues[$code] = $fieldsValue : $arUpdatePropertyValues[$code] = $fieldsValue;
			}
			elseif (!in_array($info['PROPERTY_TYPE'], $typeList) && strlen($fieldsValue) > 0)
			{
				!isset($info['PROPERTY_ID']) ? $arUpdateFieldValues[$code] = $fieldsValue : $arUpdatePropertyValues[$code] = $fieldsValue;
			}
			else
			{
				!isset($info['PROPERTY_ID']) ? $arUpdateFieldValues[$code] = $fieldsValue : $arUpdatePropertyValues[$code] = $fieldsValue;
			}

			// dopolnitelynaya proverka po regulyarnomu virazheniyu, kotoroe ukazanno v nastroykah
			/*if ($arParams["JQUERY_VALID"] !=="Y" && isset($info['VALIDRULE']) && strlen($info['VALIDRULE']) > 0 && !preg_match($info['VALIDRULE'],
					trim($fieldsValue))
			)
			{
				$arErrors[$code] = $info['VALID_ERROR_MSG'];
			}*/
		}

		// esli v forme ne ukazanno pole - privyazka k razdelu, to proverim nastroyki kompanenta
		if (!isset($arUpdateFieldValues['IBLOCK_SECTION'])
			|| (int)$arUpdateFieldValues['IBLOCK_SECTION'] <= 0 && ($arParams["PARENT_SECTION"] > 0 || strlen($arParams["PARENT_SECTION_CODE"]) > 0)
		)
		{
			$parentSection = CIBlockFindTools::GetSectionID(
				$arParams["PARENT_SECTION"],
				$arParams["PARENT_SECTION_CODE"],
				array(
					"IBLOCK_ID" => $arParams['IBLOCK_ID'],
				)
			);
			if ($parentSection > 0)
			{
				$arUpdateFieldValues["IBLOCK_SECTION_ID"] = $parentSection;
			}
		}

		$events = GetModuleEvents("main", "OnPrepeaDataFromUpdateOrAdd");
		while ($arEvent = $events->Fetch())
		{
			ExecuteModuleEventEx($arEvent, array(&$arUpdateFieldValues, &$arUpdatePropertyValues));
		}

		if (empty($arErrors))
		{
			$arUpdate = array(
				'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			);

			$arUpdate = array_merge($arUpdate, $arUpdateFieldValues);

			// proverim obyazatelynoe pole NAME, esli ego net to zapolnim ego po umolchaniyu
			if (!array_key_exists('NAME',
					$arUpdate) && ($arParams['EDIT_ELEMENT'] == "N" || $arParams['ELEMENT_ID'] <= 0)
			)
			{
				$arUpdate['NAME'] = GetMessage('CIEE_IBLOCK_NAME_FIELD_DEFAULT');
			}

			if (!empty($arUpdatePropertyValues))
			{
				foreach ($arUpdatePropertyValues as $propCode => $propValue)
				{
					$arUpdate['PROPERTY_VALUES'][$arResult["ITEMS"][$propCode]['PROPERTY_ID']] = $propValue;
				}
			}

			$obCIBlockElement = new CIBlockElement;

			// esli znachenie parametra ne ustanovlenno element ne sozdaiotsya
			if ($arParams['NOT_CREATE_ELEMENT'] == "N")
			{
				$bxIsUpdate = false;
				if ($arParams['EDIT_ELEMENT'] == "Y" && $arParams['ELEMENT_ID'] > 0)
				{
					$bxIsUpdate = $obCIBlockElement->GetByID($arParams['ELEMENT_ID'])->Fetch();
				}

				// isklyuchim svoystva iz massiva, chtobi obnovity iil dobavity element
				$arrUpdate = array_diff_key($arUpdate, array('PROPERTY_VALUES' => ''));
				if ($bxIsUpdate)
				{
					$newID = $arParams['ELEMENT_ID'];
					// obnovim polya u elementa
					if (!empty($arrUpdate))
					{
						$obCIBlockElement->Update($newID, $arrUpdate);
					}
				}
				else
				{
					$newID = $obCIBlockElement->Add($arUpdate, false, true, true);
				}

				if (// obnovim svoystva elementa
					$newID &&
					(array_key_exists('PROPERTY_VALUES', $arUpdate) && !empty($arUpdate['PROPERTY_VALUES']))
				)
				{
					$obCIBlockElement->SetPropertyValuesEx($newID, $arParams['IBLOCK_ID'],
						$arUpdate['PROPERTY_VALUES']);
				}

				if (!$newID)
				{
					$arErrors[] = $obCIBlockElement->LAST_ERROR;
					$arResult['bVarsFromForm'] = true;
				}
				else
				{
					$arParams['ELEMENT_ID'] = $newID;
				}
			}

			// sozdadim polyzovatelya esli etoukazano v nastroykah
			if ($arParams['CREATE_USER'] == "Y" && strlen($arParams['PROPERTY_CODE']) > 0)
			{
				global $DB, $USER_FIELD_MANAGER, $USER;

				$email = $arUpdate['PROPERTY_VALUES'][$arResult["ITEMS"]["PROPERTY_" . $arParams['PROPERTY_CODE']]['PROPERTY_ID']];

				// proverim korrektnosty vvoda email
				if (check_email($email))
				{
					$siteId = SITE_ID;

					$checkword = randString(8);
					$login = randString(8);
					$password_min_length = 8;

					$password_chars = array(
						"abcdefghijklnmopqrstuvwxyz",
						"ABCDEFGHIJKLNMOPQRSTUVWXYZ",
						"0123456789",
						",.<>/?;:'\"[]{}\\|`~!@#\$%^&*()-_+=",
					);

					$arFields = Array(
						"LOGIN" => $login,
						"CHECKWORD" => $checkword,
						"~CHECKWORD_TIME" => $DB->CurrentTimeFunction(),
						"EMAIL" => $email,
						"ACTIVE" => "Y",
						"NAME" => "",
						"LAST_NAME" => "",
						"USER_IP" => $_SERVER['REMOTE_ADDR'],
						"USER_HOST" => @gethostbyaddr($_SERVER['REMOTE_ADDR']),
						"SITE_ID" => $siteId,
					);

					$arFields["PASSWORD"] = $arFields["CONFIRM_PASSWORD"] = randString($password_min_length,
						$password_chars);

					$USER_FIELD_MANAGER->EditFormAddFields('USER', $arFields);

					$user = new CUser;
					if ($ID = $user->Add($arFields))
					{
						$event = new CEvent;
						$arFields["USER_ID"] = $ID;

						$arEventFields = $arFields;
						unset($arEventFields["PASSWORD"]);
						unset($arEventFields["CONFIRM_PASSWORD"]);

						$event->SendImmediate("NEW_USER", $arEventFields["SITE_ID"], $arEventFields);
						CUser::SendUserInfo($ID, $arEventFields["SITE_ID"], GetMessage("USER_REGISTERED_SIMPLE"), true);
					}

					$arErrors[] = $user->LAST_ERROR;

					if ($APPLICATION->GetException())
					{
						$err = $APPLICATION->GetException();
						$arErrors[] = $err->GetString();
					}
				}
			}

			// esli ustanovlenno znachenie otpravlyaty uvedomlenie, to otpravim pisymo
			if ($arParams['SEND_MESSAGE'] == "Y" && empty($arErrors) && isset($newID))
			{
				$event = new CEvent;
				$arMailFields = $this->GetMailField($newID, $arUpdateFieldValues);
				if (false !== $arMailFields && !empty($arMailFields))
				{
					foreach ($arParams['MAILE_EVENT_TEMPLATE'] as $mailTemplate)
					{
						$id = $event->Send($arParams['MAIL_EVENT'], SITE_ID, $arMailFields, "N", $mailTemplate);
					}
				}
			}

			if (empty($arErrors))
			{
				if ($arParams['AJAX'] != "Y")
				{
					$uri = $arParams['URL_SUCCESS_PAGE'];
					if (strlen($arParams["ANCHOR_ID"]) > 0)
					{
						$uri .= "#" . $arParams["ANCHOR_ID"];
					}

					LocalRedirect($uri);
				}

				if ($arParams['AJAX'] == "Y")
				{
					$arResult["MESSAGE"] = $arParams['SUCCESS_ADD_MESSAGE'];
				}
			}
		}

		//if(!empty($arErrors)) {
		// esli massiv oshibok ne pust to zapishem tekushtie znachenie poley
		$arResult['OLD_VALUE'] = CIEE_htmlspecialchars($arUpdatePropertyValues + $arUpdateFieldValues);
		//}
	}
}
else
{
	$this->abortResultCache();
	ShowError(GetMessage("CIEE_IBLOCK_NOT_FOUND"));
	@define("ERROR_404", "Y");
	if ($arParams["SET_STATUS_404"] === "Y")
	{
		CHTTP::SetStatus("404 Not Found");
	}
}

if (!empty($arErrors))
{
	/**
	 * V starih shablonah soobshteniya ob oshibke peredavalisy v vide stroki,
	 * poetomu noviy variant   v vide massiva budem peredavaty v shablon v novom klyuche
	 */
	$arResult["ERRORS_ARRAY"] = $arErrors;
	$arResult["ERRORS"] = implode('<br>', $arErrors);
}

if (isset($_GET["success_{$arResult["FORM_ID"]}"]) && $_GET["success_{$arResult["FORM_ID"]}"] === "true")
{
	$arResult["MESSAGE"] = $arParams['SUCCESS_ADD_MESSAGE'];
}

// poluchity kapchu
if ($arParams["USE_CAPTCHA"] && $arParams["ID"] <= 0)
{
	$arResult["CAPTCHA_CODE"] = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
}
else
{
	$defaultFields = CIEE_GetDefaultFields();
	$giftField = $defaultFields['GIFT'];

	// kaptchi net   dobavim prostuyu zashtitu ot botov, ne podderzhivayushtih javascript
	ob_start();
	?>
	<script>
        (function (BX) {
            var removeGift = function() {
                var ids = ['GIFT', '<?=\CUtil::JSEscape(substr($arResult["FORM_ID"], 6))?>_GIFT'];
                ids.forEach(function (id) {
                    var gift = BX(id);
                    while (gift) {
                        gift.remove();
                        gift = BX(id);
                    }
                });
            };
            BX.ready(removeGift);
            BX.addCustomEvent('onFrameDataReceived', removeGift);
        })(BX);
	</script>
	<?
    $isAjax = \Bitrix\Main\Application::getInstance()->getContext()->getRequest()->isAjaxRequest() || $_REQUEST['AJAX_CALL'] == 'Y';
    if ($isAjax)
    {
        ob_end_flush();
    }
    else
    {
	    $APPLICATION->AddHeadString(ob_get_clean(), $unique = true, class_exists('\Bitrix\Main\Page\AssetLocation') ? \Bitrix\Main\Page\AssetLocation::AFTER_JS_KERNEL : null);
    }

	if (!array_key_exists('GIFT', $arResult["ITEMS"]))
	{
		$arResult['ITEMS']['GIFT'] = $giftField;
	}
}

if ($arParams['CREATE_USER'] == "Y" && strlen($arParams['PROPERTY_CODE']) > 0)
{
	global $USER_FIELD_MANAGER;
	$arUserFields = $USER_FIELD_MANAGER->GetUserFields('USER');

	ob_start();
	if (count($arUserFields) > 0)
	{
		foreach ($arUserFields as $fieldName => $arUserField)
		{
			$arUserField["VALUE_ID"] = 0;
			echo $USER_FIELD_MANAGER->GetEditFormHTML($bVarsFromForm = ($_SERVER['REQUEST_METHOD'] == 'POST'),
					$fieldName, $arUserField) . "<br />";
		}
	}

	$arResult['USER_FIELDS'] = ob_get_contents();
	ob_end_clean();
}

/**
 * Dlya publichki i shablona versii 1.2.19 1.2.20 (#33725)
 */
if ($this->getTemplateName() == 'order_call')
{
	ob_start();
}

$this->includeComponentTemplate();

if ($this->getTemplateName() == 'order_call')
{
	$APPLICATION->AddViewContent('order_call_form', ob_get_clean());
}
