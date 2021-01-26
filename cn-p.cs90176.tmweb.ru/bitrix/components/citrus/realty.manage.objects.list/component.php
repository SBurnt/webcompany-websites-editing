<?php

use Bitrix\Main\Localization\Loc;
use Citrus\ArealtyPro\Integrations\Iblock\PropertyTypeFeed;
use Citrus\ArealtyPro\Manage\ComponentUtils;
use Citrus\ArealtyPro\Manage\RightsProvider;
use Citrus\ArealtyPro\Meta\Field\FieldType;
use Citrus\ArealtyPro\Meta\Field\IblockField;
use Citrus\ArealtyPro\Meta\Field\IblockProperty;

/** @var CitrusRealtyManageObjectsList $this Текущий вызванный компонент */
/** @var array $arResult Массив результатов работы компонента */
/** @var array $arParams Массив входящих параметров компонента, может использоваться для учета заданных параметров при выводе шаблона (например, отображении детальных изображений или ссылок). */
/** @var string $componentName Имя вызванного компонента
/** @var string $componentPath Путь к папке с компонентом от DOCUMENT_ROOT
/** @var string $componentTemplate Шаблон вызванного компонента
/** @var string $parentComponentName
/** @var string $parentComponentPath
/** @var string $parentComponentTemplate
/** @var string $templateFile Путь к шаблону относительно корня сайта, например /bitrix/components/bitrix/iblock.list/templates/.default/template.php) */
/** @var string $templateName Имя шаблона компонента (например: .dеfault) */
/** @var string $templateFolder Путь к папке с шаблоном от DOCUMENT_ROOT (например /bitrix/components/bitrix/iblock.list/templates/.default) */
/** @var array $templateData Массив для записи, обратите внимание, таким образом можно передать данные из template.php в файл component_epilog.php, причем эти данные попадают в кеш, т.к. файл component_epilog.php исполняется на каждом хите */
/** @var CMain $APPLICATION */

/**
 * @todo sections view
 * @todo component class
 * @todo entity name from iblock settings
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arParams["IBLOCK_ID"] = $this->getIblockId();
$arParams["IBLOCK_SECTION_ID"] = intval($arParams["IBLOCK_SECTION_ID"]);

$arParams["DEFAULT_SORT_FIELD"] = trim($arParams["DEFAULT_SORT_FIELD"]);
$arParams["DEFAULT_SORT_ORDER"] = trim($arParams["DEFAULT_SORT_ORDER"]);

if (strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if (!is_array($arrFilter))
		$arrFilter = array();
}

if (!is_array($arParams["CHAIN_ITEMS"]))
	$arParams["CHAIN_ITEMS"] = array();

$arParams["TITLE"] = trim($arParams["TITLE"]);

$arErrors = array();
$arResult = array();

if ($arParams["IBLOCK_SECTION_ID"] > 0)
{
	$arResult['SECTION'] = CIBlockSection::GetByID($arParams["IBLOCK_SECTION_ID"])->GetNext();
	if (!is_array($arResult['SECTION']) || empty($arResult['SECTION']) || $arResult['SECTION']['ACTIVE'] != 'Y')
	{
		ShowError(GetMessage('C_IBLOCK_SECTION_NOT_FOUND'));
		return;
	}
}

if (!$this->getRights()->hasAccess())
{
	global $APPLICATION;

	$ex = $APPLICATION->GetException();
	$APPLICATION->ShowAuthForm($ex ? $ex->GetString() : '');

	return;
}

$getFilterField = function($code, &$arFilter, \Citrus\ArealtyPro\Meta\Field\Base $field) use (&$arFilterSectionsList, $arParams)
{
	$codeParam = ToLower($code);
	$code = ToUpper($code);
	$filtered = false;

	if ($field instanceof \Citrus\ArealtyPro\Meta\Field\IblockProperty && ($propFields = $field->getPropertyFields()))
	{
		$arUserType = \CIBlockProperty::GetUserType($propFields["USER_TYPE"]);
		if (is_callable($arUserType['GetPublicFilterHTML']))
		{
			if ((!is_array($_REQUEST[$codeParam]) && !empty($_REQUEST[$codeParam]))
				|| (is_array($_REQUEST[$codeParam]) && count(array_filter($_REQUEST[$codeParam]))))
			{
				if (array_key_exists("AddFilterFields", $arUserType))
				{
					call_user_func_array($arUserType["AddFilterFields"], array(
						$field->getPropertyFields(),
						array("VALUE" => $codeParam),
						&$arFilter,
						&$filtered,
					));
				}
				else
				{
					$arFilter[$code] = $_REQUEST[$codeParam];
				}
			}
			return array(
				'id' => $codeParam,
				'name' => $field->getTitle(),
				'type' => 'custom',
				'value' => call_user_func_array($arUserType['GetPublicFilterHTML'], array(
					$propFields,
					array('VALUE' => $codeParam)
				)),
			);
		}
	}

	switch ($field->getType())
	{
		case FieldType::INT:
			if (strlen($_REQUEST[$codeParam . '_from']) > 0)
				$arFilter['>=' . $code] = $_REQUEST[$codeParam . '_from'];
			if (strlen($_REQUEST[$codeParam . '_to']) > 0)
				$arFilter['<=' . $code] = $_REQUEST[$codeParam . '_to'];
			return array(
				'id' => $codeParam,
				'name' => $field->getTitle(),
				'type' => 'number',
			);
            break;

		case FieldType::DATE:
		case FieldType::DATETIME:
			ComponentUtils::processGridDateFieldFilter($code, $codeParam, $arFilter, "FULL", true);
			return array(
                'id' => $codeParam,
				'name' => $field->getTitle(),
                'type' => 'date',
            );
            break;

		case FieldType::CHECKBOX:
			if (strlen($_REQUEST[$codeParam]) > 0)
				$arFilter[$code] = $_REQUEST[$codeParam];
			return array(
                'id' => $codeParam,
				'name' => $field->getTitle(),
                'type' => 'list',
                'items' => array(
                    "" => GetMessage("C_ALL"),
                    "Y" => GetMessage("C_YES"),
                    "N" => GetMessage("C_NO"),
				)
            );
            break;

		case FieldType::ENUM:
			/** @var \Citrus\ArealtyPro\Meta\Field\IblockField $field */
			$enumValues = $field->getEnumValues();
			if (is_array($_REQUEST[$codeParam]) && count(array_filter($_REQUEST[$codeParam])))
			{
				$arFilter[$code] = $_REQUEST[$codeParam];
			}
			else if (strlen($_REQUEST[$codeParam]) > 0 && isset($enumValues[$_REQUEST[$codeParam]]))
			{
				if ($code == 'IBLOCK_SECTION_ID')
				{
					$arFilter['SECTION_ID'] = $_REQUEST[$codeParam];
					$arFilter['INCLUDE_SUBSECTIONS'] = 'Y';
				}
				else
				{
					$arFilter[$code] = $_REQUEST[$codeParam];
				}
			}
			return array(
				'id' => $codeParam,
				'name' => $field->getTitle(),
				'type' => 'list',
				'params' => array('multiple' => true),
				'items' => $enumValues
			);
			break;

		default:
			if (strlen($_REQUEST[$codeParam]) > 0)
				$arFilter['%' . $code] = $_REQUEST[$codeParam];
			return array(
                'id' => $codeParam,
				'name' => $field->getTitle(),
                'params' => array('size' => 40),
                'type' => 'string',
            );
	}
};

$rights = $this->getRights();
$getItemActions = function($arItem, $arResult, $strEditUrl, $strDeleteUrl) use ($rights)
{
	$arActions = array();
	if ($rights->canDoOperation(RightsProvider::OP_ELEMENT_EDIT, $arItem['ID']))
	{
		$arActions[] = array(
			"TEXT" => $arResult["IBLOCK"]["ELEMENT_EDIT"],
			"DEFAULT" => true,
			"DISABLED" => false,
			"ONCLICK" => "jsUtils.Redirect({}, '$strEditUrl'); return false;",
			"ICONCLASS" => 'edit',
		);
	}
	elseif ($rights->canDoOperation(RightsProvider::OP_ELEMENT_READ, $arItem['ID']))
	{
		$arActions[] = array(
			"TEXT" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_VIEW_ELEMENT", ['#ELEMENT_NAME#' => ToLower($arResult['IBLOCK']['ELEMENT_NAME'])]),
			"DEFAULT" => true,
			"DISABLED" => false,
			"ONCLICK" => "jsUtils.Redirect({}, '$strEditUrl'); return false;",
			"ICONCLASS" => 'view',
		);
	}

	if ($rights->canDoOperation(RightsProvider::OP_ELEMENT_DELETE, $arItem['ID']))
	{
		$arActions[] = array(
			'TEXT' => $arResult["IBLOCK"]["ELEMENT_DELETE"],
			'DEFAULT' => false,
			'DISABLED' => false,
			"ONCLICK" => "if (confirm('" . GetMessage('C_CONFIRM_DELETE_ELEMENT') . "')) jsUtils.Redirect({}, '$strDeleteUrl'); return false;",
			'ICONCLASS' => 'delete',
		);
	}

	return $arActions;
};

$arResult["IBLOCK"] = $this->getIblockField();
$arResult["GRID_ID"] = str_replace(array(':', '.'), '_', $this->__name . ':' . $arResult["IBLOCK"]["ID"]);
$rsElement = null;
if (is_array($arResult["IBLOCK"]))
{
	$aOptions = CUserOptions::GetOption("main.interface.grid", $arResult["GRID_ID"], array());
	if (is_array($aOptions) && array_key_exists('views', $aOptions) && array_key_exists($aOptions['current_view'],
			$aOptions['views']))
	{
		$pageSize = $aOptions['views'][$aOptions['current_view']]['page_size'];
		$pageSize = ($pageSize > 0 ? $pageSize : 20);
	}
	else
	{
		$pageSize = 20;
	}

	$arNavParams = array('nPageSize' => $pageSize);
	$arNavigation = CDBResult::GetNavParams($arNavParams);

	$grid = new CGridOptions($arResult['GRID_ID']);
	$visibleColumns = $grid->GetVisibleColumns() ? $grid->GetVisibleColumns() : $arParams["FIELD_CODE"];

	//SELECT
	$arSelect = array_unique(array_merge(array(
		"ID",
		"IBLOCK_ID",
		"NAME",
		"CODE",
		"DETAIL_PAGE_URL",
	), $visibleColumns));

	$arSelect = array_filter($arSelect, function ($code) {
		return strpos($code, 'PROPERTY_') === null;
	});

	//WHERE
	$arFilter = array_merge(array(
		"IBLOCK_ID" => $arResult["IBLOCK"]["ID"],
	), $arrFilter, $this->getRights()->getFilter());

	if ($arParams["IBLOCK_SECTION_ID"] > 0)
	{
		$arFilter['SECTION_ID'] = $arParams["IBLOCK_SECTION_ID"];
	}

	$arResult["FILTER"] = array();

	$excludeFilterFields = array();
	if (!isset($arParams["RL_FILTER_FIELDS"]))
	{
		$arParams["RL_FILTER_FIELDS"] = array(
			0 => "SORT",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "PROPERTY_complex",
			4 => "PROPERTY_photo",
			5 => "PROPERTY_video",
			6 => "PROPERTY_geodata",
			7 => "",
		);
	}
	if (is_array($arParams["RL_FILTER_FIELDS"]))
	{
		$excludeFilterFields = array_flip($arParams["RL_FILTER_FIELDS"]);
	}
	foreach ($this->getMeta()->getFields() as $fieldCode => $field)
	{
		if (!isset($excludeFilterFields[$fieldCode]))
		{
			$arResult["FILTER"][] = $getFilterField($fieldCode, $arFilter, $field);
		}
	}

	$this->processActions();

	$arColumns = array();
	$arResult["COLUMNS"] = array();
	foreach ($this->getMeta()->getFields() as $fieldCode => $field)
	{
		if (!in_array($fieldCode, $arParams['FIELD_CODE']))
		{
			continue;
		}
		$arResult["COLUMNS"][] = array(
			'id' => $fieldCode,
			'sort' => ToLower($fieldCode),
			'name' => $field->getTitle(),
			'default' => in_array($fieldCode, $arParams["FIELD_CODE"]),
			'editable' => false,
		);
	}

	// sorting
	$arResult["SORT_COLUMNS"] = array();
	foreach ($arResult["COLUMNS"] as $arColumn)
	{
		if (strlen($arColumn['sort']) > 0) {
			$arResult["SORT_COLUMNS"][$arColumn['sort']] = $arColumn['sort'];
		}
	}
	$arResult["SORT"] = array(
		'by' => array_key_exists($_GET['by'], $arResult["SORT_COLUMNS"]) ? ToLower($arResult["SORT_COLUMNS"][$_GET['by']]) : $arParams['DEFAULT_SORT_FIELD'],
		'order' => isset($_GET['order']) ? ($_GET['order'] == 'asc' ? 'asc' : 'desc') : $arParams['DEFAULT_SORT_ORDER'],
	);

	// skrivaty chernoviki v spiske lichnogo kabineta
	$arFilter['PROPERTY_draft_for'] = false;

	// fetch data
	$arResult["DATA"] = array();
	$rsElement = CIBlockElement::GetList(array($arResult["SORT"]['by'] => $arResult["SORT"]['order']), $arFilter, false, $arNavParams, $arSelect);
	$rsElement->SetUrlTemplates();
	while ($obElement = $rsElement->GetNextElement())
	{
		$arItem = $obElement->GetFields();

		$arItem["FIELDS"] = array();
		$arItem["PROPERTIES"] = $obElement->GetProperties();

		$uri = new \Bitrix\Main\Web\Uri($arItem['DETAIL_PAGE_URL']);
		$uri->addParams([
			'lk_hash' => \Citrus\ArealtyPro\generateOfferParam($arItem['CODE'], '', $USER->GetID()),
		]);
		$arItem['DETAIL_PAGE_URL'] = $uri->getUri();

		foreach ($visibleColumns as $code)
		{
			// сохраненное в настройках представления грида поле больше недоступно
			// (отсутсвует среди полей списка в параметрах компонента)
			if (!in_array($code, $arParams['FIELD_CODE']))
			{
				$grid->ResetDefaultView();
				continue;
			}
			$field = $this->getMeta()->getField($code);
			if ($field instanceof IblockField)
			{
				$arItem["FIELDS"][$code] = $arItem[$code];
				$arItem["FIELDS_VIEW"][$code] = $field->getDisplayValue($arItem[$code], $arItem);
				if  ($code == "ID")
				{
					$arItem["FIELDS_VIEW"][$code] = "<a title='{$arResult["IBLOCK"]["ELEMENT_EDIT"]}' href='{$this->getEditUrl($arItem['ID'])}'>{$arItem[$code]}</a>";
				}
			}
			elseif ($field instanceof IblockProperty)
			{
				$prop = &$arItem["PROPERTIES"][$field->getCode()];

				$arItem["FIELDS"][$code] = $field->getDisplayValue($prop);
				$arItem["FIELDS_VIEW"][$code] = $field->getDisplayValue($prop);
			}
		}

		$arActions = $getItemActions($arItem, $arResult, $this->getEditUrl($arItem['ID']), $this->getDeleteUrl($arItem['ID']));
		$arResult["DATA"][] = array(
			'data' => $arItem["FIELDS"],
			'columns' => $arItem["FIELDS_VIEW"],
			'actions' => $arActions,
		);
	}
}
else
{
	$this->abortResultCache();
	ShowError(GetMessage("C_IBLOCK_NOT_FOUND"));
	@define("ERROR_404", "Y");
	if($arParams["SET_STATUS_404"]==="Y")
		CHTTP::SetStatus("404 Not Found");
}

if (isset($rsElement))
{
	$arResult["TOOLBAR_BUTTONS"] = array(
//		array("TEXT" => GetMessage("C_TB_SETTINGS"), "ICON" => 'btn-settings', "TITLE" => GetMessage("C_TB_SETTINGS_TITLE"), "LINK" => 'javascript:void(0);', "LINK_PARAM" => 'onclick="bxGrid_' . $arResult["GRID_ID"] . '.EditCurrentView()"'),
//		array("TEXT" => GetMessage("C_TB_VIEWS"), "ICON" => 'btn-list', "TITLE" => GetMessage("C_TB_VIEWS_TITLE"), "LINK" => 'javascript:void(0);', "LINK_PARAM" => 'onclick="bxGrid_' . $arResult["GRID_ID"] . '.ShowViews()"'),
	);

	if ($arParams['ALLOW_NEW_ELEMENT'])
	{
		$arResult["TOOLBAR_BUTTONS"] = array_merge(array(
			array(
				"TEXT" => $arResult["IBLOCK"]["ELEMENT_ADD"],
				"MOBILE_TEXT" => Loc::getMessage("CITRUS_AREALTYPRO_MOBILE_BUTTON_ADD"),
				"TITLE" => $arResult["IBLOCK"]["ELEMENT_ADD"],
				"LINK" => $this->getEditUrl(),
				"TYPE" => 'btn-primary'
			),
		), $arResult["TOOLBAR_BUTTONS"]);
	}

	$arResult["TOOLBAR_BUTTONS"][] = [
		"TEXT" => Loc::getMessage("CITRUS_AREALTYPRO_PROFILE_BUTTON"),
		"MOBILE_TEXT" => Loc::getMessage("CITRUS_AREALTYPRO_PROFILE_BUTTON_MOBILE"),
		"TITLE" => '',
		"LINK" => $this->getProfileUrl(),
		"TYPE" => 'btn-secondary'
	];

	/**
	 * В шаблоне citrus_arealty3 (АСАН 2019) ссылка для выхода отображается в шапке сайта
	 * Во всех прочих (старых) шаблонах добавим е  на тулбар
	 */
	$hasHeaderAuth = function_exists('Citrus\Arealty\Template\isPartShown') && Citrus\Arealty\Template\isPartShown('header-auth');
	if (!$hasHeaderAuth)
	{
		$arResult["TOOLBAR_BUTTONS"][] = array(
			"TEXT" => Loc::getMessage("CITRUS_AREALTYPRO_LOGOUT_BUTTON"),
			"ICON" => 'fa fa-sign-out',
			"TITLE" => Loc::getMessage("CITRUS_AREALTYPRO_LOGOUT_BUTTON_TITLE"),
			"LINK" => $APPLICATION->GetCurPageParam('logout=yes', array('logout')),
			"RIGHT" => true,
			"ADDITIONAL_CLASS" => 'mobile-hide-text'
		);
	}

	$arResult["NAV_OBJECT"] = $rsElement;
	$arResult["TOTAL_CNT"] = $rsElement->SelectedRowsCount();

	$arResult["ACTIONS"] = array();
	/*if ($this->getRights()->canDoOperation(RightsProvider::OP_ELEMENT_DELETE, !!))
	{
		$arResult["ACTIONS"] = array(
			'delete' => array(
				'TEXT' => GetMessage("CITRUS_AREALTY_DELETE_ITEM");,
				'TITLE' => GetMessage("CITRUS_AREALTY_DELETE_ITEM_TITLE");,
				// @todo group delete
				"ONCLICK" => 'alert("Не реализовано");',
				'ICONCLASS' => 'delete',
			),
		);
	}*/

	// onManageObjectsListShow event
	$this->onBeforeShow();
}

$title = $arParams['TITLE'];
if ($arParams['SET_TITLE'] == 'Y')
{
	if (strlen($arResult['SECTION']['NAME']) > 0)
		$title = $arResult['SECTION']['NAME'];

	if (strlen($title) > 0)
		$APPLICATION->SetTitle($title);
}

foreach($arParams["CHAIN_ITEMS"] as $key => $url)
{
	$APPLICATION->AddChainItem($key, $url);
}

if ($arParams['ADD_ITEM_CHAIN'] == 'Y' && strlen($title) > 0)
	$APPLICATION->AddChainItem($title, $arParams['LIST_PATH']);

$this->includeComponentTemplate();