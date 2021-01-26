<?include( './public/tpl/header.php' );?>
			<div id="content" class="checkout-content">
				<div class="wrapper">
					<div class="content clearfix">

						<div class="flex__block content__op">
							<?include( './public/tpl/second-sidebar.php' );?>
						</div>
						<div class="right-col rad">
							<div class="breadcrumbs">
								<a href="/" class="url rg">Главная</a><i class="fas fa-arrow-right"></i><a href="/" class="url rg">Личный кабинет</a><i class="fas fa-arrow-right"></i><a href="/" class="url rg">Корзина</a><i class="fas fa-arrow-right"></i><span class="url rg">Оформление заказа</span>
							</div>
							<h2 class="shop__title category rg">Оформление заказа</h2>
							<form method="post">
								<div class="checkout-block">
									<div class="checkout-title">
										Тип покупателя
									</div>
									<div class="checkout-buttons">
										<a href="#" class="item__list--link" data-target="#ways-block">
											<label class="checkcontainer ways-nav physical-nav">Физическое лицо
											  <input type="radio" name="type">
											  <span class="radiobtn"></span>
											</label>
										</a>
										<a href="#" class="item__list--link" data-target="#ways-block">
											<label class="checkcontainer ways-nav juridical-nav">Юридическое лицо
											  <input type="radio" name="type">
											  <span class="radiobtn"></span>
											</label>
										</a>
									</div>
								</div>

								<div class="checkout-block ways-block" id="ways-block">
									<div class="checkout-title">
										Способ доставки
									</div>
									<div class="checkout-buttons">
										<div class="subtitle">
											Доставка по Минску
										</div>
										<div class="checkout-elements">
											<a href="#" class="item__list--link" data-target="#payment-method">
											<label class="checkcontainer payment-nav">Доставка по Минску
											  <input type="radio" name="way">
											  <span class="radiobtn"></span>
											</label>
											</a>
											<div class="info-block">
												<p class="price">
													Стоимость:
													<span>
														7 BYN
													</span>
												</p>
												<ul>
													<li>
												    Доставка осуществляется в течение дня в удобное для вас время
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="checkout-buttons">
										<div class="subtitle">
											Самовывоз
										</div>
										<div class="checkout-elements">
												<label class="checkcontainer payment-nav pickup-nav item__list--link" data-target="#pickup-block">Забрать из магазина
												  <input id="pickup-inp" type="radio" name="way">
												  <span class="radiobtn"></span>
												</label>
											<div class="info-block">
												<p class="price">
													Стоимость:
													<span>
														бесплатно
													</span>
												</p>
												<ul>
													<li>
														Минск, ул. Орловская, д. 17
													</li>
													<li>
														ПН - ПТ 10:00 - 19:00
													</li>
													<li>
														СБ 10:00 - 16:00
													</li>
													<li>
														ВС выходной
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="checkout-buttons">
										<div class="subtitle">
											Доставка по Беларуси
										</div>
										<div class="checkout-elements">
											<a href="#" class="item__list--link" data-target="#payment-method">
												<label class="checkcontainer payment-nav">Курьерская служба
												  <input type="radio" name="way">
												  <span class="radiobtn"></span>
												</label>
											</a>
											<div class="info-block">
												<p class="price">
													Стоимость:
													<span>
														14 BYN
													</span>
												</p>
												<ul>
													<li>
														Доставка осуществляется в свободное для вас время.
													</li>
													<li>
														Доставка “до двери"
													</li>
													<li>
														Оплата при получении
													</li>
												</ul>
											</div>
										</div>
										<div class="checkout-elements">
											<a href="#" class="item__list--link" data-target="#payment-method">
												<label class="checkcontainer payment-nav">Маршруточное такси (по Беларуси)
												  <input type="radio" name="way">
												  <span class="radiobtn"></span>
												</label>
											</a>
											<div class="info-block">
												<p class="price">
													Стоимость:
													<span>
														25 BYN
													</span>
												</p>
												<ul>
													<li>
														Доставка осуществляется в свободное для вас время.
													</li>
													<li>
														Доставка “до двери"
													</li>
													<li>
														Оплата при получении
													</li>
												</ul>
											</div>
										</div>
										<div class="checkout-elements">
											<a href="#" class="item__list--link" data-target="#payment-method">
												<label class="checkcontainer payment-nav">Почтовым оператором
												  <input type="radio" name="way">
												  <span class="radiobtn"></span>
												</label>
											</a>
											<div class="info-block">
												<p class="price">
													Стоимость:
													<span>
														25 BYN
													</span>
												</p>
												<ul>
													<li>
														Доставка осуществляется в свободное для вас время.
													</li>
													<li>
														Доставка “до двери"
													</li>
													<li>
														Оплата при получении
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="checkout-block pickup-block" id="pickup-block">
									<div class="checkout-title">
										Самовывоз
									</div>
									<div class="map-block">
										<p class="web-title">
											Вам подарок!
										</p>
										<div id="map3"></div>
									</div>
								</div>
								<div class="checkout-block payment-element" id="payment-method">
									<div class="checkout-title">
										Оплата
									</div>
									<div class="checkout-description">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum magnam accusantium sapiente beatae laudantium sed laboriosam totam ipsa voluptas iste! Quam doloremque ipsam laborum aliquam incidunt provident molestias fugiat mollitia.
									</div>
									<div class="payment-block">
										<div class="img">
											<img src="public/img/pictures/cart1.png" alt="">
										</div>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni quos provident et, delectus pariatur accusantium nostrum, <a href="#">eligendi suscipit</a> nobis aliquid.
										</p>
										<div class="radio-btn">
											<label class="checkcontainer customer-nav item__list--link" data-target="#customer-block">
											  <input type="radio" name="cart">
											  <span class="radiobtn"></span>
											</label>
										</div>
									</div>
									<div class="payment-block">
										<div class="img">
											<img src="public/img/pictures/cart2.png" alt="">
										</div>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni quos provident et, delectus pariatur accusantium nostrum, eligendi suscipit nobis aliquid.
										</p>
										<div class="radio-btn">
											<label class="checkcontainer customer-nav item__list--link" data-target="#customer-block">
											  <input type="radio" name="cart">
											  <span class="radiobtn"></span>
											</label>
										</div>
									</div>
									<div class="payment-block">
										<div class="img">
											<img src="public/img/pictures/cart3.png" alt="">
										</div>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni quos provident et, delectus pariatur accusantium nostrum, eligendi suscipit <a href="#">nobis aliquid</a>.
										</p>
										<div class="radio-btn">
											<label class="checkcontainer customer-nav item__list--link" data-target="#customer-block">
											  <input type="radio" name="cart">
											  <span class="radiobtn"></span>
											</label>
										</div>
									</div>
									<div class="payment-block">
										<div class="img">
											<img src="public/img/pictures/cart4.png" alt="">
										</div>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni quos provident et, delectus pariatur accusantium nostrum, eligendi suscipit nobis aliquid.
										</p>
										<div class="radio-btn">
											<label class="checkcontainer customer-nav item__list--link" data-target="#customer-block">
											  <input type="radio" name="cart">
											  <span class="radiobtn"></span>
											</label>
										</div>
									</div>
									<div class="payment-block">
										<div class="img">
											<img src="public/img/pictures/cart5.png" alt="">
										</div>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat asperiores molestias alias reiciendis, sunt eum, quis recusandae rem, quam cum ad ea possimus. Atque sunt assumenda neque hic, dolorem eum excepturi. Facere sequi ducimus cupiditate repellat sed ut nulla deserunt?
										</p>
										<div class="radio-btn">
											<label class="checkcontainer customer-nav item__list--link" data-target="#customer-block">
											  <input type="radio" name="cart">
											  <span class="radiobtn"></span>
											</label>
										</div>
									</div>
									<div class="payment-block">
										<div class="img">

										</div>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident iure asperiores inventore corrupti iste repellat aut in dicta sunt excepturi, consequuntur voluptates tenetur a officiis quae cum dolorem ratione ab voluptatibus consectetur! Dolorum omnis beatae, iure facere, deleniti dolore neque aut! Quo in, laudantium repudiandae facere, quod rem a. Sunt magnam possimus placeat nulla fugit id veniam natus quis nobis!
										</p>
									</div>
									<div class="payment-block">
										<div class="img">

										</div>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni quos provident et, delectus pariatur accusantium nostrum, eligendi suscipit nobis aliquid.
										</p>
									</div>
									<div class="payment-block">
										<div class="img">
											<img src="public/img/pictures/cart6.png" alt="">
										</div>
										<p>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni quos provident et, delectus pariatur accusantium nostrum, eligendi suscipit nobis aliquid.
										</p>
										<div class="radio-btn">
											<label class="checkcontainer customer-nav item__list--link" data-target="#customer-block">
											  <input type="radio" name="cart">
											  <span class="radiobtn"></span>
											</label>
										</div>
									</div>
								</div>
								<div class="checkout-block customer-block" id="customer-block">
									<div class="checkout-title">
										Покупатель
									</div>
									<div class="checkout-buttons physical">
										<label class="customer-element">
											<p>
												ФИО <span>*</span>
											</p>
											<input type="text" class="form-element">
										</label>
										<label class="customer-element">
											<p>
												E-mail
											</p>
											<input type="text" class="form-element">
										</label>
										<label class="customer-element">
											<p>
												Телефон <span>*</span>
											</p>
											<input type="text" class="form-element">
										</label>
										<label class="customer-element">
											<p>
												Адрес доставки <span>*</span>
											</p>
											<textarea class="form-element"></textarea>
										</label>
										<label class="customer-element">
											<p>
												Комментрарий к заказу
											</p>
											<textarea class="form-element"></textarea>
										</label>
										<div class="web-total-block">
											<p class="old-price">
												291,60 BYN
											</p>
											<p class="saving">
												Экономия: 500 BYN
											</p>
											<div class="price-element small-elements">
												<p>
													Заказ
												</p>
												<div class="bordered"></div>
												<span>
													264,72 BYN
												</span>
											</div>
											<div class="price-element medium-elements">
												<p>
													Доставка
												</p>
												<div class="bordered"></div>
												<span>
													4 BYN
												</span>
											</div>
											<div class="price-element bold-elements">
												<p>
													ИТОГО
												</p>
												<div class="bordered"></div>
												<span>
													264,72 BYN
												</span>
											</div>
											<div class="buttons-element">
												<button type="submit" class="web-dotted-btn">
													вернуться
												</button>
												<button type="submit" class="web-main-btn">
													продолжить
												</button>
											</div>
										</div>
									</div>
									<div class="checkout-buttons juridical">
										<label class="customer-element">
											<p>
												Название организации <span>*</span>
											</p>
											<input type="text" class="form-element">
										</label>
										<label class="customer-element">
											<p>
												Юридический адрес <span>*</span>
											</p>
											<input type="text" class="form-element">
										</label>
										<label class="customer-element">
											<p>
												УНП <span>*</span>
											</p>
											<input type="text" class="form-element">
										</label>
										<label class="customer-element">
											<p>
												Банковские реквизиты <span>*</span>
											</p>
											<input type="text" class="form-element">
										</label>
										<label class="customer-element">
											<p>
												Контактное лицо <span>*</span>
											</p>
											<input type="text" class="form-element">
										</label>
										<label class="customer-element">
											<p>
												E-mail
											</p>
											<input type="text" class="form-element">
										</label>
										<label class="customer-element">
											<p>
												Телефон <span>*</span>
											</p>
											<textarea class="form-element"></textarea>
										</label>
										<label class="customer-element">
											<p>
												Адрес доставки <span>*</span>
											</p>
											<textarea class="form-element"></textarea>
										</label>
										<label class="customer-element">
											<p>
												Комментрарий к заказу
											</p>
											<textarea class="form-element"></textarea>
										</label>
										<div class="web-total-block">
											<p class="old-price">
												291,60 BYN
											</p>
											<p class="saving">
												Экономия: 500 BYN
											</p>
											<div class="price-element small-elements">
												<p>
													Заказ
												</p>
												<div class="bordered"></div>
												<span>
													264,72 BYN
												</span>
											</div>
											<div class="price-element medium-elements">
												<p>
													Доставка
												</p>
												<div class="bordered"></div>
												<span>
													4 BYN
												</span>
											</div>
											<div class="price-element bold-elements">
												<p>
													ИТОГО
												</p>
												<div class="bordered"></div>
												<span>
													264,72 BYN
												</span>
											</div>
											<div class="buttons-element">
												<button type="submit" class="web-dotted-btn">
													вернуться
												</button>
												<button type="submit" class="web-main-btn">
													продолжить
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>
							<div class="breadcrumbs">
								<a href="/" class="url rg">Главная</a><i class="fas fa-arrow-right"></i><a href="/" class="url rg">Личный кабинет</a><i class="fas fa-arrow-right"></i><a href="/" class="url rg">Корзина</a><i class="fas fa-arrow-right"></i><span class="url rg">Оформление заказа</span>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!--- end content --->

			<!--- client --->
			<div id="client">
				<div class="wrapper">
					<div class="client main_flex flex__align-items_center flex__jcontent_between">
						<a href="#" class="client__list">Способы оплаты</a>
						<a href="#" class="client__list">
							<img src="./public/img/client/1.png" alt="client">
						</a>
						<a href="#" class="client__list">
							<img class="svg" src="./public/img/icon/visa-pay-logo.svg" alt="visa" width="78">
						</a>
						<a href="#" class="client__list">
							<img class="svg" src="./public/img/icon/master-card-logo.svg" alt="master-card" width="78">
						</a>
						<a href="#" class="client__list">
							<img src="./public/img/client/4.png" alt="client">
						</a>
						<a href="#" class="client__list">
							<img class="svg" src="./public/img/icon/maestro-pay-logo.svg" alt="maestro" width="78">
						</a>
						<a href="#" class="client__list">
							<img src="./public/img/client/5.png" alt="client">
						</a>
						<a href="#" class="client__list">
							<img src="./public/img/client/6.png" alt="client">
						</a>
					</div>
				</div>
			</div>
			<!--- end client --->
			<!--- footer --->
			<div id="footer">
				<div class="wrapper">
					<div class="footer main_flex flex__align-items_start flex__jcontent_between">

						<div class="flex__block">
							<div class="footer__logo">
								<a href="index.html">
									<img src="./public/img/logo.png" alt="logo" class="logo">
								</a>
								<h4 class="bdi">9 лет на рынке беларуси</h4>
								<p class="rg footer__logo--p">© 2018 ОДО «АМ-Трейдер» Свидетельство №100253019, выдано Мингорисполкомом 18.04.2001 Юридический адрес: Беларусь, 220068, г. Минск, ул. Орловская, д. 17, пом. 2Н, магазин «Автотюнинг» УНП 100253019, ОКПО 14588310 Регистрационный номер в торговом реестре Республики Беларусь: 312657 от 23.03.2016</p>
								<div class="div">
									<p class="rg">Разработка сайта — <span>Polar Bear Web Studio</span></p>
								</div>
							</div>
						</div>

						<div class="flex__block flex__1">
							<div class="flex main_flex flex__align-items_start flex__jcontent_between">
								<div class="footer__title">
									<p class="rg">© 2018 ОДО «АМ-Трейдер» Свидетельство №100253019, выдано Мингорисполкомом 18.04.2001 Юридический адрес: Беларусь, 220068, г. Минск, ул. Орловская, д. 17, пом. 2Н, магазин «Автотюнинг» УНП 100253019, ОКПО 14588310 Регистрационный номер в торговом реестре Республики Беларусь: 312657 от 23.03.2016</p>
								</div>
								<div class="footer__contact">
									<p class="rg ft">Контактная информация</p>
									<div class="footer__phones">
										<div class="rg">
											<img class="svg icon" src="./public/img/icon/phone-call.svg"><span class="rg">+375 17</span> 210-17-76
										</div>
										<div class="rg">
											<img class="icon" src="./public/img/icon/logo_velcom_grey.svg"><span class="rg">+375 29</span> 635-65-65
										</div>
										<div class="rg">
											<img class="icon" src="./public/img/icon/logo_viber_grey.svg"><img class="icon" src="./public/img/icon/logo_whatsapp_grey.svg"><img class="icon last" src="./public/img/icon/logo_mts_grey.svg"><span class="rg">+375 33</span> 635-65-65
										</div>
										<div class="rg small"><img class="svg icon" src="./public/img/icon/maps-and-flags.svg">Минск, ул. Орловская, д. 17
										</div>
										<div class="rg sml">
											<img class="svg icon" src="./public/img/icon/wall-clock.svg">
											<span class="rg">ПН-ПТ ............</span> 9:00 &mdash; 19:00
										</div>
										<div class="rg sml"><span>................</span> (магазин с 10:00)</div>
										<div class="rg sml"><span class="rg">СБ ................</span> 10:00 &mdash; 16:00</div>
									</div>
								</div>

								<div class="footer__company flex__1">
									<p class="rg ft">О компании</p>
									<ul>
										<li><a href="#">О нас</a></li>
										<li><a href="#">Команда</a></li>
										<li><a href="#">Новости</a></li>
										<li><a href="#">Преимущества</a></li>
										<li><a href="#">Отзывы клиентов</a></li>
										<li><a href="#">Медиа</a></li>
										<li><a href="#">Контактная информация</a></li>
									</ul>
								</div>
								<div class="footer__service flex__1">
									<p class="rg ft">Сервис</p>
									<ul>
										<li><a href="#">Способы оплаты</a></li>
										<li><a href="#">Команда</a></li>
										<li><a href="#">Установка</a></li>
										<li><a href="#">Правила обмена и возврата</a></li>
										<li><a href="#">Гарантия</a></li>
										<li><a href="#">Помощь</a></li>
									</ul>
								</div>
								<div class="footer__acii flex__1">
									<p class="rg ft">Акции</p>
									<ul>
										<li><a href="#">Специальные предложения</a></li>
										<li><a href="#">Программа лояльности</a></li>
									</ul>
								</div>
							</div>
							<div class="div div1">
								<p class="rg">Разработка сайта — <a href="#">Polar Bear Web Studio</a></p>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!--- end footer --->

			<?include( './public/tpl/scripts.php' );?>
			<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
			<script>
				$(function() {
					$('.txt1 .all .toggler > button').click(function(){
						$(this).parent().toggleClass('active');
						$(this).parent().next('.txt-seo').slideToggle('slow');
						if ($(this).parent().hasClass('active')) {
							$(this).text('Показать меньше');
						} else {
							$(this).text('Показать больше');
						}
					});

					$('.item__list--link').click(function(e) {
						$('html, body').animate({
							scrollTop: $($(this).data('target')).offset().top - 150
						}, 1000);
					});

					$('.tag > li').click(function(){
						$(this).toggleClass('active');
						$(this).parents('.order').find('div.clear').addClass('active');
					});

					$('.order__block .clear').click(function(e) {
						e.stopPropagation();
						dropdownBtn = $(".cart .order__table .dropdown .dropdown-button");
						dropdownBtn.each(function(){
							$(this).text($(this).data('text')).removeClass('active close');
						})
						$(this).parent().next('.order__table').find("input[type=checkbox]").prop('checked', false);
						$( "#slider-range" ).slider({values: [0, 870]});
						$( "#amount-min" ).val($( "#slider-range" ).slider( "values", 0 ));
						$( "#amount-max" ).val($( "#slider-range" ).slider( "values", 1 ));
						$('.tag > li').removeClass('active');
						$(this).removeClass('active');
					});

					$('.order__table .dropdown-list > li').click(function(){
						$(this).parents('.order').find('div.clear').addClass('active');
					});

					$('.order__table input').change(function(){
						$(this).parents('.order').find('div.clear').addClass('active');
					});

					$( "#slider-range" ).slider({
						range: true,
						min: 0,
						max: 870,
						values: [ 0, 870 ],
						animate: true,
						step: 5,
						slide: function( event, ui ) {
							$( "#amount-min" ).val( ui.values[0]);
							$( "#amount-max" ).val( ui.values[1]);
							$(this).parents('.order').find('div.clear').addClass('active');
						}
					});

					$( "#amount-min" ).val($( "#slider-range" ).slider( "values", 0 ));
					$( "#amount-max" ).val($( "#slider-range" ).slider( "values", 1 ));

				});
				if($("#map3").length>0){
				ymaps.ready(init);
				  var myMap,
				      Placemarkmain;

				  function init(){
				      myMap = new ymaps.Map("map3", {
				          center: [53.932374, 27.560614],
				          zoom: 16
				      });
				       var zoomControl = new ymaps.control.ZoomControl({
				          options: {
				              size: "small",
				              position: {
				                left: "auto",
				                right: "40px",
				                top: "150px"
				              }
				          }
				      });
				      myMap.controls.remove(zoomControl);
				      myMap.controls.remove('geolocationControl');
				      myMap.controls.remove('searchControl');
				      myMap.controls.remove('trafficControl');
				      myMap.controls.remove('typeSelector');
				      myMap.controls.remove('fullscreenControl');
				      myMap.controls.remove('rulerControl');
				      myMap.controls.remove('zoomControl');
				      Placemarkmain = new ymaps.Placemark([53.932374, 27.560614], {}, {
				        iconLayout: 'default#image',
				        iconImageHref: 'public/img/pictures/map-marker.png',
				        iconImageSize: [34, 34],
				        iconImageOffset: [0, 0]
				      });
				      myMap.geoObjects.add(Placemarkmain);
				  }
				}
			</script>
		</body>
		</html>
