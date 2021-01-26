<?
if($arParams['JQUERY_VALID'] == "Y") {
	// jQuery R R R R RioR  R R S  R R R RioR R S RioRio
	$APPLICATION->AddHeadScript($this->__template->__folder . "/js/jquery.validate/jquery.validate.js");
	// S R S R R R S R  S R R R S  R R S  R R R RioR R S RioRio
	$APPLICATION->AddHeadScript($this->__template->__folder . "/js/jquery.validate/lang/" . LANGUAGE_ID . "/message.js");
}

if (isset($_REQUEST['ajax'])) {
	// R R R R R R S R S  S R S RioR S  R R S RioS S  R S  R R S R R 
	$APPLICATION->ShowHeadStrings();
}

if($arParams['AJAX'] == "Y" && $_REQUEST['ajax_param']) {
	die();
}
?>