<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule("subscribe");
$SHOW_SUBSCRIBE = true;
if($USER->IsAuthorized()){
    $arCurSubscr = CSubscription::GetList([], ["EMAIL"=>$USER->GetEmail()])->Fetch();
    if($arCurSubscr["EMAIL"]){
        $SHOW_SUBSCRIBE = false;
    }
    $arCurSubscr = CSubscription::GetList([], ["USER_ID"=>$USER->GetID()])->Fetch();
    if($arCurSubscr["EMAIL"]){
        $SHOW_SUBSCRIBE = false;
    }
}
if($SHOW_SUBSCRIBE){
?>
<div class="footer-banners">
    <div class="mc-title">Не пропустите горячее предложение !</div>
    <div class="mc-body">никакого спама, только лучшие предложения на продукцию нашего производства</div>
    <!-- Begin MailChimp Signup Form -->
    <div id="mc_embed_signup">
        <form
            class="validate js-subscribe-form"
            id="mc-embedded-subscribe-form"
            action="/local/ajax/subscribe2news.php"
            method="post"
            name="mc-embedded-subscribe-form"
            target="_blank"
            >
            <input type="hidden">
            <div id="mc_embed_signup_scroll">
                <input
                    id="mce-EMAIL"
                    class="email js-subscribe-form-input"
                    type="email"
                    name="EMAIL"
                    placeholder="Введите email"
                />

                <div class="clear">
                    <input id="mc-embedded-subscribe" class="button" type="submit" name="subscribe" value="Подписаться" />
                </div>
            </div>
        </form>
    </div>
    <!--End mc_embed_signup-->

    <p>&nbsp;</p>

    <!--22/11/2017-->

    <!-- <script type="text/javascript" data-skip-moving="true" src="https://cdn.berghoffworldwide.com/bgh-custom/js/cta-toggle.js"></script> -->
    <!-- OR -->
    <!-- cta-toggle.js CONTENT -->
    <script type="text/javascript" data-skip-moving="true">
        (function ($) {
          $(document).ready(function () {


            //COOKIE WEGSCHRIJVEN

            if(Cookies.get('name') == 'hidden'){
              $( "#custom-cta-tag" ).addClass( "cta-is-hidden" );

              if(Cookies.get('timer') == undefined){

                setTimeout(function(){
                  $("#custom-cta-tag").addClass("cta-show");
                  $("#custom-cta-tag").removeClass("cta-is-hidden");
                  Cookies.set('timer', 'startTimer', { expires: 0.5 });
                }, 5000);



                var timer = setTimeout(function(){
                  $("#custom-cta-tag").addClass("cta-hide");
                  $("#custom-cta-tag").removeClass("cta-show");
                }, 9000);

                $("#custom-cta-tag").on('mouseover',function(){
                  Cookies.set('name', 'visible');
                  clearTimeout(timer);
                });

              }

            }

            //CTA toggle
            $(".cta-toggle").on('click',function(e){
                e.preventDefault();
              if(Cookies.get('name') == 'hidden'){
                $( "#custom-cta-tag" ).removeClass( "cta-is-hidden" );
                $( "#custom-cta-tag" ).addClass( "cta-show" );
                $( "#custom-cta-tag" ).removeClass( "cta-hide" );
                Cookies.set('name', 'visible');
              }else{
                $( "#custom-cta-tag" ).addClass( "cta-hide" );
                $( "#custom-cta-tag" ).removeClass( "cta-show" );
                Cookies.set('name', 'hidden');
                Cookies.set('timer', 'startTimer', { expires: 0.5 });
              }
            });

          });

        })(jQuery);
    </script>

    <!-- <script type="text/javascript" data-skip-moving="true" src="https://cdn.berghoffworldwide.com/bgh-custom/js/cookie.js"></script> -->
    <!-- OR -->
    <!-- cookie.js CONTENT -->
    <script type="text/javascript" data-skip-moving="true">
        /*!
         * JavaScript Cookie v2.2.0
         * https://github.com/js-cookie/js-cookie
         *
         * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
         * Released under the MIT license
         */
        ;(function (factory) {
            var registeredInModuleLoader = false;
            if (typeof define === 'function' && define.amd) {
                define(factory);
                registeredInModuleLoader = true;
            }
            if (typeof exports === 'object') {
                module.exports = factory();
                registeredInModuleLoader = true;
            }
            if (!registeredInModuleLoader) {
                var OldCookies = window.Cookies;
                var api = window.Cookies = factory();
                api.noConflict = function () {
                    window.Cookies = OldCookies;
                    return api;
                };
            }
        }(function () {
            function extend () {
                var i = 0;
                var result = {};
                for (; i < arguments.length; i++) {
                    var attributes = arguments[ i ];
                    for (var key in attributes) {
                        result[key] = attributes[key];
                    }
                }
                return result;
            }

            function init (converter) {
                function api (key, value, attributes) {
                    var result;
                    if (typeof document === 'undefined') {
                        return;
                    }

                    // Write

                    if (arguments.length > 1) {
                        attributes = extend({
                            path: '/'
                        }, api.defaults, attributes);

                        if (typeof attributes.expires === 'number') {
                            var expires = new Date();
                            expires.setMilliseconds(expires.getMilliseconds() + attributes.expires * 864e+5);
                            attributes.expires = expires;
                        }

                        // We're using "expires" because "max-age" is not supported by IE
                        attributes.expires = attributes.expires ? attributes.expires.toUTCString() : '';

                        try {
                            result = JSON.stringify(value);
                            if (/^[\{\[]/.test(result)) {
                                value = result;
                            }
                        } catch (e) {}

                        if (!converter.write) {
                            value = encodeURIComponent(String(value))
                                .replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
                        } else {
                            value = converter.write(value, key);
                        }

                        key = encodeURIComponent(String(key));
                        key = key.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent);
                        key = key.replace(/[\(\)]/g, escape);

                        var stringifiedAttributes = '';

                        for (var attributeName in attributes) {
                            if (!attributes[attributeName]) {
                                continue;
                            }
                            stringifiedAttributes += '; ' + attributeName;
                            if (attributes[attributeName] === true) {
                                continue;
                            }
                            stringifiedAttributes += '=' + attributes[attributeName];
                        }
                        return (document.cookie = key + '=' + value + stringifiedAttributes);
                    }

                    // Read

                    if (!key) {
                        result = {};
                    }

                    // To prevent the for loop in the first place assign an empty array
                    // in case there are no cookies at all. Also prevents odd result when
                    // calling "get()"
                    var cookies = document.cookie ? document.cookie.split('; ') : [];
                    var rdecode = /(%[0-9A-Z]{2})+/g;
                    var i = 0;

                    for (; i < cookies.length; i++) {
                        var parts = cookies[i].split('=');
                        var cookie = parts.slice(1).join('=');

                        if (!this.json && cookie.charAt(0) === '"') {
                            cookie = cookie.slice(1, -1);
                        }

                        try {
                            var name = parts[0].replace(rdecode, decodeURIComponent);
                            cookie = converter.read ?
                                converter.read(cookie, name) : converter(cookie, name) ||
                                cookie.replace(rdecode, decodeURIComponent);

                            if (this.json) {
                                try {
                                    cookie = JSON.parse(cookie);
                                } catch (e) {}
                            }

                            if (key === name) {
                                result = cookie;
                                break;
                            }

                            if (!key) {
                                result[name] = cookie;
                            }
                        } catch (e) {}
                    }

                    return result;
                }

                api.set = api;
                api.get = function (key) {
                    return api.call(api, key);
                };
                api.getJSON = function () {
                    return api.apply({
                        json: true
                    }, [].slice.call(arguments));
                };
                api.defaults = {};

                api.remove = function (key, attributes) {
                    api(key, '', extend(attributes, {
                        expires: -1
                    }));
                };

                api.withConverter = init;

                return api;
            }

            return init(function () {});
        }));
    </script>

    <?
    $topBlackCTA = CNLSMainSettings::GetSiteSetting('nls_blackbanchtext_top');
    $VIDGET_PRICE = \Ceteralabs\UserVars::GetVar('VIDGET_PRICE');
    $VIDGET_CURRNECY = \Ceteralabs\UserVars::GetVar('VIDGET_CURRNECY');
//    if($welcomePage["VALUE"]!="Y")
    if(!$USER->IsAuthorized() && !substr_count($curPage, "/login/") && $topBlackCTA){?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.detail",
            "podarki",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_ELEMENT_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "BROWSER_TITLE" => "-",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "ELEMENT_CODE" => "",
                "ELEMENT_ID" => "3288",
                "FIELD_CODE" => array("", ""),
                "IBLOCK_ID" => "29",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_URL" => "",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "MESSAGE_404" => "",
                "META_DESCRIPTION" => "-",
                "META_KEYWORDS" => "-",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Страница",
                "PROPERTY_CODE" => array("text_podarka", "url_podarka", "sum_podarka", "text_cnopka", ""),
                "SET_BROWSER_TITLE" => "N",
                "SET_CANONICAL_URL" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "STRICT_SECTION_CHECK" => "N",
                "USE_PERMISSIONS" => "N",
                "USE_SHARE" => "N"
            )
        );?>
<!--        <div id="custom-cta-tag">-->
<!--            <a href="/login/?register=yes" class="cta-toggle"></a>-->
<!--            <div class="cta-content">-->
<!--                <div class="cta-title">-->
<!--                    <span style="font-size:65px;margin-bottom: 5px">--><?//=$VIDGET_PRICE["VALUE"]?><!-- --><?//=$VIDGET_CURRNECY["VALUE"]?><!--</span>-->
<!--                    В ПОДАРОК-->
<!--                </div>-->
<!--                <a href="/login/?register=yes" class="cta-knop" target="_blank">Регистрация!</a>-->
<!--            </div>-->
<!--        </div>-->
    <?}?>
</div>
<?}?>