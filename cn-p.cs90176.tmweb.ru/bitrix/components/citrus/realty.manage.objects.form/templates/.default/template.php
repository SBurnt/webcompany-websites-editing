<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Citrus\Arealty\Template\TemplateHelper;

/** @var CitrusRealtyManageObjectsForm $component ������� ��������� ��������� */
/** @var CBitrixComponentTemplate $this ������� ������ (������, ����������� ������) */
/** @var array $arResult ������ ����������� ������ ���������� */
/** @var array $arParams ������ �������� ���������� ����������, ����� �������������� ��� ����� �������� ���������� ��� ������ ������� (��������, ����������� ��������� ����������� ��� ������). */
/** @var string $templateFile ���� � ������� ������������ ����� �����, �������� /bitrix/components/bitrix/iblock.list/templates/.default/template.php) */
/** @var string $templateName ��� ������� ���������� (��������: .d�fault) */
/** @var string $templateFolder ���� � ����� � �������� �� DOCUMENT_ROOT (�������� /bitrix/components/bitrix/iblock.list/templates/.default) */
/** @var array $templateData ������ ��� ������, �������� ��������, ����� ������� ����� �������� ������ �� template.php � ���� component_epilog.php, ������ ��� ������ �������� � ���, �.�. ���� component_epilog.php ����������� �� ������ ���� */
/** @var string $parentTemplateFolder ����� ������������� �������. ��� ����������� �������������� ����������� ��� �������� (��������) ������ ������������ ��� ����������. �� ����� ��������� ��� ������������ ������� ���� ������������ ����� ������� */
/** @var string $componentPath ���� � ����� � ����������� �� DOCUMENT_ROOT (����. /bitrix/components/bitrix/iblock.list) */
/** @var CMain $APPLICATION */
/** @var CUser $USER */

if ($component->hasErrors())
{
	TemplateHelper::showAlert(implode('<li>', $component->popErrors()), TemplateHelper::ALERT_DANGER);
}

if ($component->hasMessages())
{
	TemplateHelper::showAlert(implode('<li>', $component->popMessages()), TemplateHelper::ALERT_SUCCESS);
}

if (!empty($arResult['BACK_BUTTON']))
{
	?>
	<div class="section-footer">
		<nav class="citrus-arealty-manage-objects__nav">
			<a href="<?=$arResult['BACK_BUTTON']['LINK']?>" title="<?=$arResult['BACK_BUTTON']['TITLE']?>"><?=$arResult['BACK_BUTTON']['TEXT']?></a>
		</nav>
	</div>

	<?
}

if (!empty($arResult["FORM_FIELDS"])):?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.interface.form",
		"",
		Array(
			"FORM_ID" => $component->getFormId(),
			"TABS" => $component->getFormTabs(),
			"DATA" => $arResult["ITEM"],
			"BUTTONS" => Array(
				"standard_buttons" => $arResult['STANDARD_BUTTONS'],
				"back_url" => $_REQUEST["backurl"],
          		"custom_html" => $arResult['BUTTONS_HTML'],
			),
			"USE_HTML_EDITOR" => $arParams["USE_HTML_EDITOR"],
			"SHOW_SETTINGS" => 'Y',

			"TOOLBAR_BUTTONS" => $arResult["TOOLBAR_BUTTONS"],
			"TOOLBAR_ID" => $arResult["FORM_ID"] . "_toolbar",
			'OFFERS_PATH' => $arParams['OFFERS_PATH'],
			'WF_PARENT_ELEMENT_ID' => $arResult['WF_PARENT_ELEMENT_ID'],
			'IS_DRAFT' => $arResult['IS_DRAFT'],
			'DRAFT_ENABLED' => $arParams['DRAFT_ENABLED'],
		),
		$component
	);?>
<?endif?>

<?php

if (!empty($arResult['BACK_BUTTON']))
{
	?>
	<div class="section-footer">
		<nav class="citrus-arealty-manage-objects__nav">
			<a href="<?=$arResult['BACK_BUTTON']['LINK']?>" title="<?=$arResult['BACK_BUTTON']['TITLE']?>"><?=$arResult['BACK_BUTTON']['TEXT']?></a>
		</nav>
	</div>

	<?
}

if (Option::get("citrus.arealty", "generate_name", "N") == "Y")
{
	?>
	<script>
		BX.ready(function ()
		{
			var fieldName = document.querySelector('input[name="NAME"]');
			if (fieldName)
			{
				fieldName.readOnly = true;
				fieldName.title = "<?=CUtil::JSEscape(Loc::getMessage("CITRUS_TEMPLATE_NAME_GENERATION_TOOLTIP"))?>";
				if (fieldName.value.trim() == "")
				{
					fieldName.value = "[blank - name]";
				}
			}
		});
	</script>
	<?php
}