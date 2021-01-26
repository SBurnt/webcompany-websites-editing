<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'catalog-' . randString(5);
?>

<div class="items" id="<?= $containerName ?>">
    <? foreach ($arResult['ITEMS'] as $item): ?>
            <?
            $uniqueId = $item['ID'] . '_' . md5($this->randString() . $component->getAction());
            $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
            $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
            ?>

            <?
            $APPLICATION->IncludeComponent(
            'bitrix:catalog.item', 'main', array(
                'RESULT' => array(
                    'ITEM' => $item,
                    'AREA_ID' => $this->GetEditAreaId($uniqueId)
                ),
                'PARAMS' => array(
                    'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                    'SHOW_TAGS' => 'Y',
                    'SHOW_LABEL_TOP' => 'N',
                    'SHOW_SCHEMA' => 'Y',
                    'LABEL_PROP' => $arParams['LABEL_PROP'][0]
                )
                    ), $component, array('HIDE_ICONS' => 'Y')
            );
            ?>

        <? endforeach; ?>
</div>