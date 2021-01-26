<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);

if(!\Bitrix\Main\Loader::includeModule('art.corp')) {
	ShowError( GetMessage('AR.CORP.ERROR_CORP_NOT_INSTALLED') );
}
if(!\Bitrix\Main\Loader::includeModule('art.devfunc')) {
	ShowError( GetMessage('AR.CORP.ERROR_DEVFUNC_NOT_INSTALLED') );
} else {
	RSDevFunc::Init(array('jsfunc'));
}

// corp options
$blackMode = ARCorp::getSettings('blackMode', 'N' );
$headType = ARCorp::getSettings('headType', 'type1');
$filterType = ARCorp::getSettings('filterType', 'ftype0');
$sidebarPos = ARCorp::getSettings('sidebarPos', 'pos1');
global $IS_CATALOG, $IS_CATALOG_SECTION;
$IS_CATALOG = false;
$IS_CATALOG_SECTION = false;

// is main page
$IS_MAIN = false;
if( $APPLICATION->GetCurPage(true)==SITE_DIR.'index.php' )
	$IS_MAIN = true;

// is catalog page
$IS_CATALOG = true;
if( strpos($APPLICATION->GetCurPage(true), SITE_DIR.'catalog/')===false )
	$IS_CATALOG = false;

// get site data
$cache = new CPHPCache();
$cache_time = 86400;
$cache_id = 'CSiteGetByID'.SITE_ID;
$cache_path = '/siteData/';
if( $cache_time>0 && $cache->InitCache($cache_time, $cache_id, $cache_path) ) {
	$res = $cache->GetVars();
	if( is_array($res["CSiteGetByID"]) && (count($res["CSiteGetByID"])>0) )
		$CSiteGetByID = $res["CSiteGetByID"];
}
if(!is_array($CSiteGetByID)) {
	$rsSites = CSite::GetByID(SITE_ID);
	$CSiteGetByID = $rsSites->Fetch();
	if($cache_time>0) {
		$cache->StartDataCache($cache_time, $cache_id, $cache_path);
		$cache->EndDataCache(array("CSiteGetByID"=>$CSiteGetByID));
	}
}
define("PATH_TO_404", "/404.php");
?>
<!DOCTYPE html>
<?
?>
<html lang="ru">
<?
?>

<head>
	<?
	?>
	<title>
		<?$APPLICATION->ShowTitle()?><?= $CSiteGetByID['SITE_NAME'] ?></title>
	<?
	$APPLICATION->ShowHead();
    // some strings
    $APPLICATION->AddHeadString('<link href="'.SITE_DIR.'favicon.png" rel="shortcut icon"  type="image/x-icon" />');
    $APPLICATION->AddHeadString('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
    $APPLICATION->AddHeadString('<meta name="viewport" content="width=device-width, initial-scale=1">');
    $APPLICATION->AddHeadString('<meta name="yandex-verification" content="6877a5fb975d8767" />');
    $APPLICATION->AddHeadString('<meta name="google-site-verification" content="I8fbYa0rUq3dbPDCku1oStH3YSNCyBUN7l-3KKvqLLE" />');
    $APPLICATION->AddHeadString('<script src="//yastatic.net/share/share.js" charset="'.SITE_CHARSET.'"></script>');
    $APPLICATION->AddHeadString('<link href="//fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet" type="text/css">');
    $APPLICATION->AddHeadString('<link href="//fonts.googleapis.com/css?family=Roboto:500,300,400" rel="stylesheet" type="text/css">');
    // add styles
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles/style.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles/owl.carousel.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles/jquery.fancybox.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles/header.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles/sidebar.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles/footer.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles/content.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/styles/color.css'); // color scheme
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/custom/style.css');
	 $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/custom/demo.css');
	 $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/custom/buttons.css');
	 $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/custom/style2.css');
    // add scripts
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery-1.11.2.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/bootstrap/bootstrap.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/owl.carousel.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/fancybox/jquery.fancybox.pack.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/script.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/modernizr.custom.53451.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.gallery.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.spincrement.min.js');
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/custom/script.js');
?>
	<script>
		// some JS params
		var SITE_ID = '<?= SITE_ID ?>',
			SITE_DIR = '<?= str_replace('//', '/', SITE_DIR); ?>',
			SITE_TEMPLATE_PATH = '<?= str_replace('//', '/', SITE_TEMPLATE_PATH); ?>',
			BX_COOKIE_PREFIX = 'BITRIX_SM_',
			AR_CORP_COUNT_COMPARE = 0,
			AR_CORP_COUNT_FAVORITE = 0,
			AR_CORP_COUNT_BASKET = 0;
		// messages
		BX.message({
			"ARCORP_JS_REQUIRED_FIELD": "<?= CUtil::JSEscape(GetMessage('AR.CORP.JS_REQUIRED_FIELD')) ?>"
		});
	</script>
	<?
?>
	<script src="/bitrix/js/art.devfunc/script.js"></script>
	<script src="/bitrix/js/main/core/core.min.js"></script>
	<script src="/bitrix/js/main/core/core_ajax.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="<?if($blackMode=='Y'):?>blackMode<?endif;?>">

	<!-- добавить класс empty-basket если корзина пуста-->
	<div id="shopCart" class="side-basket empty-basket">
		<div class="side-basket__label js-btn-show">
			<div class="side-basket__count">0</div>
		</div>
		<div class="side-basket__label mob">
			<a class="side-basket__link" href="http://gnl.cs90176.tmweb.ru/basket/">
				<div class="side-basket__count">0</div>
			</a>
		</div>
		<div class="side-basket__top">
			<div class="side-basket__top-title">Корзина</div>
			<button class="side-basket__top-close js-btn-show" type="button">
				<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L13 13M13 1L1 13" stroke="#B0B0B0" stroke-width="2" stroke-linecap="round" />
				</svg>
			</button>
		</div>
		<div class="side-basket__empty">
			<div class="side-basket__title">Корзина пуста</div>
			<p class="side-basket__text">Перейдите в каталог и закажите интересующий вас товар!</p>
		</div>
		<div class="side-basket__filled">
			<div class="side-basket__products products-scrollbar">
				<div class="side-basket__product">
					<!-- <div class="side-basket__product-el"> -->
					<div class="side-basket__product-img-wrap">
						<a href="#">
							<img src="/bitrix/images/basket-products/product-1.png" alt="Платье от Dior от лучших модельеров Парижа, черное, 6152436372" class="side-basket__product-img">
						</a>
					</div>
					<a href="#" class="side-basket__product-link">Платье от Dior от лучших модельеров Парижа, черное, 6152436372</a>
					<div class="side-basket__price">
						<div class="side-basket__price-current">5 172 руб.</div>
						<div class="side-basket__price-old">4 062 руб.</div>
					</div>
					<!-- </div> -->
					<!-- <div class="side-basket__product-el"> -->
					<div class="side-basket__product-stepper stepper js-stepper">
						<button class="stepper__btn stepper__btn--minus" type="button" data-step="down">
							<svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.913708 1.4712C0.744147 1.4712 0.609375 1.33318 0.609375 1.16467C0.609375 0.996153 0.744147 0.862213 0.913708 0.862213H8.90936C9.07892 0.862213 9.21807 0.996153 9.21807 1.16467C9.21807 1.33318 9.07892 1.47148 8.90936 1.47148H0.913708V1.4712Z" fill="#535353" />
							</svg>
						</button>
						<input type="text" class="stepper__input" value="1">
						<button class="stepper__btn stepper__btn--plus" type="button" data-step="up">
							<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.59086 4.41317H5.62891V0.475667C5.62891 0.274308 5.46467 0.111084 5.26206 0.111084C5.05945 0.111084 4.89521 0.274308 4.89521 0.475667V4.41317H0.933254C0.730644 4.41317 0.566406 4.57639 0.566406 4.77775C0.566406 4.97911 0.730644 5.14233 0.933254 5.14233H4.89521V9.07983C4.89521 9.28119 5.05945 9.44442 5.26206 9.44442C5.46467 9.44442 5.62891 9.28119 5.62891 9.07983V5.14233H9.59086C9.79347 5.14233 9.95771 4.97911 9.95771 4.77775C9.95771 4.57639 9.79347 4.41317 9.59086 4.41317Z" fill="#535353" />
							</svg>
						</button>
					</div>
					<div class="side-basket__price">
						<div class="side-basket__price-text">Итого</div>
						<div class="side-basket__price-total">5 172 руб.</div>
					</div>
					<!-- </div> -->
					<div class="side-basket__product-del">
						<a href="" class="">
							<svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.5 1L8.5 9M8.5 1L0.5 9" stroke="#B0B0B0" />
							</svg>
						</a>
					</div>
				</div>
				<div class="side-basket__product">
					<div class="side-basket__product-img-wrap">
						<a href="#">
							<img src="/bitrix/images/basket-products/product-2.png" alt="Духи Montale AOUD AMBRE, 500ml, 6362736273" class="side-basket__product-img">
						</a>
					</div>
					<a href="#" class="side-basket__product-link">Духи Montale AOUD AMBRE, 500ml, 6362736273</a>
					<div class="side-basket__price">
						<div class="side-basket__price-current">5 172 руб.</div>
						<!-- <div class="side-basket__price-old">4 062 руб.</div> -->
					</div>
					<div class="side-basket__product-stepper stepper js-stepper">
						<button class="stepper__btn stepper__btn--minus" type="button" data-step="down">
							<svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.913708 1.4712C0.744147 1.4712 0.609375 1.33318 0.609375 1.16467C0.609375 0.996153 0.744147 0.862213 0.913708 0.862213H8.90936C9.07892 0.862213 9.21807 0.996153 9.21807 1.16467C9.21807 1.33318 9.07892 1.47148 8.90936 1.47148H0.913708V1.4712Z" fill="#535353" />
							</svg>
						</button>
						<input type="text" class="stepper__input" value="2">
						<button class="stepper__btn stepper__btn--plus" type="button" data-step="up">
							<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.59086 4.41317H5.62891V0.475667C5.62891 0.274308 5.46467 0.111084 5.26206 0.111084C5.05945 0.111084 4.89521 0.274308 4.89521 0.475667V4.41317H0.933254C0.730644 4.41317 0.566406 4.57639 0.566406 4.77775C0.566406 4.97911 0.730644 5.14233 0.933254 5.14233H4.89521V9.07983C4.89521 9.28119 5.05945 9.44442 5.26206 9.44442C5.46467 9.44442 5.62891 9.28119 5.62891 9.07983V5.14233H9.59086C9.79347 5.14233 9.95771 4.97911 9.95771 4.77775C9.95771 4.57639 9.79347 4.41317 9.59086 4.41317Z" fill="#535353" />
							</svg>
						</button>
					</div>
					<div class="side-basket__price">
						<div class="side-basket__price-text">Итого</div>
						<div class="side-basket__price-total">10 344 руб.</div>
					</div>
					<div class="side-basket__product-del">
						<a href="" class="">
							<svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.5 1L8.5 9M8.5 1L0.5 9" stroke="#B0B0B0" />
							</svg>
						</a>
					</div>
				</div>
				<div class="side-basket__product">
					<div class="side-basket__product-img-wrap">
						<a href="#">
							<img src="/bitrix/images/basket-products/product-3.jpg" alt="Платье от Dior от лучших модельеров Парижа, черное, 6152436372" class="side-basket__product-img">
						</a>
					</div>
					<a href="#" class="side-basket__product-link">Платье от Dior от лучших модельеров Парижа, черное, 6152436372</a>
					<div class="side-basket__price">
						<div class="side-basket__price-current">5 172 руб.</div>
						<div class="side-basket__price-old">4 062 руб.</div>
					</div>
					<div class="side-basket__product-stepper stepper js-stepper">
						<button class="stepper__btn stepper__btn--minus" type="button" data-step="down">
							<svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.913708 1.4712C0.744147 1.4712 0.609375 1.33318 0.609375 1.16467C0.609375 0.996153 0.744147 0.862213 0.913708 0.862213H8.90936C9.07892 0.862213 9.21807 0.996153 9.21807 1.16467C9.21807 1.33318 9.07892 1.47148 8.90936 1.47148H0.913708V1.4712Z" fill="#535353" />
							</svg>
						</button>
						<input type="text" class="stepper__input" value="1">
						<button class="stepper__btn stepper__btn--plus" type="button" data-step="up">
							<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.59086 4.41317H5.62891V0.475667C5.62891 0.274308 5.46467 0.111084 5.26206 0.111084C5.05945 0.111084 4.89521 0.274308 4.89521 0.475667V4.41317H0.933254C0.730644 4.41317 0.566406 4.57639 0.566406 4.77775C0.566406 4.97911 0.730644 5.14233 0.933254 5.14233H4.89521V9.07983C4.89521 9.28119 5.05945 9.44442 5.26206 9.44442C5.46467 9.44442 5.62891 9.28119 5.62891 9.07983V5.14233H9.59086C9.79347 5.14233 9.95771 4.97911 9.95771 4.77775C9.95771 4.57639 9.79347 4.41317 9.59086 4.41317Z" fill="#535353" />
							</svg>
						</button>
					</div>
					<div class="side-basket__price">
						<div class="side-basket__price-text">Итого</div>
						<div class="side-basket__price-total">10 344 руб.</div>
					</div>
					<div class="side-basket__product-del">
						<a href="" class="">
							<svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.5 1L8.5 9M8.5 1L0.5 9" stroke="#B0B0B0" />
							</svg>
						</a>
					</div>
				</div>
			</div>
			<div class="side-basket__middle">
				<a class="side-basket__clear" href="#">
					<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L9 9M9 1L1 9" stroke="#444444" stroke-linecap="round" />
					</svg>
					Очистить корзину
				</a>
				<div class="side-basket__total-amount-wrap">
					<div class="side-basket__total-amount">Общая сумма: <span>10 344 р.</span></div>
					<div class="side-basket__total-amount-old">10 344 р.</div>
				</div>
			</div>
			<div class="side-basket__buttons">
				<div class="side-basket__go-to-basket">
					<a href="http://gnl.cs90176.tmweb.ru/basket/" class="side-basket__go-to-basket-link">Перейти в корзину</a>
					<div class="side-basket__buttons-text">Полноценное оформление заказа</div>
				</div>
				<div class="side-basket__fast-order">
					<a href="#modal-fast-wrap" class="side-basket__fast-order-link modal-fast-wrap">Быстрый заказ</a>
					<div class="side-basket__buttons-text">Вам потребуется указать только имя и номер телефона</div>
				</div>
			</div>
		</div>
	</div>

	<div id="panel"><?= $APPLICATION->ShowPanel() ?></div>

	<?$APPLICATION->IncludeFile(SITE_DIR."include_areas/body_start.php",array(),array("MODE"=>"html"));?>

	<div class="wrapper">
		<div class="wrapper-top">
			<div class="topline-wrapper">
				<div class="container">
					<div class="row topline">
						<div class="container">
							<div class="col-lg-7 col-md-7 hidden-sm hidden-xs slogan text-center">
								<?$APPLICATION->IncludeFile(SITE_DIR."include_areas/pdf_load.php",array(),array("MODE"=>"html"));?>
							</div>
							<!--<div class="col-lg-3 col-md-3 hidden-sm hidden-xs topline-middle">
									<a class="fancyajax fancybox.ajax" href="/forms/recall/" title="Свяжитесь с нами">ОБРАТНАЯ СВЯЗЬ</a>
									<a class="online-zakaz" href="/onlayn-zakaz/">ОНЛАЙН-ЗАКАЗ</a>
								</div>-->
							<div class="col-lg-5 col-md-5 hidden-sm hidden-xs social-lang">
								<span class="tophone">
									<?$APPLICATION->IncludeFile(SITE_DIR."include_areas/social.php",array(),array("MODE"=>"html"));?></span>
								<span class="lang">
									<a href="//gnl.by/">RU </a><a class="other-lang" href="//gnl.by/">| EN</a>
								</span>


							</div>
							<div class="hidden-lg hidden-md col-sm-3 col-xs-6">
								<a href="/">
									<img src="/bitrix/templates/cor/img/GNL-logo.png" alt="Логотип GNL">
									<!--<img src="/bitrix/templates/cor/images/logo-sm.png" alt="">-->
								</a>
							</div>
							<div class="hidden-lg hidden-md col-sm-6 hidden-xs topline-middle">
								<span class="tophone">
									<?$APPLICATION->IncludeFile(SITE_DIR."include_areas/pdf_load.php",array(),array("MODE"=>"html"));?></span>

							</div>
							<div class="hidden-lg hidden-md col-sm-3 col-xs-6 hidden-lang">
								<span class="lang">
									<a href="//gnl.by/">RU </a><a class="other-lang" href="//gnl.by/">| EN</a>
								</span>
								<div class="clear"></div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<?$APPLICATION->IncludeComponent("bitrix:main.include", "corp", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/header/head_type1_menu.php", "EDIT_TEMPLATE" => ""),	false);?>


		</div>

		<?if($IS_MAIN):?>
		<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include_areas/main_banners.php"), false);?>
		<?endif;?>

		<!-- container -->
		<div class="container">

			<div class="row <?if(!$IS_MAIN):?> notmain<?endif;?>">
				<div class="col col-md-9<?= ($sidebarPos == 'pos1' ? ' col-md-push-3' : '') ?> maincontent">

					<?if(!$IS_MAIN):?>
					<div class="js-brcrtitle">
						<?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"corp",
	array()
);?>
					</div>
					<div class="js-ttl">
						<div class="page-header">
							<h1>
								<?$APPLICATION->ShowTitle(false)?>
							</h1>
						</div>
					</div>
					<?endif;?>