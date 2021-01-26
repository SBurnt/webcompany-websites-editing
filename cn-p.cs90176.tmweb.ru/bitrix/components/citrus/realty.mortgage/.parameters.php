<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule("citrus.arealty"))
	return;

if (!CModule::IncludeModule("citrus.arealtypro"))
    return;

$arComponentParameters = array(
	"GROUPS" => array(
		"DEFAULT_VALUES" => array(
			"NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_DEFAULT_VALUES"),
			"SORT" => 100,
		),
	),
	"PARAMETERS" => array(
		"DEFAULT_FULL_PRICE" => array(
			"PARENT" => "DEFAULT_VALUES",
			"NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_DEFAULT_FULL_PRICE"),
			"TYPE" => "INT",
			"DEFAULT" => 3000000,
		),
		"DEFAULT_FIRST_PRICE" => array(
			"PARENT" => "DEFAULT_VALUES",
			"NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_DEFAULT_FIRST_PRICE"),
			"TYPE" => "STRING",
			"DEFAULT" => 450000,
		),
		"DEFAULT_FIRST_PRICE_UNITS" => array(
            "PARENT" => "DEFAULT_VALUES",
            "NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_DEFAULT_FIRST_PRICE_UNITS"),
            "TYPE" => "LIST",
            "VALUES" => array(
                'R' => GetMessage("CITRUS_AREALTY_MORTGAGE_DEFAULT_FIRST_PRICE_UNITS_RUB"),
                'P' => GetMessage("CITRUS_AREALTY_MORTGAGE_DEFAULT_FIRST_PRICE_UNITS_PERCENT"),
            ),
            "DEFAULT" => 'R',
        ),
		"MAX_FIRST_PRICE_PERC" => array(
			"PARENT" => "DEFAULT_VALUES",
			"NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_MAX_FIRST_PRICE_PERC"),
			"TYPE" => "STRING",
			"DEFAULT" => 70,
		),
		"DEFAULT_PERCENT" => array(
			"PARENT" => "DEFAULT_VALUES",
			"NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_DEFAULT_PERCENT"),
			"TYPE" => "STRING",
			"DEFAULT" => 11.5,
		),
		"DEFAULT_YEAR" => array(
			"PARENT" => "DEFAULT_VALUES",
			"NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_DEFAULT_YEAR"),
			"TYPE" => "INT",
			"DEFAULT" => 15,
		),
		"DISCOUNT_PERCENT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_DISCOUNT_PERCENT"),
			"TYPE" => "STRING",
			"DEFAULT" => 0.5,
		),
        "SHOW_OVERPAYMENT_BLOCK" => array(
            "PARENT" => "DEFAULT_VALUES",
            "NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_SHOW_OVERPAYMENT"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
        "SHOW_BANK_LOGOS" => array(
            "PARENT" => "DEFAULT_VALUES",
            "NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_SHOW_BANK_LOGOS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
        "RESULT_DECLAIMER" => array(
            "PARENT" => "DEFAULT_VALUES",
            "NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_RESULT_DECLAIMER"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
		"CURRENCY" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CITRUS_AREALTY_MORTGAGE_RESULT_CURRENCY_SIGN"),
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("CITRUS_AREALTY_MORTGAGE_RESULT_CURRENCY_DEFAULT"),
		),
	),
);
