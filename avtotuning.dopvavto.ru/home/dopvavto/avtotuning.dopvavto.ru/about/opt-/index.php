<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оптовым покупателям");
?><div id="content" class="<span id=" title="Код PHP: &lt;?=(CSite::InDir('/news/index.php')) ? 'news-content' : 'stock-inner-content web-content';?&gt;">
	 <?=(CSite::InDir('/news/index.php')) ? 'news-content' : 'stock-inner-content web-content';?>
	<div class="wrapper">
		<div class="content clearfix">
			 <? include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/inc/left-sidebar.php';?>
			<div class="right-col rad">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"template_bread",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
				<h2 class="shop__title category rg"><?=$APPLICATION->ShowTitle();?></h2>
				<h2><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_RECURSIVE" => "Y",
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_TEMPLATE" => ""
	)
);?></h2>
 <br>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"template_bread",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
			</div>
		</div>
	</div>
</div>
 &nbsp;
<h2></h2><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>