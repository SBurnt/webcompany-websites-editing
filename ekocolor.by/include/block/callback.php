<section class="callback<?=$lastBlock=='Y' ? ' last': ''?>" id="callback">
	<div class="container">
		<h2 class="subtitle"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_callback/h2_title.php", Array(), Array("MODE" => "html")); ?></h2>
		<div class="desc"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_callback/description.php", Array(), Array("MODE" => "html")); ?></div>
		<?$APPLICATION->IncludeComponent(
	"nextype:forms", 
	"inline", 
	array(
		"CAPTHCA" => "N",
		"DECODE_FIELDNAME" => "Y",
		"FIELDS" => "W3sibGFiZWwiOiLQmtCw0Log0LLQsNGBINC30L7QstGD0YI/IiwibmFtZSI6Ik5BTUUiLCJ0eXBlIjoidGV4dCIsInJlcXVpcmVkIjoiWSIsImRlZmF1bHQiOiIiLCJ2YWx1ZXMiOiIiLCJtYXNrIjoiIn0seyJsYWJlbCI6ItCa0L7QvdGC0LDQutGC0L3Ri9C5INGC0LXQu9C10YTQvtC9IiwibmFtZSI6IlBIT05FIiwidHlwZSI6InRleHQiLCJyZXF1aXJlZCI6IlkiLCJkZWZhdWx0IjoiIiwidmFsdWVzIjoiIiwibWFzayI6IiszNzUgKCMjKSAjIyMtIyMtIyMifV0=",
		"MESSAGE_ERRORALL" => "",
		"MESSAGE_SUCCESS" => "Ваша заявка на консультацию успешно отправлена! Мы свяжемся с вами в ближайшее время.",
		"NAME" => "Заявка на консультацию",
		"PERSONAL_PROCESSING" => "Y",
		"PERSONAL_PROCESSING_PAGE" => "",
		"SEND_EMAIL_ADDRESS" => "",
		"SEND_EMAIL_ENABLED" => "Y",
		"SEND_EMAIL_EVENT_NAME" => "",
		"SEND_IBLOCK_ENABLED" => "Y",
		"SEND_IBLOCK_ID" => "9",
		"SEND_IBLOCK_TYPE" => "nt_premium_forms",
		"COMPONENT_TEMPLATE" => "inline",
		"FORM_TYPE" => ""
	),
	false
);?>
	</div>
</section>