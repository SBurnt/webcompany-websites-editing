<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if (! \Bitrix\Main\Loader::includeModule('nextype.premium') )
    die();

$CLanding = \Nextype\Premium\CLanding::getInstance(SITE_ID);

$jsParams = Array (
    'function_name' => 'submitForm' . $arResult['FORM_ID'],
    'form_id' => 'form_' . $arResult['FORM_ID'],
);
?>

<div class="wrap">
    <div class="head">
        <div class="title"><?= $arParams['NAME'] ?></div>
        <a href="javascript:void(0);" data-close class="close"></a>
    </div>
        <form accept-charset='utf-8' method="post" action="<?=$APPLICATION->GetCurPageParam('is_ajax=' . $jsParams['form_id'], Array ('is_ajax'))?>" id="<?=$jsParams['form_id']?>" class="form form-popup">
            <? include($_SERVER['DOCUMENT_ROOT'] . $this->GetFolder() . "/ajax.php"); ?>
        </form>

        <script>

            $("#<?=$jsParams['form_id']?> input[data-mask]").each (function () {
                var mask = $(this).data('mask').replace(/#/g, "9");
                $(this).mask(mask);
            });
            $("#<?=$jsParams['form_id']?> select").selecter();

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
                        if (document.body.clientWidth < 640) {
                            $("html,body").scrollTop($('.popup .wrap').offset().top - 50);
                        }
                    }
                });
                return false;
            });

        </script>
</div>