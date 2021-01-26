<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

// TODO <input type="file" /> R R  S R R R S R R S  S  ajax S R S R R R Rio

?>
<input
    name="<?=$fieldInfo['CODE']?>"
    type="file"
    accept="image/jpeg,image/gif,image/png"
    title="<?= Loc::getMessage('CITRUS_SMARTFORM_INPUT_FILE_TITLE') ?>"
    <?if($fieldInfo['MULTIPLE'] == 'Y'):?>multiple="multiple"<?endif;?>
    id="<?=$fieldInfo["ID"]?>"
>
<script>
    cui_form.initPlugins($("#<?=$fieldInfo["ID"]?>"), "citrusFileUpload", {
        "LIMIT": <?=$fieldInfo["LIMIT"]?>,
        "FILES": <?=$fieldInfo["OLD_VALUE"] ? $fieldInfo["OLD_VALUE"] : "[]"?>,
    });
</script>


