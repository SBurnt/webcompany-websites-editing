<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    "NAME" => GetMessage("CITRUS_AREALTY_MORTAGE_COMPONENT"),
    "DESCRIPTION" => GetMessage("CITRUS_AREALTY_MORTAGE_COMPONENT_DESC"),
	"ICON" => "/images/icon.gif",
	"SORT" => 30,
    "PATH" => array(
        "ID" => "citrus",
        "NAME" => GetMessage("CITRUS_AREALTY_MANAGE_OBJECTS_PARTNER"),
    ),
);
