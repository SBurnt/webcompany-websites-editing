<?php

CJSCore::Init(array('vue', 'rangeSlider'));

if (Bitrix\Main\Config\Configuration::getValue('citrus_dev') === 'mortgage')
{
	\Bitrix\Main\Page\Asset::getInstance()->addJs('http://localhost:8082/dist/build.js', true);
}
else
{
	$APPLICATION->AddHeadScript($templateFolder.'/vueComponent/dist/build.js');
}