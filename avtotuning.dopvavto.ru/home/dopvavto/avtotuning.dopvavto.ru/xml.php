<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


$sections = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/upload/sect2.xml');

foreach($sections->row as $section)
{

    $bs = new CIBlockSection;
    $params = Array(
        "max_len" => "100", // обрезает символьный код до 100 символов
        "change_case" => "L", // буквы преобразуются к нижнему регистру
        "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
        "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
        "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
        "use_google" => "false", // отключаем использование google
    );

    $arFields = Array(
        "IBLOCK_SECTION_ID" => 40,
        "IBLOCK_ID" => 2,
        "NAME" => $section->c_caption,
        "CODE" => CUtil::translit($section->c_caption, "ru" , $params),
        "SORT" => $section->c_user_sort,
        "PICTURE" => CFile::MakeFileArray('https://www.avtotuning.by/user/image/menu/'.$section->c_menu_ico),
        "DESCRIPTION" => $section->c_desc_main_bottom,
        "DESCRIPTION_TYPE" => 'html',
        "IPROPERTY_TEMPLATES" => array(
            "SECTION_META_TITLE" => $section->c_title,
            "SECTION_META_KEYWORDS" => $section->c_keywords,
            "SECTION_META_DESCRIPTION" => $section->c_description,
        )
    );

    $ID = $bs->Add($arFields);

    if($ID > 0)
    {
        print 'Добавлен раздел';
    }
    else
    {
        echo $bs->LAST_ERROR;
    }

}

?>