<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc,
    Bitrix\Highloadblock\HighloadBlockTable as HLBT;;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);
$APPLICATION->AddChainItem($arResult['NAME'], $APPLICATION->GetCurPage(false));

function getColorHashValue($hash) {
    preg_match('/^#?([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $hash, $matches);
    return $matches[1];
}

function GetEntityDataClass($HlBlockId) {
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = HLBT::getById($HlBlockId)->fetch();
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}

CModule::IncludeModule('highloadblock');

$blockColorClass = GetEntityDataClass(2);
$objPropColor = $blockColorClass::getList(array(
    'select' => array('ID', 'UF_NAME', 'UF_XML_ID',  'UF_FILE'),
    'order' => array('UF_NAME' =>'ASC'),
));

$propColorList = [];


while ($propsColor = $objPropColor->fetch()) {
    $propColorList[$propsColor['UF_XML_ID']] = $propsColor;
} unset($propsColor, $objPropColor);
$colorItems = [];
//echo '<pre>' . print_r($propColorList, true) . '</pre>';

foreach ($arResult['OFFERS'] as $offer) {

    $propColorValue = $offer['PROPERTIES']['COLOR']['VALUE'];
    if (empty($propColorValue))
        continue;
    $colorItem = $colorItems[$propColorValue];
    if (!is_array($colorItem)) {
        $colorItem = [];
        $colorItem['VALUE'] = $propColorValue;
        $colorItem['IMAGES'] = $offer['PROPERTIES']['OFFER_PICTURES']['VALUE'];
    }

    // RES
    $colorItems[$propColorValue] = $colorItem;

}

?>
<div class="flex flex-door-new">
  <?
foreach ($arResult['ITEM_ROWS'] as $rowData) {
    $rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);
    foreach ($rowItems as $item) {
//        echo '<pre>' . print_r($item['PROPERTIES']['ACTION']['VALUE_XML_ID'], true) . '</pre>';
        $productTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
            ? $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
            : $item['NAME'];

        $list_size = [];
        $list_color = [];
        foreach ($item['OFFERS'] as $offer) {
            //dump_r($offer['PROPERTIES']['COLOR']);
            //dump_r($item['PREVIEW_PICTURE']);
            $list_color[getColorHashValue($offer['PROPERTIES']['COLOR']['VALUE'])] = true;
            $list_size[$offer['PROPERTIES']['DOOR_SIZE']['VALUE']] = true;
        }

        ksort($list_size);
        ksort($list_color);
        ?>
  <div class="product-catalog__item product-catalog__item-door">
    <div class="inner">

      <div class="body flex flex--center">
        <div class="img">
          <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="Дверь <?= $productTitle . $item['PREVIEW_PICTURE']['ALT'] ?>"></a>
          <?
              $labels = '';
              switch($item['PROPERTIES']['LABEL']['VALUE_XML_ID']) {
                  case 'ORDER': {
                      $labels = '<div class="tag tag--discount">Под заказ</div>';
                      break;
                  }
                  case 'SALE': {
                      $labels = '<div class="tag tag--sale">Распродажа</div>';
                      break;
                  }
                  case 'NEW': {
                      $labels = '<div class="tag tag--new">Новинка</div>';
                      break;
                  }
              }

              if (!empty($item['ITEM_START_PRICE']['PERCENT'])) {
                  $labels = '<div class="tag tag--discount">-' . $item['ITEM_START_PRICE']['PERCENT'] . '%</div>';
              }

              echo $labels;
          ?>
          <!---->
        </div>
      </div>
      <div class="name ff-b"><?= $productTitle ?></div>

      <?
                if ($item['PROPERTIES']['IS_AVAILABLE']['VALUE_XML_ID'] != 'Y') {
                    ?>
      <div class="avalible ff-b">Нет в наличии</div>
      <?
                } else {
                    ?>
      <!--<div class="avalible spec ff-b">В наличии</div>-->
      <div class="avalible spec">Под заказ</div>
      <?}
                $price_from = explode('|', $item['PROPERTIES']['PRICE_FROM']['VALUE']);
                if (!empty($price_from[0])) {
                    list($int, $dec) = explode('.', $price_from[0]);
                    ?>
      <!-- <div class="price ff-b"><span><?= $price_from[0] ?></span> р.</div> -->
      <div class="price ff-b"><span><?= $int ?></span><span class="price-dec"><?= $dec ?></span> р.</div>
      <?}?>
    <div class="settings">
        <?
        if(!empty(array_keys($list_size)[0])){?>
            <div class="block">
                <div class="title ff-b">Размеры:</div>
                <div class="dimensions-wrap">
                    <?foreach (array_keys($list_size) as $size){?>
                        <a href="javascript:void(0);" class="link link-default" data-settings="<?= htmlspecialchars(json_encode($sizes[$size], JSON_UNESCAPED_UNICODE)) ?>"><?= $size ?></a>
                    <?}?>
                </div>
            </div>
        <?}?>
<!--        --><?//        echo '<pre>',print_r(array_keys($list_color), 1),'</pre>';

        if(!empty(array_keys($list_color)[0])){?>
            <div class="block dynamic-colors">
                <div class="title ff-b">Цвет:</div>
                <?foreach (array_keys($list_color) as $color) {
                    $arrPropColor = $propColorList[$color];
                    if (empty($arrPropColor))
                        continue;
                    $arrPropColor['_BACKGROUND'] = '';
                    if (empty($arrPropColor['UF_FILE'])) {
                        $arrPropColor['_BACKGROUND'] = '#' . $arrPropColor['UF_XML_ID'];
                    }else{
                        $fileArray = CFile::GetFileArray( $arrPropColor['UF_FILE'], $upload_dir = false);
                        $arrTmpFile = CFile::ResizeImageGet($fileArray, array('width'=>32, 'height'=>32));
                        $arrPropColor['_BACKGROUND'] = 'url(' . $arrTmpFile['src'] . ')';
                    }?>
                    <div class="checkbox checkbox--color">
                        <input name="color" id="color_<?= $arrPropColor['UF_XML_ID'] ?>" type="radio" value="<?= $arrPropColor['UF_XML_ID'] ?>">
                        <span class="color" style="background: <?= $arrPropColor['_BACKGROUND'] ?>"></span>
                        <label for="color_<?= $arrPropColor['UF_XML_ID'] ?>"></label>
                    </div>
                <?}?>
            </div>
        <?}?>
    </div>
    <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="btn btn-solid">Подробнее</a>

    </div>
  </div>
  <?
    }
}
?>
</div>
<?
echo $arResult['NAV_STRING'];
        
unset($generalParams, $rowItems);