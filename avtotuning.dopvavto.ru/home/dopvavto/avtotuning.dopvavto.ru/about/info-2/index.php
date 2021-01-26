<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Информационная");
?>

<div id="content" class="<?=(CSite::InDir('/news/index.php')) ? 'news-content' : 'stock-inner-content web-content';?>">
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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>