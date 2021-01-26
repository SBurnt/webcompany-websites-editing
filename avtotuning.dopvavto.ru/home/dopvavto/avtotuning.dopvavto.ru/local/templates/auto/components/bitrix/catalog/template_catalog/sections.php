<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

?>
    <div class="sort main_flex flex__align-items_center">
        <h2 class="shop__title category rg">Каталог</h2>
    </div>
<?$arSections = getSectionList(
    Array(
        'IBLOCK_ID' => 2
    ),
    Array(
        'NAME',
        'SECTION_PAGE_URL'
    )
);
//pr($arSections['CHILDS']);
if($arSections)
{?>
    <style>
        .bd__link:hover{
            text-decoration: underline;
        }
    </style>
    <ul class="catalog-new__list">
        <?foreach($arSections['CHILDS'] as $item)
        {?>
            <li class="catalog-new__list__item">
                <a class="bd__link"  href="<?=$item['SECTION_PAGE_URL'];?>"><?=$item['NAME'];?></a>
                <?if($item['CHILDS']){?>
                    <ul>
                        <?foreach($item['CHILDS'] as $item2)
                        {
                            if($item2['CHILDS'])
                            {?>
                                <li class="catalog-new__list__item__drop">
                                    <span class="catalog-new__drop-btn"><?=$item2['NAME'];?> <svg style="transform: rotate(90deg);" width="15" height="15" viewBox="0 0 15 15" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"/>
                                        <rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"/>
                                    </svg></span>
                                    <ul class="catalog-new__drop-list">
                                        <?
                                        foreach($item2['CHILDS'] as $item3)
                                        {?>
                                            <li><a href="<?=$item3['SECTION_PAGE_URL'];?>"><?=$item3['NAME'];?></a></li>
                                        <?}
                                        ?>
                                    </ul>
                                </li>
                            <?}
                            else
                            {
                            ?>
                            <li><a href="<?=$item2['SECTION_PAGE_URL'];?>"><?=$item2['NAME'];?></a></li>
                        <?}}?>
                    </ul>
                <?}?>
            </li>
        <?}?>
    </ul>
<?}

?>

<?function getSectionList($filter, $select)
{
    $dbSection = CIBlockSection::GetList(
        Array(
            'LEFT_MARGIN' => 'ASC',
        ),
        array_merge(
            Array(
                'ACTIVE' => 'Y',
                'GLOBAL_ACTIVE' => 'Y'
            ),
            is_array($filter) ? $filter : Array()
        ),
        false,
        array_merge(
            Array(
                'ID',
                'IBLOCK_SECTION_ID'
            ),
            is_array($select) ? $select : Array()
        )
    );

    while( $arSection = $dbSection-> GetNext(true, false) ){

        $SID = $arSection['ID'];
        $PSID = (int) $arSection['IBLOCK_SECTION_ID'];

        $arLincs[$PSID]['CHILDS'][$SID] = $arSection;

        $arLincs[$SID] = &$arLincs[$PSID]['CHILDS'][$SID];
    }

    return array_shift($arLincs);
}
