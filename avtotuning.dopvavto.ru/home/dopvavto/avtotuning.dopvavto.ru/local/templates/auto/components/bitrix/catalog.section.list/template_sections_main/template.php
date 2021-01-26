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
//pr($arResult['SECTION']['IPROPERTY_VALUES']);
$APPLICATION->SetTitle($arResult['SECTION']['IPROPERTY_VALUES']['SECTION_META_TITLE']);
$APPLICATION->SetPageProperty("description", $arResult['SECTION']['IPROPERTY_VALUES']['SECTION_META_DESCRIPTION']);
$APPLICATION->SetPageProperty("keywords", $arResult['SECTION']['IPROPERTY_VALUES']['SECTION_META_KEYWORDS']);
?>

<?if(count($arResult['SECTIONS'])){?>
	<div class="shop">
		<h2 class="shop__title rg">Популярные категории<?//=$arResult['SECTION']['NAME']?></h2>
		<div class="web_popular_list">
			<?foreach($arResult['SECTIONS'] as $k => $section){?>
				<a href="<?=$section['LIST_PAGE_URL'].$section['SECTION_PAGE_URL']?>" class="popular_block">
					<?if($section['PICTURE_260_DETAL']){?>
						<img src="<?=$section['PICTURE_260_DETAL'];?>" alt="">
					<?}else{?>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png" alt="">
                    <?}?>
					<p class="bottom_right">
						<?=$section['NAME'];?>
					</p>
				</a>
			<?
//			if($k >= 5)
//				break;
			}?>
		</div>
	</div>
<?}?>