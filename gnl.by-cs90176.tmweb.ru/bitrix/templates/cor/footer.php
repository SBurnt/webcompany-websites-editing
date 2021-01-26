<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
IncludeTemplateLangFile(__FILE__);

// corp options
$blackMode = ARCorp::getSettings('blackMode', 'N' );
$headType = ARCorp::getSettings('headType', 'type1');
$filterType = ARCorp::getSettings('filterType', 'ftype0');
$sidebarPos = ARCorp::getSettings('sidebarPos', 'pos1');
global $IS_CATALOG, $IS_CATALOG_SECTION;

// is main page
$IS_MAIN = false;
if( $APPLICATION->GetCurPage(true)==SITE_DIR.'index.php' )
  $IS_MAIN = true;

// hide sidebar
$HIDE_SIDEBAR = false;
if($APPLICATION->GetProperty('hidesidebar')=='Y' || $IS_MAIN)
  $HIDE_SIDEBAR = true;
$SHOW_RIGHT_SIDEBAR = false;
if($APPLICATION->GetProperty('showrightsidebar')=='Y')
  $SHOW_RIGHT_SIDEBAR = true;
if($headType=='type3' || ($IS_CATALOG && $IS_CATALOG_SECTION && $filterType=='ftype1')) { $HIDE_SIDEBAR = false; }
if(defined('ERROR_404') && ERROR_404=='Y') { $HIDE_SIDEBAR = true; }

if($HIDE_SIDEBAR):?>
<script>
  $('.maincontent').removeClass('col-md-9 col-md-push-3').addClass('col-md-12');
</script>
<?else:?>
<?if($SHOW_RIGHT_SIDEBAR):?>
<script>
  $('.maincontent').removeClass('col-md-9 col-md-push-3').addClass('col-md-9');
</script>
<div class="row">
  <?if(!CSite::InDir('/info/') && !CSite::InDir('/proektirovshchikam/')):?>
  <div class="col-md-12 text-center to-top">
    <a><img src="/bitrix/templates/cor/img/up.png" alt="Вверх"></a>
  </div>
  <?endif;?>
</div>
</div>
<div id="sidebar" class="col col-md-3">
  <div class="grey-wrapper social-wrapper ask-wrapper">
    <?//$APPLICATION->IncludeFile(SITE_DIR."include_areas/sidebar/social.php",array("HEAD_TYPE"=>$headType),array("MODE"=>"html"));?>
    <?$APPLICATION->IncludeFile(SITE_DIR."include_areas/sidebar/ask.php",array("HEAD_TYPE"=>$headType),array("MODE"=>"html"));?>
  </div>
  <div class="grey-wrapper social-wrapper share-wrapper">
    <?$APPLICATION->IncludeFile(SITE_DIR."include_areas/sidebar/share.php",array("HEAD_TYPE"=>$headType),array("MODE"=>"html"));?>
  </div>
</div>
<?else:?>
</div>
<div id="sidebar" class="col col-md-3<?= ($sidebarPos == 'pos1' ? ' col-md-pull-9' : '') ?>">
  <?$APPLICATION->IncludeComponent(
  "bitrix:menu", 
  "catlog_sidebar_menu", 
  array(
    "ALLOW_MULTI_SELECT" => "N",
    "CATALOG_PATH" => "/catalog/",
    "CHILD_MENU_TYPE" => "topsub",
    "CONVERT_CURRENCY" => "N",
    "DELAY" => "N",
    "IBLOCK_ID" => "",
    "MAX_ITEM" => "9",
    "MAX_LEVEL" => "4",
    "MENU_CACHE_GET_VARS" => array(
    ),
    "MENU_CACHE_TIME" => "360000000",
    "MENU_CACHE_TYPE" => "A",
    "MENU_CACHE_USE_GROUPS" => "Y",
    "OFFERS_FIELD_CODE" => array(
      0 => "",
      1 => "",
    ),
    "OFFERS_PROPERTY_CODE" => array(
      0 => "",
      1 => "",
    ),
    "PRICE_CODE" => "",
    "PRICE_VAT_INCLUDE" => "N",
    "PRODUCT_QUANTITY_VARIABLE" => "quan",
    "ROOT_MENU_TYPE" => "topsub",
    "USE_EXT" => "Y",
    "USE_PRODUCT_QUANTITY" => "N",
    "COMPONENT_TEMPLATE" => "catlog_sidebar_menu"
  ),
  false
);?>
  <div class="hidden-xs hidden-sm">
    <?$APPLICATION->IncludeFile(SITE_DIR."include_areas/sidebar/menu.php",array("HEAD_TYPE"=>$headType),array("MODE"=>"html"));?>
  </div>

  <?$APPLICATION->ShowViewContent('smartfilter');?>

  <div class="hidden-xs hidden-sm">
    <?//$APPLICATION->IncludeFile(SITE_DIR."include_areas/sidebar/widgets.php",array(),array("MODE"=>"html"));?>
    <?$APPLICATION->IncludeFile(SITE_DIR."include_areas/sidebar/text.php",array(),array("MODE"=>"html"));?>
  </div>
  <?endif;?>
  <?endif;?>

</div><!-- /col -->
</div><!-- /row -->

</div><!-- /container -->

<div class="footer_copyright">
  <div class="container">
    <div class="row">
      <div class="footer__wrap">
        <span class="bottom-slogan">
          <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer/bottom-slogan.php"), false);?>
        </span>
        <ul class="payments__list">
          <li class="payments__item"><img src="/bitrix/images/logo-payments/webpay.png" alt="webpay" class="payments__img"></li>
          <li class="payments__item"><img src="/bitrix/images/logo-payments/belcartInet.png" alt="belcartInet" class="payments__img"></li>
          <li class="payments__item"><img src="/bitrix/images/logo-payments/visaVerified.png" alt="visa Verified by" class="payments__img"></li>
          <li class="payments__item"><img src="/bitrix/images/logo-payments/mastercard.png" alt="mastercard" class="payments__img"></li>
          <li class="payments__item"><img src="/bitrix/images/logo-payments/belcart2.png" alt="belcart" class="payments__img"></li>
          <li class="payments__item"><img src="/bitrix/images/logo-payments/visa.png" alt="visa" class="payments__img"></li>
        </ul>
        <div class="footer__info">
          <p class="footer__info-text"><span>Юридический адрес:</span> Беларусь, 220024, пром. узел Колядичи, г. Минск, ул. Бабушкина, 62, этаж&nbsp;4</p>
          <p class="footer__info-text"><span>Регистрационный номер в&nbsp;торговом реестре Республики Беларусь:</span> 499421 от&nbsp;23.12.2020</p>
          <p class="footer__info-text"><span>Свидетельство &#8470;&nbsp;100095087</span>, выдано Мингорисполкомом&nbsp;30.12.2013</p>
          <p class="footer__info-text">Торговое унитарное предприятие «Белкоопвнешторг Белкоопсоюза»</p>
          <p class="footer__info-text">УНП 100095087</p>
          <p class="footer__info-text">© 2017-2021 GNL</p>
        </div>
      </div>


      <!-- <div class="col col-lg-9 col-md-8 col-xs-7 all_rights-wrapper">
        <span class="all_rights">
          <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer/law.php"), false);?>
        </span>
        <span class="bottom-slogan">
          <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer/bottom-slogan.php"), false);?>
        </span>
      </div> -->
      <!-- <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer/bottom-webpay.php"), false);?> -->

      <!-- <div class="col col-lg-3 col-md-4 alright">
        <span id="bx-composite-banner">
          <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer/bottom-info.php"), false);?>
        </span>
      </div> -->
      <?/*$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer/bottom-slogan.php"), false);*/?>
      <!-- <div class="col col-lg-3 col-md-4 col-xs-5 alright"><span class="alfa_title"><?= GetMessage('AR.CORP.COPYRIGHT') ?></span></div> -->
    </div>
  </div>
</div>

</div><!-- wrapper -->

<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer/widget_settings.php"), false);?>

<?$APPLICATION->IncludeFile(SITE_DIR."include_areas/body_end.php",array(),array("MODE"=>"html"));?>

<div id="fixedcomparelist">
  <?$APPLICATION->IncludeComponent(
  "bitrix:catalog.compare.list", 
  "session", 
  array(
    "IBLOCK_TYPE" => "catalog",
    "IBLOCK_ID" => "11",
    "NAME" => "CATALOG_COMPARE_LIST",
    "COMPONENT_TEMPLATE" => "session",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N",
    "AJAX_OPTION_ADDITIONAL" => "",
    "DETAIL_URL" => "",
    "COMPARE_URL" => "compare.php",
    "ACTION_VARIABLE" => "action",
    "PRODUCT_ID_VARIABLE" => "id"
  ),
  false
);?>
</div>
<?$APPLICATION->IncludeComponent(
    "arcorp:forms",
    "disabled_ext_fields_monk",
    Array(
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AR_CORP_EXT_FIELDS_COUNT" => "1",
        "AR_CORP_FIELD_0_NAME" => "Товар",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "EMAIL_TO" => "gnlfurs@mail.ru",
        "EVENT_TYPE" => "AR_CORP_BUY",
        "FORM_DESCRIPTION" => "",
        "FORM_TITLE" => "",
        "MESSAGE_AGREE" => "Спасибо, ваша заявка принята!",
        "REQUIRED_FIELDS" => array("RS_NAME","RS_PHONE","RS_EMAIL"),
        "SHOW_FIELDS" => array("RS_NAME","RS_PHONE","RS_EMAIL","RS_TEXTAREA"),
        "USE_CAPTCHA" => "N"
    )
);?>
<?if($_GET['succ'] == 'ok'){?>
<script>
  var url = document.location.pathname.split('?');
  window.history.pushState({}, document.title, "" + url[0]);
  setTimeout(function() {
    $('.modal-fast-wrap').fancybox({
      margin: 0,
      padding: [14, 35, 30, 35],
      maxWidth: 350,
      height: 'auto',
      // autoSize: false,
      autoScale: true,
      wrapCSS: 'modal-fast',
      transitionIn: 'none',
      transitionOut: 'none',
      type: 'inline',
      helpers: {
        overlay: {
          locked: false,
        },
      },
      beforeShow: function() {
        var $element = $(this.element);
        if ($element.data('insertdata') != '' && typeof $element.data('insertdata') == 'object') {
          setTimeout(function() {
            var obj = $element.data('insertdata');
            for (fieldName in obj) {
              $('.fancybox-inner')
                .find('[name="' + fieldName + '"]')
                .val(obj[fieldName]);
            }
          }, 50);
        }
        $(document).trigger('ARCORP_fancyBeforeShow');
      }
    }).trigger('click');
  }, 1000);
</script>

<?}?>
<div id="modal-fast-wrap1" style="display: none;">
  <form class="modal-fast__wrap" action="" method="post">
    <div class="modal-fast__title">Быстрый заказ</div>
    <label class="modal-fast__label-contacts error">
      <input class="modal-fast__input-contacts" type="text" name="name" onkeyup="this.setAttribute('value', this.value);" required="" value="">
      <span class="modal-fast__title-contact">Ваше имя <span>*</span></span>
      <span class="modal-fast__error">Обязательное поле</span>
    </label>
    <label class="modal-fast__label-contacts">
      <input class="modal-fast__input-contacts" type="tel" inputmode="tel" name="tel" onkeyup="this.setAttribute('value', this.value);" placeholder="+375 (__) ___ -__-__" required="" value="">
      <span class="modal-fast__title-contact phone">Телефон <span>*</span></span>
      <span class="modal-fast__error">Обязательное поле</span>
    </label>
    <label class="modal-fast__label-contacts">
      <input class="modal-fast__input-contacts" type="email" name="email" onkeyup="this.setAttribute('value', this.value);" required="" value="">
      <span class="modal-fast__title-contact">Ваш e-mail <span>*</span></span>
      <span class="modal-fast__error">Обязательное поле</span>
    </label>
    <label class="modal-fast__label-contacts">
      <textarea class="modal-fast__input-contacts comment" name="comment" onkeyup="this.setAttribute('value', this.value);" value="" style="resize: none;"></textarea>
      <span class="modal-fast__title-contact">Комментарий к заказу <span>*</span></span>
    </label>
    <button class="modal-fast__btn-send" type="submit">Отправить</button>
  </form>
</div>

<div id="modal-size-table" style="display: none;">
  <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/footer/size_table.php"
        )
    );?>

</div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
  (function(d, w, c) {
    (w[c] = w[c] || []).push(function() {
      try {
        w.yaCounter47174787 = new Ya.Metrika({
          id: 47174787,
          clickmap: true,
          trackLinks: true,
          accurateTrackBounce: true,
          webvisor: true
        });
      } catch (e) {}
    });

    var n = d.getElementsByTagName("script")[0],
      s = d.createElement("script"),
      f = function() {
        n.parentNode.insertBefore(s, n);
      };
    s.type = "text/javascript";
    s.async = true;
    s.src = "https://mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
      d.addEventListener("DOMContentLoaded", f, false);
    } else {
      f();
    }
  })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
  <div><img src="https://mc.yandex.ru/watch/47174787" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111730821-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-111730821-1');
</script>


</body>

</html>