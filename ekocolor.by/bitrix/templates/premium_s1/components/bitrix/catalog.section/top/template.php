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
$containerName = 'top-catalog-' . randString(5);
?>



<div class="slider">
    <div class="owl-carousel owl-theme" id="<?= $containerName ?>">

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
                    'SHOW_TAGS' => 'N',
                    'SHOW_LABEL_TOP' => 'Y',
                    'SHOW_SCHEMA' => 'N'
                )
                    ), $component, array('HIDE_ICONS' => 'Y')
            );
            ?>

        <? endforeach; ?>
    </div>
</div>
<script>
    $('#<?= $containerName ?>').owlCarousel({
        navText: ["<div class='prev icon icon-back'></div>", "<div class='next icon icon-forward'></div>"],
        navContainer: '#catalog-top-navigation',
        dotsContainer: '#catalog-top-dots',
        responsive : {
            0 : {
                items: 1,
                loop: <?= count($arResult['ITEMS']) > 1 ? 'true' : 'false' ?>,
                dots: <?= count($arResult['ITEMS']) > 1 ? 'true' : 'false' ?>,
                nav: false,
                margin: 25
            },
            640 : {
                items: 2,
                loop: <?= count($arResult['ITEMS']) > 2 ? 'true' : 'false' ?>,
                dots: <?= count($arResult['ITEMS']) > 2 ? 'true' : 'false' ?>,
                nav: false,
                margin: 0
            },
            960 : {
                items: 2,
                loop: <?= count($arResult['ITEMS']) > 2 ? 'true' : 'false' ?>,
                dots: <?= count($arResult['ITEMS']) > 5 ? 'true' : 'false' ?>,
                nav: <?= count($arResult['ITEMS']) > 2 ? 'true' : 'false' ?>
            },
            1211 : {
                items: 3,
                loop: <?= count($arResult['ITEMS']) > 3 ? 'true' : 'false' ?>,
                dots: <?= count($arResult['ITEMS']) > 5 ? 'true' : 'false' ?>,
                nav: <?= count($arResult['ITEMS']) > 3 ? 'true' : 'false' ?>
            }
        }
    });
</script>