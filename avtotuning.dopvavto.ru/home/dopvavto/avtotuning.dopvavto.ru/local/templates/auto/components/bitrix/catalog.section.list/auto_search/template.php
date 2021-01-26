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
//session_start();

$this->setFrameMode(true);
global $USER;
$filter = array("ID" => $USER->GetID());
$arParams["SELECT"] = array("UF_MARKA","UF_MODEL","UF_YEAR");
$rsUsers = CUser::GetList(($by="ID"), ($order="DESC"), $filter,$arParams);
while ($arUser = $rsUsers->Fetch()) {
    $arSpecUser['UF_MARKA'] = $arUser['UF_MARKA'];
    $arSpecUser['UF_MODEL'] = $arUser['UF_MODEL'];
    $arSpecUser['UF_YEAR'] = $arUser['UF_YEAR'];
}

$level=1;
$what=1;
$avto_id=-1;
$avto_value='Выбрать марку';
?>
<form method="post" action="/avto_search/">
    <div class="search main_flex flex__align-items_center flex__jcontent_start">
        <div class="search__title">
            <span class="bd myauto">Мой автомобиль</span>
            <a href="<?if ($USER->IsAuthorized()) echo SITE_DIR.'personal/auto/'; else echo 'javascript:void(0)';?>" class="bd <?if (!$USER->IsAuthorized()) echo 'btn-login';?>">Добавить в список <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/double-angle-right.svg" width="7"></a>
        </div>
        <div class="search__select main_flex flex__align-items_center flex__1">
            <div class="dropdown">
                <span class="dropdown-button lvl1_span" data-text="Марка" data-cookie="Марка">
                    <?
                    if ($USER->IsAuthorized()){
                        if($_COOKIE['avto_marka']){
                            echo $_COOKIE['avto_marka'];
							$level=1;
							$what=1;
							$avto_id=$_COOKIE['avto_marka_id'];
							$avto_value=$_COOKIE['avto_marka'];
                        }else{
                            if($arSpecUser['UF_MARKA']){
								$level=1;
								$what=1;
								$avto_value=$arSpecUser['UF_MARKA'];
                                foreach ($arResult['SECTIONS'] as $arSections){
                                    if ($arSections['DEPTH_LEVEL']==1){
                                        if($arSpecUser['UF_MARKA'] == $arSections['NAME']){
                                            echo $arSections['NAME'];?>
                                            <?break;?>
                                        <?}?>
                                    <?}?>
                                <?}?>
                            <?}else{?>
                                Марка
                            <?}
                        }
                    }else{
                        if($_COOKIE['avto_marka']){
                            echo $_COOKIE['avto_marka'];
							$level=1;
							$what=1;
							$avto_id=$_COOKIE['avto_marka_id'];
							$avto_value=$_COOKIE['avto_marka'];
                        }else{?>
                            Марка
                        <?}
                    }?>
                </span>

                <ul class="dropdown-list">
                    <li data-what="1" data-value="Выбрать марку" data-id="-1" data-lvl="1" onClick="ajax(this);">Выбрать марку</li>
                    <?foreach ($arResult['SECTIONS'] as $arSections){
                        if ($arSections['DEPTH_LEVEL']==1){?>
                            <li data-what="1" data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>" onClick="ajax(this);"><?=$arSections['NAME']?></li>
                        <?}?>
                    <?}?>
                </ul>
                <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="8">
            </div>

            <div class="dropdown">
                    <div id="lll_21"<?if(isset($_COOKIE['avto_model']) && $_COOKIE['avto_model']):?> style="display:none;"<?endif;?>>
					<span class="dropdown-button lvl2_span" data-text="Модель" data-cookie="Модель" style="background-color:#cacaca !important;">Модель</span>
					
					<img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="8">
				</div>
				<div id="lll_22"<?if(!isset($_COOKIE['avto_model']) && !$_COOKIE['avto_model']):?> style="display:none;"<?endif;?>>
                <span class="dropdown-button lvl2_span" data-text="Модель" data-cookie="Модель">
                    <?
                    if ($USER->IsAuthorized()){
                        if($_COOKIE['avto_model']){
                            echo $_COOKIE['avto_model'];
							$level=2;
							$what=2;
							$avto_id=$_COOKIE['avto_model_id'];
							$avto_value=$_COOKIE['avto_model'];
                        }else{
                            if($arSpecUser['UF_MODEL']){
								$level=2;
								$what=2;
								$avto_value=$arSpecUser['UF_MODEL'];
                                foreach ($arResult['SECTIONS'] as $arSections){
                                    if ($arSections['DEPTH_LEVEL']==2){
                                        if($arSpecUser['UF_MODEL'] == $arSections['NAME']){
                                            echo $arSections['NAME'];?>
                                            <?break;?>
                                        <?}?>
                                    <?}?>
                                <?}?>
                            <?}else{?>
                                Модель
                            <?}
                        }

                    }else{
                        if($_COOKIE['avto_model']){
                            echo $_COOKIE['avto_model'];
							$level=2;
							$what=2;
							$avto_id=$_COOKIE['avto_model_id'];
							$avto_value=$_COOKIE['avto_model'];
                        }else{?>
                            Модель
                        <?}
                    }?>
                </span>
                <ul class="dropdown-list lvl2">
                    <li data-what="2" data-value="Выбрать модель" data-id="-1" data-lvl="2" onClick="ajax(this);">Выбрать модель</li>
                    <?foreach ($arResult['SECTIONS'] as $arSections){
                        if ($arSections['DEPTH_LEVEL'] == 2 && $_COOKIE['avto_marka_id'] == $arSections['IBLOCK_SECTION_ID']){?>
                            <li data-what="2" data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>" onClick="ajax(this);"><?=$arSections['NAME']?></li>
                        <?}?>
                    <?}?>
                </ul>
                <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="8">
				</div>
            </div>

            <div class="dropdown">
				<div id="lll_31"<?if(isset($_COOKIE['avto_god']) && $_COOKIE['avto_god']):?> style="display:none;"<?endif;?>>
					<span class="dropdown-button lvl3_span" data-text="Модель" data-cookie="Модель" style="background-color:#cacaca !important;">Год</span>
					
					<img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="8">
				</div>
				<div id="lll_32"<?if((!isset($_COOKIE['avto_god']) && !$_COOKIE['avto_god']) || (!isset($_COOKIE['avto_model']) && !$_COOKIE['avto_model'])):?> style="display:none;"<?endif;?>>
                <span class="dropdown-button lvl3_span" data-text="Год" data-cookie="Год">
                    <?if ($USER->IsAuthorized()){
                        if($_COOKIE['avto_god']){
                            echo $_COOKIE['avto_god'];
							$level=3;
							$what=3;
							$avto_id=$_COOKIE['avto_god_id'];
							$avto_value=$_COOKIE['avto_god'];
                        }else{
                            if($arSpecUser['UF_YEAR']){
                                foreach ($arResult['SECTIONS'] as $arSections){
									$level=3;
									$what=3;
									$avto_value=$arSpecUser['UF_YEAR'];
                                    if ($arSections['DEPTH_LEVEL']==3){
                                        if($arSpecUser['UF_YEAR'] == $arSections['NAME']){
                                            echo $arSections['NAME'];?>
                                            <?break;?>
                                        <?}?>
                                    <?}?>
                                <?}?>
                            <?}else{?>
                                Год
                            <?}
                        }
                    }else{
                        if($_COOKIE['avto_god']){
                            echo $_COOKIE['avto_god'];
							$level=3;
							$what=3;
							$avto_id=$_COOKIE['avto_god_id'];
							$avto_value=$_COOKIE['avto_god'];
                        }else{?>
                            Год
                        <?}
                    }?>
                </span>
                <ul class="dropdown-list lvl3">
                    <li data-what="3" data-value="Выбрать год" data-id="-1" data-lvl="3" onClick="ajax(this);">Выбрать год</li>
                    <?foreach ($arResult['SECTIONS'] as $arSections){
                        if ($arSections['DEPTH_LEVEL']==3 && $_COOKIE['avto_model_id'] == $arSections['IBLOCK_SECTION_ID']){?>
                            <li data-what="3" data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>" onClick="ajax(this);"><?=$arSections['NAME']?></li>
                        <?}?>
                    <?}?>
                </ul>
                <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="8">
				</div>
            </div>
				<a href="#" li data-what="1" data-value="Выбрать марку" data-id="-1" data-lvl="1" onClick="ajax(this);" class="otm-btn">Х</a>&nbsp;
                <button class="btn bd">Найти в каталоге</button>
        </div>
    </div>
</form>
<style>
/*крайняя правка по селектбоксам*/
.otm-btn{
color:#fcbf67;
padding:6px;
border: 2px dashed #fcbf67;
border-radius:2px;
}
.otm-btn:hover{
color:#000;
background-color:#fcbf67;

}
</style>

<input type="hidden" id="start_id" value="<?=$avto_id;?>">
<input type="hidden" id="start_level" value="<?=$level;?>">
<input type="hidden" id="start_value" value="<?=$avto_value;?>">
<input type="hidden" id="start_what" value="3">
<script>
var start_id=$('#start_id').val();
var start_level=$('#start_level').val();
var start_value=$('#start_value').val();
var start_what=$('#start_what').val();
</script>