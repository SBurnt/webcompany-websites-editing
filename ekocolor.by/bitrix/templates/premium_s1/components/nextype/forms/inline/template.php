<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(false);

if (! \Bitrix\Main\Loader::includeModule('nextype.premium') )
    die();

$CLanding = \Nextype\Premium\CLanding::getInstance(SITE_ID);

$jsParams = Array (
    'function_name' => 'submitForm' . $arResult['FORM_ID'],
    'form_id' => 'form_' . $arResult['FORM_ID'],
);
?>

<form accept-charset='utf-8' method="post" action="" id="<?=$jsParams['form_id']?>" class="form">
    <? include($_SERVER['DOCUMENT_ROOT'] . $this->GetFolder() . "/ajax.php"); ?>
</form>

<script>
    $("#<?=$jsParams['form_id']?> input[data-mask]").each (function () {
        var mask = $(this).data('mask').replace(/#/g, "9");
        $(this).mask(mask);
    });
    
    
    $("body").on('submit', '#<?=$jsParams['form_id']?>', function (event) {
        event.preventDefault();
        var fd = new FormData(document.getElementById('<?=$jsParams['form_id']?>'));
        $.ajax({
            url: '<?=$APPLICATION->GetCurPageParam('is_ajax=' . $jsParams['form_id'], Array ('is_ajax'))?>',
            processData: false,
            contentType: false,
            data: fd,
            type: 'post',
            success: function (data) {
                $("#<?=$jsParams['form_id']?>").html(data).find('input[data-mask]').each (function () {
                    if ($(this).data('mask') != "") {
                        var mask = $(this).data('mask').replace(/#/g, "9");
                        $(this).mask(mask);
                    }
                });
                $("#<?=$jsParams['form_id']?> select").selecter();
            }
        });
        return false;
    });

</script>