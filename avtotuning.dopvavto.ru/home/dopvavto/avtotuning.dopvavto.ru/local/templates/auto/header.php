<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;
global $USER;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?$APPLICATION->ShowHead();?>
    <meta charset="UTF-8">
    <title><?$APPLICATION->ShowTitle()?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#eeeeee" />
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#eeeeee" />
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#eeeeee" />
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#eeeeee" />
    <?
    Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic" rel="stylesheet">');
    Asset::getInstance()->addString('<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery.fancybox.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/owlcarousel/owl.carousel.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/owlcarousel/owl.theme.default.min.cs");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/flipclock.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/carousel.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/flex.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/style.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/web-style.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/dev.css");
    ?>

</head>

<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

<div id="header">
    <div class="wrapper">
        <div class="header main_flex flex__align-items_center flex__jcontent_between">
            <div class="header__logo">
                <a <?=CSite::InDir('/index.php') ? '' : 'href="/"';?>>
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/logo.png" alt="logo" class="logo">
                </a>
                <p class="bdi">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH."/include/logo-text.php"
                        )
                    );?>
                </p>
            </div>
            <div class="header__address">
                <div class="header__address--icon main_flex__nowrap flex__align-items_center">
                    <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/maps-and-flags.svg">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH."/include/header-location.php"
                        )
                    );?>
                </div>
                <div class="header__address--icon main_flex__nowrap flex__align-items_center">
                    <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/wall-clock.svg">
                    <p class="rg">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH."/include/header-work-time.php"
                            )
                        );?>
                    </p>
                </div>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => SITE_TEMPLATE_PATH."/include/header-work-time2.php"
                    )
                );?>
            </div>
            <div class="header__phones">
                <div class="header__address--icon main_flex__nowrap flex__align-items_center fx1">
                    <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/phone-call.svg">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH."/include/header-phone-1.php"
                        )
                    );?>
                </div>
                <div class="header__address--icon main_flex__nowrap flex__align-items_center fx1">
                    <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/a1_logo.svg">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH."/include/header-phone-2.php"
                        )
                    );?>
                </div>
                <div class="header__address--icon main_flex__nowrap flex__align-items_center">
                    <div class="tel main_flex__nowrap flex__align-items_center">
                        <a href="tel:+375336356565" class="inner-link">
                            <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/tg_logo.svg">
                        </a>
                        <a href="viber://chat?number=375336356565" class="inner-link">
                            <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/viber_logo.svg">
                        </a>
                        <a href="https://wa.me/375336356565" class="inner-link">
                            <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/whatsapp_logo.svg">
                        </a>
                        <a href="tel:+375336356565" class="inner-link">
                            <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/mts_logo.svg">
                        </a>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH."/include/header-phone-3.php"
                        )
                    );?>
                </div>
            </div>
            <?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"catalog_search_title", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_iblock_catalog" => array(
			0 => "2",
		),
		"CHECK_DATES" => "N",
		"COMPONENT_TEMPLATE" => "catalog_search_title",
		"CONTAINER_ID" => "title-search",
		"CONVERT_CURRENCY" => "N",
		"INPUT_ID" => "searchVal",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/index.php",
		"PREVIEW_HEIGHT" => "75",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PREVIEW_WIDTH" => "75",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"SHOW_PREVIEW" => "Y",
		"TOP_COUNT" => "",
		"USE_LANGUAGE_GUESS" => "Y"
	),
	false
);?>
<!--            <div class="header__form">-->
<!--                <form action="/search/" class="main_flex__nowrap flex__align-items_center">-->
<!--                    <input type="text" name="q" id="searchVal" value="r">-->
<!--                    <button type="submit" class="submit">-->
<!--                        <img src="--><?//=SITE_TEMPLATE_PATH;?><!--/img/pictures/magnifier.png" alt="">-->
<!--                    </button>-->
<!--                </form>-->
<!--            </div>-->
            <div class="header__mob-item">
                <a href="javascript:void(0);">
                    <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/a1_logo.svg">
                    <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/mts_logo.svg">
                    <span class="first-phone">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH."/include/mob-header-phone1.php"
                            )
                        );?>
                    </span>
                    <img class="right-arrow" src="<?=SITE_TEMPLATE_PATH;?>/img/pictures/arrow-bottom1.png" alt="">
                </a>
                <div class="hover-block">
                    <p class="title">
                        Мы находимся по адресу:
                    </p>
                    <div class="info-block">
                        <div class="img">
                            <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/maps-and-flags.svg">
                        </div>
                        <div class="info-item">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => SITE_TEMPLATE_PATH."/include/header-location.php"
                                )
                            );?>
                        </div>
                    </div>
                    <p class="title">
                        Режим работы:
                    </p>
                    <div class="info-block">
                        <div class="img">
                            <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/wall-clock.svg">
                        </div>
                        <div class="info-item">
                            <p>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/mob-header-worktime.php"
                                    )
                                );?>
                            </p>
                        </div>
                    </div>
                    <p class="title">
                        Телефоны:
                    </p>
                    <div class="info-block">
                        <div class="phones-elements">
                            <div class="phone-item">
                                <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/phone-call.svg">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/mob-header-phone-1.php"
                                    )
                                );?>
                            </div>
                            <div class="phone-item">
                                <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/a1_logo.svg">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/mob-header-phone-2.php"
                                    )
                                );?>
                            </div>
                            <div class="phone-item">

                                <a href="tel:+375336356565" class="inner-link">
                                    <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/mts_logo.svg">
                                </a>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/mob-header-phone-3.php"
                                    )
                                );?>
                            </div>
                            <div class="phone-item phone-item__last">
                                <a href="https://wa.me/375336356565" class="inner-link">
                                    <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/whatsapp_logo.svg">
                                </a>
                                <a href="tel:+375336356565" class="inner-link">
                                    <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/tg_logo.svg">
                                </a>
                                <a href="viber://chat?number=375336356565" class="inner-link">
                                    <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/viber_logo.svg">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--- end header --->
<div id="fixed-elements">
    <!--- nav --->
    <div id="nav">
        <div class="wrapper">
            <div class="nav main_flex flex__align-items_center flex__jcontent_between">
                <div class="hamburger">
                    <div class="hamb--show mobile-menu-toggler main_flex flex__align-items_center flex__jcontent_between">
                        <div class="span">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <a href="#" class="bd menus">Меню</a>
                    </div>

                    <div id="menus__show" class="mobile-menu main_flex flex__align-items_start">
                        <ul class="main_flex flex__align-items_center navlink flex__1">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "template_main_menu_mob",
                                Array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "left",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "1",
                                    "MENU_CACHE_GET_VARS" => array(""),
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "top",
                                    "USE_EXT" => "N"
                                )
                            );?>
                        </ul>
                        <div class="header__form" class="flex__4">
                            <form action="/search/" class="main_flex__nowrap flex__align-items_center">
                                <input type="text" name="q">
                                <input type="submit" value="найти на сайте" class="bd">
                            </form>
                        </div>
                    </div>
                    <!--- hamburger nav show ---->
                    <div class="hav__show mobile-menu">
                        <div class="close-circle">
                            <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="20">
                        </div>
                        <ul class="main_flex flex__align-items_center navlink">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "template_main_menu_mob",
                                Array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "left",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "1",
                                    "MENU_CACHE_GET_VARS" => array(""),
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "top",
                                    "USE_EXT" => "N"
                                )
                            );?>
                        </ul>
<a href="javascript:void(0);" class="bd main_flex__nowrap flex__align-items_center log-mob btn-login">
                     
                            <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/login.svg">Вход
                        </a>
                        <div class="header__form">
                            <form action="/search/" class="main_flex__nowrap flex__align-items_center">
                                <input type="text" name="q">
                                <input type="submit" value="найти на сайте" class="bd">
                            </form>
                        </div>
                    </div>
                    <!--- end hamburger nav show ---->
                </div>

                <div class="search__auto">
                    <div class="mobile-menu-toggler main_flex__nowrap flex__align-items_center fx1 show-click">
                        <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/car-wheel.svg" width="20">
                        <p class="bd">Поиск по авто</p>
                    </div>
                    <div id="search-show" class="mobile-menu">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:catalog.section.list",
                            "auto_search_mob",
                            Array(
                                "ADD_SECTIONS_CHAIN" => "N",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "N",
                                "COMPONENT_TEMPLATE" => "auto_search_mob",
                                "COUNT_ELEMENTS" => "N",
                                "FILTER_NAME" => "sectionsFilter",
                                "IBLOCK_ID" => "19",
                                "IBLOCK_TYPE" => "catalog",
                                "SECTION_CODE" => "",
                                "SECTION_FIELDS" => array(0=>"",1=>"",),
                                "SECTION_ID" => "",
                                "SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#",
                                "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
                                "SHOW_PARENT_NAME" => "Y",
                                "TOP_DEPTH" => "4",
                                "VIEW_MODE" => "LIST"
                            )
                        );?>
                    </div>
                    <!-- seacrh mob show ----->
                    <div id="search-show" class="mob-search mobile-menu">
                        <div class="close-circle">
                            <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="20">
                        </div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:catalog.section.list",
                            "auto_search_mob",
                            Array(
                                "ADD_SECTIONS_CHAIN" => "N",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_TYPE" => "N",
                                "COMPONENT_TEMPLATE" => "auto_search_mob",
                                "COUNT_ELEMENTS" => "N",
                                "FILTER_NAME" => "sectionsFilter",
                                "IBLOCK_ID" => "19",
                                "IBLOCK_TYPE" => "catalog",
                                "SECTION_CODE" => "",
                                "SECTION_FIELDS" => array(0=>"",1=>"",),
                                "SECTION_ID" => "",
                                "SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#",
                                "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
                                "SHOW_PARENT_NAME" => "Y",
                                "TOP_DEPTH" => "4",
                                "VIEW_MODE" => "LIST"
                            )
                        );?>
                    </div>
                    <!--- end search mob show ---->
                </div>
                <div class="navs__catalog main_flex flex__align-items_start">
                    <div class="mobile-menu-toggler">
                        <i class="fas fa-bars"></i>
                        <a class="bd"style="float: left;" href="/catalog/">Каталог</a>
<!--                        <p class="bd" style="float: left;">Каталог</p>-->
                    </div>

                    <div class="mobile-menu1 catalogs__show main_flex flex__align-items_start flex__jcontent_start">
<!--                        --><?//$APPLICATION->IncludeComponent(
//                            "bitrix:menu",
//                            "template_catalog_menu_mob_plan",
//                            Array(
//                                "ALLOW_MULTI_SELECT" => "N",
//                                "CHILD_MENU_TYPE" => "left",
//                                "DELAY" => "N",
//                                "MAX_LEVEL" => "3",
//                                "MENU_CACHE_GET_VARS" => array(""),
//                                "MENU_CACHE_TIME" => "3600",
//                                "MENU_CACHE_TYPE" => "A",
//                                "MENU_CACHE_USE_GROUPS" => "Y",
//                                "ROOT_MENU_TYPE" => "catalog",
//                                "USE_EXT" => "Y"
//                            )
//                        );?>
                    </div>
                </div>
                <div class="navs__catalog mob__navs__catalog main_flex flex__align-items_start">
                    <div class="mobile-menu-toggler">
                        <i class="fas fa-bars"></i>
                        <a class="bd"style="float: left;" href="/catalog/">Каталог</a>

<!--                        <p class="bd" style="float: left;">Каталог</p>-->
                    </div>
                    <div class="catalog__show mobile-menu1">
                        <div class="close-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 21.9 21.9" enable-background="new 0 0 21.9 21.9" class="svg replaced-svg">
                                <path d="M14.1,11.3c-0.2-0.2-0.2-0.5,0-0.7l7.5-7.5c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7l-1.4-1.4C20,0.1,19.7,0,19.5,0  c-0.3,0-0.5,0.1-0.7,0.3l-7.5,7.5c-0.2,0.2-0.5,0.2-0.7,0L3.1,0.3C2.9,0.1,2.6,0,2.4,0S1.9,0.1,1.7,0.3L0.3,1.7C0.1,1.9,0,2.2,0,2.4  s0.1,0.5,0.3,0.7l7.5,7.5c0.2,0.2,0.2,0.5,0,0.7l-7.5,7.5C0.1,19,0,19.3,0,19.5s0.1,0.5,0.3,0.7l1.4,1.4c0.2,0.2,0.5,0.3,0.7,0.3  s0.5-0.1,0.7-0.3l7.5-7.5c0.2-0.2,0.5-0.2,0.7,0l7.5,7.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l1.4-1.4c0.2-0.2,0.3-0.5,0.3-0.7  s-0.1-0.5-0.3-0.7L14.1,11.3z"></path>
                            </svg>
                        </div>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "template_catalog_menu_mob",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "3",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "catalog",
                                "USE_EXT" => "Y"
                            )
                        );?>

                    </div>
                </div>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "template_main_menu",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "N"
                    )
                );?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:system.auth.form",
                    "personal",
                    Array(
                        "FORGOT_PASSWORD_URL" => "",
                        "PROFILE_URL" => "/personal/",
                        "REGISTER_URL" => "/register/",
                        "SHOW_ERRORS" => "N"
                    )
                );?>
                <div class="basket full">
                    <a href="/personal/cart/" class="bd basket__link">
                        <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/shopping-cart.svg">Корзина
                    </a>
                    <div class="basket__open">
                        <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"small_cart", 
	array(
		"HIDE_ON_BASKET_PAGES" => "N",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => "/personal/cart/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_DELAY" => "N",
		"SHOW_EMPTY_VALUES" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_NUM_PRODUCTS" => "N",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRICE" => "Y",
		"SHOW_PRODUCTS" => "Y",
		"SHOW_REGISTRATION" => "N",
		"SHOW_SUMMARY" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"COMPONENT_TEMPLATE" => "small_cart",
		"MAX_IMAGE_SIZE" => "70"
	),
	false
);?>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav nav__catalog main_flex__nowrap flex__align-items_center flex__jcontent_center">
            <div class="search__auto">
                <div class="mobile-menu-toggler main_flex__nowrap flex__align-items_center fx1 show-click">
                    <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/car-wheel.svg" width="20">
                    <p class="bd">Поиск по авто</p>
                </div>
                <div id="search-show" class="mobile-menu">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.section.list",
                        "auto_search_mob",
                        Array(
                            "ADD_SECTIONS_CHAIN" => "N",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "N",
                            "COMPONENT_TEMPLATE" => "auto_search_mob",
                            "COUNT_ELEMENTS" => "N",
                            "FILTER_NAME" => "sectionsFilter",
                            "IBLOCK_ID" => "19",
                            "IBLOCK_TYPE" => "catalog",
                            "SECTION_CODE" => "",
                            "SECTION_FIELDS" => array(0=>"",1=>"",),
                            "SECTION_ID" => "",
                            "SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#",
                            "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
                            "SHOW_PARENT_NAME" => "Y",
                            "TOP_DEPTH" => "4",
                            "VIEW_MODE" => "LIST"
                        )
                    );?>
                </div>
                <!-- seacrh mob show ----->
                <div id="search-show" class="mob-search mobile-menu">
                    <div class="close-circle">
                        <img class="svg" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/cancel.svg" width="20">
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.section.list",
                        "auto_search_mob",
                        Array(
                            "ADD_SECTIONS_CHAIN" => "N",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "N",
                            "COMPONENT_TEMPLATE" => "auto_search_mob",
                            "COUNT_ELEMENTS" => "N",
                            "FILTER_NAME" => "sectionsFilter",
                            "IBLOCK_ID" => "19",
                            "IBLOCK_TYPE" => "catalog",
                            "SECTION_CODE" => "",
                            "SECTION_FIELDS" => array(0=>"",1=>"",),
                            "SECTION_ID" => "",
                            "SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#",
                            "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
                            "SHOW_PARENT_NAME" => "Y",
                            "TOP_DEPTH" => "4",
                            "VIEW_MODE" => "LIST"
                        )
                    );?>
                </div>
                <!--- end search mob show ---->
            </div>
            <div class="basket full">
                <a href="/personal/cart/" class="bd basket__link">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 19.2 19.2" style="enable-background:new 0 0 19.2 19.2;" xml:space="preserve" class="svg icon replaced-svg">
								<g>
                                    <g id="Layer_1_107_">
                                        <g>
                                            <path d="M19,3c-0.2-0.2-0.5-0.3-0.8-0.3H4.4L4.2,1.5C4.2,1,3.7,0.6,3.2,0.6H1c-0.6,0-1,0.4-1,1s0.4,1,1,1h1.4     l1.9,11.2c0,0,0,0.1,0,0.1c0,0.1,0,0.1,0.1,0.2c0,0.1,0.1,0.1,0.1,0.2c0,0,0.1,0.1,0.1,0.1c0.1,0.1,0.1,0.1,0.2,0.1     c0,0,0.1,0,0.1,0.1c0.1,0,0.2,0.1,0.4,0.1c0,0,11,0,11,0c0.6,0,1-0.4,1-1s-0.4-1-1-1H6.1l-0.2-1h11.3c0.5,0,0.9-0.4,1-0.9l1-7     C19.3,3.5,19.2,3.2,19,3z M17.1,4.6l-0.3,2h-3.6v-2H17.1z M12.2,4.6v2h-3v-2H12.2z M12.2,7.6v2h-3v-2H12.2z M8.2,4.6v2h-3     c-0.1,0-0.1,0-0.1,0l-0.3-2H8.2z M5.3,7.6h3v2H5.6L5.3,7.6z M13.2,9.6v-2h3.4l-0.3,2H13.2z"></path>
                                            <circle class="st0" cx="6.8" cy="17.1" r="1.5"></circle>
                                            <circle class="st0" cx="15.8" cy="17.1" r="1.5"></circle>
                                        </g>
                                    </g>
                                </g>
								</svg>Корзина
                </a>
                <div class="basket__open">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:sale.basket.basket.line",
                        "small_cart_mob",
                        Array(
                            "HIDE_ON_BASKET_PAGES" => "N",
                            "PATH_TO_AUTHORIZE" => "",
                            "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                            "PATH_TO_ORDER" => SITE_DIR."personal/cart/",
                            "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                            "PATH_TO_PROFILE" => SITE_DIR."personal/",
                            "PATH_TO_REGISTER" => SITE_DIR."login/",
                            "POSITION_FIXED" => "N",
                            "SHOW_AUTHOR" => "N",
                            "SHOW_DELAY" => "N",
                            "SHOW_EMPTY_VALUES" => "N",
                            "SHOW_IMAGE" => "Y",
                            "SHOW_NOTAVAIL" => "N",
                            "SHOW_NUM_PRODUCTS" => "N",
                            "SHOW_PERSONAL_LINK" => "N",
                            "SHOW_PRICE" => "Y",
                            "SHOW_PRODUCTS" => "Y",
                            "SHOW_REGISTRATION" => "N",
                            "SHOW_SUMMARY" => "Y",
                            "SHOW_TOTAL_PRICE" => "Y"
                        )
                    );?>
                </div>
            </div>
        </div>
    </div>
    <!--- end nav --->
    <!--- search --->
    <div id="search">
        <div class="wrapper">
            <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"auto_search", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "auto_search",
		"COUNT_ELEMENTS" => "N",
		"FILTER_NAME" => "sectionsFilter",
		"IBLOCK_ID" => "19",
		"IBLOCK_TYPE" => "catalog",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => "",
		"SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "4",
		"VIEW_MODE" => "LIST"
	),
	false
);?>
        </div>
    </div>
    <!--- end search --->
</div>