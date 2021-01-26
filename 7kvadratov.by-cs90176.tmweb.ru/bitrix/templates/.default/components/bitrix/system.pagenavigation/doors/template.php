<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

?>

<?

if($arResult["NavPageCount"] > 1) {
	?>
<div class="product-catalog__nav">
	<?
		if ($arResult["NavPageNomer"] > 1) {
			?><a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>" class="prev"></a>
	<?
		}
		
			?>
	<div><span><?= $arResult["NavPageNomer"] ?></span>/<span><?= $arResult["NavPageCount"] ?></span></div>
	<?
			
		if($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
			?><a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>" class="next"></a>
	<?
		}
	?>
</div>
<?
}
?>