<!-- Footer -->
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45 footer-mob">
	<div class="flex-w p-b-90 footer-mob__wrap">
		<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3 footer-mob__item">
			<h4 class="s-text12 p-b-30 footer-mob__title">
				Мы в социальных сетях
			</h4>

			<div>
				<div class="flex-m" style="flex-direction: column;align-items: flex-start;">
					<!--<a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>-->
					<a href="https://www.instagram.com/beautycareshop.ru/" class="fs-18 color1 p-r-20 p-b-20 fa fa-instagram"></a>
					<a class="s-text12" href="tel:84951288802">8-495-128-88-02</a>
					<a class="s-text12" href="mailto:careshopb@gmail.com">careshopb@gmail.com</a>
					<!--<a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>-->
					<!--<a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>-->
					<!--<a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>-->
				</div>
			</div>
		</div>

		<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4 footer-mob__item">
			<h4 class="s-text12 p-b-30 footer-mob__title">
				КАТАЛОГ
			</h4>
			<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"bottom_menu",
					array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MENU_CACHE_TIME" => "360000",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_USE_GROUPS" => "N",
							"ROOT_MENU_TYPE" => "bottom_catalog",
							"USE_EXT" => "N",
							"COMPONENT_TEMPLATE" => "bottom_menu"
					),
					false
			);?>
		</div>

		<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4 footer-mob__item">
			<h4 class="s-text12 p-b-30 footer-mob__title">
				Разделы
			</h4>
			<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"bottom_menu",
					array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MENU_CACHE_TIME" => "360000",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_USE_GROUPS" => "N",
							"ROOT_MENU_TYPE" => "bottom_section",
							"USE_EXT" => "N",
							"COMPONENT_TEMPLATE" => "bottom_menu"
					),
					false
			);?>
		</div>

		<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4 footer-mob__item">
			<h4 class="s-text12 p-b-30 footer-mob__title">
				Помощь
			</h4>
			<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"bottom_menu",
					array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MENU_CACHE_TIME" => "360000",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_USE_GROUPS" => "N",
							"ROOT_MENU_TYPE" => "bottom_help",
							"USE_EXT" => "N",
							"COMPONENT_TEMPLATE" => "bottom_menu"
					),
					false
			);?>
		</div>

		<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3 footer-mob__item">
			<h4 class="s-text12 p-b-30 footer-mob__title">
				Newsletter
			</h4>

			<form>
				<div class="effect1 w-size9">
					<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
					<span class="effect1-line"></span>
				</div>

				<div class="w-size2 p-t-20">
					<!-- Button -->
					<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
						Subscribe
					</button>
				</div>

			</form>
		</div>
	</div>

	<div class="t-center p-l-15 p-r-15">
		<a href="#">
			<img class="h-size2" src="<?= SITE_TEMPLATE_PATH ?>/images/icons/paypal.png" alt="IMG-PAYPAL">
		</a>

		<a href="#">
			<img class="h-size2" src="<?= SITE_TEMPLATE_PATH ?>/images/icons/visa.png" alt="IMG-VISA">
		</a>

		<a href="#">
			<img class="h-size2" src="<?= SITE_TEMPLATE_PATH ?>/images/icons/mastercard.png" alt="IMG-MASTERCARD">
		</a>

		<a href="#">
			<img class="h-size2" src="<?= SITE_TEMPLATE_PATH ?>/images/icons/express.png" alt="IMG-EXPRESS">
		</a>

		<a href="#">
			<img class="h-size2" src="<?= SITE_TEMPLATE_PATH ?>/images/icons/discover.png" alt="IMG-DISCOVER">
		</a>

		<div class="t-center s-text8 p-t-20">
			Интернет-магазин «beautycareshop.ru». Общество с ограниченной ответственностью «Сигма-М»
		</div>
	</div>
</footer>

<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
	<span class="symbol-btn-back-to-top">
		<i class="fa fa-angle-double-up" aria-hidden="true"></i>
	</span>
</div>

<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>

<div style="display: none; width: 350px;" id="modal-fast-wrap">
	<form action="" method="POST" class="modal-fast__wrap">
		<div class="modal-fast__title">Быстрый заказ</div>

		<label class="modal-fast__label-contacts">
			<input class="modal-fast__input-contacts" type="tel" inputmode="tel" name="fast-phone" placeholder="+7(___) ___ -__-__" onkeyup="this.setAttribute('value', this.value);" value="">

			<span class="modal-fast__title-contact phone">
				Телефон: <span> *</span>
			</span>
		</label>

		<input type="submit" class="modal-fast__btn-send" name="submit" value="Отправить">
	</form>
</div>
<?
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/library/jquery/jquery-3.2.1.min.js" );
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/library/animsition/js/animsition.min.js" );
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/library/bootstrap/js/popper.js" );
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/library/bootstrap/js/bootstrap.min.js" );
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/library/select2/select2.min.js" );
?>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<?/*?>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/library/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/library/animsition/js/animsition.min.js"></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/library/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/library/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/library/select2/select2.min.js"></script>
<?*/?>
<script type="text/javascript">
	$(".selection-1").select2({
		minimumResultsForSearch: 20,
		dropdownParent: $('#dropDownSelect1')
	});
</script>
<?
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/library/slick/slick.min.js" );
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/slick-custom.js" );
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/library/countdowntime/countdowntime.js" );
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/library/lightbox2/js/lightbox.min.js" );
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/library/sweetalert/sweetalert.min.js" );
?>
<?/*?>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/library/slick/slick.min.js"></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/slick-custom.js"></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/library/countdowntime/countdowntime.js"></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/library/lightbox2/js/lightbox.min.js"></script>
<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/library/sweetalert/sweetalert.min.js"></script>
<?*/?>
<script type="text/javascript">
	$('.block2-btn-addcart').each(function() {
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function() {
			swal(nameProduct, "is added to cart !", "success");
		});
	});

	$('.block2-btn-addwishlist').each(function() {
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function() {
			swal(nameProduct, "is added to wishlist !", "success");
		});
	});
</script>

<!--===============================================================================================-->
</script>
<?
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/main.js" );
?>
<?/*?>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/main.js"></script>
<?*/?>
<script type='application/ld+json'>
	{
		"@context": "https://www.schema.org",
		"@type": "WebSite",
		"name": "Beautycareshop",
		"url": "https://beautycareshop.ru/"
	}
</script>
<script type='application/ld+json'>
	{
		"@context": "https://www.schema.org",
		"@type": "LocalBusiness",
		"name": "Beautycareshop",
		"url": "https://beautycareshop.ru/",
		"logo": "https://beautycareshop.ru/bitrix/templates/cosmetik_rf/images/icons/logo.png",
		"image": "https://beautycareshop.ru/bitrix/templates/cosmetik_rf/images/icons/logo.png",
		"description": "Мы предлагаем широкий ассортимент качественной косметки по адекватным ценам.",
		"telephone": "8 (495) 128-88-02",
		"email": "careshopb@gmail.com",
		"priceRange": "RUB",
		"address": {
			"@type": "PostalAddress",
			"streetAddress": "ул. Прянишникова, д. 5А. оф.123",
			"addressLocality": "Москва",
			"postalCode": "127550 ",
			"addressCountry": "Россия"
		}
	}
</script>

</body>

</html>