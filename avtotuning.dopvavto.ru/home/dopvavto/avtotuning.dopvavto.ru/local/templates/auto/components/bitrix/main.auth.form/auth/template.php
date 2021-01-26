<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

\Bitrix\Main\Page\Asset::getInstance()->addCss(
	'/bitrix/css/main/system.auth/flat/style.css'
);
?>

<div class="modal-window web-modal" id="login-modal">


    <form name="<?= $arResult['FORM_ID'] ? $arResult['FORM_ID'] : 'form_auth'?>" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>">
        <div class="overlay"></div>
        <div class="wrapper">
            <div class="modal modal-review">
                <?if ($arResult['ERRORS']):?>
                    <div class="alert alert-danger">
                        <? foreach ($arResult['ERRORS'] as $error)
                        {
                            echo $error;
                        }
                        ?>
                    </div>
                <?endif;?>
                <div class="close main_flex flex__align-items_center flex__jcontent_center">
                    <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/cancel.svg" width="22">
                </div>
                <p class="web-title">
                    <?= Loc::getMessage('MAIN_AUTH_FORM_HEADER');?>
                </p>
                <label class="form-block">
                    <p><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_LOGIN');?> *</p>
                    <input type="text" name="<?= $arResult['FIELDS']['login'];?>" maxlength="255" value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>" class="form-element"/>
                </label>
                <label class="form-block">
                    <p><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_PASS');?> *</p>
                    <input type="password" name="<?= $arResult['FIELDS']['password'];?>" maxlength="255" autocomplete="off" class="form-element"/>
                </label>
                <div class="form-item">
                    <?if ($arResult['STORE_PASSWORD'] == 'Y'):?>
                        <label class="checkcontainer ways-nav"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_REMEMBER');?>
                            <input type="radio" id="USER_REMEMBER" name="<?= $arResult['FIELDS']['remember'];?>" value="Y" />
                            <span class="radiobtn"></span>
                        </label>
                    <?endif?>
                    <a href="<?=SITE_DIR?>auth/recovery/" rel="nofollow">
                        <?= Loc::getMessage('MAIN_AUTH_FORM_URL_FORGOT_PASSWORD');?>
                    </a>
                </div>

                <div class="buttons-block">
                    <input type="submit" class="web-main-btn" name="<?= $arResult['FIELDS']['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_SUBMIT');?>" />
                    <a href="<?= $arResult['AUTH_REGISTER_URL'];?>" rel="nofollow" class="web-main-btn">
                        <?= Loc::getMessage('MAIN_AUTH_FORM_URL_REGISTER_URL');?>
                    </a>
                </div>
            </div>
        </div>
	</form>
</div>
<script type="text/javascript">
	<?if ($arResult['LAST_LOGIN'] != ''):?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
	try{document.form_auth.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>