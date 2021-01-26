<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("CITRUS_AREALTY_MANAGE_OBJECTS"),
	"DESCRIPTION" => GetMessage("CITRUS_AREALTY_MANAGE_OBJECTS_DESCRIPTION"),
	"ICON" => "/images/catalog.gif",
	"COMPLEX" => "Y",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "citrus",
		"NAME" => GetMessage("CITRUS_AREALTY_MANAGE_OBJECTS_PARTNER"),
		"CHILD" => array(
			"ID" => "manage",
			"NAME" => GetMessage("CITRUS_AREALTY_MANAGE_OBJECTS_CHILD"),
			"SORT" => 10,
		),
	),
);
