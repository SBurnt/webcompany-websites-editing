<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/**
 * @var array $arResult
 * @var CBitrixComponent $component
 * @global CMain $APPLICATION
 */

use Bitrix\Main\Localization\Loc;
?>

<?if(!empty($arParams["FILTER"])):?>
<div class="bx-interface-filter">
<form name="filter_<?=$arParams["GRID_ID"]?>" action="" method="GET">
<?
foreach($arResult["GET_VARS"] as $var=>$value):
	if(is_array($value)):
		foreach($value as $k=>$v):
			if(is_array($v))
				continue;
?>
<input type="hidden" name="<?=htmlspecialcharsbx($var)?>[<?=htmlspecialcharsbx($k)?>]" value="<?=htmlspecialcharsbx($v)?>">
<?
		endforeach;
	else:
?>
<input type="hidden" name="<?=htmlspecialcharsbx($var)?>" value="<?=htmlspecialcharsbx($value)?>">
<?
	endif;
endforeach;
?>
<table cellspacing="0" class="bx-interface-filter">
	<tr class="bx-filter-header" id="flt_header_<?=$arParams["GRID_ID"]?>" oncontextmenu="return bxGrid_<?=$arParams["GRID_ID"]?>.filterMenu">
		<td>
            <div class="bx-filter-header__inner">
                <div class="bx-filter-text"><?echo GetMessage("interface_grid_search")?></div>

                <div class="bx-filter-header__right">

                    <?/*
                    <div class="bx-filter-btn-container">
                        <a href="javascript:void(0)" onclick="bxGrid_<?=$arParams["GRID_ID"]?>.SwitchFilterRows(true)" class="bx-filter-btn bx-filter-show" title="<?echo GetMessage("interface_grid_show_all")?>"><span class="cicon-arrow _bot"></span></a>
                        <span class="bx-filter-btn-text"><?echo GetMessage("interface_grid_show_all")?></span>
                    </div>

                    <div class="bx-filter-btn-container">
                        <a href="javascript:void(0)" onclick="bxGrid_<?=$arParams["GRID_ID"]?>.SwitchFilterRows(false)" class="bx-filter-btn bx-filter-hide" title="<?echo GetMessage("interface_grid_hide_all")?>"><span class="cicon-arrow _top"></span></a>
                        <span class="bx-filter-btn-text"><?echo GetMessage("interface_grid_hide_all")?></span>
                    </div>
                    */?>

                    <? $isShown = (bool) ($arResult["OPTIONS"]["filter_shown"] <> "N");?>
                    <div class="bx-filter-btn-container <?=$isShown ? '_shown' : ''?>">
                        <a href="javascript:void(0)" class="bx-filter-btn _min" title="<?echo GetMessage("interface_grid_show_all")?>" onclick="bxGrid_<?=$arParams["GRID_ID"]?>.SwitchFilter(this)"><span class="cicon-arrow _top"></span></a>
                        <span class="bx-filter-btn-text _min"><?echo GetMessage("interface_grid_hide_all")?></span>

                        <a href="javascript:void(0)" class="bx-filter-btn _max" title="<?echo GetMessage("interface_grid_show_all")?>" onclick="bxGrid_<?=$arParams["GRID_ID"]?>.SwitchFilter(this)"><span class="cicon-arrow _bot"></span></a>
                        <span class="bx-filter-btn-text _max"><?echo GetMessage("interface_grid_show_all")?></span>
                    </div>

                    <div class="bx-filter-btn-container">
                        <a href="javascript:void(0)" onclick="bxGrid_<?=$arParams["GRID_ID"]?>.menu.ShowMenu(this, bxGrid_<?=$arParams["GRID_ID"]?>.filterMenu);" class="bx-filter-btn bx-filter-menu" title="<?echo GetMessage("interface_grid_additional")?>"><span class="icon-service"></span></a>
                        <span class="bx-filter-btn-text"><?echo GetMessage("interface_grid_additional")?></span>
                    </div>
                </div>
            </div>

		</td>
	</tr>
	<tr class="bx-filter-content" id="flt_content_<?=$arParams["GRID_ID"]?>"<?if($arResult["OPTIONS"]["filter_shown"] == "N"):?> style="display:none"<?endif?>>
		<td>
			<div class="bx-filter-rows">
<?
foreach($arParams["FILTER"] as $field):
	$bShow = $arResult["FILTER_ROWS"][$field["id"]];
?>
				<div class="tr" id="flt_row_<?=$arParams["GRID_ID"]?>_<?=$field["id"]?>"<?if($field["valign"] <> '') echo ' valign="'.$field["valign"].'"';?><?if(!$bShow) echo ' style="display:none"'?>>
					<div class="tc bx-filter-rows--name"><?=$field["name"]?>:</div>
					<div class="tc" data-field-type="<?=$field["type"]?>">
<?
	//default attributes
	if(!is_array($field["params"]))
		$field["params"] = array();
	if($field["type"] == '' || $field["type"] == 'text')
	{
		if($field["params"]["size"] == '')
			$field["params"]["size"] = "30";
	}
	elseif($field["type"] == 'date')
	{
		if($field["params"]["size"] == '')
			$field["params"]["size"] = "10";
	}
	elseif($field["type"] == 'number')
	{
		if($field["params"]["size"] == '')
			$field["params"]["size"] = "8";
	}
	
	$params = '';
	foreach($field["params"] as $p=>$v)
		$params .= ' '.$p.'="'.$v.'"';

	$value = $arResult["FILTER"][$field["id"]];

	switch($field["type"]):
		case 'custom':
			echo $field["value"];
			break;
		case 'checkbox':
?>
<input type="hidden" name="<?=$field["id"]?>" value="N">
<input type="checkbox" name="<?=$field["id"]?>" value="Y"<?=($value == "Y"? ' checked':'')?><?=$params?>>
<?
			break;
		case 'list':
			$bMulti = isset($field["params"]["multiple"]);
?>
<select name="<?=$field["id"].($bMulti? '[]':'')?>"<?=$params?>>
<?
			if(is_array($field["items"])):
				if(!is_array($value))
					$value = array($value);
				$bSel = false;
				if($bMulti):
?>
	<option value=""<?=($value[0] == ''? ' selected':'')?>><?echo GetMessage("interface_grid_no_no_no")?></option>
<?
				endif;
				foreach($field["items"] as $k=>$v):
?>
	<option value="<?=htmlspecialcharsbx($k)?>"<?if(in_array($k, $value) && (!$bSel || $bMulti)) {$bSel = true; echo ' selected';}?>><?=htmlspecialcharsbx($v)?></option>
<?
				endforeach;
?>
</select>
<?
			endif;
			break;
		case 'date':
			$APPLICATION->IncludeComponent(
				"bitrix:main.calendar.interval",
				"",
				array(
					"FORM_NAME" => "filter_".$arParams["GRID_ID"],
					"SELECT_NAME" => $field["id"]."_datesel",
					"SELECT_VALUE" => $arResult["FILTER"][$field["id"]."_datesel"],
					"INPUT_NAME_DAYS" => $field["id"]."_days",
					"INPUT_VALUE_DAYS" => $arResult["FILTER"][$field["id"]."_days"],
					"INPUT_NAME_FROM" => $field["id"]."_from",
					"INPUT_VALUE_FROM" => $arResult["FILTER"][$field["id"]."_from"],
					"INPUT_NAME_TO" => $field["id"]."_to",
					"INPUT_VALUE_TO" => $arResult["FILTER"][$field["id"]."_to"],
					"INPUT_PARAMS" => $params,
				),
				$this->__component->__parent,
				array("HIDE_ICONS"=>true)
			);
?>
<script type="text/javascript">
BX.ready(function(){bxCalendarInterval.OnDateChange(document.forms['filter_<?=$arParams["GRID_ID"]?>'].<?=$field["id"]?>_datesel)});
</script>
<?
			break;
		case 'quick':
?>
<input type="text" name="<?=$field["id"]?>" value="<?=htmlspecialcharsbx($value)?>"<?=$params?>>
<?
			if(is_array($field["items"])):
?>
<select name="<?=$field["id"]?>_list">
<?foreach($field["items"] as $key=>$item):?>
	<option value="<?=htmlspecialcharsbx($key)?>"<?=($arResult["FILTER"][$field["id"]."_list"] == $key? ' selected':'')?>><?=htmlspecialcharsbx($item)?></option>
<?endforeach?>
</select>
<?
			endif;
			break;
		case 'number':
?>
    <div class="bx-filter__from-to">
        <input placeholder="<?=Loc::getMessage("BX_FILTER_FROM")?>" type="text" name="<?=$field["id"]?>_from" value="<?=htmlspecialcharsbx($arResult["FILTER"][$field["id"]."_from"])?>"<?=$params?>>
        <input placeholder="<?=Loc::getMessage("BX_FILTER_TO")?>" type="text" name="<?=$field["id"]?>_to" value="<?=htmlspecialcharsbx($arResult["FILTER"][$field["id"]."_to"])?>"<?=$params?>>
    </div>
<?
			break;
		default:
?>
<input type="text" name="<?=$field["id"]?>" value="<?=htmlspecialcharsbx($value)?>"<?=$params?>>
<?
			break;
	endswitch;
?>
					</div>
                    <?/* delete col
					<div class="bx-filter-minus"><a href="javascript:void(0)" onclick="bxGrid_<?=$arParams["GRID_ID"]?>.SwitchFilterRow('<?=CUtil::addslashes($field["id"])?>')" class="bx-filter-minus" title="<?echo GetMessage("interface_grid_hide")?>"></a></div>
                    */?>
				</div>
<?endforeach?>
			</div>
			<div class="bx-filter-buttons">
                <button class="btn btn-primary" type="submit" name="filter" value="<?echo GetMessage("interface_grid_find")?>" title="<?echo GetMessage("interface_grid_find_title")?>"><span class="display-xs-n display-sm-b"><?echo GetMessage("interface_grid_find")?></span><span class="display-sm-n"><?=Loc::getMessage('interface_grid_find_short')?></span></button>

                <button class="btn btn-secondary" type="button" name="" value="<?echo GetMessage("interface_grid_flt_cancel")?>" title="<?echo GetMessage("interface_grid_flt_cancel_title")?>" onclick="bxGrid_<?=$arParams["GRID_ID"]?>.ClearFilter(this.form)"><?echo GetMessage("interface_grid_flt_cancel")?></button>
				<input type="hidden" name="clear_filter" value="">
			</div>
		</td>
	</tr>
</table>

</form>
</div>
<?endif;?>
