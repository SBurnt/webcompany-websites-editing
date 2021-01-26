<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (count($arResult['SECTIONS'])):?>
	<br /><br />
	<h2><?=GetMessage("ASTDESIGN_CLIMATE_TOVARY_ETOGO_PROIZVO")?></h2>
	<div class="items inbrand">
		<?$i=0; foreach($arResult['SECTIONS'] as $sid=>$pic):
			$sect = $arResult['SECT'][$sid]; $i++;?>
			<article class="productBlock <?=($i%4==0)?'last':''?>">
				<a href="<?=$sect['SECTION_PAGE_URL'],$arResult['FILTER']?>" class="img">
					<div style="padding:10px">
						<img src="<?=Refs::get_resize_src($pic, 110)?>" alt="<?=$sect['NAME']?>">
					</div>
				</a>
				<a href="<?=$sect['SECTION_PAGE_URL'],$arResult['FILTER']?>" class="title"><?=$sect['NAME']?></a>
			</article>
			<?if ($i%4==0) echo '<div class="clear"></div></div><div class="line"></div><div class="items inbrand">';
		endforeach?>
		<div class="clear"></div>
	</div>
<?endif;
