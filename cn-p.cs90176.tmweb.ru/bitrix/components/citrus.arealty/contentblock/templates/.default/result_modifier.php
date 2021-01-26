<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use function \Citrus\Core\array_get;

/** @var array $arParams Parametri, chtenie, izmenenie. Ne zatragivaet odnoimenniy chlen komponenta, no izmeneniya tut vliyayut na $arParams v fayle template.php. */
/** @var array $arResult Rezulytat, chtenie/izmenenie. Zatragivaet odnoimenniy chlen klassa komponenta. */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */

Loc::loadMessages(__FILE__);

$this->getComponent()->setResultCacheKeys(['TITLE', 'SUBTITLE', 'FOOTER']);

$arResult['TITLE'] = array_get($arResult, 'DISPLAY_PROPERTIES.title.VALUE', $arResult['NAME']);
$arResult['SUBTITLE'] = array_get($arResult, 'DISPLAY_PROPERTIES.subtitle.VALUE');

$arParams['SHOW_DETAIL_LINK'] =
	!empty($arParams['SHOW_DETAIL_LINK']) && $arParams['SHOW_DETAIL_LINK'] == 'Y'
		? 'Y'
		: 'N';

if ($arParams['SHOW_DETAIL_LINK'] == 'Y')
{
	ob_start();
	?>
	<a href="<?=$arResult['DETAIL_PAGE_URL']?>" class="btn btn-secondary btn-big btn-stretch">
		<?= Loc::getMessage("CITRUS_CONTENT_BLOCK_DETAIL_LINK") ?>
	</a>
	<?php

	$arResult['FOOTER'] = ob_get_clean();
}
