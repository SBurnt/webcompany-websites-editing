<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>                </div>
            <!-- footer BOF -->
            <div class="footer-container">

                <?include("banner_foot.php")?>

                <?include("subscribe_block.php")?>

                <div class="footer-info">
                    <div class="row clearfix facebook">
                        <div class="grid_3">
                            <div class="info-footer-1">
                                <h4>Категории</h4>
                                <div class="block-content">
                                    <?$APPLICATION->IncludeComponent("bitrix:menu","footer_menu",Array(
                                            "ADD_LOGO" => true,
                                            "ROOT_MENU_TYPE" => "footer1",
                                            "MAX_LEVEL" => "1",
                                            "CHILD_MENU_TYPE" => "",
                                            "USE_EXT" => "Y",
                                            "DELAY" => "N",
                                            "ALLOW_MULTI_SELECT" => "Y",
                                            "MENU_CACHE_TYPE" => "N",
                                            "MENU_CACHE_TIME" => "3600",
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_CACHE_GET_VARS" => ""
                                        )
                                    );?>
                                </div>
                            </div>
                        </div>
                        <div class="grid_3">
                            <div class="info-footer-2">
                                <h4>Коллекции</h4>
                                <div class="block-content">
                                    <?$APPLICATION->IncludeComponent("bitrix:menu","footer_menu",Array(
                                            "ROOT_MENU_TYPE" => "footer2",
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
                                    );?>
                                </div>
                            </div>
                        </div>
                        <div class="grid_3 information">
                            <div class="info-footer-3">
                                <h4>Информация</h4>
                                <div class="block-content">
                                    <?$APPLICATION->IncludeComponent("bitrix:menu","footer_menu",Array(
                                            "ROOT_MENU_TYPE" => "footer3",
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
                                    );?>
                                </div>
                            </div>
                        </div>
                        <div class="grid_3">
                            <div class="info-footer-4">
                                <h4>Компания и бренд</h4>
                                <div class="block-content">
                                    <div class="col-l">
                                        <?$APPLICATION->IncludeComponent("bitrix:menu","footer_menu",Array(
                                                "ROOT_MENU_TYPE" => "footer4",
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
                                        );?>
                                    </div>
                                    <div class="col-r">
                                        <p>Следите за нами:</p>
                                        <ul class="social-icons">
                                            <li><a href="<?=CNLSMainSettings::GetSiteSetting('soc_fb')?>"><img src="<?=SITE_TEMPLATE_PATH?>/_html/img/social-icon-fb.png" alt="BergHOFF on facebook"></a></li>
                                            <li><a href="<?=CNLSMainSettings::GetSiteSetting('soc_linkedin')?>"><img src="<?=SITE_TEMPLATE_PATH?>/_html/img/social-icon-in.png" alt="BergHOFF on Linkedin"></a></li>
                                            <li><a href="<?=CNLSMainSettings::GetSiteSetting('soc_inst')?>"><img src="<?=SITE_TEMPLATE_PATH?>/_html/img/social-icon-ig.png" alt="BergHOFF on Instagram"></a></li>
                                            <li><a href="<?=CNLSMainSettings::GetSiteSetting('soc_youtube')?>"><img src="<?=SITE_TEMPLATE_PATH?>/_html/img/social-icon-yt.png" alt="BergHOFF on YouTube"></a></li>
                                        </ul>
                                        <p>Наши награды</p>
                                        <ul class="design-awards">
                                            <li><img src="<?=SITE_TEMPLATE_PATH?>/_html/img/reddot-icon.png" alt="Reddot Award Winner"></li>
                                            <li><img src="<?=SITE_TEMPLATE_PATH?>/_html/img/hvdv-icon.png" alt="Henry Van de Velde Award Winner"></li>
                                            <li><img src="<?=SITE_TEMPLATE_PATH?>/_html/img/if-design.png" alt="IF Product Design Award Winner"></li>
                                            <li><img src="<?=SITE_TEMPLATE_PATH?>/_html/img/good-design.png" alt="Good Design Award Winner"></li>
                                            <li><img src="<?=SITE_TEMPLATE_PATH?>/_html/img/german-design-icon.png" alt="German Design Award Winner"></li>
                                        </ul>
                                        <a href="/info/awards/" class="footer-link-awards"> Подробнее&nbsp;&nbsp;&gt;</a> <!-- ссылка на раздел награды-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="row clearfix">
                    <div class="grid_6">
                        <address style="width: 100%;">
                            <div class="footer-row-dark">
                                <div class="grid_3 usp usp-1">
                                    <div class="usp">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/_html/img/check-icon.png">
                                        <span>Официальный вебсайт BergHOFF</span>
                                    </div>
                                </div>
                                <div class="grid_3 usp usp-2">
                                    <div class="usp">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/_html/img/check-icon.png">
                                        <span>Гарантированное качество</span>
                                    </div>
                                </div>
                                <div class="grid_3 usp usp-3">
                                    <div class="usp">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/_html/img/check-icon.png">
                                        <span>Бесплатная доставка от 50 р</span>
                                    </div>
                                </div>
                                <div class="grid_3 usp usp-4">
                                    <div class="usp">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/_html/img/check-icon.png">
                                        <span>Современный дизайн</span>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-row-light">
                                <div class="footer-content-wrapper">
                                    <div class="grid_6 copyright">
                                        <p><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/copyright.php"), false);?></p>
                                    </div>
                                    <div class="grid_6 pay-icons">
                                        <ul>
                                            <li>
                                                <img src="<?=SITE_TEMPLATE_PATH?>/_html/img/fin-footer.png" alt=""/>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </address>
                    </div>
                </footer>
            </div>

        </div>
        <!-- footer EOF -->

        <div id="aw-afptc-popup" class="block aw-afptc-popup" style="display:none"></div>
        <div id="aw-afptc-overlay" style="display:none"></div>

        <script>
            /*
            var amlabel_selector = '.product-image';
            amlabel_product_ids[2759] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/3-piece-knife-set-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2760] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/bread-knives/bread-knife-15-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2761] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/cheese-knives/cheese-knife-9-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2762] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/cheese-knives/cheese-knife-10-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2763] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/tomato-knives/tomato-knife-12-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2764] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/santoku-knives/santoku-knife-14-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2765] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/chef-s-knives/chef-s-knife-13-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2766] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/paring-knives/paring-knife-10-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2767] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/bread-knives/bread-knife-coated-15-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2768] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/cheese-knives/cheese-knife-coated-10-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2769] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/tomato-knives/tomato-knife-coated-12-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2770] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/santoku-knives/santoku-knife-coated-14-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2771] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/chef-s-knives/chef-s-knife-coated-13-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2772] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/paring-knives/paring-knife-coated-10-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            amlabel_product_ids[2774] = '<div class=\"amlabel-table2 top-left\" onclick=\"window.location=\'https://berghoffworldwide.com/bgh_en_int/kitchen-knives/cheese-knives/cheese-knife-coated-9-cm-eclipse\'\" >  <div class=\"amlabel-txt2 top-left\" style=\"width:91px; background: url(<?=SITE_TEMPLATE_PATH?>/_html/img/0eclipse-icon.png) no-repeat 0 0; margin-top: 5px; margin-left: 5px; height: 14px !important; max-height: 16px !important; max-height: 24px; max-width: 100%;\" ><div class=\"amlabel-txt\" ></div></div></div>';
            */
        </script>

        <div id="bubble-layer-overlay" style="display:none;">
            <img id="bubble-layer-loader" src="<?=SITE_TEMPLATE_PATH?>/_html/img/loader.gif" width="64" height="68" alt="Loader">
        </div>

        <?if(false){?>
          <span class="clerk" data-template="@magento-live-search-template" data-live-search-categories="1" data-live-search-categories-title="Categories" data-live-search-products-title="Products" data-bind-live-search="#search"></span>
        <?}?>

        <style>
            #search_autocomplete {
                display: none !important;
            }
        </style>
    </div>
</div>

<script>
    var amlabel_selector = '.product-image';
</script>

<?/*if($SHOW_LOCATION){?>
    <div class="popup is-active js-popup">
        <div class="popup-body">
            <button class="popup-close-button js-popup-close-button" type="button"></button>

            <div class="popup-content">
                <div class="region-popup">
                    <h3 class="region-popup-title">
                        <?if($LOCATION=="other"){?>
                            Ваш регион находится за пределами <br/>Москвы и Московской области?
                        <?}else{?>
                            Вы находитесь в <br/>Москве или Московской области?
                        <?}?>
                    </h3>
                    <div class="region-popup-buttons">
                        <button class="region-popup-button js-popup-close-button" type="button">Да</button>
                        <?if($LOCATION=="other"){?>
                            <a class="region-popup-button" href="?user_location=moscow">Не верно</a>
                        <?}else{?>
                            <a class="region-popup-button" href="?user_location=other">Не верно</a>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?}*/?>

<?if($GLOBALS["PRODUCT_ID"]){
    $arInsts = [];
    $rsInstruc = CIBlockElement::GetProperty("4", $GLOBALS["PRODUCT_ID"], "sort", "asc", ["CODE"=>"INSTRUCTIONS"]);
    while($arInst = $rsInstruc->GetNext()){
        if($arInst["VALUE"]){
            $arFile = CFile::GetFileArray($arInst["VALUE"]);
            ?>
            <div class="popup js-popup" id="instruction-popup-<?=$arInst["VALUE"]?>">
                <div class="popup-body">
                    <button class="popup-close-button js-popup-close-button" type="button"></button>

                    <div class="popup-content">
                        <div class="instruction-popup">
                            <h3 class="instruction-popup-title"><?=$arFile["ORIGINAL_NAME"]?></h3>

                            <div class="instruction-popup-text">
                                <embed src="<?=$arFile["SRC"]?>" width="100%" height="1000" />
                            </div>

                            <div class="instruction-popup-buttons">
                                <a class="instruction-popup-button-print" href="javascript: window.frames['pact_<?=$arInst["VALUE"]?>'].print();" target="_blank">Распечатать</a>
                                <iframe name="pact_<?=$arInst["VALUE"]?>" src="<?=$arFile["SRC"]?>" width="0" height="0" frameborder="0"></iframe>
                                <a class="instruction-popup-button-download" href="<?=$arFile["SRC"]?>" download="newfilename">Распечатать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?}
    }
}?>

<?include("include/notification_popup.php")?>

<div class="popup js-popup" id="subscribe-form-popup">
    <div class="popup-body">
        <button class="popup-close-button js-popup-close-button" type="button"></button>

        <div class="popup-content">
            <div class="info-popup success-subscribe">

                <div class="success-subscribe-form error-subscribe js-error-subscribe">
                    <h3 class="success-subscribe-title">Ваша подписка активна,</h3>
                    <p class="success-subscribe-subtitle">указанный email был зарегистрирован ранее</p>
                </div>

                <form class="success-subscribe-form js-success-subscribe-form is-active" action="/local/ajax/subscribe_add_userdata.php">
                    <h3 class="success-subscribe-title">Спасибо за подписку, </h3>
                    <p class="success-subscribe-subtitle">Пожалуйста, помогите сделать рассылку для вас ещё лучше!</p>

                    <div class="success-subscribe-form-title">Шаг 1 из 2: Заполните немного информации о себе:</div>
                    <div class="success-subscribe-field">
                        <div class="success-subscribe-field-title">
                            <label class="success-subscribe-field-label" for="success-subscribe-name">Как вас зовут</label>
                        </div>
                        <input class="success-subscribe-field-input" id="success-subscribe-name" name="success-subscribe-name" type="text">
                    </div>
                    <div class="success-subscribe-field" style="position:relative;">
                        <div class="success-subscribe-field-title">
                            <label class="success-subscribe-field-label" for="success-subscribe-city">Ваш город</label>
                        </div>
                        <input class="success-subscribe-field-input" id="success-subscribe-city" name="success-subscribe-city" type="text">
                        <div class="city_suggest"></div>
                    </div>
                    <div class="success-subscribe-field">
                        <div class="success-subscribe-field-title">
                            <label class="success-subscribe-field-label" for="success-subscribe-city">Когда у вас день рождения</label>
                        </div>
                        <div class="success-subscribe-field-items">
                            <div class="success-subscribe-subfield">
                                <div class="success-subscribe-subfield-title">
                                    <label class="success-subscribe-subfield-label" for="success-subscribe-birthday">день</label>
                                </div>
                                <input class="success-subscribe-subfield-input" id="success-subscribe-birthday" name="success-subscribe-birthday" type="text">
                            </div>
                            <div class="success-subscribe-subfield">
                                <div class="success-subscribe-subfield-title">
                                    <label class="success-subscribe-subfield-label" for="success-subscribe-birthmonth">месяц</label>
                                </div>
                                <input class="success-subscribe-subfield-input" id="success-subscribe-birthmonth" name="success-subscribe-birthmonth" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="success-subscribe-buttons">
                        <button class="success-subscribe-cancel-button js-popup-close-button" type="button">Отмена</button>
                        <button class="success-subscribe-submit-button" type="submit">Отправить</button>
                    </div>
                </form>

                <form class="success-subscribe-form js-success-subscribe-form" action="/local/ajax/subscribe_add_rubrics.php">
                    <h3 class="success-subscribe-title">Спасибо за подписку, </h3>
                    <p class="success-subscribe-subtitle">Пожалуйста, помогите сделать рассылку для вас ещё лучше!</p>

                    <div class="success-subscribe-form-title">Шаг 2 из 2: Выберите интересные для вас темы:</div>

                    <?CModule::IncludeModule("subscribe");
                        $rub = CRubric::GetList(array("SORT"=>"ASC", "NAME"=>"ASC"), array("ACTIVE"=>"Y", "LID"=>LANG));
                        while($rub->ExtractFields("r_")){?>
                            <div class="success-subscribe-checkbox">
                                <input class="success-subscribe-checkbox-input" id="success-subscribe-checkbox-<?=$r_ID?>" name="sf_RUB_ID[]" value="<?=$r_ID?>" type="checkbox" <?if(in_array($r_ID,["2","3"])){?>checked="checked"<?}?>>
                                <label class="success-subscribe-checkbox-label" for="success-subscribe-checkbox-<?=$r_ID?>"><?=$r_NAME?></label>
                            </div>
                        <?}?>

                    <div class="success-subscribe-buttons">
                        <button class="success-subscribe-cancel-button js-popup-close-button" type="button">Отмена</button>
                        <button class="success-subscribe-submit-button" type="submit">Отправить</button>
                    </div>
                </form>

                <div class="success-subscribe-form js-success-subscribe-form">
                    <h3 class="success-subscribe-title">Спасибо за уделённое время</h3>
                    <p class="success-subscribe-subtitle">Мы постараемся радовать вас только самыми интересными новостями.</p>

                    <button class="success-subscribe-finish-close-button js-popup-close-button" type="button">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ydwidget" class="yd-widget-modal"></div>

<?if(isset($insrtuction_popup))include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/instructions.php");?>
<?if(COMPLAINT_FORM == "Y")include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/complaint.php");?>

<?if(substr_count($curPage,"/grill/")){?>
    <div class="popup js-popup" id="callback-popup">
        <div class="popup-body">
            <button class="popup-close-button js-popup-close-button" type="button"></button>
            <div class="popup-content">
                <div class="info-popup success-subscribe">
                    <div class="success-subscribe-form error-subscribe">
                        <h3 class="success-subscribe-title">Спасибо за заявку</h3>
                        <p class="success-subscribe-subtitle">В ближайшее время с Вами свяжется наш менеджер!<br>Удачных покупок!</p>
                    </div>
                    <form class="success-subscribe-form js-success-subscribe-form is-active" id="callback_form">
                        <h3 class="success-subscribe-title">Мы с радостью перезвоним Вам</h3>
                        <div class="success-subscribe-field">
                            <div class="success-subscribe-field-title">
                                <label class="success-subscribe-field-label" for="success-callback-name">Ваше имя</label>
                            </div>
                            <input class="success-subscribe-field-input" id="success-subscribe-name" name="success-callback-name" type="text">
                        </div>
                        <div class="success-subscribe-field" style="">
                            <div class="success-subscribe-field-title">
                                <label class="success-subscribe-field-label" for="success-callback-phone">Ваш телефон</label>
                            </div>
                            <input class="success-subscribe-field-input" id="success-subscribe-city" name="success-callback-phone" type="tel">
                        </div>
                        <div class="success-subscribe-buttons">
                            <button class="success-subscribe-submit-button" type="submit" style="background: transparent;color: #000;border: 1px solid #000;margin: 0 auto;">Перезвоните мне</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?}?>
</body>
</html>