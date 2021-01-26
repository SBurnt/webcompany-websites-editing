<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if ($USER->IsAuthorized())
{
	if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0)
	{
		LocalRedirect($_REQUEST["backurl"]);
	}
    else
    {
        LocalRedirect(LocalRedirect($arResult['FOLDER'] . $arResult['URL_TEMPLATES']['list']));
    }
}

$APPLICATION->ShowAuthForm('');
