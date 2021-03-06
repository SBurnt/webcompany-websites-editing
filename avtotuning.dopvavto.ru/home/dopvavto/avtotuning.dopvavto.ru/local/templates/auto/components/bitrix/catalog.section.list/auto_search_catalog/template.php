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
global $USER;
$filter = array("ID" => $USER->GetID());
$arParams["SELECT"] = array("UF_MARKA","UF_MODEL","UF_YEAR");
$rsUsers = CUser::GetList(($by="ID"), ($order="DESC"), $filter,$arParams);
while ($arUser = $rsUsers->Fetch()) {
    $arSpecUser['UF_MARKA'] = $arUser['UF_MARKA'];
    $arSpecUser['UF_MODEL'] = $arUser['UF_MODEL'];
    $arSpecUser['UF_YEAR'] = $arUser['UF_YEAR'];
}
//pr($_COOKIE);
/*if((!$arSpecUser['UF_MARKA'] && !$arSpecUser['UF_MODEL'] && !$arSpecUser['UF_YEAR']) && (!$_COOKIE['avto_marka'] && !$_COOKIE['avto_model'] && !$_COOKIE['avto_god'])):*/
?>
<form method="post">
    <div class="order cart">
        <div class="order__block main_flex__nowrap flex__align-items_center flex__jcontent_between">
<!--            <img class="svg" src="--><?//=SITE_TEMPLATE_PATH?><!--/img/icon/car-wheel.svg" width="31">-->
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px" y="0px"
                 viewBox="0 0 360.725 360.725" style="enable-background:new 0 0 360.725 360.725;" xml:space="preserve">
<path d="M233.657,89.355c-0.179-0.12-0.362-0.235-0.552-0.345c-0.18-0.104-0.361-0.201-0.545-0.291
	c-15.4-8.806-33.221-13.842-52.196-13.842c-18.979,0-36.805,5.039-52.208,13.848c-0.18,0.089-0.357,0.184-0.533,0.285
	c-0.186,0.106-0.366,0.22-0.541,0.337c-31.21,18.341-52.206,52.272-52.206,91.015s20.995,72.673,52.205,91.014
	c0.175,0.119,0.356,0.231,0.542,0.339c0.176,0.103,0.355,0.197,0.535,0.286c15.403,8.809,33.227,13.847,52.206,13.847
	c18.976,0,36.794-5.035,52.194-13.841c0.185-0.091,0.366-0.188,0.547-0.292c0.189-0.109,0.374-0.225,0.554-0.346
	c31.199-18.344,52.189-52.271,52.189-91.007C285.849,141.624,264.861,107.697,233.657,89.355z M180.364,92.878
	c12.714,0,24.804,2.727,35.714,7.625l-23.629,40.927c-3.819-1.188-7.879-1.829-12.085-1.829c-4.207,0-8.265,0.641-12.086,1.828
	l-23.628-40.927C155.561,95.604,167.65,92.878,180.364,92.878z M203.125,180.362c0,12.552-10.21,22.763-22.761,22.763
	c-12.552,0-22.765-10.211-22.765-22.763c0-12.551,10.212-22.762,22.765-22.762C192.915,157.601,203.125,167.812,203.125,180.362z
	 M129.076,109.526l23.625,40.922c-5.945,5.5-10.252,12.747-12.1,20.914H93.336C95.942,145.979,109.444,123.778,129.076,109.526z
	 M93.336,189.362h47.265c1.848,8.168,6.156,15.414,12.101,20.915l-23.625,40.922C109.444,236.947,95.942,214.745,93.336,189.362z
	 M180.364,267.848c-12.714,0-24.804-2.727-35.714-7.624l23.628-40.927c3.821,1.188,7.879,1.828,12.086,1.828
	c4.206,0,8.266-0.641,12.085-1.829l23.629,40.927C205.168,265.121,193.078,267.848,180.364,267.848z M231.652,251.198
	l-23.626-40.923c5.942-5.5,10.25-12.747,12.098-20.913h47.265C264.783,214.742,251.28,236.946,231.652,251.198z M220.124,171.362
	c-1.848-8.166-6.155-15.412-12.098-20.913l23.626-40.922c19.628,14.252,33.131,36.455,35.736,61.835H220.124z M315.354,160.969
	c-0.626,0.132-1.251,0.195-1.865,0.195c-4.165,0-7.904-2.908-8.798-7.146c-10.362-49.16-48.823-87.621-97.983-97.984
	c-4.863-1.025-7.976-5.8-6.95-10.663s5.797-7.977,10.663-6.95c56.135,11.833,100.052,55.751,111.884,111.885
	C323.33,155.17,320.218,159.943,315.354,160.969z M160.967,315.354c-0.894,4.237-4.633,7.146-8.797,7.146
	c-0.615,0-1.24-0.063-1.866-0.195C94.172,310.472,50.256,266.555,38.422,210.421c-1.025-4.863,2.086-9.638,6.95-10.663
	c4.864-1.024,9.638,2.086,10.663,6.95c10.364,49.16,48.824,87.62,97.982,97.982C158.88,305.716,161.992,310.49,160.967,315.354z
	 M180.347,171.362h0.031c4.971,0,9,4.029,9,9s-4.029,9-9,9s-9.016-4.029-9.016-9S175.376,171.362,180.347,171.362z M180.364,0
	C80.912,0,0.002,80.91,0.002,180.362s80.91,180.362,180.362,180.362c99.45,0,180.358-80.91,180.358-180.362S279.814,0,180.364,0z
	 M180.364,342.725c-89.527,0-162.362-72.835-162.362-162.362S90.837,18,180.364,18c89.524,0,162.358,72.835,162.358,162.362
	S269.889,342.725,180.364,342.725z"/>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
                <g>
                </g>
</svg>
            <p class="rg">Поиск по автомобилю</p>
            <div class="clear main_flex__nowrap flex__align-items_center">
                <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/cancel.svg">
                <p class="rg">Очистить</p>
            </div>
            <div class="arrow"></div>
        </div>

        <div class="order__table">
            <div class="search__select main_flex flex__jcontent_between">
                <div class="dropdown">
                <span class="dropdown-button" data-text="Марка" data-cookie="Марка">Марка</span>

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
                <span class="dropdown-button lvl2_span" data-text="Модель" data-cookie="Модель">Модель</span>
                    <ul class="dropdown-list lvl2">
                        <li data-what="2" data-value="Выбрать модель" data-id="-1" data-lvl="2" onClick="ajax(this);">Выбрать модель</li>
                        <?foreach ($arResult['SECTIONS'] as $arSections){
                            if ($arSections['DEPTH_LEVEL']==2){?>
                                <li data-what="2" data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>" onClick="ajax(this);"><?=$arSections['NAME']?></li>
                            <?}?>
                        <?}?>
                    </ul>
                    <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="8">
                </div>

                <div class="dropdown">
                <span class="dropdown-button lvl3_span" data-text="Год" data-cookie="Год">Год</span>
                    <ul class="dropdown-list lvl3">
                        <li data-what="3" data-value="Выбрать год" data-id="-1" data-lvl="3" onClick="ajax(this);">Выбрать год</li>
                        <?foreach ($arResult['SECTIONS'] as $arSections){
                            if ($arSections['DEPTH_LEVEL']==3){?>
                                <li data-what="3" data-value="<?=$arSections['NAME']?>" data-id="<?=$arSections['ID']?>" data-lvl="<?=$arSections['DEPTH_LEVEL']?>" onClick="ajax(this);"><?=$arSections['NAME']?></li>
                            <?}?>
                        <?}?>
                    </ul>
                    <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="8">
                </div>
                <div class="submit">
                    <button class="btn bd">Найти в каталоге</button>
                    <!--<div class="order__table--link bd">или <a href="#">выбрать из списка</a></div>-->
                </div>
            </div>
        </div>
    </div>
</form>


<?//endif;