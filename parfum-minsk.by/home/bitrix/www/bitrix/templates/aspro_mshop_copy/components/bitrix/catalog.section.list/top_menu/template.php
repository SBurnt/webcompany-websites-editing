<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<div class="child cat_menu">
	<div class="child_wrapp">
	 
		<?$index=0;?>
		<?$arUrl=explode("?", $_SERVER["REQUEST_URI"]);?>
		<?
		$url2=$APPLICATION->GetCurPage(false);
		$urrrl=$APPLICATION->GetCurPage(false);
		$urrl=explode('/',$urrrl);
		$url=explode($urrl[3],$urrrl);
		if($urrl[3]!=""){
		   $url2=$url[0];
		}else{
			$url2=$APPLICATION->GetCurPage(false);
		}
		$rows = count($arResult["NEW_SECTIONS"]) / 6;

		?>
		
		<?foreach( $arResult["SECTIONS"] as $key=>$arColums ){?>
		<?$index++;?>
		  <ul <?if(!($index%6)):?>class="last"<?endif;?> >
			<?foreach($arColums as $kk=> $arItems){?>
			
			
				<li <?if($url2==$arItems["SECTION_PAGE_URL"] ){ echo "style='background:#c50026;color:#fff;'";}?> class="menu_title">
					<?if($arItems["NAME"]):?>
						<span style="<?if($url2==$arItems["SECTION_PAGE_URL"] ){ echo "color:#fff;";}?> font-weight: bold;">&ndash;</span>
						<a <?if($url2==$arItems["SECTION_PAGE_URL"] ){ echo "style='color:#fff;'";}?> href="<?=$arItems["SECTION_PAGE_URL"]?>" ><?=$arItems["NAME"]?></a>
					<?endif;?>
				</li>
				<?if($arItems["SECTIONS"]):?>
					<?$i = 0;?>
					<?foreach($arItems["SECTIONS"] as $arItem ):?>
						<li  <?=($i > 7 ? 'class="d menu_item" style="display: none;"' : 'class="menu_item"')?>><a href="<?=$arItem["SECTION_PAGE_URL"]?>" <?=($arUrl[0]==$arItem["SECTION_PAGE_URL"] ? "class='current'" : "")?>><?=$arItem["NAME"]?></a></li>
						<?++$i;?>
					<?endforeach;?>
					<?if(count($arItems["SECTIONS"] ) > 5 ):?>
						<!--noindex-->
						<li class="see_more">
							<a rel="nofollow" href="javascript:;"><?=GetMessage('CATALOG_VIEW_MORE')?></a>
						</li>
						<!--/noindex-->
					<?endif;?>
				<?endif;?>
			
		  <?
		  }?>
		  </ul>
		  <?
		}?>
	</div>
</div>
