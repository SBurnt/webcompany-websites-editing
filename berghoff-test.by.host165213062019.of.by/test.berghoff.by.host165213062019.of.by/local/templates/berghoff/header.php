<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Sale;

IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");
// CJSCore::Init(array("fx"));  //"jquery", "jquery2", "moment.js", "bootstrap", "window", "core"
$curPage = $APPLICATION->GetCurPage(true);
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");

// Избранное
if ($USER->IsAuthorized()) {
  $arUser = $USER->GetByID($USER->GetID())->GetNext();
  if ($arUser["WORK_NOTES"]) $arFavorites = explode(";", $arUser["WORK_NOTES"]);
  else $arFavorites = array();
} else {
  $arUser = false;
  if (isset($_SESSION['favorites']) && is_array($_SESSION['favorites'])) $arFavorites = $_SESSION['favorites'];
  elseif ($APPLICATION->get_cookie('favorites')) $arFavorites = explode(";", $APPLICATION->get_cookie('favorites'));
  else $arFavorites = array();
}
$arRegions = [];
$rsRegions = CIBlockElement::GetList([], ["IBLOCK_ID" => "28", "ACTIVE" => "Y"], false, false, ["ID", "NAME", "CODE"]);
while ($arRegion = $rsRegions->GetNext()) {
  $arRegions[$arRegion["CODE"]] = $arRegion;
}


// Корзина
$BasketItems = array();
$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
foreach ($basket as $basketItem) {

  $BasketItems[] = $basketItem->getField('PRODUCT_ID');
  $arProduct = CIBlockElement::GetList([], ["IBLOCK_ID" => "4", "ID" => $basketItem->getField('PRODUCT_ID')], false, false, ["ID", "PREVIEW_PICTURE", "CATALOG_GROUP_1"])->GetNext();
  $miniBasket[] = [
    "ID" => $basketItem->getField('ID'),
    "NAME" => $basketItem->getField('NAME'),
    "QUANTITY" => $basketItem->getField('QUANTITY'),
    "PRODUCT_ID" => $basketItem->getField('PRODUCT_ID'),
    "DETAIL_PAGE_URL" => $basketItem->getField('DETAIL_PAGE_URL'),
    "PRICE" => $basketItem->getPrice(),
    //        "PRICE" => $basketItem->getField('PRICE'),
    "OLD_PRICE" => $arProduct["CATALOG_PRICE_1"] > $basketItem->getField('PRICE') ? $arProduct["CATALOG_PRICE_1"] : false,
    //        "OLD_PRICE" => intval($arProduct["CATALOG_PRICE_1"])>$basketItem->getField('PRICE')?intval($arProduct["CATALOG_PRICE_1"]):false,
    "PICTURE" => $arProduct["PREVIEW_PICTURE"] ? array_change_key_case(CFile::ResizeImageGet($arProduct["PREVIEW_PICTURE"], ['width' => 50, 'height' => 50], BX_RESIZE_IMAGE_PROPORTIONAL, true), CASE_UPPER) : false,
    "PROPS" => $basketItem->getPropertyCollection()->getPropertyValues(),
  ];
}
$BasketNumCount = count($BasketItems);
unset($basket);
// if($_REQUEST["bb"]) {echo "<pre>".print_r($miniBasket,1)."</pre>";die();}

// Местоположение
if ($_REQUEST["user_location"]) {
  if ($_REQUEST["user_location"] == "moscow") $LOCATION = "moscow";
  else $LOCATION = "other";
} elseif ($_SESSION['user_location']) $LOCATION = $_SESSION['user_location'];
elseif ($APPLICATION->get_cookie('user_location')) $LOCATION = $APPLICATION->get_cookie('user_location');
else {
  $SHOW_LOCATION = true;
  if (CModule::IncludeModule("altasib.geoip")) $GEO_DATA = $arDataGeoIP = ALX_GeoIP::GetAddr();
  if ($GEO_DATA["city"] == "Москва") $LOCATION = "moscow";
  else {
    $S_LAT = abs(55.754105 - $GEO_DATA["lat"]) * 111;
    $S_LON = abs(37.620479 - $GEO_DATA["lng"]) * 65;
    $M_DIST = sqrt(pow($S_LAT, 2) + pow($S_LON, 2));
    // Если расстояние до центра москвы больше 99 Км
    if ($M_DIST > 99) $LOCATION = "other";
    else $LOCATION = "moscow";
  }
}
$_SESSION['user_location'] = $LOCATION;
$APPLICATION->set_cookie("user_location", $LOCATION);
?>
<!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>" slick-uniqueid="12">

<head>
  <script>
    var headerPhone = document.querySelectorAll('.header-top-tel-link');
    var phoneOverlay = document.querySelector('#phone-drop__overlay');
    var headerPhoneDrop = document.querySelectorAll('.phone-drop');

    for (var i = 0; i < headerPhone.length; i++) {
      headerPhone[i].addEventListener('click', function() {
        this.nextElementSibling.classList.toggle('active');
        phoneOverlay.classList.add('active');
      })
    }

    phoneOverlay.addEventListener('click', function() {
      for (var i = 0; i < headerPhoneDrop.length; i++) {
        if (headerPhoneDrop[i].classList.contains('active')) {
          headerPhoneDrop[i].classList.remove('active');
          phoneOverlay.classList.remove('active');
        }
      }
    })

    $('.phone-drop__callback').click(function() {
      document.getElementById("phone-drop__overlay").click();
    })
  </script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-136894169-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-136894169-1');
  </script>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
  <title><? $APPLICATION->ShowTitle() ?></title>
  <? if (false && $APPLICATION->GetDirProperty("ydelivery")) { ?>
    <script src="https://delivery.yandex.ru/widget/loader?resource_id=52306&sid=39016&key=d01f1f84c6ffa986940d0eeeeb2dfa97"></script>
  <? } ?>
  <script type="text/javascript" data-skip-moving="true" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

  <script>
    // jQuery.noConflict();
  </script>
  <link rel="icon" href="/berghoff-favicon_1.png" type="image/x-icon">
  <link rel="shortcut icon" href="/berghoff-favicon_1.png" type="image/x-icon">
  <link href="<?= SITE_TEMPLATE_PATH ?>/_html/css/styles1.css?v=1.04" rel="stylesheet" type="text/css" media="all" />
  <link href="<?= SITE_TEMPLATE_PATH ?>/_html/css/styles.css?v=1.04" rel="stylesheet" type="text/css" media="all" />
  <link href="<?= SITE_TEMPLATE_PATH ?>/_html/css/print.css?v=1.04" rel="stylesheet" type="text/css" media="print" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <? if (!substr_count($curPage, "/grill")) { ?>
    <script src="<?= SITE_TEMPLATE_PATH ?>/_html/js/base.js?v=1.04"></script>
  <? } ?>
  <? if (CATALOG_SCRIPTS == "Y") { ?>
    <script src="<?= SITE_TEMPLATE_PATH ?>/_html/js/catalog-scripts.js?v=1.04"></script>
  <? } ?>
  <style>
    font.tablebodytext {
      display: none;
    }
  </style>

  <script type="text/javascript">
    //<![CDATA[
    optionalZipCountries = ["HK", "IE", "MO", "PA"];
    //]]>

    function countbanner(bID) {
      var url = "/local/ajax/countbanner.php?ID=" + bID;
      var xhr = new XMLHttpRequest();
      xhr.open("POST", url, true);
      xhr.send();
      return true;
    }
  </script>

  <? if (substr_count($curPage, "/grill")) {/*?>
        <script  src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <?*/
  } else {/*?>
        <script src="<?=SITE_TEMPLATE_PATH?>/_html/js/jquery.js" async></script>
    <?*/
  } ?>


  <script src="<?= SITE_TEMPLATE_PATH ?>/_html/js/jquery.cookie.js"></script>

  <script type="text/javascript">
    //<![CDATA[
    var Shopper = {};
    Shopper.url = 'https://berghoffworldwide.com/';
    Shopper.store = 'bgh_en_int';
    Shopper.category = '';
    Shopper.price_circle = 1;
    Shopper.fixed_header = 1;
    Shopper.totop = 0;
    Shopper.responsive = 1;
    Shopper.quick_view = 0;
    Shopper.shopby_num = '20';
    Shopper.text = {};
    Shopper.text.more = 'more...';
    Shopper.text.less = 'less...';
    Shopper.anystretch_bg = '';
    //]]>
  </script>
  <? if ($APPLICATION->GetDirProperty("body_onload") == "Y") { ?>
    <script type="text/javascript">
      function OnLoad() {
        let paramValue = window.location.href.split("?")[1].split("=")[1];

        document.getElementById(paramValue).checked = true;
        let scrollId = window.location.href.split("?")[1].split("=")[2];

        let scrollElement = document.getElementById(scrollId);
        let coordElement = scrollElement.getBoundingClientRect().top;
        let screenWidth = document.body.clientWidth;
        let headerFixed = document.getElementsByTagName("header")[0].clientHeight;
        let scrollEnd = 0;
        if (screenWidth > 959) {
          scrollEnd = coordElement + window.pageYOffset - headerFixed;
        } else {
          scrollEnd = coordElement + window.pageYOffset;
        }

        window.scrollTo(0, scrollEnd);

        //console.log(paramValue, scrollId, scrollElement, headerFixed, scrollEnd);

      }
    </script>
  <? } ?>
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
      j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NR46JPJ');
  </script> <!-- End Google Tag Manager -->
  <? if ($_SERVER['REQUEST_URI'] == '/info/contacts/') { ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <? } ?>
  <? $APPLICATION->ShowHead(); ?>
</head>
<script src="//code.jivosite.com/widget/enF2HJ5XE2" async></script>

<body class="<? $APPLICATION->ShowProperty("body_class") ?>" <? if ($APPLICATION->GetDirProperty("body_onload") == "Y") { ?>onload="OnLoad()" <? } ?>>
  <!-- Google Tag Manager (noscript) --> <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NR46JPJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> <!-- End Google Tag Manager (noscript) -->
  <? if ($USER->IsAdmin()) : ?>
    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
  <? endif; ?>
  <? include("banner_head.php") ?>
  <div class="wrapper">
    <noscript>
      <div class="global-site-notice noscript">
        <div class="notice-inner">
          <p>
            <strong>JavaScript seems to be disabled in your browser.</strong>
            <br />
            You must have JavaScript enabled in your browser to utilize the functionality of this website.
          </p>
        </div>
      </div>
    </noscript>

    <div class="page">
      <div id="phone-drop__overlay"></div>
      <!-- HEADER BOF -->
      <div class="header-container">
        <div class="top-switch-bg">
          <div class="row clearfix flex">
            <? $APPLICATION->IncludeComponent(
              "bitrix:menu",
              "top_menu",
              array(
                "ROOT_MENU_TYPE" => "top",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => ""
              )
            ); ?>
            <div class="grid_4 center-goriz">
              <!-- <div class="top-cms-left"></div> -->
              <div class="header-top-tel">
                <span class="header-top-tel-link">
                  <svg class="header-top-tel-link-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="18" height="18" viewBox="0 0 18 18">
                    <defs>
                      <style>
                        .header-top-tel-link-cls-1 {
                          fill: #181619;
                          fill-rule: evenodd;
                        }
                      </style>
                    </defs>
                    <path class="header-top-tel-link-cls-1" d="M16.507,17.099 C16.385,17.215 16.271,17.322 16.166,17.427 C15.784,17.810 15.172,18.002 14.402,18.002 C13.671,18.002 12.798,17.829 11.844,17.484 C9.645,16.689 7.248,15.064 5.092,12.909 C1.334,9.150 0.000,5.545 0.000,3.601 C0.000,2.820 0.198,2.210 0.574,1.835 C0.679,1.729 0.787,1.616 0.897,1.500 C1.587,0.775 2.371,-0.047 3.430,-0.002 C4.162,0.028 4.865,0.474 5.577,1.360 C7.678,3.974 6.680,4.957 5.625,5.998 L5.435,6.186 C5.257,6.364 5.406,6.864 5.836,7.524 C6.271,8.194 6.993,9.034 7.980,10.021 C11.081,13.122 11.749,12.632 11.816,12.566 L12.002,12.378 C13.043,11.321 14.026,10.322 16.640,12.425 C17.526,13.137 17.972,13.839 18.003,14.572 C18.043,15.637 17.227,16.414 16.507,17.099 ZM12.423,13.172 C11.585,14.010 10.027,13.249 7.525,10.779 L7.525,10.780 L7.373,10.628 L7.222,10.476 L7.222,10.476 C6.268,9.510 5.560,8.675 5.116,7.992 C4.410,6.906 4.313,6.094 4.829,5.579 L5.021,5.388 C5.562,4.855 5.953,4.470 5.953,3.930 C5.953,3.430 5.621,2.784 4.908,1.898 C4.360,1.216 3.865,0.875 3.394,0.855 C3.381,0.855 3.367,0.854 3.353,0.854 C2.695,0.854 2.071,1.511 1.519,2.091 C1.402,2.215 1.290,2.332 1.180,2.441 C0.118,3.505 1.378,7.980 5.699,12.302 C10.022,16.624 14.497,17.884 15.560,16.821 C15.670,16.711 15.788,16.598 15.909,16.483 C16.500,15.921 17.169,15.285 17.145,14.606 C17.126,14.137 16.785,13.642 16.103,13.094 C14.093,11.478 13.598,11.980 12.613,12.980 L12.423,13.172 Z" />
                  </svg>
                  <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/telephone.php"), false); ?>
                  <!--                                    +375 29<span class="header-top-tel-link__bold"> 612 44 00</span>-->
                  <svg class="header-top__arrow" width="6" height="3" viewBox="0 0 6 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 3L5.59808 0H0.401924L3 3Z" fill="#333333" />
                  </svg>
                  <!----><? //=CNLSMainSettings::GetSiteSetting('nls_phone')
                          ?>
                </span>
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "vidjet", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/Vidjet.php"), false); ?>
              </div>
            </div>
            <style>
              .top-drop-company {
                right: 100px;
              }

              @media only screen and (max-width:959px) {
                .top-drop-company {
                  right: 0px;
                }
              }

              /*@media only screen and (min-width:1025px) and (max-width:1280px) {*/
              /*.top-drop-company {top:0; right:260px;}*/
              /*							}*/
            </style>
            <div class="grid_4 grid-fix">
              <div class="top-dropdowns top-drop-company">
                <div class="cart-top-title">
                  <a href="/personal/cart/" class="clearfix">
                    <span class="icon"></span>
                    Корзина
                  </a>
                </div>

                <a class="favorites-top js-favorites-top" href="/catalog/favorites/">
                  <svg class="favorites-top-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" viewBox="0 0 17 16">
                    <defs>
                      <style>
                        .heart-icon-cls-2 {
                          fill: #000;
                          fill-rule: evenodd;
                        }
                      </style>
                    </defs>
                    <path d="M8.811,15.862 L8.500,16.000 L8.189,15.862 C4.197,13.390 -0.000,7.762 -0.000,4.637 C0.013,2.078 2.088,-0.000 4.636,-0.000 C6.247,-0.000 7.669,0.830 8.500,2.087 C9.331,0.830 10.753,-0.000 12.364,-0.000 C14.912,-0.000 16.986,2.078 17.000,4.637 C17.000,7.762 12.803,13.390 8.811,15.862 ZM12.364,0.777 C11.068,0.777 9.864,1.427 9.143,2.518 L8.500,3.490 L7.857,2.517 C7.136,1.427 5.932,0.777 4.636,0.777 C2.518,0.777 0.784,2.510 0.773,4.637 C0.773,7.394 4.727,12.758 8.500,15.142 C12.273,12.758 16.227,7.394 16.227,4.641 C16.216,2.510 14.482,0.777 12.364,0.777 Z" class="heart-icon-cls-2" />
                  </svg>

                  <span class="favorites-top-title">Favorites</span> (<?= count($arFavorites) ?>)
                </a>

                <? $welcomePage = \Ceteralabs\UserVars::GetVar('BASKET_OFF');
                if ($welcomePage["VALUE"] != "Y") {
                ?>
                  <div class="cart-top-container js-cart-top">
                    <div class="cart-top">
                      <a class="summary" href="/personal/cart/">
                        <span>
                          <span>Корзина</span> (<?= $BasketNumCount ?>)
                        </span>
                      </a>
                    </div>

                    <? if (HIDE_MINICART != "Y") {
                    ?>
                      <div class="details">
                        <div class="details-border"></div>
                        <?
                        if ($miniBasket) {
                        ?>
                          <ol id="cart-sidebar" class="mini-products-list">
                            <?
                            $totalPrice = 0;
                            $totalPromoDiscount = 0;
                            $totalCardDiscount = 0;
                            $totalCardSumm = 0;
                            $totalSummDisc = 0;
                            foreach ($miniBasket as $bItem) {
                              $totalPrice += $bItem["QUANTITY"] * $bItem["PRICE"];
                              if ($bItem["PROPS"]["PROMO_DISC"]["VALUE"]) $totalPromoDiscount += round($bItem["QUANTITY"] * $bItem["PRICE"] * $bItem["PROPS"]["PROMO_DISC"]["VALUE"] / 100);
                              if ($bItem["PROPS"]["PROMO_SUMM"]["VALUE"]) $totalPromoDiscount += $bItem["PROPS"]["PROMO_SUMM"]["VALUE"];
                              if ($bItem["PROPS"]["SUMM_DISCOUNT"]["VALUE"]) $totalSummDisc += round($bItem["QUANTITY"] * $bItem["PRICE"] * $bItem["PROPS"]["SUMM_DISCOUNT"]["VALUE"] / 100);
                              if ($bItem["PROPS"]["DCART_DISC"]["VALUE"]) $totalCardDiscount += round($bItem["QUANTITY"] * $bItem["PRICE"] * $bItem["PROPS"]["DCART_DISC"]["VALUE"] / 100);
                              if ($bItem["PROPS"]["DCART_SUMM"]["VALUE"]) $totalCardSumm += $bItem["PROPS"]["DCART_SUMM"]["VALUE"];
                            ?>
                              <li class="item clearfix">
                                <a href="<?= $bItem["DETAIL_PAGE_URL"] ?>" title="<?= $bItem["NAME"] ?>" class="product-image">
                                  <?
                                  if ($bItem["PICTURE"]) ?>
                                  <img src="<?= $bItem["PICTURE"]["SRC"] ?>" data-srcx2="<?= $bItem["PICTURE"]["SRC"] ?>" width="50" height="50" alt="<?= $bItem["NAME"] ?>">
                                  <span></span>
                                </a>
                                <div class="product-details">
                                  <a href="/personal/cart/?action=delete&id=<?= $bItem["ID"] ?>" title="Remove This Item" onclick="return confirm('Вы уверены, что хотите удалить этот товар из корзины?');" class="btn-remove">Удалить</a>
                                  <p class="product-name"><a href="<?= $bItem["DETAIL_PAGE_URL"] ?>"><?= $bItem["NAME"] ?></a>
                                  </p>
                                  <strong><?= floatval($bItem["QUANTITY"]) ?></strong>
                                  x&nbsp;<span class="price"> <?= str_replace(".", ",", $bItem["PRICE"]) ?> р.<?
                                                                                                            if ($bItem["OLD_PRICE"]) {
                                                                                                            ?> <span class="old-price"><?= str_replace(".", ",", $bItem["OLD_PRICE"]) ?>
                                      р.</span><?
                                                                                                            } ?></span>
                                </div>
                              </li>
                            <?
                            } ?>
                          </ol>
                          <?
                          if ($totalPromoDiscount || $totalCardDiscount || $totalCardSumm || $totalSummDisc) {
                          ?>
                            <div class="subtotal-wrapper">
                              <div class="subtotal">
                                <div class="freeshippingmessage">
                                  <?
                                  if ($totalCardDiscount) {
                                  ?><span>
                                      Скидка по дисконтной карте <?= $totalCardDiscount ?> р.</span><?
                                                                                                  } ?>
                                  <?
                                  if ($totalPromoDiscount) {
                                  ?><span>
                                      Скидка по промокоду <?= $totalPromoDiscount ?> р.</span><?
                                                                                            } ?>
                                  <?
                                  if ($totalCardSumm) {
                                  ?><span>
                                      Списано с предоплаченной карты <?= $totalCardSumm ?> р.</span><?
                                                                                                  } ?>
                                  <?
                                  if ($totalSummDisc) {
                                  ?><span>Скидка За количество товаров в корзине <?= $totalSummDisc ?> р.</span><?
                                                                                                                                                } ?>
                                </div>
                              </div>
                            </div>
                          <?
                          } ?>
                          <div class="buttons clearfix">
                            <button type="button" title="View Cart" class="button btn-continue" onclick="window.location='/personal/cart/';">
                              <span><span>Корзина</span></span>
                            </button>
                          </div>
                          <div class="totals-wrapper">
                            <span class="label">Итого</span> <span class="price"><?= str_replace(".", ",", $totalPrice) ?> р.</span>
                          </div>
                        <?
                        } else {
                        ?>
                          <p class="a-center">Ваша корзина пуста.</p>
                        <?
                        } ?>
                      </div>

                    <?
                    } ?>
                  </div><?
                      } ?>

                <!-- cart EOF -->
                <div class="compare-top-title">
                  <a href="#" class="clearfix" onclick="popWin('https://berghoffworldwide.com/bgh_en_int/catalog/product_compare/index/uenc/aHR0cHM6Ly9iZXJnaG9mZndvcmxkd2lkZS5jb20vYmdoX2VuX2ludC8,/','compare','top:0,left:0,width=820,height=600,resizable=yes,scrollbars=yes')">
                    <span class="icon"></span>
                    Compare
                  </a>
                </div>

                <div class="compare-top-container">
                  <div class="compare-top">
                    <a class="summary" href="#" onclick="popWin('https://berghoffworldwide.com/bgh_en_int/catalog/product_compare/index/uenc/aHR0cHM6Ly9iZXJnaG9mZndvcmxkd2lkZS5jb20vYmdoX2VuX2ludC8,/','compare','top:0,left:0,width=820,height=600,resizable=yes,scrollbars=yes')"></a>
                  </div>

                  <div class="details">
                    <div class="details-border"></div>
                    <p class="empty">You have no items to compare.</p>
                  </div>
                </div>

                <div class="search-top-container">
                  <div class="search-top"></div>
                  <div class="search-form">
                    <div class="search-form-border"></div>
                    <div class="search-top-title">
                      <span class="icon"></span>
                      Search
                    </div>

                    <form id="search_mini_form" action="/catalog/search/" method="get">
                      <div class="form-search">
                        <input id="search" type="text" name="q" value="" class="input-text" placeholder="Что вы хотите найти?">
                        <button type="submit" title="Search"></button>
                      </div>

                      <div id="search_autocomplete" class="search-autocomplete"></div>
                    </form>
                  </div>
                </div>

                <div class="clear"></div>
              </div>
              <!-- LANGUAGES BOF -->
              <!--<div class="header-switch language-switch">
                                <span>
                                    <span class="current">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/_html/img/Russia.png" alt="current">
                                        <?= $arRegions[$LOCATION]["NAME"] ?>
                                    </span>
                                </span>

                                <div class="header-dropdown site-switcher">
                                    <div class="site-switcher-label">Выберите регион</div>

                                    <div class="site-switcher-primary-items">
                                        <div class="site-switcher-primary-item active"><?= $arRegions[$LOCATION]["NAME"] ?></div>
                                        <? foreach ($arRegions as $region) {
                                          if ($region["CODE"] == $LOCATION) continue;
                                        ?>
                                          <a class="site-switcher-primary-item" href="?user_location=<?= $region["CODE"] ?>"><?= $region["NAME"] ?></a>
                                        <? } ?>
                                    </div>

                                    <? include("include/countries.php") ?>

                                </div>
                            </div>-->

              <? // include("include/language-select.php")
              ?>

              <div class="top-cms-right">
                <div class="drop-nav">
                  <ul>
                    <? if ($USER->IsAuthorized()) { ?>
                      <li>
                        <a href="/personal/profile/"><span>Аккаунт</span></a>
                        <ul>
                          <li><a href="/personal/profile/"><span>Личные данные</span></a></li>
                          <li><a href="/personal/orders/"><span>Мои заказы</span></a></li>
                          <li><a href="/personal/address/"><span>Мои адреса</span></a></li>
                          <li><a href="/personal/subscription/"><span>Рассылки</span></a></li>
                          <li><a href="?logout=yes"><span>Выйти</span></a></li>
                        </ul>
                      </li>
                    <? } else { ?>
                      <li><a href="/login/"><span>Войти</span></a></li>
                    <? } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="header-wrapper">
          <header>
            <div class="row clearfix">
              <div class="grid_12 header-bottom-wrapper">
                <? if (false && $curPage == SITE_DIR . "index.php") { ?>
                  <h1 style="display: none"><? $APPLICATION->ShowTitle() ?></h1>
                <? } else { ?>
                  <h1 class="logo">
                    <strong>BergHOFF Worldwide</strong>

                    <a href="/" title="BergHOFF Worldwide" class="logo">
                      <div>
                        <img class="retina" src="<?= SITE_TEMPLATE_PATH ?>/_html/img/logo-berghoff.svg" alt="BergHOFF Logo" />
                      </div>
                    </a>
                    <div class="header-top-tel header-top-tel_mobile">
                      <span class="header-top-tel-link">
                        <svg class="header-top-tel-link-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="18" height="18" viewBox="0 0 18 18">
                          <defs>
                            <style>
                              .header-top-tel-link-cls-1 {
                                fill: #181619;
                                fill-rule: evenodd;
                              }
                            </style>
                          </defs>
                          <path class="header-top-tel-link-cls-1" d="M16.507,17.099 C16.385,17.215 16.271,17.322 16.166,17.427 C15.784,17.810 15.172,18.002 14.402,18.002 C13.671,18.002 12.798,17.829 11.844,17.484 C9.645,16.689 7.248,15.064 5.092,12.909 C1.334,9.150 0.000,5.545 0.000,3.601 C0.000,2.820 0.198,2.210 0.574,1.835 C0.679,1.729 0.787,1.616 0.897,1.500 C1.587,0.775 2.371,-0.047 3.430,-0.002 C4.162,0.028 4.865,0.474 5.577,1.360 C7.678,3.974 6.680,4.957 5.625,5.998 L5.435,6.186 C5.257,6.364 5.406,6.864 5.836,7.524 C6.271,8.194 6.993,9.034 7.980,10.021 C11.081,13.122 11.749,12.632 11.816,12.566 L12.002,12.378 C13.043,11.321 14.026,10.322 16.640,12.425 C17.526,13.137 17.972,13.839 18.003,14.572 C18.043,15.637 17.227,16.414 16.507,17.099 ZM12.423,13.172 C11.585,14.010 10.027,13.249 7.525,10.779 L7.525,10.780 L7.373,10.628 L7.222,10.476 L7.222,10.476 C6.268,9.510 5.560,8.675 5.116,7.992 C4.410,6.906 4.313,6.094 4.829,5.579 L5.021,5.388 C5.562,4.855 5.953,4.470 5.953,3.930 C5.953,3.430 5.621,2.784 4.908,1.898 C4.360,1.216 3.865,0.875 3.394,0.855 C3.381,0.855 3.367,0.854 3.353,0.854 C2.695,0.854 2.071,1.511 1.519,2.091 C1.402,2.215 1.290,2.332 1.180,2.441 C0.118,3.505 1.378,7.980 5.699,12.302 C10.022,16.624 14.497,17.884 15.560,16.821 C15.670,16.711 15.788,16.598 15.909,16.483 C16.500,15.921 17.169,15.285 17.145,14.606 C17.126,14.137 16.785,13.642 16.103,13.094 C14.093,11.478 13.598,11.980 12.613,12.980 L12.423,13.172 Z" />
                        </svg>
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/telephone.php"), false); ?>
                        <svg class="header-top__arrow" width="6" height="3" viewBox="0 0 6 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M3 3L5.59808 0H0.401924L3 3Z" fill="#333333" />
                        </svg>
                      </span>
                      <? $APPLICATION->IncludeComponent("bitrix:main.include", "vidjet_mob", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/Vidjet_mob.php"), false); ?>
                    </div>
                  </h1>
                <? } ?>

                <div class="nav-container-wrapper">
                  <div class="nav-container">
                    <div class="nav-top-title">
                      <div class="icon">
                        <span></span>
                        <span></span>
                        <span></span>
                      </div>

                      <a href="#">Категории</a>
                    </div>

                    <?
                    // Проверим, есть ли акционные товары
                    $rsDiscount = CIBlockElement::GetList([], ["IBLOCK_ID" => "4", "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "!PROPERTY_DISCOUNT" => false], false, false, ["ID"]);
                    $Discount = $rsDiscount->SelectedRowsCount();
                    ?>
                    <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"berghoff_main_menu", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"DISCOUNTER" => $Discount,
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "berghoff_main_menu",
		"COMPOSITE_FRAME_MODE" => "N",
		"COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITHOUT_STUB"
	),
	false
); ?>
                  </div>





                </div>
              </div>
            </div>
          </header>
        </div>
        <? include("include/notification.php") ?>
      </div>
      <!-- HEADER EOF -->

      <? if ($curPage == SITE_DIR . "index.php") { ?>
        <? include("include/slider.php") ?>
      <? } ?>

      <div class="main-container <? $APPLICATION->ShowProperty("container_class") ?>">
        <div class="main <? $APPLICATION->ShowProperty("main_class") ?>">
          <? if ($curPage != SITE_DIR . "index.php" && $APPLICATION->GetProperty("hide_breadcrumbs") != true && MAIN_PAGE != "Y") {
            $APPLICATION->IncludeComponent(
              "bitrix:breadcrumb",
              "berghoff_crumb",
              array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "-"
              ),
              false,
              array('HIDE_ICONS' => 'Y')
            );
          } ?>
          <? $APPLICATION->IncludeComponent(
            "bitrix:main.feedback",
            "feedback_vidjet",
            array(
              "COMPOSITE_FRAME_MODE" => "A",  // Голосование шаблона компонента по умолчанию
              "COMPOSITE_FRAME_TYPE" => "AUTO",  // Содержимое компонента
              "EMAIL_TO" => "order@berghoff.by",  // E-mail, на который будет отправлено письмо
              "EVENT_MESSAGE_ID" => array(  // Почтовые шаблоны для отправки письма
                0 => "7",
              ),
              "OK_TEXT" => "Спасибо, ваше сообщение принято.",  // Сообщение, выводимое пользователю после отправки
              "REQUIRED_FIELDS" => array(  // Обязательные поля для заполнения
                0 => "NAME",
                1 => "PHONE",
              ),
              "USE_CAPTCHA" => "N",
            ),
            false
          ); ?>