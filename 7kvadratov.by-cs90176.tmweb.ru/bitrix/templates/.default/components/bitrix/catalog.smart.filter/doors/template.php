<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
function dump() {
    $args = func_get_args();
    foreach ($args as $_) {
        echo "<pre>" , var_dump($_, true) , "</pre>";
    }
}
function dump_r() {
    $args = func_get_args();
    foreach ($args as $_) {
        echo "<pre>" , print_r($_, true) , "</pre>";
    }
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/colors.css',
    'TEMPLATE_CLASS' => 'bx-' . $arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME'])) {
    $this->addExternalCss($templateData['TEMPLATE_THEME']);
}
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");

?>

<a href="javascript:void(0);" class="btn btn-gradient btn-gradient--2 btn-open-filter js-open-filter visible-xs btn-block ff-b"><span>Открыть фильтр</span></a>
<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>"
      method="get"
      class="smartfilter bx-filter-parameters-box">
    <? foreach ($arResult["HIDDEN"] as $arItem): ?>
        <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
               value="<? echo $arItem["HTML_VALUE"] ?>"/>
    <? endforeach; ?>
    <?//dump_r($arResult);
    foreach ($arResult["ITEMS"] as $key => $arItem) {
        if (
            empty($arItem["VALUES"])
            || isset($arItem["PRICE"])
        ) {
            continue;
        }

        if (
            $arItem["DISPLAY_TYPE"] == "A"
            && (
                $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
            )
        ) {
            continue;
        }
        ?>
        <??>
        <div class="block js-filter-block filter-close">
            <div class="title ff-b"><a href="javascript:void(0);"
                                       class="btn-filter js-filter-btn"><?= $arItem['NAME'] ?></a>
            </div>
            <div class="block-body js-filter-body" style="display: none;">

                <?
                $arCur = current($arItem["VALUES"]);
                switch ($arItem['CODE']) {
                    case 'COLOR':
                        ?>
                        <div class="block-body col-2 js-filter-body">
                            <?
                            foreach ($arItem["VALUES"] as $val => $ar) {
                                //dump_r($arItem);

                                ?>
                                <div class="checkbox checkbox--color">
                                    <input type="checkbox"
                                           value="<? echo $ar["HTML_VALUE"] ?>"
                                           name="<? echo $ar["CONTROL_NAME"] ?>"
                                           id="<? echo $ar["CONTROL_ID"] ?>"
                                        <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                           onchange="smartFilter.click(this)">
                                    <?if (empty($ar['FILE']['SRC'])) {?>
                                        <span class="color" style="background-color: #<?= $val ?>"></span>
                                    <?} else {?>
                                        <span class="color" style="background: url(<?= $ar['FILE']['SRC']?>);"></span>
                                    <?}?>
                                    <label for="<? echo $ar["CONTROL_ID"] ?>"><?= $ar["VALUE"]; ?></label>
                                </div>
                                <?
                            }
                            ?>
                        </div>
                        <?
                        break;
                    default:
                        foreach ($arItem["VALUES"] as $val => $ar) {
                            ?>
                            <div class="checkbox">
                                <input
                                    type="checkbox"
                                    value="<? echo $ar["HTML_VALUE"] ?>"
                                    name="<? echo $ar["CONTROL_NAME"] ?>"
                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                    onclick="smartFilter.click(this)"
                                />
                                <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                       class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"
                                       for="<? echo $ar["CONTROL_ID"] ?>">
                                        <span class="bx-filter-param-text"
                                              title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                ?>&nbsp;(<span
                                                data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                            endif; ?></span>
                                </label>
                            </div>
                            <?
                        }
                        break;
                }
                ?>
            </div>
        </div>
        <?
    }
    ?>
    <div class="block-buttons-actions">
        <span class="bx-filter-container-modef"></span>
        <div class="bx-filter-popup-result <? if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"] ?>"
            id="modef" <? if (!isset($arResult["ELEMENT_COUNT"])) { echo 'style="display:none"'; } ?>>
            <? echo GetMessage("CT_BCSF_FILTER_COUNT",
                array("#ELEMENT_COUNT#" => '<span id="modef_num">' . intval($arResult["ELEMENT_COUNT"]) . '</span>')); ?>
            <a href="<? echo $arResult["FILTER_URL"] ?>" target=""><? echo GetMessage("CT_BCSF_FILTER_SHOW") ?></a>
        </div>
        <input
            type="hidden"
            id="set_filter"
            name="set_filter"
            value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>"
        />
        <input
            type="submit"
            id="del_filter"
            name="del_filter"
            value="<?= GetMessage("CT_BCSF_DEL_FILTER") ?>"
        />
    </div>
</form>
<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>