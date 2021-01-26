<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$d=intval($arParams['TOP_DEPTH']); if($d>3) $d=3; elseif ($d<1) $d=1;?>
<div class="btn catalog darrow red_bg">
    <a href="<?=SITE_DIR?>catalog/"><?=GetMessage("CATALOG")?><b></b></a>
</div>
<div class="window catalog">
    <div class="angle"></div>
    <div class="close"></div>
    <?foreach($arResult['DATA']['H'][0] as $i=>$sid):
    	$arSection = $arResult['DATA']['SECTIONS'][$sid];?>
	    <ul>
	    	<li class="title"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></li>
	    	<?if ($d>1) foreach($arResult['DATA']['H'][$sid] as $ssid):
	    		$arSection = $arResult['DATA']['SECTIONS'][$ssid];?>
				<li>
					<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
					<?if($d>2 && count($arResult['DATA']['H'][$ssid])):?>
						<ul>
							<?foreach($arResult['DATA']['H'][$ssid] as $sssid):
	    						$arSection = $arResult['DATA']['SECTIONS'][$sssid];?>
	    						<li><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></li>
	    					<?endforeach?>
						</ul>
					<?endif?>
				</li>
	    	<?endforeach?>
	    </ul>
    	<?if($i&&$i%3==2):?><div class="clear"></div><?endif?>
    <?endforeach?>
</div>