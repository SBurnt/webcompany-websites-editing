<? if ($_REQUEST['is_ajax'] == $jsParams['form_id'])
            $APPLICATION->RestartBuffer();
?>
<? if ($arResult['SUCCESS']): ?>

        <div class="popup inline succees">
            <div class="box">
                <div class="head">
                        <div class="title"><?= GetMessage('NT_FORMS_SUCCESS_TITLE') ?></div>
                        <a href="javascript:void(0);" data-close class="close"></a>
                    </div>
                    <div class="content">
                        <div class="icon icon-succees"></div>
                        <div class="text"><?= $arResult['SUCCESS'] ?></div>
                        <a href="javascript:void(0);" data-close class="btn color"><?= GetMessage('NT_FORMS_CLOSE') ?></a>
                    </div>
            </div>
        </div>
<? endif; ?>

<div class="fields">
<? $fieldsCount = (isset($arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING'])) ? count($arResult['FIELDS']) - 1 : count($arResult['FIELDS']); ?>
<? foreach ($arResult['FIELDS'] as $arField): ?>
    <? if ($arField['name'] == "SYSTEM_PERSONAL_PROCESSING") continue; ?>
    <? if ($arField['type'] != "hidden"): ?>
    <div class="field <?=$arField['type']?><?=($arField['error']) ? " error" : ""?>">
        <? if ($arField['type'] == "checkbox"): ?>
            <?=$arField['html']?>
            <label for="<?=$arField['field_id']?>"><?=$arField['label']?></label>
        <? elseif ($arField['type'] == "file"): ?>
            <div class="label"><?=$arField['label']?><?if($arField['required']):?><sup>*</sup><?endif;?></div>
            <? if ($arField['error']): ?><div class="error-tip"><?=$arField['error']['TEXT']?></div><?endif;?>
            <?=$arField['html']?>
            <label for="<?=$arField['field_id']?>" class="file"><span data-default="<?=GetMessage('NT_FORMS_FILE_LABEL')?>"><?=GetMessage('NT_FORMS_FILE_LABEL')?></span></label>
        <? else: ?>
        <div class="label"><?=$arField['label']?><?if($arField['required']):?><sup>*</sup><?endif;?></div>
        <? if ($arField['error']): ?><div class="error-tip"><?=$arField['error']['TEXT']?></div><?endif;?>
        <?=$arField['html']?>
        <? endif; ?>
    </div>
    <? else: ?>
    <?=$arField['html']?>
    <? endif; ?>
<? endforeach; ?>
    
<? if ($arParams['CAPTHCA'] == 'DEFAULT'): ?>
<div class="captcha field">
    <div class="label"><?=GetMessage('NT_FORMS_CAPTCHA_LABEL')?><sup>*</sup></div>
    <div class="image">
        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTHCA_CODE'];?>" alt="CAPTCHA" />
        <input type="hidden" name="<?=$arResult['FORM_ID']?>[captcha_sid]" value="<?=$arResult['CAPTHCA_CODE'];?>" />
    </div>
    <input type="text" required="required" class="form-text" name="<?=$arResult['FORM_ID']?>[captcha_word]" value="" />
    <? if ($arResult['ERROR']['CAPTCHA']): ?>
    <div class="error-tip"><?= $arResult['ERROR']['CAPTCHA'] ?></div>
    <? endif; ?>
</div>
<? endif; ?>

<? if ($arParams['PERSONAL_PROCESSING'] == "Y"): ?>
<div class="field personal <?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['type']?><?=($fieldsCount == 1) ? ' last' : ''?>">
    <?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['html']?>
    <label for="<?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['field_id']?>"><?=GetMessage('NT_FORMS_AGREEMENT_TEXT')?></label>
    <?if($arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['error']):?>
    <div class="error-tip"><?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['error']['TEXT'] ?></div>
    <? endif; ?>
</div>
<? endif; ?>

<button type="submit" class="btn color submit"><?= GetMessage('NT_FORMS_SEND') ?></button>

</div>

<? if ($_REQUEST['is_ajax'] == $jsParams['form_id'])
            die();
?>