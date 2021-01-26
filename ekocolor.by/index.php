<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Сайт по умолчанию");
?>

<?if (class_exists('\Nextype\Premium\CLanding')) \Nextype\Premium\CLanding::render();?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>