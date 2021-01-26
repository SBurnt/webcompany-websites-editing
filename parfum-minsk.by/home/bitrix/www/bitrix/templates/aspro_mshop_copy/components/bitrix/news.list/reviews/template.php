<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if($_POST['submit_review']){
	$el = new CIBlockElement;
	$PROP = array();
	$PROP[86] = $_POST['name'];  // свойству с кодом 12 присваиваем значение "Белый"
	$PROP[87] = $_POST['email'];        // свойству с кодом 3 присваиваем значение 38

	$arLoadProductArray = Array(
	  
	  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
	  "IBLOCK_ID"      => 15,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => $_POST['name'],
	  "ACTIVE"         => "N",            // активен
	  "PREVIEW_TEXT"   => $_POST['review'],
	  );
	  
	 
	    if($PRODUCT_ID = $el->Add($arLoadProductArray))
		  echo "<h2 style='color:#d9002a'>Благодарим. Ваш отзыв отправлен на модерацию</h2>";
		else
		  echo "Error: ".$el->LAST_ERROR;

}?>
<?$z=0; $max=count($arResult["ITEMS"])-1; foreach($arResult["ITEMS"] as $arItem):?>

            <div class="comment">
                <div class="comment__title"><b><?=$arItem["PROPERTIES"]['AUTHOR_NAME']['VALUE']?></b><span>, <?=$arItem["DISPLAY_ACTIVE_FROM"]?$arItem["DISPLAY_ACTIVE_FROM"]:substr($arItem['DATE_CREATE'],0,11)?></span></div>
                           
                <p><?=$arItem['PREVIEW_TEXT']?></p>
            </div>
	
		
		<?if($arItem['DETAIL_TEXT']!=""){?>
		    <div class="otvet">
			   <div class="admin_name">Администрация</div>
			   <?=$arItem['DETAIL_TEXT']?>
			</div>
		<?}?>
		
<?$z++; endforeach?>
<?/*=$arResult["NAV_STRING"]?><br /><br />*/?>
