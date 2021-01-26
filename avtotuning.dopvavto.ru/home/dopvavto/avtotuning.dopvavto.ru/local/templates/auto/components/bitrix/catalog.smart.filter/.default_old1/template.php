<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);
$i=1;
?>

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
<?foreach($arResult["HIDDEN"] as $arItem):?>
	<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
<?endforeach;?>
    <div class="order__block main_flex__nowrap flex__align-items_center flex__jcontent_between">
        <img src="<?=SITE_TEMPLATE_PATH?>/img/icon/paintbrush.svg" width="31">
        <p class="rg">Фильтр по параметрам</p>
        <div class="clear main_flex__nowrap flex__align-items_center">
            <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/cancel.svg">
            <p class="rg" id="del_filter" name="del_filter">Очистить</p>
        </div>
        <div class="arrow"></div>
    </div>
    <div class="order__table filters">
        <div class="search__select main_flex flex__align-items_start flex__jcontent_between flex__1">
            <div class="flex__1">
                <?foreach($arResult["ITEMS"] as $key=>$arItem)
                {
                    $key = $arItem["ENCODED_ID"];
                    if(isset($arItem["PRICE"])):
                        if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                            continue;

                        $precision = 2;
                        if (Bitrix\Main\Loader::includeModule("currency"))
                        {
                            $res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
                            $precision = $res['DECIMALS'];
                        }
                        ?>
                            <span class="bx_filter_container_modef"></span>
                            <div class="rg order__price">Цена</div>
                            <div id="price-slider">
                                <div class="main_flex flex__align-items_start">
                                    <input

                                        type="text"
                                        name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                        id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                        value="<?echo !empty($arItem["VALUES"]["MIN"]["HTML_VALUE"]) ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arResult['ITEMS']['BASE']['VALUES']['MIN']['VALUE']?>"
                                        size="5"
                                        onkeyup="smartFilter.keyup(this)"
                                    />
                                    <div class="num">-</div>
                                    <input

                                        type="text"
                                        name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                        id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                        value="<?echo !empty($arItem["VALUES"]["MAX"]["HTML_VALUE"]) ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arResult['ITEMS']['BASE']['VALUES']['MAX']['VALUE']?>"
                                        size="5"
                                        onkeyup="smartFilter.keyup(this)"
                                    />
                                </div>
                                <div style="clear: both;"></div>

                                <div class="bx_ui_slider_track" id="drag_track_<?=$key?>" style="left: 0;right: 0;">

                                    <div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0; display: none;" id="colorUnavailableActive_<?=$key?>"></div>
                                    <div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0; display: none;" id="colorAvailableInactive_<?=$key?>"></div>
                                    <div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0; display: none;" id="colorAvailableActive_<?=$key?>"></div>
                                    <div class="bx_ui_slider_range" id="drag_tracker_<?=$key?>"  style="left: 0%; right: 0%; background: #061c2b;">
                                        <a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
                                        <a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
                                    </div>
                                </div>
                                <div style="opacity: 0;height: 1px;"></div>
                            </div>
                    <?
                    $arJsParams = array(
                        "leftSlider" => 'left_slider_'.$key,
                        "rightSlider" => 'right_slider_'.$key,
                        "tracker" => "drag_tracker_".$key,
                        "trackerWrap" => "drag_track_".$key,
                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                        "precision" => $precision,
                        "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                        "colorAvailableActive" => 'colorAvailableActive_'.$key,
                        "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
                    );
                    ?>
                        <script type="text/javascript">
                            BX.ready(function(){
                                window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                            });
                        </script>
                    <?endif;
                }?>

                <?foreach($arResult["ITEMS"] as $key=>$arItem) {?>
                    <?if($key == 17):?>
                        <?foreach($arItem["VALUES"] as $val => $ar):?>
                            <div class="md-checkbox">
                                <input type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>"
                                       name="<? echo $ar["CONTROL_NAME"] ?>"
                                       id="<? echo $ar["CONTROL_ID"] ?>"
                                    <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                       onclick="smartFilter.click(this)">
                                <label for="<? echo $ar["CONTROL_ID"] ?>">В наличии</label>
                            </div>
                        <?endforeach;?>
                    <?endif;?>
                <?}?>
                <?foreach($arResult["ITEMS"] as $key=>$arItem) {?>
                    <?if($key == 36):?>
                        <ul class="tag main_flex flex__align-items_start">
                            <?foreach($arItem["VALUES"] as $val => $ar):?>
                                <li class="rg" onclick="li_input(<? echo $ar["CONTROL_NAME"]?>);">
                                    <? echo $ar["VALUE"] ?>
                                    <input style="opacity: 0;" type="checkbox" name="<? echo $ar["CONTROL_NAME"]?>" id="<? echo $ar["CONTROL_ID"]?>" onclick="smartFilter.click(this)" value="<? echo $ar["HTML_VALUE"] ?>"/>
                                </li>
                            <?endforeach;?>
                        </ul>
                    <?endif;?>
                <?}?>
            </div>
            <div class="flex__1">
                <div class="colors main_flex__nowrap flex__align-items_start flex__jcontent_between">
                    <?foreach($arResult["ITEMS"] as $key=>$arItem) {?>
                        <?if($key == 35):?>
                            <div class="check_city">
                                <div class="rg order__city">Страна</div>
                                <?foreach($arItem["VALUES"] as $val => $ar):?>
                                    <div class="md-checkbox">
                                        <input type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>"
                                               name="<? echo $ar["CONTROL_NAME"] ?>"
                                               id="<? echo $ar["CONTROL_ID"] ?>"
                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                               onclick="smartFilter.click(this)">
                                        <label for="<? echo $ar["CONTROL_ID"] ?>"><? echo $ar["VALUE"] ?></label>
                                    </div>
                                <?endforeach;?>
                            </div>
                        <?endif;?>
                    <?}?>
                    <?
                    foreach($arResult["ITEMS"] as $key=>$arItem) {
                        if($key == 37):?>
                            <div class="check__color">
                                <div class="rg order__city">Цвет</div>
                                <?foreach($arItem["VALUES"] as $val => $ar):?>
                                    <div class="md-checkbox <?if($i>3) echo "mb-0";?>">
                                        <input
                                                type="checkbox"
                                                name="<?=$ar["CONTROL_NAME"]?>"
                                                id="<?=$ar["CONTROL_ID"]?>"
                                                value="<?=$ar["HTML_VALUE"]?>"
                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                        />
                                        <?
                                        $class = "";
                                        if ($ar["CHECKED"])
                                            $class.= " active";
                                        if ($ar["DISABLED"])
                                            $class.= " disabled";
                                        ?>
                                        <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
                                            <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                <span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                            <?endif?>
                                        </label>
                                    </div>
                                    <?$i++;
                                endforeach;?>
                            </div>
                        <?endif;?>
                    <?}?>
                </div>
            </div>
            <div class="flex__1">
                <?foreach($arResult["ITEMS"] as $key=>$arItem) {?>
                    <?if($key == 27):?>
                        <div class="rg order__producer">Производитель</div>
                        <div class="check_producer">
                            <?foreach($arItem["VALUES"] as $val => $ar):?>
                                <div class="md-checkbox">
                                    <input type="checkbox" value="<? echo $ar["HTML_VALUE"] ?>"
                                           name="<? echo $ar["CONTROL_NAME"] ?>"
                                           id="<? echo $ar["CONTROL_ID"] ?>"
                                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                           onclick="smartFilter.click(this)">
                                    <label for="<? echo $ar["CONTROL_ID"] ?>"><? echo $ar["VALUE"]?></label>
                                </div>
                            <?endforeach;?>
                        </div>
                    <?endif;?>
                <?}?>
            </div>
    </div>
        </div>
<div class="clb"></div>
<div class="bx_filter_button_box active" style="display:none;">
	<div class="bx_filter_block">
		<div class="bx_filter_parameters_box_container">
			<input
				type="submit"
				id="set_filter"
				name="set_filter"
				value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
				/>
			<input
				class="bx_filter_search_reset"
				type="submit"
				id="del_filter"
				name="del_filter"
				value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
				/>
			<div class="bx_filter_popup_result <?=$arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
				<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
				<span class="arrow"></span>
				<a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
			</div>
		</div>
	</div>
</div>
</form>
<div style="clear: both;"></div>

<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>