<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;
IncludeTemplateLangFile(__FILE__);
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "template_pays_list",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_NOTES" => "",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("", ""),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "1",
        "IBLOCK_TYPE" => "content",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "7",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("URL", ""),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "ID",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    )
);?>
<!--- footer --->
<div id="footer">
    <div class="wrapper">
        <div class="footer main_flex flex__align-items_start flex__jcontent_between">

            <div class="flex__block">
                <div class="footer__logo">
                    <a <?=(CSite::InDir('/index.php') ? '' : 'href="/"')?>>
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/logo.png" alt="logo" class="logo">
                    </a>
                    <h4 class="bdi">
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
                    </h4>
                    <p class="rg footer__logo--p">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH."/include/footer-text.php"
                            )
                        );?>
                    </p>
                    <div class="div">
                        <p class="rg">Разработка сайта — <span>Polar Bear Web Studio</span></p>
                    </div>
                </div>
            </div>

            <div class="flex__block flex__1">
                <div class="flex main_flex flex__align-items_start flex__jcontent_between">
                    <div class="footer__title">
                        <p class="rg">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => SITE_TEMPLATE_PATH."/include/footer-text.php"
                                )
                            );?>
                        </p>
                    </div>
                    <div class="footer__contact">
                        <p class="rg ft"><a href="/contacts/">Контактная информация</a></p>
                        <div class="footer__phones">
                            <div class="rg">
                                <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/phone-call.svg">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/footer-phone-1.php"
                                    )
                                );?>
                            </div>
                            <div class="rg">
                                <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/logo_velcom_grey.svg">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/footer-phone-2.php"
                                    )
                                );?>
                            </div>
                            <div class="rg">
                                <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/logo_viber_grey.svg">
                                <img class="icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/logo_whatsapp_grey.svg">
                                <img class="icon last" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/logo_mts_grey.svg">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/footer-phone-3.php"
                                    )
                                );?>
                            </div>
                            <div class="rg small">
                                <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/maps-and-flags.svg">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/footer-location.php"
                                    )
                                );?>
                            </div>
                            <div class="rg sml">
                                <img class="svg icon" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/wall-clock.svg">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/footer-worktime-1.php"
                                    )
                                );?>
                            </div>
                            <div class="rg sml">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/footer-worktime-2.php"
                                    )
                                );?>
                            </div>
                            <div class="rg sml">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => SITE_TEMPLATE_PATH."/include/footer-worktime-3.php"
                                    )
                                );?>
                            </div>
                        </div>
                    </div>

                    <div class="footer__company flex__1">
                        <p class="rg ft"><a href="/about/">О компании</a></p>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "template_main_menu_footer",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "footer1",
                                "USE_EXT" => "N"
                            )
                        );?>
                    </div>
                    <div class="footer__service flex__1">
                        <p class="rg ft"><a href="/services/">Сервис</a></p>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "template_main_menu_footer",
                                Array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "left",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "1",
                                    "MENU_CACHE_GET_VARS" => array(""),
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "footer2",
                                    "USE_EXT" => "N"
                                )
                            );?>
                    </div>
                    <div class="footer__acii flex__1">
                        <p class="rg ft"><a href="/actions/">Акции</a></p>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "template_main_menu_footer",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "footer3",
                                "USE_EXT" => "N"
                            )
                        );?>
                    </div>
                </div>
<!--                <div class="div div1">-->
<!--                    <p class="rg">Разработка сайта — <a href="#">Polar Bear Web Studio</a></p>-->
<!--                </div>-->
            </div>

        </div>
    </div>
</div>
<!--- end footer --->
<div class="modal-window web-modal" id="no_avalaible"></div>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.auth.form",
    "auth",
    Array(
        "AUTH_FORGOT_PASSWORD_URL" => "",
        "AUTH_REGISTER_URL" => "/auth/register/",
        "AUTH_SUCCESS_URL" => "/personal/"
    )
);?>
<div class="modal-window" id="avalaible-modal">
    <div class="overlay"></div>
    <div class="wrapper">
        <div class="modal modal-review">
            <div class="close main_flex flex__align-items_center flex__jcontent_center">
                <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/cancel.svg" width="22">
            </div>
            <p class="web-title">
                Товар успешно<br> добавлен в корзину!
            </p>
            <div class="buttons">
                <a href="#" class="avalaible hidden">
                    ПРОДОЛЖИТЬ ПОКУПКИ
                </a>
                <a href="/personal/cart/" class="avalaible">
                    ПЕРЕЙТИ В КОРЗИНУ
                </a>
            </div>
        </div>
    </div>
</div>
<script>
function ajax(i) {
        var id = $(i).attr('data-id');
        var lvl = $(i).attr('data-lvl');
        var value = $(i).attr('data-value');
        var what = $(i).attr('data-what');
        console.log('test');
        $.ajax({
            type: 'POST',
            url: '<?=SITE_DIR?>ajax/avto_marka.php',
            data: {id: id, lvl: lvl, value: value, what: what},
            success: function(data) {
                if(lvl==1){
                    $('.lvl2').html(data);
					if(id!=-1){
					$('#lll_21').hide();
					$('#lll_22').show();
					$('#lll_31').show();
					$('#lll_32').hide();
					
                    $('.lvl2_span').text('Модель');
                    $('.lvl3_span').text('Год');
					} else {
					$('#lll_21').show();
					$('#lll_22').hide();
					$('#lll_31').show();
					$('#lll_32').hide();
					$('.lvl1_span').text('Выберите марку');
                    $('.lvl2_span').text('Модель');
                    $('.lvl3_span').text('Год');
					}
                }else if(lvl==2){
					if(id!=-1){
					$('#lll_31').hide();
					$('#lll_32').show()
					} else {
					$('#lll_31').show();
					$('#lll_32').hide()
					}
                    $('.lvl3').html(data);
                    $('.lvl3_span').text('Год');
                }
            }
        });
    }
</script>
<?
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-ui.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.fancybox.min.js");
Asset::getInstance()->addJs("https://api-maps.yandex.ru/2.1/?lang=ru_RU");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/flipclock.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/owl.carousel.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/app.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/common.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/dev.js");
?>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'TSWJM0kK0M';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
</body>
</html>