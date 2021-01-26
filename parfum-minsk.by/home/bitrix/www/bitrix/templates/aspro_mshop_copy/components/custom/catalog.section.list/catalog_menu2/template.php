<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    $d=intval($arParams['TOP_DEPTH']); if($d>3) $d=3; elseif ($d<1) $d=1;?>
<div class="btn catalog darrow">
    <a href="<?=SITE_DIR?>catalog/"><?=GetMessage("CATALOG")?><b></b></a>
</div>
<ul class="main-catalog-ul">
    <?foreach($arResult['DATA']['H'][0] as $i=>$sid){
            $arSection = $arResult['DATA']['SECTIONS'][$sid];?>
        <li class="firstLevel"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
            <div class="window catalog alt">
                <div class="bg"></div>
                <?if ($d>1){?>
                    <?
                        $cnt = count($arResult['DATA']['H'][$sid]);
                        $col = 3; //столбцов
                        $arCounts = array();
                        if($cnt >= $col){
                            $fstep = round($cnt/$col);
                            for($i = 1; $i < $col; $i++) $arCounts[] = $fstep;
                            $arCounts[] = $cnt - ($fstep*($col-1));
                            rsort($arCounts);
                        }else{
                            for($i = 1; $i <= $cnt; $i++)
                                $arCounts[] = 1;
                        }
                        $i = 0;
                        $flag = false;                
                    ?>
                    <?foreach($arResult['DATA']['H'][$sid] as $ssid){
                            if($arCounts[$i] == 0) continue;
                            $arSection = $arResult['DATA']['SECTIONS'][$ssid];?>
                        <?if($arCounts[$i] > 0 && !$flag){?>
                            <ul>
                                <?$flag = true; } // в этой колонке уже открывали ul?>                
                            <li>
                                <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
                                <?if($d>2 && count($arResult['DATA']['H'][$ssid])){?>
                                    <span class="hide">+</span>
                                    <div>
                                        <?foreach($arResult['DATA']['H'][$ssid] as $sssid){
                                                $arSection = $arResult['DATA']['SECTIONS'][$sssid];?>
                                            <a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
                                            <?}?>
                                    </div>
                                    <?}?>
                            </li>
                            <?$arCounts[$i]--;?>
                            <?if($arCounts[$i] == 0){?>
                            </ul>
                            <?$flag = false; $i++; } // закрыли колонку, обнуляем флаг, переходим к след. колонке?> 
                        <?}?>

                    <?}?>
            </div></li>
        <?}?>
    </ul>