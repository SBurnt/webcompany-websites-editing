<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//Let's determine what value to display: rating or average ?
if($arParams["DISPLAY_AS_RATING"] == "vote_avg")
{
	if($arResult["PROPERTIES"]["vote_count"]["VALUE"])
		$DISPLAY_VALUE = round($arResult["PROPERTIES"]["vote_sum"]["VALUE"]/$arResult["PROPERTIES"]["vote_count"]["VALUE"], 2);
	else
		$DISPLAY_VALUE = 0;
}
else
	$DISPLAY_VALUE = $arResult["PROPERTIES"]["rating"]["VALUE"];
?>
<div class="rating main_flex flex__align-items_center" id="vote_<?echo $arResult["ID"]?>">

<script type="text/javascript">
if(!window.voteScript) window.voteScript =
{
	trace_vote: function(div, flag)
	{
		var my_div;
		var r = div.id.match(/^vote_(\d+)_(\d+)$/);
		for(var i = r[2]; i >= 0; i--)
		{
			my_div = document.getElementById('vote_'+r[1]+'_'+i);
			if(my_div)
			{
				if(flag)
				{
					if(!my_div.saved_class)
						my_div.saved_className = my_div.className;
					if(my_div.className!='star-active star-over')
						my_div.className = 'star-active star-over';
				}
				else
				{
					if(my_div.saved_className && my_div.className != my_div.saved_className)
						my_div.className = my_div.saved_className;
				}
			}
		}
		i = r[2]+1;
		while(my_div = document.getElementById('vote_'+r[1]+'_'+i))
		{
			if(my_div.saved_className && my_div.className != my_div.saved_className)
				my_div.className = my_div.saved_className;
			i++;
		}
	},
	do_vote: function(div, parent_id, arParams)
	{
		var r = div.id.match(/^vote_(\d+)_(\d+)$/);

		var vote_id = r[1];
		var vote_value = r[2];

		function __handler(data)
		{
			var obContainer = document.getElementById(parent_id);
			if (obContainer)
			{
				var obResult = document.createElement("DIV");
				obResult.innerHTML = data;
				obContainer.parentNode.replaceChild(obResult.firstChild, obContainer);
			}
		}

		PShowWaitMessage('wait_' + parent_id, true);
		var url = '/bitrix/components/bitrix/iblock.vote/component.php'
		arParams['vote'] = 'Y';
		arParams['vote_id'] = vote_id;
		arParams['rating'] = vote_value;

		var TID = CPHttpRequest.InitThread();
		CPHttpRequest.SetAction(TID, __handler);
		CPHttpRequest.Post(TID, url, arParams);
	}
}
</script>
	<?if($arResult["VOTED"] || $arParams["READ_ONLY"]==="Y"):?>
		<?if($DISPLAY_VALUE):?>
			<?foreach($arResult["VOTE_NAMES"] as $i=>$name):?>
				<?if(round($DISPLAY_VALUE) > $i):?>
                    <div id="vote_<?echo $arResult["ID"]?>_<?echo $i?>" class="star-voted"></div>
                <?else:?>
                    <div id="vote_<?echo $arResult["ID"]?>_<?echo $i?>" class="star-empty"></div>
				<?endif?>
			<?endforeach?>
		<?else:?>
			<?foreach($arResult["VOTE_NAMES"] as $i=>$name):?>
				<div id="vote_<?echo $arResult["ID"]?>_<?echo $i?>" class="star" title="<?echo $name?>"></div>
			<?endforeach?>
		<?endif?>
	<?else:
		$onclick = "voteScript.do_vote(this, 'vote_".$arResult["ID"]."', ".$arResult["AJAX_PARAMS"].")";?>
		<?if($DISPLAY_VALUE):?>
			<?foreach($arResult["VOTE_NAMES"] as $i=>$name):?>
				<?if(round($DISPLAY_VALUE) > $i):?>
                    <div id="vote_<?echo $arResult["ID"]?>_<?echo $i?>" class="star-active star-voted" onmouseover="voteScript.trace_vote(this, true);" onmouseout="voteScript.trace_vote(this, false)" onclick="<?echo htmlspecialchars($onclick);?>"></div>
				<?else:?>
                    <div id="vote_<?echo $arResult["ID"]?>_<?echo $i?>" class="star-active star-empty" onmouseover="voteScript.trace_vote(this, true);" onmouseout="voteScript.trace_vote(this, false)" onclick="<?echo htmlspecialchars($onclick)?>"></div>
				<?endif?>
			<?endforeach?>
		<?else:?>
			<?foreach($arResult["VOTE_NAMES"] as $i=>$name):?>
                <div id="vote_<?echo $arResult["ID"]?>_<?echo $i?>" class="star-active star-empty" onmouseover="voteScript.trace_vote(this, true);" onmouseout="voteScript.trace_vote(this, false)" onclick="<?echo htmlspecialchars($onclick)?>"></div>
			<?endforeach?>
		<?endif?>
	<?endif?>
</div>