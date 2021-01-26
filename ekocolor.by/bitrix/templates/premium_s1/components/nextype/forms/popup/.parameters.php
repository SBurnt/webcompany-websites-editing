<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters['FORM_TYPE'] = array(
	'PARENT' => 'BASE',
	'NAME' => GetMessage("NT_FORMS_TYPE_FORM_TITLE"),
	'TYPE' => 'LIST',
	'VALUES' => Array (
            '' => GetMessage("NT_FORMS_TYPE_FORM_DEFAULT"),
            'ORDER' => GetMessage("NT_FORMS_TYPE_FORM_ORDER"),
            'CALLBACK' => GetMessage("NT_FORMS_TYPE_FORM_CALLBACK"),
        ),
	'DEFAULT' => '',
	'ADDITIONAL_VALUES' => 'N'
);