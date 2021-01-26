<?php

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Citrus\ArealtyPro\Iblock\ExternalAuthors;
use Citrus\ArealtyPro\Manage\UserGroup;

/** @var CitrusRealtyManageObjects $component */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

$APPLICATION->SetTitle(Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_REGISTER_PAGE_TITLE"));
$APPLICATION->AddChainItem($APPLICATION->GetTitle());

if (!ExternalAuthors::isFeatureEnabled())
{
	LocalRedirect($arResult['FOLDER'] . $arResult['URL_TEMPLATES']['auth']);
}

require __DIR__ . '/functions.php';

$textPath = $firstExistingPath([
	SITE_DIR . "include/lk/register.php",
	SITE_DIR . "include/lk/auth.php",
]);

$userGroups = array_column(UserGroup::getAllowed(0), null, 'STRING_ID');

$loginUrl = $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['auth'];
$loginText = '
<div class="agree-block__text"
	 style="margin: -.5em 10px 0 auto; flex: 0; min-width: auto; white-space: nowrap;"
>
	' . Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_REGISTER_AUTH_LINK", ['#AUTH_LINK#' => $loginUrl]) . ' 
</div>
';

?>

<div class="lk">
	<div class="lk__form-w">

		<?$APPLICATION->IncludeComponent(
			"citrus.forms:user.profile",
			"simple",
			array(
				"COMPONENT_TEMPLATE" => ".default",
				"SUB_TEXT" => "",
				"JQUERY_VALID" => "Y",
				"COMPONENT_METHOD" => "REGISTER",
				"FORM_CLASS" => "",
				"FORM_PLACE_MODE" => "PAGE",
				"FORM_STYLE" => "lk lk--form",
				"AGREEMENT_LINK" => SITE_DIR . "agreement/",
				"BUTTON_POSITION" => "RIGHT",
				"BUTTON_CLASS" => "btn btn-border btn-transparent",
				"HIDDEN_ANTI_SPAM" => "Y",
				"USE_SERVER_VALIDATE" => "N",
				"SAVE_SESSION" => "Y",
				"FORM_ID" => "profile-register",
				"USE_MAIN_SETTINGS" => "Y",
				"USE_GOOGLE_RECAPTCHA" => "N",
				"FIELDS" => $arParams['REGISTER_FIELDS'],
				"USE_MAIN_Y_OKMESSAGE" => "",
				"ADD_ACTIVE" => "Y",
				"ADD_GROUP" => [$userGroups[UserGroup::CODE_OWERS]['ID']],
				"AUTH_AFTER_REGISTRATION" => "Y",
				"SUCCESS_TEXT" => Option::get('main', 'new_user_registration_email_confirmation', 'N', SITE_ID) == 'Y'
                    ? Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_REGISTER_FINISH_EMAIL")
                    : Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_REGISTER_FINISH_AUTHORIZED"),
				"BUTTON_TITLE" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_REGISTER_BUTTON_TITLE"),
                "BUTTON_CONTENT_AFTER" => $loginText,
                "REDIRECT_AFTER_SUCCESS" => $component->getBackUrl() ?: SITE_DIR . "kabinet/0/",
			)
		);?>
	</div><!-- .lk__form-w -->
	<?php if ($textPath)
	{
		?>
		<div class="lk__text-w">
			<div class="lk__inner">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					".default",
					array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "clear.php",
						"PATH" => $textPath,
						"PAGE_SECTION" => "Y",
						"TITLE" => "",
						"COMPONENT_TEMPLATE" => ".default",
						"ADDITIONAL_CLASS" => "",
						"SECTION_BORDERED" => "Y",
					),
					false
				);?>
			</div>
		</div><!-- .lk__text -->
		<?php
	}
	?>
</div><!-- .lk -->
