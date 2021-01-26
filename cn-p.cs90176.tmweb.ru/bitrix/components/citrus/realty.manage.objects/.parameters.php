<?php

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Citrus\Arealty\Helper;
use Citrus\ArealtyPro\Meta\Iblock;
use Citrus\Forms;

/** @var array $arCurrentValues */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule("citrus.arealty"))
	return;

if (!CModule::IncludeModule("citrus.arealtypro"))
    return;

if (!CModule::IncludeModule("iblock"))
	return;

$fields = new Iblock((int)Helper::getIblock('offers', isset($_GET['src_site']) ? $_GET['src_site'] : null));

$arAscDesc = array(
	"asc" => GetMessage("CITRUS_AREALTY_SORT_ASC"),
	"desc" => GetMessage("CITRUS_AREALTY_SORT_DESC"),
);

/**
 * ѕри обновлении диалога с параметрами компонента (при смене инфоблока или установке галочки »спользовать »спользовать Google reCaptcha)
 * происходит перезагрузка формы с параметрами, при этом JS_DATA у CUSTOM-параметров прилетает в кодировке utf-8
 * настройки полей в неправильной кодировке затем используетс€ на форме и сохран€етс€ в параметрах компонента
 * #35002
 */
if (Main\Context::getCurrent()->getRequest()->isAjaxRequest())
{
	if (isset($_REQUEST['current_values']))
	{
		CUtil::decodeURIComponent($arCurrentValues);
	}
}

$arComponentParameters = array(
	"GROUPS" => array(
		"RL_SETTINGS" => array(
			"SORT" => 100,
			"NAME" => GetMessage("P_RL_SETTINGS"),
		),
		"RF_SETTINGS" => array(
			"SORT" => 150,
			"NAME" => GetMessage("P_RF_SETTINGS"),
		),
		"DEV_SETTINGS" => array(
			"SORT" => 500,
			"NAME" => GetMessage("CITRUS_AREALTYPRO_DEV_SETTINGS"),
		),
	),
	"PARAMETERS" => array(
		"VARIABLE_ALIASES" => Array(
			"ID" => Array("NAME" => GetMessage("P_REQUEST_ID")),
		),
		"AJAX_MODE" => array(),
		"SEF_MODE" => Array(
			"list" => array(
				"NAME" => GetMessage("P_REQUEST_LIST_PAGE"),
				"DEFAULT" => "",
				"VARIABLES" => array(),
			),
			"form" => array(
				"NAME" => GetMessage("P_REQUEST_FORM_PAGE"),
				"DEFAULT" => "#ID#/",
				"VARIABLES" => array(),
			),
			"auth" => array(
				"NAME" => GetMessage("CITRUS_AREALTYPRO_MANAGE_OJECTS_PAGE_AUTH"),
				"DEFAULT" => "auth/",
				"VARIABLES" => array(),
			),
			"register" => array(
				"NAME" => GetMessage("CITRUS_AREALTYPRO_MANAGE_OJECTS_PAGE_REGISTER"),
				"DEFAULT" => "register/",
				"VARIABLES" => array(),
			),
			"profile" => array(
				"NAME" => GetMessage("CITRUS_AREALTYPRO_MANAGE_OJECTS_PAGE_PROFILE"),
				"DEFAULT" => "profile/",
				"VARIABLES" => array(),
			),
			"catalog" => array(
				"NAME" => GetMessage("P_REQUEST_CATALOG_PAGE"),
				"DEFAULT" => '/predlozhenija/preview/',
				"VARIABLES" => array("REQUEST_ID"=>"RID"),
			),
		),

		"RL_FIELD_CODE" => array(
			"PARENT" => "RL_SETTINGS",
			"NAME" => GetMessage("P_RL_FIELD_CODE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $fields->getTitlesArray(),
			"ADDITIONAL_VALUES" => "Y",
		),
		"RL_DEFAULT_SORT_FIELD" => array(
			"PARENT" => "RL_SETTINGS",
			"NAME" => GetMessage("P_RL_DEFAULT_SORT_FIELD"),
			"TYPE" => "LIST",
			"VALUES" => $fields->getTitlesArray(),
			"ADDITIONAL_VALUES" => "Y",
		),
		"RL_DEFAULT_SORT_ORDER" => array(
			"PARENT" => "RL_SETTINGS",
			"NAME" => GetMessage("P_RL_DEFAULT_SORT_ORDER"),
			"TYPE" => "LIST",
			"VALUES" => $arAscDesc,
			"ADDITIONAL_VALUES" => "Y",
		),
		"RL_TITLE" => array(
			"PARENT" => "RL_SETTINGS",
			"NAME" => GetMessage("P_RL_TITLE"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		"RL_FILTER_FIELDS" => array(
			"PARENT" => "RL_SETTINGS",
			"NAME" => GetMessage("P_RL_FILTER_FIELDS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $fields->getTitlesArray(),
			"ADDITIONAL_VALUES" => "Y",
			"DEFAULT" => array(
				"SORT",
				"PREVIEW_PICTURE",
				"DETAIL_PICTURE",
				"PROPERTY_complex",
				"PROPERTY_photo",
				"PROPERTY_video",
				"PROPERTY_geodata",
			),
		),
		"SHOW_ALL_COUNT" => array(
			"PARENT" => "RL_SETTINGS",
			"NAME" => GetMessage("P_REQUEST_SHOW_ALL_COUNT"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		"RF_FIELD_CODE" => array(
			"PARENT" => "RF_SETTINGS",
			"NAME" => GetMessage("P_RF_FIELD_CODE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $fields->getTitlesArray(),
			"ADDITIONAL_VALUES" => "Y",
		),
		/*"RF_ALLOW_NEW_ELEMENT" => array(
			"PARENT" => "RF_SETTINGS",
			"NAME" => GetMessage("P_RF_ALLOW_NEW_ELEMENT"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),*/
		"RF_TITLE" => array(
			"PARENT" => "RF_SETTINGS",
			"NAME" => GetMessage("P_RF_TITLE"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		"RF_MAX_FILE_COUNT" => array(
			"PARENT" => "RF_SETTINGS",
			"NAME" => GetMessage("P_RF_MAX_FILE_COUNT"),
			"TYPE" => "INT",
			"DEFAULT" => "6",
		),
		"USE_HTML_EDITOR" => Array(
			"NAME" => GetMessage("CITRUS_AREALTY_USE_HTML_EDITOR"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		"SET_TITLE" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_SET_TITLE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"ADD_ITEM_CHAIN" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_ADD_ITEM_CHAIN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SET_STATUS_404" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("CITRUS_AREALTY_SET_STATUS_404"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"RIGHTS_PROVIDER" => array(
			"PARENT" => "DEV_SETTINGS",
			"NAME" => GetMessage("CITRUS_AREALTYPRO_SETTINGS_RIGHTS_PROVIDER"),
		),
	),
);

if (Main\Loader::includeModule('citrus.forms'))
{
	/** @var Forms\UserProfile $component */
	$component = Forms\includeFormComponent('citrus.forms:user.profile', 'simple');
	if ($component instanceof Forms\UserProfile)
	{
		$arComponentParameters['GROUPS']['REGISTER'] = ['SORT' => 200, 'NAME' => Loc::getMessage('CITRUS_AREALTYPRO_MANAGE_OJECTS_PAGE_REGISTER')];
		$arComponentParameters['GROUPS']['PROFILE'] = ['SORT' => 250, 'NAME' => Loc::getMessage('CITRUS_AREALTYPRO_MANAGE_OJECTS_PAGE_PROFILE')];

		// @todo ¬ class.php выставл€ть значение по умолчанию если не передано другое
		$defaultProfileFields = [
			"NAME" => [
				"TITLE" => Loc::getMessage('CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_F_NAME'),
				"IS_REQUIRED" => "Y",
				"VALIDRULE" => "",
				"VALID_ERROR_MSG" => "",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => ".default",
			],
			"EMAIL" => [
				"TITLE" => "E-mail",
				"IS_REQUIRED" => "Y",
				"VALIDRULE" => "",
				"VALID_ERROR_MSG" => "",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => ".default",
			],
			"WORK_PHONE" => [
				"TITLE" => Loc::getMessage('CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_F_WORK_PHONE'),
				"IS_REQUIRED" => "Y",
				"VALIDRULE" => "",
				"VALID_ERROR_MSG" => "",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => "phone",
			],
			"PERSONAL_MOBILE" => [
				"TITLE" => Loc::getMessage('CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_F_PERSONAL_MOBILE'),
				"IS_REQUIRED" => "N",
				"VALIDRULE" => "",
				"VALID_ERROR_MSG" => "",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => "phone",
			],
			"PERSONAL_GENDER" => [
				"TITLE" => Loc::getMessage('CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_F_PERSONAL_GENDER'),
				"IS_REQUIRED" => "N",
				"VALIDRULE" => "",
				"VALID_ERROR_MSG" => "",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => "checkbox",
			],
			"PERSONAL_PHOTO" => [
				"TITLE" => Loc::getMessage('CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_F_PERSONAL_PHOTO'),
				"IS_REQUIRED" => "N",
				"VALIDRULE" => "file",
				"ADDITIONAL" => "filetype=.gif, .jpg, .jpeg, .png;filesize=10mb",
				"FILE_TYPE" => ['gif', 'jpg', 'jpeg', 'png'],
				"DISABLE_RESET" => "Y",
				'PLACEHOLDER' => '',
				'DESCRIPTION' => 'gif, jpg, jpeg, png',
				"VALID_ERROR_MSG" => "",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => "avatar",
			],
		];

		$defaultRegisterFields = [
			"EMAIL" => [
				"TITLE" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_REGISTER_F_EMAIL"),
				"IS_REQUIRED" => "Y",
				"VALIDRULE" => "email",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => ".default",
			],
			"PASSWORD" => [
				"TITLE" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_REGISTER_F_PASSWORD"),
				"IS_REQUIRED" => "Y",
				"VALIDRULE" => "main_password",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => "password",
			],
			"CONFIRM_PASSWORD" => [
				"TITLE" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_REGISTER_F_CONFIRM_PASSWORD"),
				"IS_REQUIRED" => "Y",
				"VALIDRULE" => "confirm_password",
				"HIDE_FIELD" => "N",
				"TEMPLATE_ID" => "password",
			],
		];

		$arComponentParameters['PARAMETERS']['PROFILE_FIELDS'] = $component
			->setParams($arCurrentValues ?: [])
			->setFieldsParamName('PROFILE_FIELDS')
			->setFieldsParamDefault($defaultProfileFields)
			->GetParametrsFieldInput(Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OJECTS_PROFILE_FIELDS"), '', 'PROFILE');

		$arComponentParameters['PARAMETERS']['REGISTER_FIELDS'] = $component
			->setParams($arCurrentValues ?: [])
			->setFieldsParamName('REGISTER_FIELDS')
			->setFieldsParamDefault($defaultRegisterFields)
			->GetParametrsFieldInput(Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OJECTS_REGISTER_FIELDS"), '', 'REGISTER');
	}
}