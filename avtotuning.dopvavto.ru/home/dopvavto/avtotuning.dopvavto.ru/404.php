<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
?>
<div id="content">
        <div class="wrapper">
            <div class="content clearfix">
                <div class="right-col rad <?$APPLICATION->ShowViewContent('class_m');?>">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "template_bread",
                        Array(
                            "PATH" => "",
                            "SITE_ID" => "s1",
                            "START_FROM" => "0"
                        )
                    );?>
                <h1 class="shop__title category rg">Страница не найдена</h1>
                </div>
            </div>
        </div>
    </div>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>