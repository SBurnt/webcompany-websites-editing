<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule("citrus.arealty"))
	return;

if (!CModule::IncludeModule("citrus.arealtypro"))
    return;

if (!CModule::IncludeModule("iblock"))
	return;

$siteId = !empty($_REQUEST["site"])
	? $_REQUEST["site"]
	: (!empty($_REQUEST["src_site"])
		? $_REQUEST["src_site"]
		: false
	);
$fields = new \Citrus\ArealtyPro\Meta\Iblock((int)\Citrus\Arealty\Helper::getIblock('offers', $siteId));

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("CIEE_ELEMENT_ID"),
			"TYPE" => "STRING",
			"ADDITIONAL_VALUES" => "Y",
		),
		"PARENT_SECTION_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("CIEE_SECTION_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		),

		"FIELD_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CIEE_IBLOCK_FIELD"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $fields->getTitlesArray(),
			"ADDITIONAL_VALUES" => "Y",
		),
		"ADDITIONAL_UPDATE_PROPERTIES" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("P_ADDITIONAL_UPDATE_PROPERTIES"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => array(),
		),
		"ALLOW_NEW_ELEMENT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CIEE_ALLOW_NEW_ELEMENT"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),

		'SET_TITLE' => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			'NAME' => GetMessage("P_SET_TITLE"),
			'TYPE' => 'STRING',
			'DEFAULT' => "",
		),
		'TITLE' => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			'NAME' => GetMessage("P_TITLE"),
			'TYPE' => 'STRING',
			'DEFAULT' => "",
		),
		"CHAIN_ITEMS" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_CHAIN_ITEMS"),
			'TYPE' => 'STRING',
			'DEFAULT' => "",
		),
		"ADD_ITEM_CHAIN" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_ADD_ITEM_CHAIN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SET_STATUS_404" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_SET_STATUS_404"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),

		'LIST_PATH' => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			'NAME' => GetMessage("P_LIST_PATH"),
			'TYPE' => 'STRING',
			'DEFAULT' => "",
		),
		'EDIT_PATH' => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			'NAME' => GetMessage("P_EDIT_PATH"),
			'TYPE' => 'STRING',
			'DEFAULT' => "",
		),
		"MAX_FILE_COUNT" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_RF_MAX_FILE_COUNT"),
			"TYPE" => "INT",
			"DEFAULT" => "6",
		),
	),
);
