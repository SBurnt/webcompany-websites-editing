<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<div class="search-form">
	<form action="<?= $arResult["FORM_ACTION"] ?>" id="search-header">
		<!-- <table border="0" cellspacing="0" cellpadding="2" align="center"> -->
		<!-- <tr> -->
		<!-- <td align="center"> -->
		<?if($arParams["USE_SUGGEST"] === "Y"):?>
		<?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 15,
					"DROPDOWN_SIZE" => 10,
				),
				$component, array("HIDE_ICONS" => "Y")
			);?>
		<?else:?>
		<div class="search-form-wrap">
			<input class="search-form-input" type="text" name="q" value="" size="15" maxlength="50" placeholder="Поиск" />
			<svg class="search-form-input-img" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M13.77 12.6659L11.1264 10.0301C11.9794 8.94347 12.4422 7.60162 12.4404 6.22022C12.4404 4.98998 12.0756 3.78736 11.3921 2.76445C10.7087 1.74154 9.73719 0.944282 8.60059 0.473489C7.464 0.0026951 6.21332 -0.120486 5.00672 0.119523C3.80011 0.359531 2.69178 0.951949 1.82186 1.82186C0.951949 2.69178 0.359531 3.80011 0.119523 5.00672C-0.120486 6.21332 0.0026951 7.464 0.473489 8.60059C0.944282 9.73719 1.74154 10.7087 2.76445 11.3921C3.78736 12.0756 4.98998 12.4404 6.22022 12.4404C7.60162 12.4422 8.94347 11.9794 10.0301 11.1264L12.6659 13.77C12.7382 13.8429 12.8242 13.9007 12.9189 13.9402C13.0137 13.9797 13.1153 14 13.218 14C13.3206 14 13.4222 13.9797 13.517 13.9402C13.6117 13.9007 13.6977 13.8429 13.77 13.77C13.8429 13.6977 13.9007 13.6117 13.9402 13.517C13.9797 13.4222 14 13.3206 14 13.218C14 13.1153 13.9797 13.0137 13.9402 12.9189C13.9007 12.8242 13.8429 12.7382 13.77 12.6659ZM1.55506 6.22022C1.55506 5.29754 1.82866 4.39558 2.34128 3.62839C2.85389 2.86121 3.58249 2.26327 4.43494 1.91017C5.28739 1.55708 6.2254 1.46469 7.13035 1.6447C8.0353 1.8247 8.86655 2.26902 9.51899 2.92145C10.1714 3.57389 10.6157 4.40514 10.7957 5.31009C10.9757 6.21504 10.8834 7.15305 10.5303 8.0055C10.1772 8.85795 9.57923 9.58655 8.81205 10.0992C8.04486 10.6118 7.1429 10.8854 6.22022 10.8854C4.98294 10.8854 3.79634 10.3939 2.92145 9.51899C2.04656 8.6441 1.55506 7.4575 1.55506 6.22022Z" fill="#999999" />
			</svg>
		</div>
		<?endif;?>
		<!-- </td> -->
		<!-- </tr> -->
		<!-- </table> -->
	</form>
</div>