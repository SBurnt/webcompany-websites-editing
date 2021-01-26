<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

$APPLICATION->SetTitle(Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_PAGE_TITLE"));
$APPLICATION->AddChainItem($APPLICATION->GetTitle());

require __DIR__ . '/functions.php';

$textPath = $firstExistingPath([
	SITE_DIR . "include/lk/profile.php",
	SITE_DIR . "include/lk/auth.php",
]);

?>

<div class="lk">
	<div class="lk__form-w">
		<?$APPLICATION->IncludeComponent(
			"citrus.forms:user.profile",
			"simple",
			array(
				"FIELDS" => $arParams['PROFILE_FIELDS'],
				"COMPONENT_TEMPLATE" => ".default",
				"USE_SERVER_VALIDATE" => "N",
				"SAVE_SESSION" => "Y",
				"FORM_ID" => "personal-profile",
				"USE_MAIN_SETTINGS" => "Y",
				"COMPONENT_METHOD" => "UPDATE",
				"USE_GOOGLE_RECAPTCHA" => "N",
				"AJAX" => "Y",
				"FORM_CLASS" => "",
				"SUB_TEXT" => "",
				"JQUERY_VALID" => "Y",
				"FORM_PLACE_MODE" => "PAGE",
				"FORM_STYLE" => "lk lk--form",
				"AGREEMENT_LINK" => '',
				"BUTTON_POSITION" => "RIGHT",
				"BUTTON_CLASS" => "btn btn-border btn-transparent",
				"HIDDEN_ANTI_SPAM" => "Y",
				"ADD_GROUP" => array(
					0 => "2",
				),
				"SITE_ID" => array(
					0 => SITE_ID,
				),
				"ACTIVE" => "Y",
				"AUTH_AFTER_REGISTRATION" => "Y",
				"DEFAULT_LOGIN_FIELD" => "LOGIN",
				"DEFAULT_USER_EMAIL" => "example@mail.ru",
				"USE_MAIN_Y_OKMESSAGE" => "",
				"FORM_TITLE" => "",
				"SUCCESS_TEXT" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_SUCCESS_MESSAGE"),
				"ERROR_TEXT" => "",
				"BUTTON_TITLE" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_BUTTON_TITLE"),
				"BEFORE_FORM_TOOLTIP" => "",
				"AFTER_FORM_TOOLTIP" => ""
			),
			$component
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

            <div class="lk__inner">
                <div class="h3 lk--title"><?= Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_PASSWORD_TITLE") ?></div>
                <?$APPLICATION->IncludeComponent(
                    "citrus.forms:user.profile",
                    "simple",
                    array(
                        "FIELDS" => array(
                            "PASSWORD" => array(
                                "TITLE" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_F_PASSWORD"),
                                "IS_REQUIRED" => "Y",
                                "VALIDRULE" => "",
                                "VALID_ERROR_MSG" => "",
                                "HIDE_FIELD" => "N",
                                "TEMPLATE_ID" => "password",
                            ),
                            "CONFIRM_PASSWORD" => array(
                                "TITLE" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_F_CONFIRM_PASSWORD"),
                                "IS_REQUIRED" => "Y",
                                "VALIDRULE" => "",
                                "VALID_ERROR_MSG" => "",
                                "HIDE_FIELD" => "N",
                                "TEMPLATE_ID" => "password",
                            ),
                        ),
                        "COMPONENT_TEMPLATE" => ".default",
                        "USE_SERVER_VALIDATE" => "N",
                        "SAVE_SESSION" => "Y",
                        "FORM_ID" => "personal-profile-password",
                        "USE_MAIN_SETTINGS" => "Y",
                        "COMPONENT_METHOD" => "UPDATE",
                        "USE_GOOGLE_RECAPTCHA" => "N",
                        "AJAX" => "Y",
                        "FORM_CLASS" => "",
                        "SUB_TEXT" => "",
                        "JQUERY_VALID" => "Y",
                        "FORM_PLACE_MODE" => "PAGE",
                        "FORM_STYLE" => "",
                        "AGREEMENT_LINK" => '',
                        "BUTTON_POSITION" => "RIGHT",
                        "BUTTON_CLASS" => "btn btn-primary btn-small",
                        "HIDDEN_ANTI_SPAM" => "Y",
                        "ADD_GROUP" => array(
                            0 => "2",
                        ),
                        "SITE_ID" => array(
                            0 => SITE_ID,
                        ),
                        "ACTIVE" => "Y",
                        "AUTH_AFTER_REGISTRATION" => "Y",
                        "DEFAULT_LOGIN_FIELD" => "LOGIN",
                        "DEFAULT_USER_EMAIL" => "example@mail.ru",
                        "USE_MAIN_Y_OKMESSAGE" => "",
                        "FORM_TITLE" => "",
                        "SUCCESS_TEXT" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_PASSWORD_SUCCESS_MESSAGE"),
                        "ERROR_TEXT" => "",
                        "BUTTON_TITLE" => Loc::getMessage("CITRUS_AREALTYPRO_MANAGE_OBJECTS_PROFILE_PASSWORD_BUTTON_TITLE"),
                        "BEFORE_FORM_TOOLTIP" => "",
                        "AFTER_FORM_TOOLTIP" => ""
                    ),
                    $component
                );?>
            </div>
		</div><!-- .lk__text -->
		<?php
	}
	?>
</div><!-- .lk -->
