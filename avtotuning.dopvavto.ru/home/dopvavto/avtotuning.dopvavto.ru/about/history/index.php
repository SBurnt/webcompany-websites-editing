<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("История");
?><div id="content" class="<span id=" title="Код PHP: &lt;?=(CSite::InDir('/news/index.php')) ? 'news-content' : 'stock-inner-content web-content';?&gt;">
	<?=(CSite::InDir('/news/index.php')) ? 'news-content' : 'stock-inner-content web-content';?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>"&gt;
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
				<h1 class="shop__title category rg"><?=$APPLICATION->ShowTitle();?></h1>
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
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>