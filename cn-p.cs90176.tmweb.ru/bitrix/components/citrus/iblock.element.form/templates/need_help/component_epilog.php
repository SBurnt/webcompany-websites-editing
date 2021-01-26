<?
if($arParams['JQUERY_VALID'] == "Y") {
	// jQuery R R R R RioR  R R S  R R R RioR R S RioRio
	$APPLICATION->AddHeadScript($this->__template->__folder . "/js/jquery.validate/jquery.validate.js");
	// S R S R R R S R  S R R R S  R R S  R R R RioR R S RioRio
	$APPLICATION->AddHeadScript($this->__template->__folder . "/js/jquery.validate/lang/" . LANGUAGE_ID . "/message.js");
}

if($arParams['AJAX'] == "Y" && $_REQUEST['ajax_param']) {
	die();
}
?>