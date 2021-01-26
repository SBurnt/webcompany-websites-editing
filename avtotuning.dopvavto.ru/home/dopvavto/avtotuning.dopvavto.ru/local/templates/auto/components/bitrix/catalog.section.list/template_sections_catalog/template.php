<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>


<?


if(count($arResult['SECTIONS'])){?>
        <?
        $TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
        $CURRENT_DEPTH = $TOP_DEPTH;

        foreach($arResult["SECTIONS"] as $arSection)
        {
            if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
            {
                echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH),"<ul class='catalog-new__list'>";
            }
            elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
            {
                echo "</li>";
            }
            else
            {
                while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
                {
                    echo "</li>";
                    echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
                    $CURRENT_DEPTH--;
                }
                echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</li>";
            }


            if ($_REQUEST['SECTION_ID']==$arSection['ID'])
            {
                $link = '<b>'.$arSection["NAME"].'</b>';
                $strTitle = $arSection["NAME"];
            }
            else
            {
                $link = $arSection["NAME"];
            }

            echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
            ?><li class="catalog-new__list__item"><?=$link?><?

                $CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
        }

                while($CURRENT_DEPTH > $TOP_DEPTH)
                {
                    echo "</li>";
                    echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
                    $CURRENT_DEPTH--;
                }
            ?>
<?}?>

