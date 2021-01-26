<?include( './public/tpl/header.php' );?>
			<div id="content" class="web-content pending-goods-content">
				<div class="wrapper">
					<div class="content main_flex flex__align-items_start flex__jcontent_between">

						<div class="flex__block content__op">

							<?include( './public/tpl/second-sidebar.php' );?>

						</div>

						<div class="right-col">
							<div class="breadcrumbs">
								<a href="/" class="url rg">Главная</a><i class="fas fa-arrow-right"></i><a href="/profile.html" class="url rg">Личный кабинет</a><i class="fas fa-arrow-right"></i><span class="url rg">Профиль</span>
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
							<div class="shop">
								<h2 class="shop__title rg" style="margin-top: 50px;">Профиль</h2>
								<div class="profile neon">
									<div class="profile__block main_flex flex__align-items_start flex__jcontent_between">
										<p class="rg">Аккаунт</p>
										<div class="profile__edit">
											<img class="svg" src="./public/img/icon/pencil-edit-button.svg" width="9">
											<span class="rg">Редактировать</span>
										</div>
										<!--- popup modal --->
										<div class="modal-window">
											<div class="overlay"></div>
											<div class="wrapper">
												<div class="modal">
													<div class="close main_flex flex__align-items_center flex__jcontent_center">
														<img class="svg" src="./public/img/icon/cancel.svg" width="22">
													</div>
													<p class="rg account">Аккаунт</p>
													<form action="" id="form--modal-1" class="ur-modal">
														<div class="form__name main_flex flex__align-items_center flex__jcontent_between">
															<p class="rg">Название организации</p>
															<input type="text" value="Текст Текст Текст">
														</div>
														<div class="form__name main_flex flex__align-items_center flex__jcontent_between">
															<p class="rg">Юридический адрес</p>
															<input type="text" value="Текст Текст Текст">
														</div>
														<div class="form__name main_flex flex__align-items_center flex__jcontent_between">
															<p class="rg">УНП &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
															<input type="text" value="Текст Текст Текст">
														</div>
														<div class="form__name main_flex flex__align-items_center flex__jcontent_between">
															<p class="rg">Банковские реквизиты</p>
															<input type="text" value="Текст Текст Текст">
														</div>
														<div class="form__name main_flex flex__align-items_center flex__jcontent_between">
															<p class="rg">Контактное лицо</p>
															<input type="text" value="Иван Иванович Иванов">
														</div>
														<div class="form__name main_flex flex__align-items_center flex__jcontent_between">
															<div class="flex__1">
																<div class="form__name--p main_flex flex__align-items_center">
																	<p class="rg">Электр. почта<br>(Логин)</p>
																	<input type="text" value="mail@gmail.com">
																</div>
															</div>
															<div class="flex__1">
																<div class="form__name--p main_flex flex__align-items_center">
																	<p class="rg label-mw">Телефон</p>
																	<input type="text" value="+375 (25) 255-55-55">
																</div>
															</div>
														</div>
													</form>
													<button class="abs">Сохранить</button>
												</div>
											</div>
										</div>
										<!--- end popup modal --->
									</div>
									<div class="profile__info main_flex flex__align-items_start flex__jcontent_between">
										<!--<div class="profile__info--img">
											<img src="./public/img/user.png" alt="user">
										</div>-->
										<div class="profile__info--block">
											<div class="profile__info--block--row">
												<p class="rg">Название организации</p>
												<div class="filler"></div>
												<p class="rg name">Текст Текст Текст</p>
											</div>
											<div class="profile__info--block--row">
												<p class="rg">Юридический адрес</p>
												<div class="filler"></div>
												<p class="rg name">Текст Текст Текст</p>
											</div>
											<div class="profile__info--block--row">
												<p class="rg">УНП</p>
												<div class="filler"></div>
												<p class="rg name">Текст Текст Текст</p>
											</div>
											<div class="profile__info--block--row">
												<p class="rg">Банковские реквизиты</p>
												<div class="filler"></div>
												<p class="rg name">Текст Текст Текст</p>
											</div>
											<div class="profile__info--block--row">
												<p class="rg">Контактное лицо</p>
												<div class="filler"></div>
												<p class="rg name">Иван Иванович Иванов</p>
											</div>
											<div class="profile__info--block--row">
												<p class="rg">Электронная почта(Логин)</p>
												<div class="filler"></div>
												<p class="rg name">mail@gmail.com</p>
											</div>
											<div class="profile__info--block--row">
												<p class="rg">Телефон</p>
												<div class="filler"></div>
												<p class="rg name">+375 25 255-55-55</p>
											</div>
										</div>


									</div>
								</div>

								<!--<div class="profile neon">
									<div class="profile__block main_flex flex__align-items_start flex__jcontent_between">
										<p class="rg">Пароль</p>
										<div class="profile__edit">
											<img class="svg" src="./public/img/icon/pencil-edit-button.svg" width="9">
											<span class="rg">Редактировать</span>
										</div>
										<div class="modal-window">
											<div class="overlay"></div>
											<div class="wrapper">
												<div class="modal">
													<div class="close main_flex flex__align-items_center flex__jcontent_center">
														<img class="svg" src="./public/img/icon/cancel.svg" width="22">
													</div>
													<p class="rg account">Пароль</p>
													<form action="" id="form--modal-2">
														<div class="form__name main_flex flex__align-items_center">
															<div class="w-100">
																<div class="form__name--p main_flex flex__align-items_center flex__jcontent_between">
																	<p class="rg">Текущий пароль</p>
																	<input type="password">
																</div>
																<div class="form__name--p main_flex flex__align-items_center flex__jcontent_between">
																	<p class="rg">Новый пароль</p>
																	<input type="password">
																</div>
																<div class="form__name--p main_flex flex__align-items_center flex__jcontent_between">
																	<p class="rg">Подтвердить новый пароль</p>
																	<input type="password">
																</div>
															</div>
														</div>
													</form>
													<button class="abs">Сохранить</button>
												</div>
											</div>
										</div>
									</div>
								</div>-->

								<div class="profile neon">
									<div class="profile__block main_flex flex__align-items_start flex__jcontent_between">
										<p class="rg">Адрес доставки</p>
										<div class="profile__edit">
											<img class="svg" src="./public/img/icon/pencil-edit-button.svg" width="9">
											<span class="rg">Редактировать</span>
										</div>
										<!--- popup modal --->
										<div class="modal-window">
											<div class="overlay"></div>
											<div class="wrapper">
												<div class="modal">
													<div class="close main_flex flex__align-items_center flex__jcontent_center">
														<img class="svg" src="./public/img/icon/cancel.svg" width="22">
													</div>
													<p class="rg account">Адрес доставки</p>
													<form action="" id="form--modal-3">
														<div class="form__name main_flex flex__align-items_center">
															<div class="w-100">
																<div class="form__name--p main_flex flex__align-items_center flex__jcontent_between">
																	<p class="rg">Адрес 1</p>
																	<input type="text" value="Барановичи, ул. Орловская, д. 17">
																</div>
															</div>
														</div>
													</form>
													<button class="abs">Сохранить</button>
												</div>
											</div>
										</div>
										<!--- end popup modal --->
									</div>
									<div class="block">Барановичи, ул. Орловская, д. 17</div>
								</div>

								<div class="profile neon">
									<div class="profile__block main_flex flex__align-items_start flex__jcontent_between">
										<p class="rg">Подписка на рассылку</p>
									</div>

									<div class="profile__check">
										<div class="profile__check--option">
											<div class="holder">
												<input type="checkbox" value="None" id="check-2" name="check-2" class="check-ios"/>
												<label for="check-2"></label>
												<span></span>
											</div>
											<div class="wd">
												<p class="rg">SMS-уведомления</p>
											</div>
										</div>
										<div class="profile__check--option">
											<div class="holder">
												<input type="checkbox" value="None" id="check-3" name="check-3" class="check-ios"/>
												<label for="check-3"></label>
												<span></span>
											</div>
											<div class="wd">
												<p class="rg">Email-рассылки об акциях и специальных предложениях</p>
											</div>
										</div>
									</div>
								</div>

								<!--<div class="profile neon">
									<div class="profile__block main_flex flex__align-items_start flex__jcontent_between">
										<p class="rg">Социальные сети</p>
										<div class="profile__edit">
											<img class="svg" src="./public/img/icon/pencil-edit-button.svg" width="9">
											<span class="rg">Редактировать</span>
										</div>
										<div class="modal-window">
											<div class="overlay"></div>
											<div class="wrapper">
												<div class="modal">
													<div class="close main_flex flex__align-items_center flex__jcontent_center">
														<img class="svg" src="./public/img/icon/cancel.svg" width="22">
													</div>
													<p class="rg account">Социальные сети</p>
													<form action="" id="form--modal-4">
														<div class="form__name main_flex flex__align-items_center flex__jcontent_between">
															<div class="flex__1">
																<div class="form__name--p main_flex flex__align-items_center">
																	<p class="rg">Вконтакте</p>
																	<input type="text">
																</div>
																<div class="form__name--p main_flex flex__align-items_center">
																	<p class="rg">Facebook</p>
																	<input type="text">
																</div>
																<div class="form__name--p main_flex flex__align-items_center">
																	<p class="rg">ОК</p>
																	<input type="text">
																</div>
															</div>
															<div class="flex__1">
																<div class="form__name--p main_flex flex__align-items_center">
																	<p class="rg">LinkedIn</p>
																	<input type="text">
																</div>
																<div class="form__name--p main_flex flex__align-items_center">
																	<p class="rg">Pinterest</p>
																	<input type="text">
																</div>
																<div class="form__name--p main_flex flex__align-items_center">
																	<p class="rg">Instagram</p>
																	<input type="text">
																</div>
															</div>
														</div>
													</form>
													<button class="abs">Сохранить</button>
												</div>
											</div>
										</div>
									</div>

									<ul class="main_flex flex__align-items_start row">
										<li>
											<a href="#" class="profile__icon vk">
												<img class="svg" src="./public/img/icon/vk.svg">
											</a>
										</li>
										<li>
											<a href="#" class="profile__icon fb">
												<img class="svg" src="./public/img/icon/facebook-logo.svg">
											</a>
										</li>
										<li>
											<a href="#" class="profile__icon od">
												<img class="svg" src="./public/img/icon/odnoklassniki-logo.svg">
											</a>
										</li>
										<li>
											<a href="#" class="profile__icon tw inactive">
												<img class="svg" src="./public/img/icon/twitter-logo.svg">
											</a>
										</li>
										<li>
											<a href="#" class="profile__icon gl inactive">
												<img class="svg" src="./public/img/icon/google-plus-logo.svg">
											</a>
										</li>
										<li>
											<a href="#" class="profile__icon in inactive">
												<img class="svg" src="./public/img/icon/linkedin.svg">
											</a>
										</li>
										<li>
											<a href="#" class="profile__icon pi inactive">
												<img class="svg" src="./public/img/icon/pinterest.svg">
											</a>
										</li>
										<li>
											<a href="#" class="profile__icon ins inactive">
												<img class="svg" src="./public/img/icon/instagram-logo.svg">
											</a>
										</li>
									</ul>
								</div> -->
							</div>

							<div class="breadcrumbs">
								<a href="/" class="url rg">Главная</a><i class="fas fa-arrow-right"></i><a href="/profile.html" class="url rg">Личный кабинет</a><i class="fas fa-arrow-right"></i><span class="url rg">Профиль</span>
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
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 473.806 473.806" style="enable-background:new 0 0 473.806 473.806;" xml:space="preserve" class="svg icon replaced-svg">
<g>
	<g>
		<path d="M374.456,293.506c-9.7-10.1-21.4-15.5-33.8-15.5c-12.3,0-24.1,5.3-34.2,15.4l-31.6,31.5c-2.6-1.4-5.2-2.7-7.7-4    c-3.6-1.8-7-3.5-9.9-5.3c-29.6-18.8-56.5-43.3-82.3-75c-12.5-15.8-20.9-29.1-27-42.6c8.2-7.5,15.8-15.3,23.2-22.8    c2.8-2.8,5.6-5.7,8.4-8.5c21-21,21-48.2,0-69.2l-27.3-27.3c-3.1-3.1-6.3-6.3-9.3-9.5c-6-6.2-12.3-12.6-18.8-18.6    c-9.7-9.6-21.3-14.7-33.5-14.7s-24,5.1-34,14.7c-0.1,0.1-0.1,0.1-0.2,0.2l-34,34.3c-12.8,12.8-20.1,28.4-21.7,46.5    c-2.4,29.2,6.2,56.4,12.8,74.2c16.2,43.7,40.4,84.2,76.5,127.6c43.8,52.3,96.5,93.6,156.7,122.7c23,10.9,53.7,23.8,88,26    c2.1,0.1,4.3,0.2,6.3,0.2c23.1,0,42.5-8.3,57.7-24.8c0.1-0.2,0.3-0.3,0.4-0.5c5.2-6.3,11.2-12,17.5-18.1c4.3-4.1,8.7-8.4,13-12.9    c9.9-10.3,15.1-22.3,15.1-34.6c0-12.4-5.3-24.3-15.4-34.3L374.456,293.506z M410.256,398.806    C410.156,398.806,410.156,398.906,410.256,398.806c-3.9,4.2-7.9,8-12.2,12.2c-6.5,6.2-13.1,12.7-19.3,20    c-10.1,10.8-22,15.9-37.6,15.9c-1.5,0-3.1,0-4.6-0.1c-29.7-1.9-57.3-13.5-78-23.4c-56.6-27.4-106.3-66.3-147.6-115.6    c-34.1-41.1-56.9-79.1-72-119.9c-9.3-24.9-12.7-44.3-11.2-62.6c1-11.7,5.5-21.4,13.8-29.7l34.1-34.1c4.9-4.6,10.1-7.1,15.2-7.1    c6.3,0,11.4,3.8,14.6,7c0.1,0.1,0.2,0.2,0.3,0.3c6.1,5.7,11.9,11.6,18,17.9c3.1,3.2,6.3,6.4,9.5,9.7l27.3,27.3    c10.6,10.6,10.6,20.4,0,31c-2.9,2.9-5.7,5.8-8.6,8.6c-8.4,8.6-16.4,16.6-25.1,24.4c-0.2,0.2-0.4,0.3-0.5,0.5    c-8.6,8.6-7,17-5.2,22.7c0.1,0.3,0.2,0.6,0.3,0.9c7.1,17.2,17.1,33.4,32.3,52.7l0.1,0.1c27.6,34,56.7,60.5,88.8,80.8    c4.1,2.6,8.3,4.7,12.3,6.7c3.6,1.8,7,3.5,9.9,5.3c0.4,0.2,0.8,0.5,1.2,0.7c3.4,1.7,6.6,2.5,9.9,2.5c8.3,0,13.5-5.2,15.2-6.9    l34.2-34.2c3.4-3.4,8.8-7.5,15.1-7.5c6.2,0,11.3,3.9,14.4,7.3c0.1,0.1,0.1,0.1,0.2,0.2l55.1,55.1    C420.456,377.706,420.456,388.206,410.256,398.806z"></path>
		<path d="M256.056,112.706c26.2,4.4,50,16.8,69,35.8s31.3,42.8,35.8,69c1.1,6.6,6.8,11.2,13.3,11.2c0.8,0,1.5-0.1,2.3-0.2    c7.4-1.2,12.3-8.2,11.1-15.6c-5.4-31.7-20.4-60.6-43.3-83.5s-51.8-37.9-83.5-43.3c-7.4-1.2-14.3,3.7-15.6,11    S248.656,111.506,256.056,112.706z"></path>
		<path d="M473.256,209.006c-8.9-52.2-33.5-99.7-71.3-137.5s-85.3-62.4-137.5-71.3c-7.3-1.3-14.2,3.7-15.5,11    c-1.2,7.4,3.7,14.3,11.1,15.6c46.6,7.9,89.1,30,122.9,63.7c33.8,33.8,55.8,76.3,63.7,122.9c1.1,6.6,6.8,11.2,13.3,11.2    c0.8,0,1.5-0.1,2.3-0.2C469.556,223.306,474.556,216.306,473.256,209.006z"></path>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg><span class="rg">+375 17</span> 210-17-76
											</div>
											<div class="rg">
												<img class="icon" src="./public/img/icon/logo_velcom_grey.svg"><span class="rg">+375 29</span> 635-65-65
											</div>
											<div class="rg">
												<img class="icon" src="./public/img/icon/logo_viber_grey.svg"><img class="icon" src="./public/img/icon/logo_whatsapp_grey.svg"><img class="icon last" src="./public/img/icon/logo_mts_grey.svg"><span class="rg">+375 33</span> 635-65-65
											</div>
											<div class="rg small"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" class="svg icon replaced-svg">
<g>
	<g>
		<path d="M256,0C153.755,0,70.573,83.182,70.573,185.426c0,126.888,165.939,313.167,173.004,321.035    c6.636,7.391,18.222,7.378,24.846,0c7.065-7.868,173.004-194.147,173.004-321.035C441.425,83.182,358.244,0,256,0z M256,469.729    c-55.847-66.338-152.035-197.217-152.035-284.301c0-83.834,68.202-152.036,152.035-152.036s152.035,68.202,152.035,152.035    C408.034,272.515,311.861,403.37,256,469.729z"></path>
	</g>
</g>
<g>
	<g>
		<path d="M256,92.134c-51.442,0-93.292,41.851-93.292,93.293s41.851,93.293,93.292,93.293s93.291-41.851,93.291-93.293    S307.441,92.134,256,92.134z M256,245.328c-33.03,0-59.9-26.871-59.9-59.901s26.871-59.901,59.9-59.901s59.9,26.871,59.9,59.901    S289.029,245.328,256,245.328z"></path>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>Минск, ул. Орловская, д. 17
											</div>
											<div class="rg sml">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" class="svg icon replaced-svg">
<g>
	<g>
		<path d="M256,0C114.497,0,0,114.507,0,256c0,141.503,114.508,256,256,256c141.503,0,256-114.507,256-256    C512,114.497,397.492,0,256,0z M256,472c-119.393,0-216-96.615-216-216c0-119.393,96.616-216,216-216    c119.393,0,216,96.615,216,216C472,375.393,375.384,472,256,472z"></path>
	</g>
</g>
<g>
	<g>
		<path d="M366.29,298.85L276,244.676V96c0-11.046-8.954-20-20-20s-20,8.954-20,20v160c0,7.025,3.686,13.535,9.71,17.15l100,60    c9.471,5.683,21.758,2.611,27.439-6.86C378.833,316.818,375.762,304.533,366.29,298.85z"></path>
	</g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>
												<span class="rg">ПН-ПТ ............</span> 9:00 — 19:00
											</div>
											<div class="rg sml"><span>................</span> (магазин с 10:00)</div>
											<div class="rg sml"><span class="rg">СБ ................</span> 10:00 — 16:00</div>
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

			<script src="./public/js/datepicker-ru.js"></script>
			<?include( './public/tpl/scripts.php' );?>
			<script>

				$(function(){
					$('.profile__edit').click(function(){
						$(this).next('.modal-window').show();
					});

					$('.check-ios').change(function(){
						$(this).parents('.profile__check--option').toggleClass('active');
					});

					$(".calendar").datepicker({
						dateFormat: 'd MM yy',
						firstDay: 1
					});

					$(document).on('click', '.date-picker .input', function(){
						$(this).parents('.date-picker').toggleClass('open');
					});

					$(".calendar").on("change",function(){
						var $me = $(this),
						$selected = $me.val(),
						$parent = $me.parents('.date-picker');
						$parent.find('.result').children('span').html($selected);
					});
				});

			</script>
		</body>
		</html>
