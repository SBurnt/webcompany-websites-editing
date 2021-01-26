<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$arResult["VISIBLE_FIELD_COUNT"] = 0;
$firstGroupField = false;
foreach ($arResult["ITEMS"] as $code => &$fieldInfo) {
	if ($fieldInfo['GROUP_FIELD'] === "Y"){
		$firstGroupField = false;
		continue;
	}

	if (!$firstGroupField && $fieldInfo['HIDE_FIELD'] !== "Y" ) { $fieldInfo['FIRST_GROUP_FIELD'] = true; $firstGroupField = true; }

    /**
     * R R S R RioS S R R  S R RioR R R S R S R  field_id
     */
    $fieldInfo["ID"] = str_replace( array("[", "]"), "__",$arResult["FORM_ID"]."--".$fieldInfo["CODE"]);

	/**
	 * R RioR RioS  S R R R R R 
	 */
	if ($fieldInfo["TYPE"] === "F") {
		$fieldInfo["LIMIT"] = $fieldInfo['MULTIPLE'] == 'N' ? 1 : 10;
	}

	/**
	 * R R R R  ADDITIONAL R R S  R R R RioR R S RioRio R S R R R  R R R R R R S S S  R  S S S R R S  R  S R S R R S R  'filesize=1mb;minlength=4'
	 */
	if ($fieldInfo['ADDITIONAL']) {
		$additionalExplode = explode(';', $fieldInfo['ADDITIONAL']);
		$arAdditional = array();
		foreach ( $additionalExplode as $add) {
			$addOne = explode('=', $add);
			$arAdditional[trim($addOne[0])] = trim($addOne[1]);
		}
		$fieldInfo['ADDITIONAL'] = $arAdditional;
	}

    /**
     * R S R S S R R R S R R  old value R R S  R R S R R S R S S  R R R S R R RioR 
     */
    $fieldInfo["OLD_VALUE"] = $fieldInfo["OLD_VALUE"] ? $fieldInfo["OLD_VALUE"] : $fieldInfo["DEFAULT"];

    if ($fieldInfo["HIDE_FIELD"] !== "Y") $arResult["VISIBLE_FIELD_COUNT"]++;
}
?>


<?
/**
 * delete success in url
 */
/*if (isset($_GET["success_{$arResult["FORM_ID"]}"]) && $_GET["success_{$arResult["FORM_ID"]}"] === "true"):?>
	<script>
		//IE10+
		if (typeof window.history.pushState !== "undefined") {
			window.history.pushState(null, null, "<?=$APPLICATION->GetCurPageParam("", array("success_{$arResult["FORM_ID"]}"))?>");
		}
	</script>
<?endif;*/?>





