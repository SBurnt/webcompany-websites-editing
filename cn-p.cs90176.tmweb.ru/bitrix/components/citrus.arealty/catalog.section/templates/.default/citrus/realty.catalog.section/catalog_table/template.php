<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Citrus\Arealty\Template\Property;
use Citrus\Developer\Template\Property as DeveloperProperty;
use Citrus\Arealty\Template\TemplateHelper;

$this->setFrameMode(true);

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

$isDeveloper = $arParams['IS_DEVELOPER'] === 'Y' && Loader::includeModule('citrus.developer');

if ($arResult["DESCRIPTION"])
{
	?>
	<div class="catalog-section-description"><?=$arResult["DESCRIPTION"]?></div>
	<p class="indent"></p>
	<?php
}

if (empty($arResult['ITEMS']))
{
	ShowNote($arParams['EMPTY_LIST_MESSAGE'] ? $arParams['EMPTY_LIST_MESSAGE'] : GetMessage("CITRUS_REALTY_NO_OFFERS"));
	return;
}

if ($arParams["DISPLAY_TOP_PAGER"])
{
	echo $arResult["NAV_STRING"];
}

$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
$arElementDeleteParams = array("CONFIRM" => GetMessage("CITRUS_REALTY_DELETE_CONFIRM"));


?>

<div class="table-slider">

	<?#region left col?>
	<div class="table-slider__left">
		<div class="table-slider__th"><?=($isDeveloper ? Loc::getMessage("TABLE_SLIDER_PHOTO_DEV") : Loc::getMessage("TABLE_SLIDER_PHOTO")) ?></div>

		<?foreach ($arResult['ITEMS'] as $key => $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
			$preview = \Citrus\Arealty\Helper::resizeOfferImage($arItem, 250, 225);
			?>
			<div class="table-slider__td _photo"
			     style="background: url(<?=$preview['src']?>);"
			     id="<?=$this->GetEditAreaId($arItem["ID"])?>">
				<a href="<?=(is_callable($arResult['ON_DETAIL_URL']) ? $arResult['ON_DETAIL_URL']($arItem) : $arItem['DETAIL_PAGE_URL'])?>" class="table-slider__detail-link"><?=$arItem['NAME']?></a>
			</div><!-- .table-slider__th -->
		<?endforeach;?>
	</div><!-- .favorites-table__left -->
	<?#endregion?>

	<?#center?>
	<div class="table-slider__center _with-right-col">
		<div class="p__swiper table-slider__swiper">
			<div class="swiper-container">
				<div class="swiper-wrapper">

				<?#slide?>
				<?foreach ( $arResult['FIELDS'] as $arProperty ):?>

					<div class="swiper-slide table-slider__slide">
						<a href="<?=$arProperty['SORT_LINK']?>"
						   class="table-slider__th _sort">
							<span
							   class="table-slider__property-name-list">
								<span class="table-slider__property-name">
									<?=$arProperty['name']?>
								</span>
							</span><!-- .table-slider__property-name-list -->

							<?php

							$iconClass = ['table-slider__sort-icon'];
							if ($arProperty['SELECTED']) $iconClass[] = '_active';
							if ($arProperty['ORDER'] === 'DESC') $iconClass[] = '_desc';
							?>
							<span class="<?=implode(' ', $iconClass)?>"></span>
						</a><!-- .table-slider__th -->

						<?foreach ( $arResult['ITEMS'] as $arItem):
							$property = $isDeveloper ? new DeveloperProperty($arItem) : new Property($arItem);
							?>
							<div class="table-slider__td"
							     data-property-code="<?=$arProperty['code']?>">
								<?if($arProperty['code'] === 'cost'):?>
								    <b><?=$property->getFormatValue($arProperty['code'])?></b>
									<?= TemplateHelper::quickSaleLabel($arItem, '.table-slider__share-label.theme--bg-color')?>
								<?else:?>
									<span><?=$property->getFormatValue($arProperty['code'])?></span>
								<?endif;?>
							</div><!-- .table-slider__td -->
						<?endforeach;?>

					</div><!-- .swiper-slide -->
				<?endforeach;?>

				</div><!-- .swiper-wrapper -->
			</div><!-- .swiper-container -->
			<div class="swiper-scrollbar"></div>
		</div><!-- .p__swiper -->
	</div>

	<?#region right col?>
	<div class="table-slider__right">
		<div class="table-slider__th"><?= Loc::getMessage("TABLE_SLIDER_ACTIONS") ?></div>

		<?foreach ( $arResult['ITEMS'] as $arItem):
			$property = $isDeveloper ? new DeveloperProperty($arItem) : new Property($arItem);
			$geodata = $property->getValue('geodata');
			?>
			<div class="table-slider__td">
				<div class="table-slider__action-block">
					<?php

					// region Ssilka Na karte
					if($geodata && $geodata instanceof \Citrus\Yandex\Geo\GeoObject)
					{
						if ($geodata->getLatitude() && $geodata->getLongitude())
						{
							$dataCoords = [
								$geodata->getLatitude(),
								$geodata->getLongitude(),
							];
						}

						if ($isDeveloper)
						{
							?>
							<a href="javascript:void(0);"
							   data-coords="<?=\Bitrix\Main\Web\Json::encode($dataCoords)?>"
							   title="<?=(string)$geodata?>"
							   data-address="<?=(string)$geodata?>"
							   class="image-actions__link js-map-link"
							>
                                <span class="image-actions__link-icon">
	                                <i class="icon-map"></i>
                                </span>
								<span class="image-actions__link-text">
									<?=Loc::getMessage("TABLE_SLIDER_ACTION_MAP")?>
	                            </span>
							</a>
							<?php
						}
						else
						{
							?>
							<a href="javascript:void(0);"
							   data-coords="<?=\Bitrix\Main\Web\Json::encode($dataCoords)?>"
							   title="<?=(string)$geodata?>"
							   data-address="<?=(string)$geodata?>"
							   class="table-slider__action-link js-map-link"
							>
								<i class="<?=($isDeveloper ? 'icon-map' : 'icon-on-map')?>"></i>
								<span
									class="table-slider__action-text"><?= Loc::getMessage("TABLE_SLIDER_ACTION_MAP") ?></span>
							</a>
							<?php
						}
					}
					// endregion

					// region Dobavlenie v izbrannoe
					if (!$isDeveloper)
					{
						?>
						<a href="javascript:void(0);"
						   data-id="<?=$arItem['ID']?>"
						   class="table-slider__action-link add2favourites"
						>
							<i class="icon-favorites _not-added"></i>
							<i class="icon-favorites-full _added"></i>

							<span
								class="table-slider__action-text _not-added"><?=Loc::getMessage("TABLE_SLIDER_FAVORITE")?></span>
							<span
								class="table-slider__action-text _added"><?=Loc::getMessage("TABLE_SLIDER_FAVORITE_ADDED")?></span>
						</a>
						<?php
					}
					// endregion
					?>
				</div>
			</div>
		<?endforeach;?>
	</div><!-- .table-slider__right -->
	<?#endregion?>
</div><!-- .table-slider -->


<script>
	;(function(){
		if (typeof currency !== 'undefined') {
			currency.updateHtmlCurrency($('.table-slider [data-currency-base]'));
		}

		$('.table-slider__th').responsiveEqualHeightGrid();
		$('.table-slider__left .table-slider__td').each(function (index) {
			var nthIndex = index + 2;
			var $items = $(this)
			.add($('.table-slider__slide .table-slider__td:nth-child(' + nthIndex + ')'))
			.add($('.table-slider__right .table-slider__td:nth-child(' + nthIndex + ')'));

			$items.responsiveEqualHeightGrid();
		});


		// http://idangero.us/swiper/api/
		var swiper = new Swiper('.table-slider__swiper .swiper-container', {
			watchOverflow: true,
			scrollbar: {
				el: '.table-slider__swiper .swiper-scrollbar',
				draggable: true
			},
			freeMode: true,
			slidesPerView: 'auto',
			breakpoints: {
				380: {
					slidesPerView: 1,
					freeMode: false
				}
			},
			on: {
				init: function () {}
			},
			freeModeMomentumBounce: false,
			touchReleaseOnEdges: true
		});
	}());
</script>

<?if ($arParams["DISPLAY_BOTTOM_PAGER"])
{
	echo $arResult["NAV_STRING"];
}