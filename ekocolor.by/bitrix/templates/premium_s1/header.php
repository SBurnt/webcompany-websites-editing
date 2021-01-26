<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);

if (! \Bitrix\Main\Loader::includeModule('nextype.premium') )
    die();

$CLanding = \Nextype\Premium\CLanding::getInstance(SITE_ID);

?>
<? $CLanding::start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <? $APPLICATION->ShowMeta("viewport"); ?>
        <title><? $APPLICATION->ShowTitle() ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                <meta name="format-detection" content="telephone=no">
                    <? $APPLICATION->ShowHead(); ?>
                    <? $APPLICATION->AddHeadString('<script>BX.message(' . CUtil::PhpToJSObject($MESS, false) . ')</script>', true); ?>
                    <? $APPLICATION->AddHeadString('<script>BX.message(' . CUtil::PhpToJSObject(Array (
                        'FORM_CALLBACK_URL' => 'include/forms/callback.php?' . $_SERVER['QUERY_STRING'],
                        'FORM_REVIEWS_URL' => 'include/forms/reviews.php?' . $_SERVER['QUERY_STRING'],
                        'AGREEMENT_URL' => 'include/agreement_text.php',
                        'FORM_ORDER_URL' => 'include/forms/order.php'
                    ), false) . ')</script>', true); ?>
                    </head>
                    <body class="<?=(defined('ERROR_404') == "Y") ? "bg-color" : ""?><?=($CLanding::$options['HEADER_ADVANTAGES'] != "N") ? " hide-header-advantages" : ""?>">
                        <? if (defined('ERROR_404') != "Y"): ?>
                        <? $APPLICATION->IncludeComponent("nextype:landing.options", ".default", array(), false, array("HIDE_ICONS"=>"Y")); ?>
                        <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
                        <header>
                            <div class="header">
                                <div class="container">
                                    <div class="items">
                                        <div class="logo">
                                            <?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php", Array(), Array("MODE" => "html"));?>
                                        </div>
                                        <div class="slogan"><?$APPLICATION->IncludeFile(SITE_DIR."include/header_slogan.php", Array(), Array("MODE" => "html"));?></div>
                                        <div class="tel">
                                            <div class="content">
                                                <div class="item"><?$APPLICATION->IncludeFile(SITE_DIR."include/header_phone1.php", Array(), Array("MODE" => "html"));?></div>
                                                <div class="item"><?$APPLICATION->IncludeFile(SITE_DIR."include/header_phone2.php", Array(), Array("MODE" => "html"));?></div>
                                            </div>
                                        </div>
                                        <a href="javascript:viod(0)" onclick="<?=$CLanding::$options['EVENT_CLICK_CALLBACK']?>" class="btn callback-popup-btn transparent"><?=GetMessage('CALLBACK_BTN_NAME')?></a>
                                    </div>
                                </div>
                            </div>
                            <? if ($CLanding::$options['HEADER_TYPE']=='FLY'):?>
                                <script>
                                  var header = document.querySelector('.header');
                                  window.onscroll = function() {
                                    if (window.pageYOffset > 100) {
                                      header.classList.add('fixed');
                                    } else {
                                      header.classList.remove('fixed');
                                    }
                                  };
                                </script>
                            <? endif;?>
                            <? if (\Nextype\Premium\CLanding::$options['SLIDER'] == "Y")
                                include_once($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . "include/header_slider.php");
                            else
                                include_once($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . "include/header_image.php");
                            ?>
                            <?$CLanding::$options['HEADER_ADVANTAGES'] != "Y" ? include_once($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . "include/header_advantages.php") : '' ?>
                        </header>
                        <main> 
                        <? endif; ?>