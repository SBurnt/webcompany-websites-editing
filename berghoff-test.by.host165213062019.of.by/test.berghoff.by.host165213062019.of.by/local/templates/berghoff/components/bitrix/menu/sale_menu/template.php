<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<ul class="info-menu-list discounts__list">
  <?
    foreach($arResult as $arItem):
      if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;
  ?>
  <li class="info-menu-item discounts__item<?= (($arItem["SELECTED"]) ? " active" : "") ?>">
    <a class="info-menu-link discounts__link" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
  </li>
  <?endforeach?>
</ul>
<?endif?>