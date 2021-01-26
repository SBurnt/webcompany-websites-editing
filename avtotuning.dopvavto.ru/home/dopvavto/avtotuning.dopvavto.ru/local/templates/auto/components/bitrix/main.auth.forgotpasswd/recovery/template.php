<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);


if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_PWD_SUCCESS');
	return;
}
?>
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

                <?if ($arResult['ERRORS']):?>
                    <div class="alert alert-danger">
                        <? foreach ($arResult['ERRORS'] as $error)
                        {
                            echo $error;
                        }?>
                    </div>
                <?elseif ($arResult['SUCCESS']):?>
                    <div class="alert alert-success">
                        <?= $arResult['SUCCESS'];?>
                    </div>
                <?endif;?>
                <h2 class="shop__title category rg">Восстановление пароля</h2>
                <div class="recovery-block">
                    <p><?= Loc::getMessage('MAIN_AUTH_PWD_NOTE');?></p>
                    <form name="bform" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>">
                        <label>
                            <p><?= Loc::getMessage('MAIN_AUTH_PWD_FIELD_EMAIL');?><span>*</span></p>
                            <input type="text" name="<?= $arResult['FIELDS']['email'];?>" maxlength="255" value="" class="form-element" />
                        </label>
                        <input type="submit"  class="web-main-btn" name="<?= $arResult['FIELDS']['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_PWD_FIELD_SUBMIT');?>" />
                    </form>
                </div>
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
<script type="text/javascript">
	document.bform.<?= $arResult['FIELDS']['login'];?>.focus();
</script>
