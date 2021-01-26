<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><div id="content">
	<div class="wrapper">
		<div class="content main_flex flex__align-items_start flex__jcontent_between">
			 <? include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/inc/left-sidebar.php';?>
			<div class="right-col about">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"template_bread",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
				<div class="shop">
					<h2 class="shop__title mt rg"><?=$APPLICATION->ShowTitle();?></h2>
					<p class="rg">
						<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_TEMPLATE_PATH."/include/about-text-1.php"
	)
);?>
					</p>
				</div>
				<div class="item__cont right">
 <br>
				</div>
			</div>
		</div>
	</div>
</div>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>