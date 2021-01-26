<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы");?><script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY0Xs_-2Dnsr1DL7fbJXhTEaM3P6SEJps&libraries=places"></script> <?php
function get_request_result($request)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $request);
    /*Храним сеанс в сессии*/
    curl_setopt($ch, CURLOPT_COOKIEFILE, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookiefile");
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookiefile");
    /**/

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);

    curl_close($ch);

    return json_decode($server_output, JSON_UNESCAPED_UNICODE);
}
$request_reviews = "https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJY_SN8H7F20YRMjVbJNt_qtI&key=AIzaSyDY0Xs_-2Dnsr1DL7fbJXhTEaM3P6SEJps";
$reviews_obj =  get_request_result($request_reviews);
usort($reviews_obj['result']['reviews'], function($a, $b){
    return $b['time'] <=> $a['time'];
});

?>
<div id="content" class="review-content">
	<div class="wrapper">
		<div class="content clearfix">
			 <? include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/inc/left-sidebar.php';?>
			<div class="right-col rad">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"template_bread",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
				<h2 class="shop__title category rg"><?=$APPLICATION->ShowTitle();?></h2>
				<h1 style=" text-align: center; color: white; ">Отзывы Яндекс</h1>
				<div style="width:100%;height:1240px;overflow:hidden;position:relative; ">
					<iframe style="width:100%;height:100%;border:1px solid #e6e6e6;border-radius:8px;box-sizing:border-box" src="https://yandex.ru/maps-reviews-widget/1166369455?comments"></iframe><a href="https://yandex.by/maps/org/avtotyuning/1166369455/" target="_blank" style="box-sizing:border-box;text-decoration:none;color:#b3b3b3;font-size:10px;font-family:YS Text,sans-serif;padding:0 20px;position:absolute;bottom:8px;width:100%;text-align:center;left:0">Автотюнинг на карте Минска — Яндекс.Карты</a>
				</div>
 <br>
				<h2 style=" text-align: center; color: white; ">Отзывы Google</h2>
				 <script src="https://apps.elfsight.com/p/platform.js" defer></script>
				<div class="elfsight-app-7f4aa572-4286-4660-9859-ecf7579dba44">
				</div>
				 <? if(CSite::InGroup(array(5,1))){ ?> <button class="abs bd avalaible review-btn">Оставить отзыв на нашем сайте</button>
				<?}else{?>
				<p style="color: white">
					Для того что бы оставить отзыв, нужно быть <a href="/auth/register/" style="color: #FFDB6B">зарегистрированным </a>
				</p>
				<?}?> <?if($arResult['REVIEWS']){
//            pr($arResult['REVIEWS']);
            foreach($arResult['REVIEWS'] as $review){
            ?>
				<div class="comments">
					<div class="comments__list main_flex__nowrap flex__align-items_start flex__jcontent_between">
						<div class="comments__list--user">
 <img width="73" src="/local/templates/auto/img/icon/avatar-inside-a-circle.svg">
						</div>
						<div class="comments__list--comment">
							<div class="name main_flex__nowrap flex__align-items_center flex__jcontent_between">
								<p class="rg">
									<?=$review['PROPERTY_NAME_VALUE'];?>
								</p>
								<div class="rating main_flex flex__align-items_center">
									 <?for ($i = 0; $i < $review['PROPERTY_SCORE_VALUE']; $i++) {?> <img width="20" src="/local/templates/auto/img/icon/star-favorite.svg" class="svg">
									<?}?>
								</div>
							</div>
							<p class="rg">
								<?=$review['PREVIEW_TEXT'];?>
							</p>
							<div class="date main_flex__nowrap flex__align-items_center flex__jcontent_between">
								<div class="date__like main_flex flex__align-items_center">
 <a href="<?if (!$USER->IsAuthorized()){echo 'javascript:void(0);';}else{echo '#';}?>" class="review_like <span id=" title=" Код PHP: &lt;?if (!$USER-&gt;IsAuthorized()){echo 'btn-login';}?&gt;"><?if (!$USER->IsAuthorized()){echo 'btn-login';}?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>" data-like="Y" data-review="<?=$review['ID']?>"&gt; <img width="20" src="/local/templates/auto/img/icon/thumbs-up.svg" class="svg cool"> </a>
									<p class="rg data_like<span id=" title="Код PHP: &lt;?=$review['ID']?&gt;">
										<?=$review['ID']?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>"&gt;<?=$review['LIKES']['LIKES'];?>
									</p>
 <a href="<?if (!$USER->IsAuthorized()){echo 'javascript:void(0);';}else{echo '#';}?>" class="review_like <span id=" title=" Код PHP: &lt;?if (!$USER-&gt;IsAuthorized()){echo 'btn-login';}?&gt;"><?if (!$USER->IsAuthorized()){echo 'btn-login';}?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>" data-like="N" data-review="<?=$review['ID']?>"&gt; <img width="20" src="/local/templates/auto/img/icon/thumbs-up.svg" class="svg hate"> </a>
									<p class="rg data_diz<span id=" title="Код PHP: &lt;?=$review['ID']?&gt;">
										<?=$review['ID']?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>"&gt;<?=$review['LIKES']['DIZ'];?>
									</p>
								</div>
								<div class="date__in">
									<p class="rg">
										<?=FormatDate("d F Y", MakeTimeStamp($review['ACTIVE_FROM']))?>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				 <?}?> <?}?>
				<div class="review-block">
					<div class="review-element">
						 <?foreach($reviews_obj['result']['reviews'] as $reviews){?>
						<div class="review-item">
							<div class="reviewer">
								<p class="name">
									<?=$reviews['author_name']?>
								</p>
								<p class="date">
									<?=date("d.m.Y", $reviews['time'])?>
								</p>
							</div>
							<div class="review-info">
								<p>
									<?=$reviews['text']?>
								</p>
							</div>
						</div>
						 <?}?>
					</div>
				</div>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"template_bread",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
			</div>
		</div>
	</div>
</div>
 <script>
   /* $('.review-btn').click(function () {
        document.location.href = 'https://search.google.com/local/writereview?placeid=ChIJY_SN8H7F20YRMjVbJNt_qtI';
    });*/
    BX.ajax.onload_951477 = function() {
    $('.eapps-widget-toolbar').attr('style',"display:none!important");

    $("a[href~='https://elfsight.com/google-reviews-widget/?utm_source=websites&utm_medium=clients&utm_content=google-reviews&utm_term=avtotuning.dopvavto.ru&utm_campaign=free-widget']").attr('style',"display:none!important");}
</script> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "standard.php",
		"PATH" => "/about/reviews/revi.php"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>