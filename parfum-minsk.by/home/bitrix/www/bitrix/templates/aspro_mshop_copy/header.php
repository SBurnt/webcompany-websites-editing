<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if($GET["debug"] == "y"){
	error_reporting(E_ERROR | E_PARSE);
}
IncludeTemplateLangFile(__FILE__);
global $APPLICATION, $TEMPLATE_OPTIONS, $arSite;
$arSite = CSite::GetByID(SITE_ID)->Fetch();
$htmlClass = ($_REQUEST && isset($_REQUEST['print']) ? 'print' : false);
?>
<!DOCTYPE html>
<html xml:lang='<?=LANGUAGE_ID?>' lang='<?=LANGUAGE_ID?>' xmlns="http://www.w3.org/1999/xhtml" <?=($htmlClass ? 'class="'.$htmlClass.'"' : '')?>>
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<?$APPLICATION->ShowMeta("viewport");?>
	<?$APPLICATION->ShowMeta("HandheldFriendly");?>
	<?$APPLICATION->ShowMeta("apple-mobile-web-app-capable", "yes");?>
	<?$APPLICATION->ShowMeta("apple-mobile-web-app-status-bar-style");?>
	<?$APPLICATION->ShowMeta("SKYPE_TOOLBAR");?>
	<?$APPLICATION->ShowHead();?>
	<?$APPLICATION->AddHeadString('<script>BX.message('.CUtil::PhpToJSObject( $MESS, false ).')</script>', true);?>
	<?if(CModule::IncludeModule("aspro.mshop")) {CMShop::Start(SITE_ID);}?>
	<!--[if gte IE 9]><style type="text/css">.basket_button, .button30, .icon {filter: none;}</style><![endif]-->
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
	<meta name="yandex-verification" content="632fd588f5d956a1" />
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(24763379, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/24763379" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
	<body id="main">
	
<script>
<?
$dynx_itemid="";
$dynx_pagetype="";
$dynx_totalvalue="";
if(CSite::InDir('/catalog/')) {
 CModule::IncludeModule('iblock');
 $page = $APPLICATION->GetCurPage(false);
 $page_array=explode('/',$page);

  if($page_array[3]!=""){
	  $res = CIBlockElement::GetList( Array("SORT"=>"ASC"), Array('CODE'=>$page_array[3]), false,false,Array('ID','CATALOG_GROUP_1'));
      $ar_res = $res->GetNext();
	  $dynx_itemid='product_'.$ar_res['ID'];
	  $dynx_pagetype="offerdetail";
	  $res2 = CIBlockElement::GetList( Array("CATALOG_GROUP_1"=>"DESC"), Array('PROPERTY_CML2_LINK'=>$ar_res['ID']), false,false,Array('ID','CATALOG_GROUP_1'));
	  $ar_res2 = $res2->GetNext();
	  
	  //$dynx_totalvalue=$ar_res[''];
	  $dynx_totalvalue=CCurrencyRates::ConvertCurrency($ar_res2['CATALOG_PRICE_1'], $ar_res2['CATALOG_CURENCY_1'], "BYN");
  
?>
dataLayer = [];
dataLayer.push({
dynx_itemid: '<?=$dynx_itemid?>',
dynx_pagetype: '<?=$dynx_pagetype?>',
dynx_totalvalue: '<?=$dynx_totalvalue?>',
});
<?
   }
}?>
</script>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WDJKBB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WDJKBB');</script>
<!-- End Google Tag Manager -->
		<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		<?if(!CModule::IncludeModule("aspro.mshop")){?><center><?$APPLICATION->IncludeFile(SITE_DIR."include/error_include_module.php");?></center></body></html><?die();?><?}?>
		<?$APPLICATION->IncludeComponent("aspro:theme.mshop", ".default", array("COMPONENT_TEMPLATE" => ".default"), false);?>
		<?CMShop::SetJSOptions();?>
		<?$isFrontPage = CSite::InDir(SITE_DIR.'index.php');?>
		<?$isContactsPage = CSite::InDir(SITE_DIR.'contacts/');?>
		<?$isBasketPage=CSite::InDir(SITE_DIR.'basket/');?>
		<div class="wrapper <?=($TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU_COLOR"] != "none" ? "has_menu" : "");?> h_color_<?=$TEMPLATE_OPTIONS["HEAD"]["CURRENT_HEAD_COLOR"];?> m_color_<?=$TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU_COLOR"];?> <?=($isFrontPage ? "front_page" : "");?> basket_<?=strToLower($TEMPLATE_OPTIONS["BASKET"]["CURRENT_VALUE"]);?> head_<?=strToLower($TEMPLATE_OPTIONS["HEAD"]["CURRENT_VALUE"]);?> banner_<?=strToLower($TEMPLATE_OPTIONS["BANNER_WIDTH"]["CURRENT_VALUE"]);?>">
			<div class="header_wrap <?=strtolower($TEMPLATE_OPTIONS["HEAD_COLOR"]["CURRENT_VALUE"])?>">
				<div class="top-h-row">
					<div class="wrapper_inner">
						<div class="content_menu">
							<?$APPLICATION->IncludeComponent("bitrix:menu", "top_content_row", array(
								"ROOT_MENU_TYPE" => $TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU"],
								"MENU_CACHE_TYPE" => "Y",
								"MENU_CACHE_TIME" => "86400",
								"MENU_CACHE_USE_GROUPS" => "N",
								"MENU_CACHE_GET_VARS" => array(),
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "N",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
								),false
							);?>
						</div>
						<div class="phones">
							<span class="phone_wrap">
								<span class="icons"></span>
								<span class="phone_text">
									<?$APPLICATION->IncludeFile(SITE_DIR."include/phone.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("PHONE")));?>
								</span>
							</span>
							<span class="order_wrap_btn">
								<?if( \Bitrix\Main\Config\Option::get("aspro.mshop", "SHOW_CALLBACK", "Y") != "N"):?>
							<span class="callback_btn"><?=GetMessage("CALLBACK")?></span>
							<?endif;?>
							</span>
						</div>
						<div class="h-user-block" id="personal_block">
							<div class="form_mobile_block"><div class="search_middle_block"><?include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/search.title.catalog3.php');?></div></div>
							<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "top", array(
								"REGISTER_URL" => SITE_DIR."auth/registration/",
								"FORGOT_PASSWORD_URL" => SITE_DIR."auth/forgot-password/",
								"PROFILE_URL" => SITE_DIR."personal/",
								"SHOW_ERRORS" => "Y"
								)
							);?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<header id="header">
					<div class="wrapper_inner">	
						<table class="middle-h-row"><tr>
							<td class="logo_wrapp">
								<div class="logo">
									<?CMShop::ShowLogo();?>
								</div>
							</td>
							<td  class="center_block">
								<div class="main-nav">
									<?include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/menu.top_general_multilevel.php');?>
								</div>
								
								<div class="middle_phone">
									<div class="phones">
										<span class="phone_wrap">
											<span class="icons"></span>
											<span class="phone_text">
												<?$APPLICATION->IncludeFile(SITE_DIR."include/phone.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("PHONE")));?>
											</span>
										</span>
										<span class="order_wrap_btn">
											<?if( \Bitrix\Main\Config\Option::get("aspro.mshop", "SHOW_CALLBACK", "Y") != "N"):?>
							<span class="callback_btn"><?=GetMessage("CALLBACK")?></span>
							<?endif;?>
										</span>
									</div>
								</div>
								<div class="search">
									<?include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/search.title.catalog.php');?>
								</div>
							</td>
							<td class="basket_wrapp custom_basket_class <?=CMShop::getCurrentPageClass()?>">
								<div class="wrapp_all_icons">
										<div class="header-compare-block icon_block iblock" id="compare_line">
											<?include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/catalog.compare.list.compare_top.php');?>
										</div>
										<div class="header-cart" id="basket_line">
											<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("header-cart");?>
											<?//CSaleBasket::UpdateBasketPrices(CSaleBasket::GetBasketUserID(), SITE_ID);?>
											<?if($TEMPLATE_OPTIONS["BASKET"]["CURRENT_VALUE"] === "FLY" && !$isBasketPage && !CSite::InDir(SITE_DIR."order/")):?>
												<script>
												$(document).ready(function(){
													$.ajax({
														url: arMShopOptions["SITE_DIR"] + "ajax/basket_fly.php",
														type: "post",
														success: function(html){
															$("#basket_line").append(html);
														}
													});
												});
												</script>
											<?else:?>
												<?$APPLICATION->IncludeFile(SITE_DIR."include/basket_top.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("BASKET_TOP")));?>
											<?endif;?>
											<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("header-cart", "");?>
										</div>
									</div>
									<div class="clearfix"></div>
							</td>
						</tr></table>
					</div>
					<div class="catalog_menu">
						<div class="wrapper_inner">
							<div class="wrapper_middle_menu">
								<?include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/menu.top_catalog_multilevel.php');?>
							</div>
						</div>
					</div>
				</header>
			</div>
			<?if(!$isFrontPage):?>
				<div class="wrapper_inner">				
					<section class="middle">
						<div class="container" itemscope itemtype="http://schema.org/Product">
							<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "mshop", array(
								"START_FROM" => "0",
								"PATH" => "",
								"SITE_ID" => "-",
								"SHOW_SUBSECTIONS" => "N"
								),
								false
							);?>
                            <?$APPLICATION->ShowViewContent('catalog_detail');?>
							<h1 id="pagetitle" itemprop="name" class="<?$APPLICATION->ShowViewContent('catalog_detail_class');?>"><?=$APPLICATION->ShowTitle(false);?></h1>
                            <?$APPLICATION->ShowViewContent('brand_catalog');?>
				<?if($isContactsPage):?>
						</div>
					</section>
				</div>
				<?else:?>
							<div id="content">
							<?if(CSite::InDir(SITE_DIR.'help/') || CSite::InDir(SITE_DIR.'company/') || CSite::InDir(SITE_DIR.'info/')):?>
								<div class="left_block">
									<?$APPLICATION->IncludeComponent("bitrix:menu", "left_menu", array(
										"ROOT_MENU_TYPE" => "left",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "3600000",
										"MENU_CACHE_USE_GROUPS" => "N",
										"MENU_CACHE_GET_VARS" => "",
										"MAX_LEVEL" => "1",
										"CHILD_MENU_TYPE" => "left",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N" ),
										false, array( "ACTIVE_COMPONENT" => "Y" )
									);?>
								</div>
								<div class="right_block">
							<?endif;?>
				<?endif;?>
			<?endif;?>
								<?if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") $APPLICATION->RestartBuffer();?>