<?include( './public/tpl/header.php' );?>
			<div id="content" class="registration-content web-content">
				<div class="wrapper">
					<div class="content clearfix">

						<div class="flex__block content__op">
							<?include( './public/tpl/second-sidebar.php' );?>

						</div>

						<div class="right-col rad">
							<div class="breadcrumbs">
								<a href="/" class="url rg">Главная</a><i class="fas fa-arrow-right"></i><a href="/" class="url rg">Личный кабинет</a><i class="fas fa-arrow-right"></i><span class="url rg">Регистрация</span>
							</div>
							<ul class="sidebar-menu sidebar-menu__sm">
								<li>
									<a href="#">
										Профиль
										<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"/>
											<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"/>
										</svg>
									</a>
								</li>
								<li>
									<a href="#">
										Сменить пароль
										<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"/>
											<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"/>
										</svg>
									</a>
								</li>
								<li>
									<a href="#">
										История заказов
										<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"/>
											<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"/>
										</svg>
									</a>
								</li>
								<li>
									<a href="#">
										Выбор автомобиля
										<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"/>
											<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"/>
										</svg>
									</a>
								</li>
								<li>
									<a href="#">
										Выйти
										<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"/>
											<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"/>
										</svg>
									</a>
								</li>
							</ul>
							<h2 class="shop__title category rg">Регистрация</h2>
							<div class="registration-block">
								<img src="public/img/pictures/checkform.png" alt="">
								<p>
									Зарегистрируйтесь, чтобы использовать все возможности личного кабинета: отслеживание заказов, настройку подписки, связи с социальными сетями и другое.
								</p>
								<p>
									Уже зарегистрирована? <a href="#">Войдите</a> в личный кабинет.
								</p>
								<p>
									Мы никогда и ни при каких условиях не разглашаем личные данные клиентов. Контактная информация будет использована только для оформления заказов и более удобной работы с сайтом.
								</p>
							</div>
							<form method="post">
									<div class="checkout-block checkout-flex">
										<div class="checkout-buttons">
											<label class="checkcontainer ways-nav physical-nav">Физическое лицо
											  <input type="radio" name="type">
											  <span class="radiobtn"></span>
											</label>
											<label class="checkcontainer ways-nav juridical-nav">Юридическое лицо
											  <input type="radio" name="type">
											  <span class="radiobtn"></span>
											</label>
										</div>
									</div>
									<div class="checkout-block ways-block">
											<div class="checkout-buttons physical">
												<label class="customer-element">
													<p>
														ФИО <span>*</span>
													</p>
													<input type="text" class="form-element">
												</label>
												<label class="customer-element">
													<p>
														E-mail (Логин)<span>*</span>
													</p>
													<input type="text" class="form-element">
												</label>
												<label class="customer-element">
													<p>
														Телефон <span>*</span>
													</p>
													<input type="text" class="form-element">
												</label>
												<label>
													<p>
														Пароль <span>*</span>
													</p>
													<input type="text" class="form-element">
												</label>
												<label>
													<p>
														Подтверждение пароля <span>*</span>
													</p>
													<input type="text" class="form-element">
												</label>
												<button class="web-main-btn">
													Зарегистрироваться
												</button>
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
														Контактное лицо <span>*</span>
													</p>
													<input type="text" class="form-element">
												</label>
												<label class="customer-element">
													<p>
														E-mail (Логин) <span>*</span>
													</p>
													<input type="text" class="form-element">
												</label>
												<label class="customer-element">
													<p>
														Телефон <span>*</span>
													</p>
													<input type="text" class="form-element">
												</label>
												<label>
													<p>
														Пароль <span>*</span>
													</p>
													<input type="text" class="form-element">
												</label>
												<label>
													<p>
														Подтверждение пароля <span>*</span>
													</p>
													<input type="text" class="form-element">
												</label>
												<button class="web-main-btn">
													Зарегистрироваться
												</button>
											</div>
									</div>
							</form>
							<div class="breadcrumbs">
                <a href="/" class="url rg">Главная</a><i class="fas fa-arrow-right"></i><a href="/" class="url rg">Личный кабинет</a><i class="fas fa-arrow-right"></i><span class="url rg">Регистрация</span>
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
			<div class="modal-window web-modal" id="login-modal">
				<div class="overlay"></div>
				<div class="wrapper">
					<div class="modal modal-review">
						<div class="close main_flex flex__align-items_center flex__jcontent_center">
							<img class="svg" src="./public/img/icon/cancel.svg" width="22">
						</div>
						<p class="web-title">
							Личный кабинет
						</p>
						<form method="post">
							<label class="form-block">
								<p>
									Логин *
								</p>
								<input type="text" class="form-element">
							</label>
							<label class="form-block">
								<p>
									Пароль *
								</p>
								<input type="password" class="form-element">
							</label>
							<div class="form-item">
								<label class="checkcontainer ways-nav">Запомнить меня
								  <input type="radio" name="type">
								  <span class="radiobtn"></span>
								</label>
								<a href="#">
									Забыли пароль?
								</a>
							</div>
							<div class="buttons-block">
								<button type="submit" class="web-main-btn">
									Войти
								</button>
								<button type="submit" class="web-main-btn">
									Регистрация
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
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
				$('.btn-login').click(function(){
					$('#login-modal').show();
				});
			</script>
		</body>
		</html>
