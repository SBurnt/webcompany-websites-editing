<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle(""); ?><?$APPLICATION->IncludeComponent(
	"nextype:forms",
	"popup",
	Array(
		"CAPTHCA" => "DEFAULT",
		"DECODE_FIELDNAME" => "Y",
		"FIELDS" => "W3sibGFiZWwiOiJcdTA0MWFcdTA0MzBcdTA0M2EgXHUwNDMyXHUwNDMwXHUwNDQxIFx1MDQzN1x1MDQzZVx1MDQzMlx1MDQ0M1x1MDQ0Mj8iLCJuYW1lIjoiTkFNRSIsInR5cGUiOiJ0ZXh0IiwicmVxdWlyZWQiOiJZIiwiZGVmYXVsdCI6IiIsInZhbHVlcyI6IiIsIm1hc2siOiIifSx7ImxhYmVsIjoiXHUwNDEyXHUwNDMwXHUwNDQ4XHUwNDMwIFx1MDQzZlx1MDQzZVx1MDQ0N1x1MDQ0Mlx1MDQzMCIsIm5hbWUiOiJFTUFJTCIsInR5cGUiOiJlbWFpbCIsInJlcXVpcmVkIjoiWSIsImRlZmF1bHQiOiIiLCJ2YWx1ZXMiOiIiLCJtYXNrIjoiIn0seyJsYWJlbCI6Ilx1MDQxZVx1MDQ0Mlx1MDQzN1x1MDQ0Ylx1MDQzMiIsIm5hbWUiOiJSRVZJRVciLCJ0eXBlIjoidGV4dGFyZWEiLCJyZXF1aXJlZCI6Ik4iLCJkZWZhdWx0IjoiIiwidmFsdWVzIjoiIiwibWFzayI6IiJ9XQ==",
		"MESSAGE_ERRORALL" => "",
		"MESSAGE_SUCCESS" => "Ваш отзыв успешно отправлен. Спасибо за обратную связь!",
		"NAME" => "Оставить отзыв",
		"PERSONAL_PROCESSING" => "Y",
		"PERSONAL_PROCESSING_PAGE" => "",
		"SEND_EMAIL_ADDRESS" => "",
		"SEND_EMAIL_ENABLED" => "Y",
		"SEND_EMAIL_EVENT_NAME" => "",
		"SEND_IBLOCK_ENABLED" => "Y",
		"SEND_IBLOCK_ID" => "8",
		"SEND_IBLOCK_TYPE" => "nt_premium_forms"
	)
);?>