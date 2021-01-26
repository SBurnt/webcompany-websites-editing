<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
<div class="bids-bargaining item-views news-items type_1 type_2 front greyline news_scroll press">
	<div class="maxwidth-theme">
		<div class="bids-bargaining__top">
			<h2 class="bids-bargaining__title">Заявки на торги</h2>
			<a href="#" class="bids-bargaining__show-all">все заявки</a>
		</div>
		<div class="bids-bargaining__bottom">
			<div class="bids-bargaining__wrap">
				<!-- flexslider-init flexslider-control-nav flexslider-direction-nav -->
				<div class="flexslider swiper-container js-bids-bargaining-slider" data-plugin-options='{"directionNav": true, "controlNav" :true, "controlsContainer": ".pagination__controls-container", "customDirection": ".pagination__arrow", "animationLoop": true, "slideshow": false, "counts": [3, 2, 2, 1], "itemMargin": 40}'>
					<ul class="slides swiper-wrapper bids-bargaining__list">
						<li class="swiper-slide bids-bargaining__item">
							<ul class="bids-bargaining__sublist">
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Конкурс коммерческих предложений по реализации фракции пропановой производства ОАО «Нафтан»</p>
										<span class="bids-bargaining__date">28.08.2020</span>
									</a>
								</li>
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Уточнение систем разработки.</p>
										<span class="bids-bargaining__date">19.04.2020</span>
									</a>
								</li>
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Конкурс коммерческих предложений по реализации фракции пропановой производства ОАО «Нафтан»</p>
										<span class="bids-bargaining__date">28.08.2020</span>
									</a>
								</li>
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Уточнение систем разработки.</p>
										<span class="bids-bargaining__date">19.04.2020</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="swiper-slide bids-bargaining__item">
							<ul class="bids-bargaining__sublist">
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Уточнение систем разработки.</p>
										<span class="bids-bargaining__date">19.04.2020</span>
									</a>
								</li>
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Конкурс коммерческих предложений по реализации фракции пропановой производства ОАО «Нафтан»</p>
										<span class="bids-bargaining__date">28.08.2020</span>
									</a>
								</li>
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Уточнение систем разработки.</p>
										<span class="bids-bargaining__date">19.04.2020</span>
									</a>
								</li>
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Конкурс коммерческих предложений по реализации фракции пропановой производства ОАО «Нафтан»</p>
										<span class="bids-bargaining__date">28.08.2020</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="swiper-slide bids-bargaining__item">
							<ul class="bids-bargaining__sublist">
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Конкурс коммерческих предложений по реализации фракции пропановой производства ОАО «Нафтан»</p>
										<span class="bids-bargaining__date">28.08.2020</span>
									</a>
								</li>
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Уточнение систем разработки.</p>
										<span class="bids-bargaining__date">19.04.2020</span>
									</a>
								</li>
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Уточнение систем разработки. Уточнение систем разработки.</p>
										<span class="bids-bargaining__date">19.04.2020</span>
									</a>
								</li>
								<li class="bids-bargaining__subitem">
									<a href="#">
										<p class="bids-bargaining__text">Конкурс коммерческих предложений по реализации фракции пропановой производства ОАО «Нафтан»</p>
										<span class="bids-bargaining__date">28.08.2020</span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="bids-bargaining__pagination">
					<a href="#" class="flex-prev pagination__arrow">
						<svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M5 10L1 5.6L5 1.2" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</a>
					<div class="pagination__controls-container"></div>
					<a href="#" class="flex-next pagination__arrow">
						<svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 1L5 5.4L1 9.8" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</a>
				</div>
			</div>
		</div>
		<!-- <script>
			var $window = $(window),
				flexslider = {
					vars: {}
				};

			function getGridSize() {
				return (window.innerWidth < 600) ? 1 : (window.innerWidth < 900) ? 3 : 4;
			}

			$(function() {
				SyntaxHighlighter.all();
			});
			$(window).load(function() {
				$('.flexslider.js-bids-bargaining-slider').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav: true,
					// minItems: getGridSize(),
					// maxItems: getGridSize(),
					minItems: 3,
					controlsContainer: $(".custom-controls-container"),
					customDirectionNav: $(".custom-navigation a")
				});
			});

			$window.resize(function() {
				var gridSize = getGridSize();
				flexslider.vars.minItems = gridSize;
				flexslider.vars.maxItems = gridSize;
			});
		</script> -->
	</div>
</div>
<!-- <div class="bids-bargaining item-views news-items type_1 type_2 front greyline news_scroll press">
	<div class="maxwidth-theme">
		<?
			global $arTheme;
			$slideshowSpeed = (isset($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED'])));
			$animationSpeed = (isset($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED'])));
			$bAnimation = (bool)$slideshowSpeed;
			?>
		<div class="top_block clearfix">
			<?if($arParams['PAGER_SHOW_ALL']):?>
			<a class="show_all pull-right" href="<?= str_replace('#SITE' . '_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL']) ?>"><span><?= (strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : Loc::getMessage('S_TO_SHOW_ALL_NEWS')) ?></span></a>
			<?endif;?>
			<div class="pull-left top_title_block">
				<h2><?= ($arParams["TITLE"] ? $arParams["TITLE"] : Loc::getMessage("TITLE_NEWS")); ?></h2>
			</div>
			<?if(\Bitrix\Main\Loader::includeModule('subscribe')):?>
			<span class="subscribe font_upper pull-left" data-event="jqm" data-param-id="subscribe" data-param-type="subscribe" data-name="subscribe">
				<?= CPriority::showIconSvg(SITE_TEMPLATE_PATH . '/images/include_svg/subscribe.svg') ?>
				<?= Loc::getMessage('SUBSCRIBE_NEWS'); ?>
			</span>
			<?endif;?>
		</div>

		<div class="flexslider unstyled row front dark-nav view-control navigation-vcenter" data-plugin-options='{"directionNav": true, "controlNav" :false, "animationLoop": true, "slideshow": false, <?= ($slideshowSpeed >= 0 ? '"slideshowSpeed": ' . $slideshowSpeed . ',' : '') ?> <?= ($animationSpeed >= 0 ? '"animationSpeed": ' . $animationSpeed . ',' : '') ?> "counts": [4, 3, 2, 1], "itemMargin": 32}'>
			<ul class="items slides">
				<?foreach($arResult['ITEMS'] as $i => $arItem):?>
				<?
						// edit/add/delete buttons for edit mode
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						// use detail link?
						$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
						// preview image
						$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
						$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] : '');

						// show active date period
						$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));
						?>
				<li class="item<?= (!$bImage ? ' wti' : '') ?> col-md-3 col-sm-4 col-xs-6">
					<div class="wrap shadow border clearfix" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<?if($imageSrc):?>
						<div class="image<?= ($bImage ? "" : " wti"); ?>">
							<div class="wrap">
								<?if($bDetailLink):?><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
									<?endif;?>
									<img class="img-responsive" src="<?= $imageSrc ?>" alt="<?= ($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME']) ?>" title="<?= ($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME']) ?>" />
									<?if($bDetailLink):?>
								</a>
								<?endif;?>
							</div>
						</div>
						<?endif;?>
						<div class="body-info">
							<div class="wrap">
								<?// section title?>
								<?if(strlen($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']) && !((isset($arItem['SOCIAL_PROPS']) && $arItem['SOCIAL_PROPS']))):?>
								<div class="section_name"><?= $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME'] ?></div>
								<?endif;?>

								<?// element name?>
								<?if(strlen($arItem['FIELDS']['NAME'])):?>
								<div class="title font_md">
									<?if($bDetailLink):?><a class="dark-color" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
										<?endif;?>
										<?= $arItem['NAME'] ?>
										<?if($bDetailLink):?>
									</a>
									<?endif;?>
								</div>
								<?endif;?>

								<?// element preview text?>
								<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT']) && !$bImage):?>
								<div class="previewtext">
									<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
									<p><?= $arItem['FIELDS']['PREVIEW_TEXT'] ?></p>
									<?else:?>
									<?= $arItem['FIELDS']['PREVIEW_TEXT'] ?>
									<?endif;?>
								</div>
								<?endif;?>

								<?// date active period?>
								<?if($bActiveDate):?>
								<div class="period">
									<?if(strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
									<span class="date font_xs"><?= $arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE'] ?></span>
									<?else:?>
									<span class="date font_xs"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></span>
									<?endif;?>
								</div>
								<?endif;?>
							</div>
						</div>
					</div>
				</li>
				<?endforeach;?>
			</ul>
		</div>
	</div>
</div> -->
<?endif;?>