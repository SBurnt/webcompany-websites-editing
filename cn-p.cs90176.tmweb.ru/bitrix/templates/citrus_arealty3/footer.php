<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Citrus\Arealty\Entity\SettingsTable;
use Citrus\Arealty\Helper;
use Spatie\HtmlElement\HtmlElement;

Loc::loadMessages(__FILE__);

Citrus\Arealty\Template\showPart('main-slider', ['view-target' => 'page-top']);

/**
 * @todo otlozhity vivod bloka s zagolovkom stranitsi do kontsa raboti futera
 */
if ($APPLICATION->GetProperty('SHOW_TITLE', 'Y') === 'Y')
{
    $subheaderHtml = '';
    if ($subheader = $APPLICATION->GetProperty('PAGE_SUBHEADER'))
    {
        $subheaderHtml = HtmlElement::render('.section-description', $subheader);
    }

    $title = $APPLICATION->GetPageProperty('pageH1', 'h1#pagetitle');

    $pageSectionClass = trim($APPLICATION->GetPageProperty('pageSectionClass'));
    $pageSectionClass = $pageSectionClass ? ' ' . $pageSectionClass : '';

    $pageSectionContentClass = trim($APPLICATION->GetPageProperty('pageSectionContentClass'));
    $pageSectionContentClass = $pageSectionContentClass ? ' ' . $pageSectionContentClass : '';

    $titleHtml = HtmlElement::render($title, $APPLICATION->GetTitle(false));

    $blockStart = <<<HTML
<section class="section section--page-wrapper _with-padding$pageSectionClass">
	<div class="w" style='width: auto'>
		<hr class="section__border-top">
		<div class="section-inner" style='padding-top:15px'>
			<header class="section__header">
			    {$titleHtml}
				{$subheaderHtml}
			</header><!-- .section__header -->
			<div class="section__content$pageSectionContentClass">

HTML;
    $APPLICATION->AddViewContent('workarea-start', $blockStart);

    $blockEnd = <<<HTML
			</div><!-- .section__content -->
		</div><!-- .section-inner -->
	</div><!-- .w -->
</section>
HTML;
    echo $blockEnd;
}

$APPLICATION->ShowViewContent('workarea-end');

$mapIblockId = $APPLICATION->GetProperty('mapCatalogIblockId') ?: $APPLICATION->GetCurPage(false) == SITE_DIR ? Helper::getIblock('offers') : '';
if ($mapIblockId && strpos($APPLICATION->GetCurPage(false),'/predlozhenija/') === false):
	?><?$APPLICATION->IncludeComponent(
	"citrus.core:include",
	".default",
	[
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "footer_map",
		"TITLE" => "",
		"PAGE_SECTION" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"WIDGET_REL" => "map",
		"MAP_IBLOCK_ID" => $mapIblockId,
	]);?><?
endif;

$APPLICATION->ShowViewContent('footer-before');

Citrus\Arealty\Template\showPart('footer-callout');

?>

	<footer class="f print-hidden">
		<div class="w">
			<div class="f-t row row-grid">
				<div class="col-md-6 col-lg-8">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"footer_menu",
						[
							"ROOT_MENU_TYPE" => "bottom",
							"MAX_LEVEL" => "2",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "Y",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "N",
							"MENU_CACHE_GET_VARS" => [],
							"COMPONENT_TEMPLATE" => "bottom",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "Y",
                            "CACHE_SELECTED_ITEMS" => "N",
						]
					);?>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="f-t__contact-w">
						<div class="f-t__title"><?= Loc::getMessage("CITRUS_AREALTY3_FOOTER_CONTACT_TITLE") ?></div>

						<div class="f-contacts">
							<div class="f-contacts__item <?=!SettingsTable::getValue("PHONE") ? 'hidden': ''?>"
							     data-settings-container="PHONE">
								<div class="f-contacts__item-icon">
									<i class="icon-phone"></i>
								</div>
								<div class="f-contacts__item-value">
									<a href="tel:<?=Helper::clearPhoneNumber(SettingsTable::getValue("PHONE"))?>"
									   data-settings="PHONE">
										<?=SettingsTable::showValue("PHONE")?>
									</a>
								</div><!-- .f-contacts__item-value -->
							</div><!-- .f-contacts__item" -->
							<div class="f-contacts__item <?=!SettingsTable::getValue("EMAIL") ? 'hidden': ''?>"
							     data-settings-container="EMAIL">
								<div class="f-contacts__item-icon">
									<i class="icon-mailmanager"></i>
								</div>

								<div class="f-contacts__item-value">
									<a href="mailto:<?=SettingsTable::getValue("EMAIL")?>"
									   data-settings="EMAIL">
										<?=SettingsTable::showValue("EMAIL")?>
									</a>
								</div><!-- .f-contacts__item-value -->
							</div><!-- .f-contacts__item -->
							<div class="f-contacts__item <?=!SettingsTable::getValue("ADDRESS") ? 'hidden': ''?>"
							     data-settings-container="ADDRESS">
								<div class="f-contacts__item-icon">
									<i class="icon-map"></i>
								</div>

								<div class="f-contacts__item-value"
								     data-settings="ADDRESS">
									<?=SettingsTable::showValue("ADDRESS")?>
								</div><!-- .f-contacts__item-value -->
							</div><!-- .f-contacts__item -->
						</div><!-- .f-contacts -->

						<?php if (CModule::IncludeModule("subscribe")
								&& $APPLICATION->GetProperty('SHOW_FOOTER_SUBSCRIBE_FORM') !== 'N')
						{
							?>
							<div class="f-subscribe">
								<?$APPLICATION->IncludeComponent(
									"citrus:subscribe.form",
									"",
									[
										"FORMAT" => "text",
										"INC_JQUERY" => "N",
										"NO_CONFIRMATION" => "N",
									]
								);?>
							</div>
							<?php
						}
						?>
					</div><!-- .f-t__col-contact -->
				</div><!-- .col -->
			</div>

			<div class="f-b">
				<div class="f-b__copy">
					<span class="fa fa-copyright"></span> <?=date('Y')?>, <?=SettingsTable::showValue("SITE_NAME")?><br>
					<a href="<?=SITE_DIR?>agreement/"><?=Loc::getMessage("CITRUS_AREALTY3_FOOTER_AGREEMENT")?></a>
				</div>
				<div class="f-b__soc">
					<?$APPLICATION->IncludeFile(
						SITE_DIR."include/footer_social.php",
						[],
						["MODE"=>"html"]
					);?>
				</div>
				<div class="f-b__developer">
					<a href="https://citrus-soft.ru/" target="_blank"><?=Loc::getMessage("CITRUS_AREALTY3_COPYRIGHT");?></a>
					<div id="bx-composite-banner"></div>
				</div>
			</div><!-- .f-b -->
		</div><!-- .w -->
	</footer>

    </div><!-- .container -->
</div><!-- .cry-layout -->

<?php

$APPLICATION->ShowProperty('BeforeHeadClose');

?>

<?php Citrus\Arealty\Template\showPart('counters'); ?>
</body>
</html>