<?php

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Loader;
use Citrus\Arealty\Helper;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Citrus\Arealty\Entity\SettingsTable;
use Citrus\Arealty\Theme;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadLanguageFile(__FILE__);

if (file_exists(__DIR__ . '/functions.php'))
{
    require __DIR__ . '/functions.php';
}

if (file_exists(__DIR__ . '/blocks.php'))
{
	require __DIR__ . '/blocks.php';
}

if (file_exists(__DIR__ . '/lk.php'))
{
	require __DIR__ . '/lk.php';
}

\Citrus\Arealty\Template\demoNotice();

$theme = new Theme(SITE_ID);
$theme->apply();

$asset = Asset::getInstance();

// css variables polifill for IE11 https://github.com/jhildenbiddle/css-vars-ponyfill
$asset->addString('<script>
if (BX.browser.DetectIeVersion() >= 9 || BX.browser.IsMac()) {
	BX.loadScript("https://unpkg.com/css-vars-ponyfill@1", function () {
		BX.ready(function () {
			cssVars();
		});
	});
}
</script>
', \Bitrix\Main\Page\AssetLocation::AFTER_JS);

$asset->addString("<script>

	window.citrusTemplateColor = '#".$theme->getColor()."';
	window.citrusMapIcon = { 
		href: '". CUtil::JSEscape($theme->getPath(). 'map.png') ."', 
		size: [32, 52], 
		offset: [-16, -48]
	};
</script>
");

$APPLICATION->SetPageProperty('SHOW_HEADER_AUTH', Loader::includeModule('citrus.arealtypro'));

?><!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
	<?$APPLICATION->ShowProperty('AfterHeadOpen');?>
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta content="on" http-equiv="cleartype">
	<meta content="True" name="HandheldFriendly">
	<meta content="320" name="MobileOptimized">
	<meta name="format-detection" content="telephone=no">
  <meta content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" name="viewport">

	<?php \Citrus\Arealty\Template\showFavicon($theme) ?>

    <!-- fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&amp;subset=cyrillic" rel="stylesheet"> -->
		<!-- <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400&amp;subset=cyrillic" rel="stylesheet"> -->
		<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:wght@300;400&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- js plugins -->
	<?php

    Helper::initTemplatePlugins();
	CJSCore::Init(['app']);

	//$APPLICATION->ShowTitle();
	$APPLICATION->ShowHead();

	?>
	<title><?$APPLICATION->AddBufferContent([Helper::class, 'showHeadTitle'])?></title>
	<?$APPLICATION->ShowProperty('BeforeHeadClose');?>
</head>

<body class="<?$APPLICATION->ShowProperty('BodyClass');?>" <?$APPLICATION->ShowProperty('BodyTag');?>>
<?php

$APPLICATION->ShowPanel();

$APPLICATION->ShowProperty('AfterBodyOpen');

if(Configuration::getValue('citrus_demo') || $APPLICATION->GetUserRight('citrus.arealty') >= 'W'):
	$APPLICATION->IncludeComponent(
		"citrus:settings.widget",
		"",
		[
			"DEMO_MODE" => $APPLICATION->GetUserRight('citrus.arealty') < 'W' && Configuration::getValue('citrus_demo') ? 'Y' : 'N',
		],
		null,
		['HIDE_ICONS' => 'Y']
	)?><?
endif;

?><div class="main-overlay"></div><?

\Citrus\Arealty\Template\showPart('mobile-sidebar');

?>

<div class="cry-layout">
    <header class="header">
        <div class="c-side">
	        <div class="header__row">
                <div class="header__left"><?\Citrus\Arealty\Template\showPart('header-logo', ['theme' => $theme])?></div>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "location",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/location.php"
                    )
                );?>
	            <div class="header__right print-hidden">
		            <div class="header-search-overflow">
				        <div class="header-search__wrapper">
					        <?$APPLICATION->IncludeComponent(
						        "bitrix:search.title",
						        "header_search",
						        [
							        "CATEGORY_0" => [
								        0 => "iblock_realty",
							        ],
							        "CATEGORY_0_TITLE" => "",
							        "CATEGORY_0_iblock_realty" => [
								        0 => Helper::getIblock('offers'),
								        1 => Helper::getIblock('complexes', SITE_ID, false),
							        ],
							        "CHECK_DATES" => "N",
							        "CONTAINER_ID" => "title-search",
							        "INPUT_ID" => "title-search-input",
							        "NUM_CATEGORIES" => "1",
							        "ORDER" => "date",
							        "PAGE" => "#SITE_DIR#search/index.php",
							        "SHOW_INPUT" => "Y",
							        "SHOW_OTHERS" => "N",
							        "TOP_COUNT" => "5",
							        "USE_LANGUAGE_GUESS" => "N",
							        "COMPONENT_TEMPLATE" => "header_search",
							        "PRICE_CODE" => "",
							        "PRICE_VAT_INCLUDE" => "Y",
							        "PREVIEW_TRUNCATE_LEN" => "",
							        "SHOW_PREVIEW" => "Y",
							        "PREVIEW_WIDTH" => "100",
							        "PREVIEW_HEIGHT" => "65",
							        "MIN_LETTER_COUNT" => "2"
						        ],
						        false
					        );?>
				        </div>
				        <?$APPLICATION->IncludeComponent("citrus:currency", '', [], null, ['HIDE_ICONS' => 'Y']);?>
			        </div>
			        <div class="header-search-overlay js-search-overlay-hide"></div>

			        <div class="header-phone">
				        <a href="tel:<?=Helper::clearPhoneNumber(SettingsTable::getValue("PHONE"))?>"
				           class="header-phone-number"
				           data-settings="PHONE"><?=SettingsTable::showValue("PHONE")?></a>
				        <a href="<?=SITE_DIR?>ajax/order_call.php"
				           rel="nofollow"
				           class="header-btn btn-header-phone"
				           data-toggle="modal"
				           aria-label="<?=Loc::getMessage('CITRUS_AREALTY3_ORDER_CALL_LINK')?>"
				        >
					        <i class="icon-phone" aria-hidden="true"></i>
				        </a>
			        </div><!-- .header-phone -->

			        <?php

			        \Citrus\Arealty\Template\showPart('header-auth');

		            if (\Citrus\Arealty\Template\isPartShown('mobile-sidebar'))
		            {
			            ?>
			            <a href="javascript:void(0);"
			               class="header-btn hamburger js-open-menu"
			               aria-label="<?=Loc::getMessage("CITRUS_AREALTY3_OPEN_HAMBURGER_MENU")?>"
			            >
				            <span class="lines" aria-hidden="true"></span>
			            </a>
			            <?php
		            }

	            ?>
		        </div><!-- .header__right -->
	        </div><!-- .header__row -->
        </div><!-- .c-side -->
    </header>

	<?#main menu?>
	<div class="main-menu-line">
		<div class="c-side">
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"main_menu",
				[
					"ROOT_MENU_TYPE" => "top",
					"MAX_LEVEL" => "1",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "Y",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "N",
					"MENU_CACHE_GET_VARS" => "",
	                "CACHE_SELECTED_ITEMS" => "N",
	                "ALLOW_MULTI_SELECT" => "Y",
				]
			);?>
		</div>
	</div>

    <div class="container">

	    <?$APPLICATION->IncludeComponent(
		    "bitrix:breadcrumb",
		    ".default",
		    [
			    "START_FROM" => "0",
			    "PATH" => "",
			    "SITE_ID" => "-",
		    ]
	    );?><?php

		$APPLICATION->ShowViewContent('page-top');
		$APPLICATION->ShowViewContent('workarea-start');
