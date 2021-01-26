<? if ($_REQUEST['is_ajax'] == $jsParams['form_id'])
            $APPLICATION->RestartBuffer();
?>
<? if ($arResult['SUCCESS']): ?>
    <div class="content">
        <div class="icon icon-succees"></div>
        <div class="text"><?= $arResult['SUCCESS'] ?></div>
        <a href="javascript:void(0);" data-close class="btn color"><?= GetMessage('NT_FORMS_CLOSE') ?></a>
    </div>    
    <? if ($arParams['FORM_TYPE'] == "ORDER"): ?>
    <script><?=\Nextype\Premium\CLanding::$options['EVENT_SUBMIT_BUY']?></script>
    <? elseif ($arParams['FORM_TYPE'] == "CALLBACK"): ?>
    <script><?=\Nextype\Premium\CLanding::$options['EVENT_SUBMIT_CALLBACK']?></script>
    <? endif; ?>
<? else: ?>

<div class="fields">
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
<div class="field personal">
    <?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['html']?>
    <label for="<?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['field_id']?>"><?=GetMessage('NT_FORMS_AGREEMENT_TEXT')?></label>
    <?if($arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['error']):?>
    <div class="error-tip"><?=$arResult['FIELDS']['SYSTEM_PERSONAL_PROCESSING']['error']['TEXT'] ?></div>
    <? endif; ?>
</div>
<? endif; ?>

</div>

<button type="submit" class="btn color submit"><?= GetMessage('NT_FORMS_SEND') ?></button>

<? endif; ?>

<? if ($_REQUEST['is_ajax'] == $jsParams['form_id'])
            die();
?>