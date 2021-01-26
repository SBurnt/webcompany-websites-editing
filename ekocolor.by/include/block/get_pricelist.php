<section class="price-list<?=$lastBlock=='Y' ? ' last': ''?>" id="get_pricelist">
	<div class="container">
		<div class="content">
			<div class="info">
				<div class="icon icon-list"></div>
				<h2 class="subtitle white"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_get_pricelist/h2_title.php", Array(), Array("MODE" => "html")); ?></h2>
				<div class="desc"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_get_pricelist/description.php", Array(), Array("MODE" => "html")); ?></div>
			</div>		
                    <?$APPLICATION->IncludeComponent(
	"nextype:forms", 
	"inline", 
	array(
		"FIELDS" => "W3sibGFiZWwiOiJcdTA0MTJcdTA0MzBcdTA0NDhcdTA0MzAgXHUwNDNmXHUwNDNlXHUwNDQ3XHUwNDQyXHUwNDMwIiwibmFtZSI6IkVNQUlMIiwidHlwZSI6ImVtYWlsIiwicmVxdWlyZWQiOiJZIiwiZGVmYXVsdCI6IiIsInZhbHVlcyI6IiIsIm1hc2siOiIifV0=",
		"SEND_EMAIL_ADDRESS" => "",
		"SEND_EMAIL_ENABLED" => "Y",
		"SEND_EMAIL_EVENT_NAME" => "",
		"SEND_IBLOCK_ENABLED" => "Y",
		"SEND_IBLOCK_ID" => "6",
		"SEND_IBLOCK_TYPE" => "nt_premium_forms",
		"DECODE_FIELDNAME" => "Y",
		"NAME" => "Получить прайс-лист",
		"MESSAGE_SUCCESS" => "Ваше сообщение успешно отправлено!",
		"COMPONENT_TEMPLATE" => "inline",
		"MESSAGE_ERRORALL" => "",
		"CAPTHCA" => "N",
		"PERSONAL_PROCESSING" => "Y"
	),
	false
);?>

		</div>
	</div>
</section>