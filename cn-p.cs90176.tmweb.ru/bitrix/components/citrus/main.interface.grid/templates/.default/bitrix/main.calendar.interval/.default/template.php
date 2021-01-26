<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)
	die();

/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 */

use Bitrix\Main\Localization\Loc;
if(count($arResult["INTERVALS"]) > 0):
?>
<select name="<?=$arParams["SELECT_NAME"]?>" onchange="bxCalendarInterval.OnDateChange(this)">
<?
	foreach($arResult["INTERVALS"] as $k=>$v):
?>
	<option value="<?=$k?>"<?if($arParams["~SELECT_VALUE"] == $k) echo ' selected="selected"'?>><?=$v?></option>
<?
	endforeach;
?>
</select>
<?
endif;
$time = (time()+date("Z")+CTimeZone::GetOffset());
?>

<div class="bx-filter-days" style="display:none"><input type="text" name="<?=$arParams["INPUT_NAME_DAYS"]?>" value="<?=$arParams["INPUT_VALUE_DAYS"]?>" class="filter-date-days" size="5" /> <?echo GetMessage("inerface_grid_days")?></div>
<div class="bx-filter-interval">
    <div class="bx-filter-from"><input type="text" name="<?=$arParams["INPUT_NAME_FROM"]?>" value="<?=$arParams["INPUT_VALUE_FROM"]?>" class="filter-date-interval"<?=$arParams["~INPUT_PARAMS"]?> data-placeholder="<?=Loc::getMessage("BX_FILTER_DATE_FIELD_FROM")?>" />
    <span class="icon-calendar"
          onclick="BX.calendar({
                  node:this,
                  field:'<?=htmlspecialcharsbx(CUtil::JSEscape($arParams['~INPUT_NAME_FROM']))?>',
                  form: '<?=CUtil::JSEscape($arParams['FORM_NAME']);?>',
                  currentTime: '<?=$time?>',
                  bTime: false
                });"></span>
    </div>

    <div class="bx-filter-to">
        <input type="text" name="<?=$arParams["INPUT_NAME_TO"]?>" value="<?=$arParams["INPUT_VALUE_TO"]?>" class="filter-date-interval"<?=$arParams["~INPUT_PARAMS"]?> placeholder="<?=Loc::getMessage("BX_FILTER_DATE_FIELD_TO")?>" />
        <span class="icon-calendar"
              onclick="BX.calendar({
                      node:this,
                      field:'<?=htmlspecialcharsbx(CUtil::JSEscape($arParams['~INPUT_NAME_TO']))?>',
                      form: '<?=CUtil::JSEscape($arParams['FORM_NAME']);?>',
                      currentTime: '<?=$time?>',
                      bTime: false
                      });"></span>
    </div>
</div>
