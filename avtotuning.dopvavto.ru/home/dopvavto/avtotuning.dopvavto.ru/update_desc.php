<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$row = 0;
$step = 100;
$filename = 'desc.csv';
$end = sizeof(file($filename));
$i = 0;


if($_GET['row'])
    $row = $_GET['row'];

$go = $row + $step;

$params = Array(
    "max_len" => "100", // обрезает символьный код до 100 символов
    "change_case" => "L", // буквы преобразуются к нижнему регистру
    "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
    "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
    "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
    "use_google" => "false", // отключаем использование google
);



if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, '|')) !== FALSE) {

        if($i < $row || $i == 0)
        {
            $i++;
            continue;
        }

        if($i >= $go)
        {
            break;
        }

        // Ищем товар по коду

        $code = CUtil::translit($data[0], "ru" , $params);

        $arSelect = Array("ID", "NAME");
        $arFilter = Array("IBLOCK_ID"=> 2, "CODE"=> $code);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            $PRODUCT_ID = $arFields['ID'];
        }

        if($PRODUCT_ID)
        {
            $el = new CIBlockElement;
            $arLoadProductArray = Array(
                "DETAIL_TEXT_TYPE" => 'html',
                "DETAIL_TEXT" => str_replace('|', '', $data[1]),          // элемент лежит в корне раздела
            );

            $res = $el->Update($PRODUCT_ID, $arLoadProductArray);
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
        window.location.href = '/update_desc.php?row=<?=$go;?>';
    }
    setTimeout('go()', 1000);
</script>
