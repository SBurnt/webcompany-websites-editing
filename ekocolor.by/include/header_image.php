<?
$headerBackground = (empty(\Nextype\Premium\CLanding::$options['HEADER_BACKGROUND'])) ? SITE_TEMPLATE_PATH . "/images/header-bg.jpg" : \CFile::GetPath(\Nextype\Premium\CLanding::$options['HEADER_BACKGROUND']);
$headerImage = (empty(\Nextype\Premium\CLanding::$options['HEADER_IMAGE'])) ? SITE_TEMPLATE_PATH . "/images/header-image.png" : \CFile::GetPath(\Nextype\Premium\CLanding::$options['HEADER_IMAGE']);
?>
<div class="top-slider alone">
<div class="item" style="background-image:url('<?=$headerBackground?>')">
    <div class="gradient">
        <div class="container">
            <div class="content">
                <div class="text">
                    <h1 class="title"><?$APPLICATION->IncludeFile(SITE_DIR."include/header_title.php", Array(), Array("MODE" => "html"));?></h1>
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/header_btn.php", Array(), Array("MODE" => "php"));?>
                </div>
                <img class="image" src="<?=$headerImage?>" alt="" title="" />
            </div>
        </div>
    </div>
</div>
</div>