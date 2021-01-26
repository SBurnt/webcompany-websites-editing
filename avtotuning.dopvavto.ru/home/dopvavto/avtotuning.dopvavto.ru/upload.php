<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$row = 0;
$step = 20;
$filename = 'prod.csv';
$end = sizeof(file($filename));
$i = 0;


if($_GET['row'])
    $row = $_GET['row'];

$go = $row + $step;



if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ';')) !== FALSE) {

        if($i < $row || $i == 0)
        {
            $i++;
            continue;
        }

        if($i >= $go)
        {
            break;
        }


        $el = new CIBlockElement;

        $params = Array(
            "max_len" => "100", // обрезает символьный код до 100 символов
            "change_case" => "L", // буквы преобразуются к нижнему регистру
            "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
            "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
            "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
            "use_google" => "false", // отключаем использование google
        );

        $PROP = array();
        $PROP['AVAIL'] = array('VALUE' => ($data[8] == 1) ? 2 : '');
        $rr = 0;
        for($j = 9; $j <=12; $j++)
        {
            if($data[$j])
            {
                $PROP['GALLERY']['n'.$rr]['VALUE'] = CFile::MakeFileArray("https://www.avtotuning.by/user/image/bpic/".$data[$j]);
                $rr++;
            }
        }
        $PROP['OLD_PRICE'] = $data[4];

        $arLoadProductArray = Array(
            "IBLOCK_SECTION_ID" => 49,          // элемент лежит в корне раздела
            "IBLOCK_ID"      => 2,
            "PROPERTY_VALUES"=> $PROP,
            "NAME"           => $data[2],
            "CODE"           => CUtil::translit($data[2], "ru" , $params),
            "ACTIVE"         => "Y",            // активен
            "PREVIEW_TEXT"   => "",
            "PREVIEW_PICTURE" => CFile::MakeFileArray("https://www.avtotuning.by/user/image/bpic/".$data[7]),
            "IPROPERTY_TEMPLATES" => array(
                    "ELEMENT_META_TITLE" => $data[5],
                    "ELEMENT_META_KEYWORDS" => $data[1],
                    "ELEMENT_META_DESCRIPTION" => $data[6],
            )
        );


        if($PRODUCT_ID = $el->Add($arLoadProductArray))
        {
            $arFields = array(
                "ID" => $PRODUCT_ID,
                "VAT_ID" => 1, //выставляем тип ндс (задается в админке)
                "VAT_INCLUDED" => "Y" //НДС входит в стоимость
            );
            if(CCatalogProduct::Add($arFields))
            {
                $arFields2 = Array(
                    "PRODUCT_ID" => $PRODUCT_ID,
                    "CATALOG_GROUP_ID" => 1,
                    "PRICE" => $data[3],
                    "CURRENCY" => "USD",
                );
                CPrice::Add($arFields2);
            }
        }

        $i++;
    }
    fclose($handle);
}


if($go >= $end)
{
    die('end');
}

?>
<script>
    function go()
    {
        window.location.href = '/upload.php?row=<?=$go;?>';
    }
    setTimeout('go()', 1000);
</script>
