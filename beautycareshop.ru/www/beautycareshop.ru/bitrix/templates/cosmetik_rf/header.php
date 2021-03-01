<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;
?>
<!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">

<head>
	<title>
		<?$APPLICATION->ShowTitle()?>
	</title>
	<!--	<meta http-equiv="X-UA-Compatible" content="IE=edge" />-->
	<!--	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">-->
	<!--	<link rel="shortcut icon" type="image/x-icon" href="-->
	<?//=SITE_DIR?>
	<!--favicon.ico" />-->
	<!--	<link rel="icon" type="image/png" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/images/icons/favicon.png"/>-->
	<?Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge" />');?>
	<?Asset::getInstance()->addString('<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">');?>
	<?Asset::getInstance()->addString('<link rel="shortcut icon" type="image/x-icon" href="<?= SITE_DIR ?>favicon.ico" />');?>
	<?Asset::getInstance()->addString('<link rel="icon" type="image/png" href="<?= SITE_TEMPLATE_PATH ?>/images/icons/favicon.png"/>');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/library/bootstrap/css/bootstrap.min.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/font-awesome-4.7.0/css/font-awesome.min.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/themify/themify-icons.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/Linearicons-Free-v1.0.0/icon-font.min.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/elegant-font/html-css/style.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/library/animate/animate.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/library/css-hamburgers/hamburgers.min.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/library/animsition/css/animsition.min.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/library/select2/select2.min.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/library/daterangepicker/daterangepicker.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/library/slick/slick.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/library/lightbox2/css/lightbox.min.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/util.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/main.css');?>
	<?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/bootstrap.css');?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">

	<!--    <link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/library/bootstrap/css/bootstrap.min.css">-->
	<!--	<link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/fonts/font-awesome-4.7.0/css/font-awesome.min.css">-->
	<!--	<link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/fonts/themify/themify-icons.css">-->
	<!--	<link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">-->
	<!--	<link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/fonts/elegant-font/html-css/style.css">-->
	<!---->
	<!--    <link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/library/animate/animate.css">-->
	<!--    <link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/library/css-hamburgers/hamburgers.min.css">-->
	<!--    <link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/library/animsition/css/animsition.min.css">-->
	<!--    <link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/library/select2/select2.min.css">-->
	<!--    <link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/library/daterangepicker/daterangepicker.css">-->
	<!--    <link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/library/slick/slick.css">-->
	<!--    <link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/library/lightbox2/css/lightbox.min.css">-->
	<!--	<link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/css/util.css">-->
	<!--	<link rel="stylesheet" type="text/css" href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/css/main.css">-->


	<!--<link href="-->
	<?//= SITE_TEMPLATE_PATH ?>
	<!--/css/bootstrap.css" rel="stylesheet">-->

	<? $APPLICATION->ShowHead(); ?>

	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-P2XLC46');
	</script>
	<!-- End Google Tag Manager -->


</head>

<body class="animsition">

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P2XLC46" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<? $APPLICATION->ShowPanel(); ?>
			<div class="topbar">
				<div class="topbar-social">
					<!--					<a href="#" class="topbar-social-item fa fa-facebook"></a>-->
					<a href="https://www.instagram.com/beautycareshop.ru/" class="topbar-social-item fa fa-instagram"></a>
					<!--					<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
					<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>-->
					<!--					<a href="#" class="topbar-social-item fa fa-youtube-play"></a>-->
				</div>

				<span class="topbar-child1">
					Косметика для здоровой кожи
				</span>

				<div class="topbar-child2">
					<span class="topbar-email">
						careshopb@gmail.com
					</span>
				</div>
			</div>
			<div class="wrap_header">
				<!-- Logo -->
				<a href="/" class="logo">
					<img src="<?= SITE_TEMPLATE_PATH ?>/images/icons/logo.png" alt="IMG-LOGO">
				</a>
				<!-- <?global $USER;
                if ($USER->IsAdmin()){
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/telephone.php"
                        )
                    );
                } ?> -->

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="/">Главная</a>
							</li>

							<!--							<li class="sale-noti">
								<a href="/catalog/">Каталог</a>
							</li>-->

							<li>
								<a href="/about/">О нас</a>
							</li>

							<li>
								<a href="/about/contacts/">Контакты</a>
							</li>


						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
					<div class="header-search">
						<?$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	"header_search",
	Array(
		"PAGE" => "#SITE_DIR#search/index.php",
		"USE_SUGGEST" => "N"
	)
);?>
					</div>
					<a href="<?= ($USER->IsAuthorized()) ? "/personal/" : "/login/" ?>" class="header-wrapicon1 dis-block">


						<img src="<?= SITE_TEMPLATE_PATH ?>/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>


					<?$APPLICATION->IncludeComponent(
						"bitrix:sale.basket.basket.line",
						"header_line",
						array(
							"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
							"PATH_TO_PERSONAL" => SITE_DIR."personal/",
							"SHOW_PERSONAL_LINK" => "N",
							"SHOW_NUM_PRODUCTS" => "Y",
							"SHOW_TOTAL_PRICE" => "Y",
							"SHOW_PRODUCTS" => "N",
							"POSITION_FIXED" =>"N",
							"SHOW_AUTHOR" => "Y",
							"PATH_TO_REGISTER" => SITE_DIR."login/",
							"PATH_TO_PROFILE" => SITE_DIR."personal/"
						),
						false,
						array()
					);?>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="/" class="logo-mobile">
				<img src="<?= SITE_TEMPLATE_PATH ?>/images/icons/logo.png" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="<?= SITE_TEMPLATE_PATH ?>/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<img src="<?= SITE_TEMPLATE_PATH ?>/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">


						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">




							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="/personal/cart/" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu">
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Косметика для здоровой кожи
						</span>
					</li>

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								careshopb@gmail.com
							</span>
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<!--							<a href="#" class="topbar-social-item fa fa-facebook"></a>-->
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
							<!--							<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
							<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>-->
							<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>


					<li class="item-menu-mobile">
						<a href="/">Главная</a>
					</li>


					<li class="item-menu-mobile">
						<a href="/about/">О нас</a>
					</li>

					<li class="item-menu-mobile">
						<a href="/about/contacts/">Контакты</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>
	<?php $APPLICATION->IncludeComponent(
		"new:menu",
		".default",
		array(
			"COMPONENT_TEMPLATE" => ".default"
		),
		false
	); ?>
	<?
/*global $USER;
if ($USER->IsAdmin()){
     if ($APPLICATION->GetCurPage(false) !== '/'):?>
	<h1>
		<?$APPLICATION->ShowTitle(false)?>
	</h1>
	<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "universal_webcompany", Array(
            "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                "COMPONENT_TEMPLATE" => "universal"
            ),
            false
        );?>
	<?endif;
}*/?>
	<? if ($APPLICATION->GetCurPage(false) !== '/'){?>
<div class="container" style="padding-top: 20px;">
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "universal_webcompany", Array(
            "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                "COMPONENT_TEMPLATE" => "universal"
            ),
            false
        );?>
</div>
<div class="container">
	<h2 class="page-title"><?$APPLICATION->ShowTitle()?></h2>
</div>
	<?}?>