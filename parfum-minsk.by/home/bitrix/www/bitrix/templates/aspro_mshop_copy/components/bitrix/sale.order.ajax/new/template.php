<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!isset($_SESSION["ORDER_".$arResult["ORDER"]["ID"]])) {
	if($arResult["PAY_SYSTEM"]["PAY_SYSTEM_ID"] == 8) {
	    $ER_USER_DATA	= CUser::GetByID($arResult["ORDER"]["USER_ID"])->arResult[0];
	    $ER_EVENT		= "SALE_STATUS_CHANGED_ER";
	    $ER_SITE		= $arResult["ORDER"]["LID"];
	    $ER_EMAIL		= COption::GetOptionString('main', 'email_from', 'default@admin.email');
	    $ER_TO			= CUser::GetByID($arResult["ORDER"]["USER_ID"])->arResult[0]["EMAIL"];
	    $ER_USER 		= $ER_USER_DATA["NAME"] ? $ER_USER_DATA["NAME"] : $ER_USER_DATA["LAST_NAME"];
	    $ER_PATH		= "Пункт “Система “Расчет” (ЕРИП) -> Интернет магазины/сервисы -> A-Z Латинские домены -> P -> ".SITE_SERVER_NAME;
	    $ER_FIELDS		= array(
	        "EMAIL_TO"           => $ER_TO,
	        "DEFAULT_EMAIL_FROM" => $ER_EMAIL,
	        "NAME"               => $ER_USER,
	        "ORDER_ID"           => $arResult["ORDER"]["ID"],
	        "SALE_NAME"          => SITE_SERVER_NAME,
	        "COMPANY_NAME"       => SITE_SERVER_NAME,
	        "PATH_TO_SERVICE"    => $ER_PATH,
	        "SALE_EMAIL"         => $ER_EMAIL
	    );
	    CEvent::SendImmediate($ER_EVENT, $ER_SITE, $ER_FIELDS);
		$_SESSION["ORDER_".$arResult["ORDER"]["ID"]] = $arResult["ORDER"]["ID"];
	}
}
if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N"){
	if(!empty($arResult["ERROR"])){
		foreach($arResult["ERROR"] as $v) {
			echo ShowError($v);
		}
	}
	elseif(!empty($arResult["OK_MESSAGE"])){
		if (count($arResult["OK_MESSAGE"])) {
			echo '<h2>';
		}
		foreach($arResult["OK_MESSAGE"] as $v) {
			echo ShowNote($v);
		}
		if (count($arResult["OK_MESSAGE"])) {
			echo '</h2>';
		}
	}
	include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
	return;
}
elseif(!$_REQUEST["ORDER_ID"]){
	// check min order price
	$price=0;
	foreach($arResult["BASKET_ITEMS"] as $arItem){
		if($arItem["CAN_BUY"]=="Y" && $arItem["DELAY"]=="N"){
			$price += ($arItem["PRICE"]*$arItem["QUANTITY"]);
			$currency = $arItem["CURRENCY"];
		}
	}
	$arError = CMshop::checkAllowDelivery($price,$currency);
	if($arError["ERROR"]){
		LocalRedirect($arParams["PATH_TO_BASKET"]);
	}
}
?>
<?if($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y")
{
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
	{
		if(strlen($arResult["REDIRECT_URL"]) > 0)
		{
			$APPLICATION->RestartBuffer();
			?>
			<script >
				window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			</script>
			<?
			die();
		}

	}
}

//$APPLICATION->SetAdditionalCSS($templateFolder."/style_cart.css");
$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");

CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));
?>

<a name="order_form"></a>

<div id="order_form_div" class="order-checkout">
<NOSCRIPT>
	<div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
</NOSCRIPT>

<?
if (!function_exists("getColumnName"))
{
	function getColumnName($arHeader)
	{
		return (strlen($arHeader["name"]) > 0) ? $arHeader["name"] : GetMessage("SALE_".$arHeader["id"]);
	}
}

if (!function_exists("cmpBySort"))
{
	function cmpBySort($array1, $array2)
	{
		if (!isset($array1["SORT"]) || !isset($array2["SORT"]))
			return -1;

		if ($array1["SORT"] > $array2["SORT"])
			return 1;

		if ($array1["SORT"] < $array2["SORT"])
			return -1;

		if ($array1["SORT"] == $array2["SORT"])
			return 0;
	}
}
?>
<script>
$.cookie("checked","N");

function InitOrderJS(){
	try{
		$(document).ready(function(){
			if(arMShopOptions['THEME']['PHONE_MASK'].length){
				var base_mask = arMShopOptions['THEME']['PHONE_MASK'].replace( /(\d)/g, '_' );
				$('input.phone').inputmask('mask', {'mask': arMShopOptions['THEME']['PHONE_MASK'] });
				$('form[name="ORDER_FORM"] input.phone').blur(function(){
					if( $(this).val() == base_mask || $(this).val() == '' ){
						if( $(this).hasClass('required') ){
							$(this).parent().find('label.error').html(BX.message('JS_REQUIRED'));
						}
					}
				});
			}
		});
	}
	catch(e){}
}
</script>
<div class="bx_order_make">
	<?
	unset($_COOKIE["checked"]);
	echo $_SESSION["checked"];
	if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
	{
		if(!empty($arResult["ERROR"]))
		{
			foreach($arResult["ERROR"] as $v)
				echo ShowError($v);
		}
		elseif(!empty($arResult["OK_MESSAGE"]))
		{
			foreach($arResult["OK_MESSAGE"] as $v)
				echo ShowNote($v);
		}

		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
	}
	else
	{
		if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
		{
			if(strlen($arResult["REDIRECT_URL"]) == 0)
			{
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
			}
		}
		else
		{
			?>
			<script >
			InitOrderJS();

			<?if(CSaleLocation::isLocationProEnabled()):?>

				<?
				// spike: for children of cities we place this prompt
				$city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
				?>

				BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
					'source' => $this->__component->getPath().'/get.php',
					'cityTypeId' => intval($city['ID']),
					'messages' => array(
						'otherLocation' => '--- '.GetMessage('SOA_OTHER_LOCATION'),
						'moreInfoLocation' => '--- '.GetMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
						'notFoundPrompt' => '<div class="-bx-popup-special-prompt">'.GetMessage('SOA_LOCATION_NOT_FOUND').'.<br />'.GetMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
							'#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
							'#ANCHOR_END#' => '</a>'
						)).'</div>'
					)
				))?>);

			<?endif?>

			var BXFormPosting = false;
			function submitForm(val)
			{
				if (BXFormPosting === true)
					return true;

				BXFormPosting = true;
				if(val != 'Y')
					BX('confirmorder').value = 'N';

				var orderForm = BX('ORDER_FORM');
				BX.showWait();

				<?if(CSaleLocation::isLocationProEnabled()):?>
					BX.saleOrderAjax.cleanUp();
				<?endif?>

				BX.ajax.submit(orderForm, ajaxResult);

				return true;
			}

			function ajaxResult(res)
			{
				var orderForm = BX('ORDER_FORM');
				try
				{
					// if json came, it obviously a successfull order submit

					var json = JSON.parse(res);
					BX.closeWait();

					if (json.error)
					{
						BXFormPosting = false;
						return;
					}
					else if (json.redirect)
					{
						window.top.location.href = json.redirect;
					}
				}
				catch (e)
				{
					// json parse failed, so it is a simple chunk of html

					BXFormPosting = false;
					BX('order_form_content').innerHTML = res;

					<?if(CSaleLocation::isLocationProEnabled()):?>
						BX.saleOrderAjax.initDeferredControl();
					<?endif?>
				}

				BX.closeWait();
				BX.onCustomEvent(orderForm, 'onAjaxSuccess');
			}

			function SetContact(profileId)
			{
				BX("profile_change").value = "Y";
				submitForm();
			}

			BX.addCustomEvent('onAjaxSuccess', function(){
			   InitOrderJS();
			});

			</script>
			<?if($_POST["is_ajax_post"] != "Y")
			{
				?><form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
				<?=bitrix_sessid_post()?>
				<div id="order_form_content">
				<?
			}
			else
			{
				$APPLICATION->RestartBuffer();
			}

			if($_REQUEST['PERMANENT_MODE_STEPS'] == 1)
			{
				?>
				<input type="hidden" name="PERMANENT_MODE_STEPS" value="1" />
				<?
			}

			if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
			{
				foreach($arResult["ERROR"] as $v)
					echo ShowError($v);
				?>
				<script >
					top.BX.scrollToNode(top.BX('ORDER_FORM'));
				</script>
				<?
			}

			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");?>

			
			<div class="wrap_md">
				<?if ($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d"){?>
					<div class="l_block iblock">
						<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");?>
					</div>
					<div class="r_block iblock">
						<?if($info = CModule::CreateModuleObject('sale')){
							$testVersion = '15.0.0';
							if(CheckVersion($testVersion, $info->MODULE_VERSION)){
								include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
							}
							else{
								include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery_new.php");
							}
						}
						?>
					</div>
				<?}else{?>
					<div class="l_block iblock">
						<?if($info = CModule::CreateModuleObject('sale')){
							$testVersion = '15.0.0';
							if(CheckVersion($testVersion, $info->MODULE_VERSION)){
								include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
							}
							else{
								include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery_new.php");
							}
						}
						?>
					</div>
					<div class="r_block iblock">
						<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");?>
					</div>
				<?}?>
			</div>
			
			
			
			
			<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");
		
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
			if(strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
				echo $arResult["PREPAY_ADIT_FIELDS"];
			?>

			<?if($_POST["is_ajax_post"] != "Y")
			{
				?>
					</div>
					<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
					<input type="hidden" name="profile_change" id="profile_change" value="N">
					<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
					<input type="hidden" name="json" value="Y">
					<div class="bx_ordercart_order_pay_center"><a href="javascript:;" id="ORDER_CONFIRM_BUTTON" onclick="submitForm('Y'); return false;" class="checkout button big_btn"><span><?=GetMessage("SOA_TEMPL_BUTTON")?></span></a></div>
				</form>
				<?
				if($arParams["DELIVERY_NO_AJAX"] == "N")
				{
					?>
					<div style="display:none;"><?$APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator", "", array(), null, array('HIDE_ICONS' => 'Y')); ?></div>
					<?
				}
			}
			else
			{
				?>
				<script >
					top.BX('confirmorder').value = 'Y';
					top.BX('profile_change').value = 'N';
				</script>
				<?
				die();
			}
		}
	}
	?>
	</div>
</div>
<script>
	$('body').addClass('order_page');
</script>
<?if(CSaleLocation::isLocationProEnabled()):?>

	<div style="display: none">
		<?// we need to have all styles for sale.location.selector.steps, but RestartBuffer() cuts off document head with styles in it?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.location.selector.steps", 
			".default", 
			array(
			),
			false
		);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.location.selector.search", 
			".default", 
			array(
			),
			false
		);?>
	</div>

<?endif?>