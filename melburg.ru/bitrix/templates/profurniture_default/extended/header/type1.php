<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<!-- header type1 -->
<div id="header" class="header js-header">
	<div class="centering">
		<div class="centeringin clearfix">
			<div class="logo column1">
				<div class="column1inner">
					<a href="<?= SITE_DIR ?>">
						<?
?>
						<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/company_logo.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
						<?
?>
					</a>
				</div>
			</div>
			<div class="phone column1 nowrap phone-time">
				<div class="column1inner">
					<svg class="svg-icon">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-handphone"></use>
					</svg>
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/header/phone.php",
							"EDIT_TEMPLATE" => ""
						),
						false
					);?>
				</div>
				<div class="time__wrap">
					<svg class="time__ico" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M7 0C3.14005 0 0 3.14005 0 7C0 10.86 3.14005 14 7 14C10.86 14 14 10.86 14 7C14 3.14005 10.86 0 7 0ZM10.3291 10.6207C10.2153 10.7345 10.066 10.7917 9.9167 10.7917C9.76738 10.7917 9.61795 10.7345 9.5043 10.6207L6.5876 7.7041C6.47791 7.59505 6.4167 7.44679 6.4167 7.2917V3.5C6.4167 3.17743 6.67796 2.9167 7 2.9167C7.32204 2.9167 7.5833 3.17743 7.5833 3.5V7.0502L10.3291 9.7959C10.5571 10.024 10.5571 10.3927 10.3291 10.6207Z" fill="#6D6D6D" />
					</svg>
					<div class="time">c 10:00 до 21:00</div>
				</div>
			</div>
			<div class="callback column1 nowrap hidden-print">
				<div class="column1inner">
					<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/nasvyazi.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
				</div>
			</div>
			<div class="favorite column1 nowrap hidden-print">
				<div class="column1inner">
					<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/favorite.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
				</div>
			</div>
			<div class="basket column1 nowrap hidden-print">
				<div class="column1inner">
					<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/basket_small.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /header type1 -->