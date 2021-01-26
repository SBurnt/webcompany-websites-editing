<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мебельная компания");


/*$ibj=CIBlockElement::GetList(Array("SORT"=>"ASC"), Array('IBLOCK_ID'=>13),false, false,Array('ID',"NAME"));
while($row=$ibj->GetNext()){
	
	
	

		$el = new CIBlockElement;

		

		$arLoadProductArray = Array(
		  "DETAIL_TEXT"    => "",
		  );

		
		$res = $el->Update($row['ID'], $arLoadProductArray);

	
	
	echo $row['NAME']."-".$res."<br>";
}
*/

$sect=CIBlockSection::GetList( Array("SORT"=>"ASC"), Array('IBLOCK_ID'=>13,'ID'=>925),false,Array('ID','NAME','DESCRIPTION'),false);
while($section=$sect->GetNext()){
	
	
	echo strip_tags($section['DESCRIPTION']);
}
?>