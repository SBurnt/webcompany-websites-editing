<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$strReturn = '';
if(!function_exists('SortByName')) {
    function SortByName($a, $b)
    {
        $a = ToLower($a["NAME"]);
        $b = ToLower($b["NAME"]);
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }
}
if($arResult){
	CModule::IncludeModule("iblock");
	global $MShopSectionID;
	$cnt = count($arResult);
	$lastindex = $cnt - 1;
	$bShowCatalogSubsections = COption::GetOptionString("aspro.mshop", "SHOW_BREADCRUMBS_CATALOG_SUBSECTIONS", "Y", SITE_ID) == "Y";
	
	for($index = 0; $index < $cnt; ++$index){
		$arSubSections = array();
		$arItem = $arResult[$index];
		$title = htmlspecialcharsex($arItem["TITLE"]);
		$bLast = $index == $lastindex;
		
//			$arSubSections = CMShop::getChainNeighbors($MShopSectionID, $arItem['LINK']);
            usort($arSubSections, 'SortByName');

		
		if($index){
			$strReturn .= '<span class="separator">-</span>';
		}
		if($arItem["LINK"] <> "" && $arItem['LINK'] != GetPagePath() && $arItem['LINK']."index.php" != GetPagePath() || $arSubSections){
			if($arSubSections){
				$strReturn .= '<span class="drop" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
					$strReturn .= '<a class="number" itemprop="item" href="'.$arItem["LINK"].'">'.($arSubSections ? '<span itemprop="name">'.$title.'</span><b class="space"></b><span class="separator'.($bLast ? ' cat_last' : '').'"></span>' : '<span itemprop="name">'.$title.'</span>').'</a>';
					$strReturn .= '<div class="dropdown_wrapp"><div class="dropdown">';
						foreach($arSubSections as $arSubSection){
							$strReturn .= '<a href="'.$arSubSection["LINK"].'">'.$arSubSection["NAME"].'</a>';
						}
					$strReturn .= '</div></div>';
                    $strReturn .= '<meta itemprop="position" content="'.($index+1).'" />';
                $strReturn .= '</span>';
			}
			else{
				
				if($arItem["LINK"]!="/catalog/"){
					
					
					
				$strReturn .= '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.$arItem["LINK"].'" title="'.$title.'" itemprop="item"><span itemprop="name">'.$title.'</span></a><meta itemprop="position" content="'.($index+1).'" /></span>';
				}else{
					$Sections_object=CIBlockSection::GetList(Array("NAME"=>"ASC"),Array('IBLOCK_ID'=>13, 'ACTIVE'=>"Y"),false,Array('NAME','SECTION_PAGE_URL'),false);
					$ii=0;
				    while($ars=$Sections_object->GetNext()){
						$arSubSections[$ii]["LINK"]=$ars['SECTION_PAGE_URL'];
						$arSubSections[$ii]["NAME"]=$ars['NAME'];
						$ii++;
					};
					$strReturn .= '<span class="drop" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
					$strReturn .= '<a class="number" itemprop="item" href="'.$arItem["LINK"].'">'.($arSubSections ? '<span itemprop="name">'.$title.'</span><b class="space"></b><span class="separator'.($bLast ? ' cat_last' : '').'"></span>' : '<span itemprop="name">'.$title.'</span>').'</a>';
					$strReturn .= '<div class="dropdown_wrapp"><div class="dropdown">';
						foreach($arSubSections as $arSubSection){
							$strReturn .= '<a href="'.$arSubSection["LINK"].'">'.$arSubSection["NAME"].'</a>';
						}
					$strReturn .= '</div></div>';
                    $strReturn .= '<meta itemprop="position" content="'.($index+1).'" />';
                    $strReturn .= '</span>';
				}
				
			}
		}
		else{
			$strReturn .= '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.$title.'</span><meta itemprop="position" content="'.($index+1).'" /></span>';
		}
	}
	
	return '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'.$strReturn.'</div>';
}
else{
	return $strReturn;
}
?>