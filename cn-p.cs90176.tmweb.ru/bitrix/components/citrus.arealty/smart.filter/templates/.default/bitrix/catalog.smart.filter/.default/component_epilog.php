<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $templateData */
/** @var @global CMain $APPLICATION */

CJSCore::Init(['ajax', 'jquery', 'cui_form']);

//����������� ������ � �������� ��������
foreach ($arResult["ADDITIONAL_SCRIPTS"] as $link) {
	$APPLICATION->AddHeadScript($templateFolder.'/'.$link);
}
foreach ($arResult["ADDITIONAL_STYLES"] as $link) {
	$APPLICATION->SetAdditionalCSS($templateFolder.'/'.$link);
}