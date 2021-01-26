<?php
/** @var CBCitrusIBAddFormComponent $this R R R S S RioR  R S R R R R R S R  R R R R R R R R S  */
/** @var array $arResult R R S S RioR  S R R S R S S R S R R  S R R R S S  R R R R R R R R S R  */
/** @var array $arParams R R S S RioR  R S R R S S RioS  R R S R R R S S R R  R R R R R R R R S R , R R R R S  RioS R R R S R R R R S S S S  R R S  S S R S R  R R R R R R S S  R R S R R R S S R R  R S Rio R S R R R R  S R R R R R R  (R R R S RioR R S , R S R R S R R R R RioRio R R S R R S R S S  RioR R R S R R R R RioR  RioR Rio S S S R R R ). */
/** @var string $componentName R R S  R S R R R R R R R R  R R R R R R R R S R 
/** @var string $componentPath R S S S  R  R R R R R  S  R R R R R R R R S R R  R S  DOCUMENT_ROOT
/** @var string $componentTemplate R R R R R R  R S R R R R R R R R  R R R R R R R R S R 
/** @var string $parentComponentName
/** @var string $parentComponentPath
/** @var string $parentComponentTemplate
/** @var string $templateFile R S S S  R  S R R R R R S  R S R R S RioS R R S R R  R R S R S  S R R S R , R R R S RioR R S  /bitrix/components/bitrix/iblock.list/templates/.default/template.php) */
/** @var string $templateName R R S  S R R R R R R  R R R R R R R R S R  (R R R S RioR R S : .dR fault) */
/** @var string $templateFolder R S S S  R  R R R R R  S  S R R R R R R R  R S  DOCUMENT_ROOT (R R R S RioR R S  /bitrix/components/bitrix/iblock.list/templates/.default) */
/** @var array $templateData R R S S RioR  R R S  R R R RioS Rio, R R S R S RioS R  R R RioR R R RioR , S R R RioR  R R S R R R R  R R R R R  R R S R R R S S  R R R R S R  RioR  template.php R  S R R R  component_epilog.php, R S RioS R R  S S Rio R R R R S R  R R R R R R S S  R  R R S , S .R . S R R R  component_epilog.php RioS R R R R S R S S S  R R  R R R R R R  S RioS R  */

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */

// TODO R S R R R S S S S  R R S S S R 

/*
 * R R R R S R  R R R R  R R S R R R S S R R R S  R R R R S R  R RioR R R R R R R R R  R R R R  R R S  R R R R R R R R RioS  R R R R R R 
 * S RioR R  R R S S R R R R R  S R R S S RioS . 
 * */

Loc::loadMessages(__FILE__);

if (check_bitrix_sessid() && isset($_REQUEST['showDialog']) && $_REQUEST['showDialog'] == 1)
{
    $GLOBALS["APPLICATION"]->RestartBuffer();
    
    if (!$USER->IsAdmin())
    {
        // R S R Rio R R R S R R R R S R R S  R R  R R R RioR  Rio R R  R R R R -R R R RioR , S R  R R  R R R R S  R R R R R R S S S  R R S S R R S R  S R R S S RioS 
        $by="c_sort"; $order="desc";
        $arDemoAdminsGroup = CGroup::GetList($by, $order, array("STRING_ID" => "DEMO_ADMINS"))->Fetch();
        if (!$arDemoAdminsGroup["ID"] || !in_array($arDemoAdminsGroup["ID"], $USER->GetUserGroupArray()))
            $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"), false, false, "N", true);
    }

    $arResilt = array();

    $arResult['FORM_DATA'] = array();

    // R R S R R R S R R  R R R R S S  R R R S S R R R S S  S  S R S R S  R R R R R R R R RioS 
    if(isset($_REQUEST['ajax-form']) && $_REQUEST['ajax-form'] == "Y")
    {
        CUtil::JSPostUnescape();
        $errorStr = array();
        if(strlen($_REQUEST['EVENT_NAME']) <= 0)
        {
            $errorStr[] = GetMessage('CIEE_ADD_EVENT_NAME_ERROR');
        }
        else
        {
            $arResult['FORM_DATA']['EVENT_NAME'] = $_REQUEST['EVENT_NAME'];
        }

        $arResult['FORM_DATA']['NAME'] = $_REQUEST['NAME'];

        if(count($errorStr) > 0)
        {
            $arResult['ERROR'] = implode("<br />",$errorStr);
        }
        else
        {
            $arAddFieldMailEventType = array(
                'LID' => LANGUAGE_ID,
                'EVENT_NAME' => $arResult['FORM_DATA']['EVENT_NAME'],
                'NAME' => $arResult['FORM_DATA']['NAME'],
                'DESCRIPTION' => ''
            );

            foreach($arParams['FIELDS'] as $propCode => $propInfo)
            {
            	if ($propCode == 'CAPTCHA')
					continue;
                $arAddFieldMailEventType['DESCRIPTION'] .= "#" . $propCode . "# - " . $propInfo['TITLE'] . "\n";
                $arMailMessageFields .= $propInfo['TITLE'] . ": #" . $propCode . "#" . "\n";
            }

            if($type_id = CEventType::Add($arAddFieldMailEventType))
            {
                $arAddFieldMailEventTemplate = array(
                    'ACTIVE' => "Y",
                    'EVENT_NAME' => $arResult['FORM_DATA']['EVENT_NAME'],
                    'LID' => SITE_ID,
                    'EMAIL_FROM' => "#DEFAULT_EMAIL_FROM#",
                    'EMAIL_TO' => "#DEFAULT_EMAIL_FROM#",
                    'SUBJECT' => "#SITE_NAME#: " . $arResult['FORM_DATA']['NAME'],
                    'BODY_TYPE' => 'text',
                    'MESSAGE' => GetMessage('CIEE_MESSAGE_SUBJECT',array("#FIELDS_LIST#" => $arMailMessageFields))
                );

                $emess = new CEventMessage;
                if($emess->Add($arAddFieldMailEventTemplate))
                {
                    echo '<script type="text/javascript">';
                    echo 'BX.WindowManager.Get().Close();';
                    echo '</script>';
                }
                else
                {
                    $et = new CEventType;
                    $et->Delete($arResult['FORM_DATA']['EVENT_NAME']);
                }
            }
        }
    }
    
    require_once($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/interface/admin_lib.php');
    $obJSPopup = new CJSPopup('',
        array(
            'TITLE' => GetMessage('TPL_POPUP_TITLE'),
            'SUFFIX' => 'tpl_add_mail_events_form',
            'ARGS' => ''
        )
    );
    
    if(strlen($arResult['ERROR']) > 0):
        ShowMessage(array("TYPE" => "ERROR","MESSAGE" => $arResult['ERROR']));
    endif;
    
    $obJSPopup->ShowTitlebar();?>
    
    <script type="text/javascript">
        BX.loadCSS('/bitrix/components/citrus/iblock.element.form/templates/showPop/style.css');
    </script>
    
    <?$obJSPopup->StartDescription('bx-edit-menu');?>
    <div class="b-form-title"><?=GetMessage('ADD_FORM_FORM_TITLE')?></div>
    <?$obJSPopup->StartContent();?>
    <div class="b-add-mail-event-form">
        <form action="<?=$APPLICATION->GetCurPageParam()?>" method="POST">
            <input name="ajax-form" type="hidden" value="Y"/>
            <input name="back_url" type="hidden" value="Y"/>
            
            <table class="b-form-content">
                <tr>
                    <td class="b-form-field-title"><span class="required">*</span><?=GetMessage('ADD_FORM_EVENT_NAME')?></td>
                    <td class="b-form-field-content">
                        <input name="EVENT_NAME" type="text" size="30" value="<?=$arResult['FORM_DATA']['EVENT_NAME']?>"/>
                    </td>
                </tr>
                
                <tr>
                    <td class="b-form-field-title"><?=GetMessage('ADD_FORM_NAME')?></td>
                    <td class="b-form-field-content">
                        <input class="field-fullscrin" name="NAME" type="text" size="30" value="<?=$arResult['FORM_DATA']['NAME']?>"/>
                    </td>
                </tr>
            </table>
            <?$obJSPopup->StartButtons();
            $obJSPopup->ShowStandardButtons(array('save','cancel'));
            $obJSPopup->EndButtons();
            ?>
        </form> 
    </div>
    <?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin_js.php");
}

?>