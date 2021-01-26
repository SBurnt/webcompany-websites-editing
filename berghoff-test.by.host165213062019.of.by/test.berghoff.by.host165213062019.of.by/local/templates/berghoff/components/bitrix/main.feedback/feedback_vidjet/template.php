<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<div  style="display: none;" id="callback-modal">
    <?if(!empty($arResult["ERROR_MESSAGE"]))
    {
        foreach($arResult["ERROR_MESSAGE"] as $v)
            ShowError($v);
    }
    if(strlen($arResult["OK_MESSAGE"]) > 0)
    {
        ?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
    }
    ?>
    <form action="<?=POST_FORM_ACTION_URI?>" method="POST">
        <?=bitrix_sessid_post()?>
        <div class="callback-modal__header">
            <span>Заказать звонок</span>
        </div>
        <div class="callback-modal__body">
      <span class="callback-modal__field-name">
        <b>*</b>Имя:
      </span>
            <input class="callback-modal__field" type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>" required>
            <span class="callback-modal__field-name">
        <b>*</b>Телефон:
      </span>
            <input class="callback-modal__field" type="text" name="user_phone" value="<?=$arResult["AUTHOR_PHONE"]?>" required>
            <span class="callback-modal__field-name">
        E-mail:
      </span>
            <input class="callback-modal__field" type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
            <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
            <input class="callback-modal__btn" type="submit" name="submit" value="Отправить">
        </div>
    </form>
</div>
