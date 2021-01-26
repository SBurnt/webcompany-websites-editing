<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["PHONE_REGISTRATION"])
{
	CJSCore::Init('phone_auth');
}
ShowMessage($arParams["~AUTH_RESULT"]);

global $USER;
?>

<?if($arResult["SHOW_FORM"]):?>


        <h2 class="shop__title category rg"><?=GetMessage("AUTH_CHANGE")?></h2>
        <div class="recovery-block">
            <form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
                <?if (strlen($arResult["BACKURL"]) > 0): ?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <? endif ?>
                <input type="hidden" name="AUTH_FORM" value="Y">
                <input type="hidden" name="TYPE" value="CHANGE_PWD">
                <input type="hidden" name="USER_LOGIN" maxlength="50" value="<?=$USER->GetLogin()?>" class="form-element" required />
                <div class="mess"></div>
                <label>
                    <p>
                        Текущий пароль <span>*</span>
                    </p>
                    <input type="text" class="form-element" required>
                </label>
                <label>
                    <p><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?><span>*</span></p>
                    <input type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" class="form-element" required autocomplete="off" />
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
                <label>
                    <p><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?><span>*</span></p>
                    <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="form-element" required autocomplete="off" />
                </label>
                <input type="submit" name="change_pwd" class="web-main-btn" value="<?=GetMessage("AUTH_CHANGE")?>" />
            </form>
        </div>

<?endif?>
