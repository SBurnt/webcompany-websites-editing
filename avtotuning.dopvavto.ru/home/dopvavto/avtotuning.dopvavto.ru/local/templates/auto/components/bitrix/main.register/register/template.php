<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div id="content" class="registration-content web-content">
    <div class="wrapper">
        <div class="content clearfix">
            <div class="flex__block content__op">
                <? include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/inc/profile_left-sidebar.php';?>
            </div>
            <div class="right-col rad">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "template_bread",
                    Array(
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0"
                    )
                );?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "template_left_menu_mob",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "left",
                        "USE_EXT" => "N"
                    )
                );?>
                <h2 class="shop__title category rg"><?=GetMessage("AUTH_REGISTER")?></h2>
                <div class="registration-block">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/pictures/checkform.png" alt="">
                    <p>
                        Зарегистрируйтесь, чтобы использовать все возможности личного кабинета: отслеживание заказов, настройку подписки, связи с социальными сетями и другое.
                    </p>
                    <p>
                        Уже зарегистрирована? <a href="javascript:void(0);" class="btn-login">Войдите</a> в личный кабинет.
                    </p>
                    <p>
                        Мы никогда и ни при каких условиях не разглашаем личные данные клиентов. Контактная информация будет использована только для оформления заказов и более удобной работы с сайтом.
                    </p>
                </div>
                <?if($USER->IsAuthorized()):?>
                <?LocalRedirect('/personal/')?>
                    <p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
                <?else:?>
                    <?if (count($arResult["ERRORS"]) > 0):
                        foreach ($arResult["ERRORS"] as $key => $error)
                            if (intval($key) == 0 && $key !== 0)
                                $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);
                                ShowError(implode("<br />", $arResult["ERRORS"]));
                                elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
                                    <p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
                                <?endif;?>
                <?endif?>
                <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
                    <?if($arResult["BACKURL"] <> ''):?>
                        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                    <?endif;?>
                    <div class="checkout-block checkout-flex">
                        <div class="checkout-buttons">
                            <label class="checkcontainer ways-nav physical-nav">Физическое лицо
                                <input type="radio" name="type">
                                <span class="radiobtn"></span>
                            </label>
                            <label class="checkcontainer ways-nav juridical-nav">Юридическое лицо
                                <input type="radio" name="type">
                                <span class="radiobtn"></span>
                            </label>
                        </div>
                    </div>
                    <div class="checkout-block ways-block">
                        <div class="checkout-buttons physical">
                            <div id="fiz_select" style="display: none;">
<!--                                --><?//foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):
//                                    if($arUserField["EDIT_FORM_LABEL"] == "UF_TYPE"):?>
<!--                                        --><?//$APPLICATION->IncludeComponent(
//                                            "bitrix:system.field.edit",
//                                            'enumeration1',
//                                            array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?>
<!--                                     --><?//endif;
//                                endforeach;?>
                            </div>
                            <?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
                                <label <?if($FIELD == 'LOGIN') echo 'style="display: none;"';?>>
                                    <p><?=GetMessage("REGISTER_FIELD_".$FIELD)?> <?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span>*</span><?endif?></p>
                                <?switch ($FIELD)
                                {
                                    case "PASSWORD":?>
                                        <input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="form-element" />
                                        <?if($arResult["SECURE_AUTH"]):?>
                                            <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                                                <div class="bx-auth-secure-icon"></div>
                                            </span>
                                            <noscript>
                                                <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                                                    <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                                </span>
                                            </noscript>
                                            <script type="text/javascript">
                                                document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                            </script>
                                        <?endif?>
                                        </label>
                                    <?break;
                                    case "CONFIRM_PASSWORD":
                                        ?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="form-element"/>
                                        </label>
                                   <?break;
                                    default:
                                        if ($FIELD == 'LOGIN'){?>
                                            <input size="30" style="display: none;" type="text" name="REGISTER[<?=$FIELD?>]" value="<?= uniqid('user_'); ?>" class="form-element"/>
                                            </label>
                                        <?}else{?>
                                            <input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="form-element"/>
                                            </label>
                                        <?}?>
                                <?}?>
                            <?endforeach?>
                            <input class="web-main-btn" type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_ZAREGISTER")?>" />
                        </div>
                        <div class="checkout-buttons juridical">
                            <div id="ur_select" style="display: none;">
<!--                                --><?//foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):
//                                    ?><!----><?//
//                                        if($arUserField["EDIT_FORM_LABEL"] == "UF_TYPE"):?>
<!--                                            --><?//$APPLICATION->IncludeComponent(
//                                                "bitrix:system.field.edit",
//                                                $arUserField["USER_TYPE"]["USER_TYPE_ID"],
//                                                array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?>
<!--                                        --><?//endif;?>
<!--                                   --><?//
//                                endforeach;?>
                            </div>
                            <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):
                                if($arUserField["EDIT_FORM_LABEL"] != "UF_TYPE"):?>

                                    <label>
                                        <p><?=$arUserField["EDIT_FORM_LABEL"]?> <?if ($arUserField["MANDATORY"]=="Y"):?><span>*</span><?endif;?></p>
                                        <?$APPLICATION->IncludeComponent(
                                        "bitrix:system.field.edit",
                                        'string1',
                                        array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?>
                                <?endif;
                            endforeach;?>
                            <?foreach ($arResult["SHOW_FIELDS"] as $FIELD):
                                ?>

                                <?if($FIELD == "EMAIL" || $FIELD == "PERSONAL_PHONE"){?>
                                    <label <?if($FIELD == 'LOGIN') echo 'style="display: none;"';?>>
                                        <p><?=GetMessage("REGISTER_FIELD_".$FIELD)?> <?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span>*</span><?endif?></p>
                                        <input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="form-element ur_registr"/>
                                    </label>
                                <?}?>
                                <?switch ($FIELD)
                                {
                                    case "PASSWORD":?>
                                        <label>
                                            <p><?=GetMessage("REGISTER_FIELD_".$FIELD)?> <?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span>*</span><?endif?></p>
                                            <input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="form-element ur_registr" />
                                            <?if($arResult["SECURE_AUTH"]):?>
                                                <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                                                        <div class="bx-auth-secure-icon"></div>
                                                    </span>
                                                <noscript>
                                                        <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                                                            <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                                                        </span>
                                                </noscript>
                                                <script type="text/javascript">
                                                    document.getElementById('bx_auth_secure').style.display = 'inline-block';
                                                </script>
                                            <?endif?>
                                        </label>
                                    <?break;
                                    case "CONFIRM_PASSWORD":?>
                                        <label>
                                            <p><?=GetMessage("REGISTER_FIELD_".$FIELD)?> <?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span>*</span><?endif?></p>
                                            <input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="form-element ur_registr"/>
                                        </label>
                                    <?break;
                                default:
                                    if ($FIELD == 'LOGIN'){?>
                                        <input size="30" style="display: none;" type="text" name="REGISTER[<?=$FIELD?>]" value="<?= uniqid('user_'); ?>" class="form-element ur_registr"/>
                                        </label>
                                    <?}
                                }?>

                            <?endforeach?>

                            <input class="web-main-btn" type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_ZAREGISTER")?>" />
                        </div>
                    </div>
                </form>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "template_bread",
                    Array(
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0"
                    )
                );?>
            </div>
        </div>
    </div>
</div>
<script>
    $(".web-main-btn").click(function(){
        if($('input[name="UF_CONTACT"]').val() != ' '){
            $('input[name="REGISTER[NAME]"]').val($('input[name="UF_CONTACT"]').val());
        }
    });
    $(".physical-nav").click(function(){
        $('.ur_registr').each(function() {
            $('.ur_registr').prop("disabled",true);
        });
        $('#ur_select').empty();
        $('#fiz_select').append('<input type="hidden" name="UF_TYPE" value=""><select class="bx-user-field-enum ur" name="UF_TYPE" size="5"><option value="">нет</option><option value="1" selected>Физическое лицо</option><option value="2">Юридическое лицо</option></select> ')
    });
    $(".juridical-nav").click(function(){
        $('.ur_registr').each(function() {
            $('.ur_registr').prop("disabled",false);
        });
        $('#fiz_select').remove();
        $('#ur_select').append('<input type="hidden" name="UF_TYPE" value=""><select class="bx-user-field-enum ur" name="UF_TYPE" size="5"><option value="">нет</option><option value="1">Физическое лицо</option><option value="2" selected>Юридическое лицо</option></select> ')
    });
</script>