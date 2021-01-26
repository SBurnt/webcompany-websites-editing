<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Avtotuning</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Avtotuning компания" />
		<!-- <link rel="icon" type="image/png" sizes="32x32" href="./public/img/favicon/favicon-32x32.png" />
			<link rel="icon" type="image/png" sizes="16x16" href="./public/img/favicon/favicon-16x16.png" /> -->
			<meta name="theme-color" content="#eeeeee" />
			<!-- Chrome, Firefox OS and Opera -->
			<meta name="theme-color" content="#eeeeee" />
			<!-- Windows Phone -->
			<meta name="msapplication-navbutton-color" content="#eeeeee" />
			<!-- iOS Safari -->
			<meta name="apple-mobile-web-app-status-bar-style" content="#eeeeee" />

			<!--- fonts google --->
			<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic" rel="stylesheet">

			<!--- stylesheet CSS -->
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
			<link rel="stylesheet" href="./public/css/jquery.fancybox.min.css">
			<link rel="stylesheet" href="./public/css/owlcarousel/owl.carousel.min.css">
			<link rel="stylesheet" href="./public/css/owlcarousel/owl.theme.default.min.css">
			<link rel="stylesheet" href="./public/css/flipclock.css">
			<link rel="stylesheet" href="./public/css/carousel.css">
			<link rel="stylesheet" href="./public/css/flex.css">
			<link rel="stylesheet" href="./public/css/style.css">
			<link rel="stylesheet" href="./public/css/web-style.css">

			<!--- scripts ---->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
			<script src="./public/js/flipclock.js"></script>
			<script src="https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		</head>
		<body>
			<!--- header --->
			<div id="header">
				<div class="wrapper">
					<div class="header main_flex flex__align-items_center flex__jcontent_between">
						<div class="header__logo">
							<a href="index.html">
								<img src="./public/img/logo.png" alt="logo" class="logo">
							</a>
							<p class="bdi">10 лет на рынке Беларуси </p>
						</div>
						<div class="header__address">
							<div class="header__address--icon main_flex__nowrap flex__align-items_center">
								<img class="svg icon" src="./public/img/icon/maps-and-flags.svg">
								<a href="https://www.google.com/maps/place/%D1%83%D0%BB.+%D0%9E%D1%80%D0%BB%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F+17,+%D0%9C%D0%B8%D0%BD%D1%81%D0%BA,+%D0%91%D0%B5%D0%BB%D0%B0%D1%80%D1%83%D1%81%D1%8C/@53.9319269,27.5588165,17z/data=!3m1!4b1!4m5!3m4!1s0x46dbcf79982616bf:0x10dbc0fa3639f24c!8m2!3d53.9319238!4d27.5610052?hl=ru-KG" target="_blank" class="rg">Минск, ул. Орловская, д. 17</a>
							</div>
							<div class="header__address--icon main_flex__nowrap flex__align-items_center">
								<img class="svg icon" src="./public/img/icon/wall-clock.svg">
								<p class="rg"><span class="rg">ПН-ПТ</span> 9:00 - 19:00</p>
							</div>
							<p class="rg fx">(магазин с 10:00)</p>
							<p class="rg fx"><span class="rg">СБ</span> 10:00 - 16:00, <span class="rg">ВС</span> выходной</p>
						</div>
						<div class="header__phones">
							<div class="header__address--icon main_flex__nowrap flex__align-items_center fx1">
								<img class="svg icon" src="./public/img/icon/phone-call.svg">
								<a href="#" class="rg"><span class="rg">+375 17</span> 210-17-76</a>
							</div>
							<div class="header__address--icon main_flex__nowrap flex__align-items_center fx1">
								<img class="icon" src="./public/img/icon/logo_velcom.svg">
								<a href="#" class="rg"><span class="rg">+375 29</span> 635-65-65</a>
							</div>
							<div class="header__address--icon main_flex__nowrap flex__align-items_center">
								<div class="tel main_flex__nowrap flex__align-items_center">
									<a href="#" class="inner-link">
										<img class="icon" src="./public/img/icon/logo_viber.svg">
									</a>
									<a href="#" class="inner-link">
										<img class="icon" src="./public/img/icon/logo_whatsapp.svg">
									</a>
									<img class="icon" src="./public/img/icon/logo_mts.svg">
								</div>
								<a href="#" class="rg"><span class="rg">+375 33</span> 635-65-65</a>
							</div>
						</div>
						<div class="header__form">
							<form action="" class="main_flex__nowrap flex__align-items_center">
								<input type="text" name="search" id="searchVal">
								<button type="submit" class="submit">
									<img src="public/img/pictures/magnifier.png" alt="">
								</button>
							</form>
						</div>
						<div class="header__mob-item">
							<a href="javascript:void(0);">
								<img class="icon" src="./public/img/icon/logo_velcom.svg">
								<img class="icon" src="./public/img/icon/logo_mts.svg">
								<span class="first-phone">635 - 65 - 65</span>
								<img class="right-arrow" src="public/img/pictures/arrow-bottom1.png" alt="">
							</a>
							<div class="hover-block">
								<p class="title">
									Мы находимся по адресу:
								</p>
								<div class="info-block">
									<div class="img">
										<img class="svg icon" src="./public/img/icon/maps-and-flags.svg">
									</div>
									<div class="info-item">
										<a href="https://www.google.com/maps/place/%D1%83%D0%BB.+%D0%9E%D1%80%D0%BB%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F+17,+%D0%9C%D0%B8%D0%BD%D1%81%D0%BA,+%D0%91%D0%B5%D0%BB%D0%B0%D1%80%D1%83%D1%81%D1%8C/@53.9319269,27.5588165,17z/data=!3m1!4b1!4m5!3m4!1s0x46dbcf79982616bf:0x10dbc0fa3639f24c!8m2!3d53.9319238!4d27.5610052?hl=ru-KG" target="_blank">
											Минск, ул. Орловская, д. 17
										</a>
									</div>
								</div>
								<p class="title">
									Режим работы:
								</p>
								<div class="info-block">
									<div class="img">
										<img class="svg icon" src="./public/img/icon/wall-clock.svg">
									</div>
									<div class="info-item">
										<p>
											ПН-ПТ 9:00 - 19:00 <br>
											(магазин с 10:00)<br>
											СБ 10:00 - 16:00б <br>
											ВС выходной
										</p>
									</div>
								</div>
								<p class="title">
									Телефоны:
								</p>
								<div class="info-block">
									<div class="phones-elements">
										<div class="phone-item">
											<img class="svg icon" src="./public/img/icon/phone-call.svg">
											<a href="#">
												+375 (17) 210 - 17 - 76
											</a>
										</div>
										<div class="phone-item">
											<img class="svg icon" src="./public/img/icon/logo_velcom.svg">
											<a href="#">
												+375 (29) 635 - 65 - 65
											</a>
										</div>
										<div class="phone-item">
											<a href="#" class="inner-link">
												<img class="icon" src="./public/img/icon/logo_viber.svg">
											</a>
											<a href="#" class="inner-link">
												<img class="icon" src="./public/img/icon/logo_whatsapp.svg">
											</a>
											<img class="icon" src="./public/img/icon/logo_mts.svg">
											<a href="#">
												+375 (33) 635 - 65 - 65
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--- end header --->
			<div id="fixed-elements">
				<!--- nav --->
				<div id="nav">
					<div class="wrapper">
						<div class="nav main_flex flex__align-items_center flex__jcontent_between">
							<div class="hamburger">
								<div class="hamb--show mobile-menu-toggler main_flex flex__align-items_center flex__jcontent_between">
									<div class="span">
										<span></span>
										<span></span>
										<span></span>
									</div>
									<a href="#" class="bd menus">Меню</a>
								</div>

								<div id="menus__show" class="mobile-menu main_flex flex__align-items_start">
									<ul class="main_flex flex__align-items_center navlink flex__1">
										<li><a class="bd" href="#">Акции</a></li>
										<li><a class="bd" href="/catalog.html">Каталог</a></li>
										<li><a class="bd" href="#">Сервис</a></li>
										<li><a class="bd" href="/about.html">О компании</a></li>
										<li><a class="bd" href="#">Контактная информация</a></li>
									</ul>
									<div class="header__form" class="flex__4">
										<form action="" class="main_flex__nowrap flex__align-items_center">
											<input type="text" name="search">
											<input type="submit" value="найти на сайте" class="bd">
										</form>
									</div>
								</div>
								<!--- hamburger nav show ---->
								<div class="hav__show mobile-menu">
									<div class="close-circle">
										<img class="svg" src="./public/img/icon/cancel.svg" width="20">
									</div>
									<ul class="main_flex flex__align-items_center navlink">
										<li><a class="bd" href="#">Акции</a></li>
										<li><a class="bd" href="/catalog.html">Каталог</a></li>
										<li><a class="bd" href="#">Сервис</a></li>
										<li><a class="bd" href="/about.html">О компании</a></li>
										<li><a class="bd" href="#">Контактная информация</a></li>
									</ul>
									<a href="/login.html" class="bd main_flex__nowrap flex__align-items_center log">
										<img class="svg icon" src="./public/img/icon/login.svg">Вход
									</a>
									<div class="header__form">
										<form action="" class="main_flex__nowrap flex__align-items_center">
											<input type="text" name="search">
											<input type="submit" value="найти на сайте" class="bd">
										</form>
									</div>
								</div>
								<!--- end hamburger nav show ---->
							</div>
							<div class="search__auto">
								<div class="mobile-menu-toggler main_flex__nowrap flex__align-items_center fx1 show-click">
									<img class="svg icon" src="./public/img/icon/car-wheel.svg" width="20">
									<p class="bd">Поиск по авто</p>
								</div>
								<div id="search-show" class="mobile-menu">
									<div class="search main_flex flex__align-items_start flex__jcontent_start">
										<div class="search__title">
											<h3 class="bd">Мой автомобиль</h3>
											<a href="#" class="bd">Добавить в список <img class="svg" src="./public/img/icon/double-angle-right.svg" width="7"></a>
										</div>
										<div class="search__select main_flex flex__align-items_center flex__jcontent_end flex__1">
											<div class="dropdown">
												<span class="dropdown-button" data-text="Марка">Марка</span>
												<ul class="dropdown-list">
													<li data-value="Acura">Acura</li>
													<li data-value="Alfa Romeo">Alfa Romeo</li>
													<li data-value="Audi">Audi</li>
													<li data-value="BAW">BAW</li>
													<li data-value="BMW">BMW</li>
													<li data-value="Brilliance">Brilliance</li>
													<li data-value="Byd">Byd</li>
													<li data-value="Cadillac">Cadillac</li>
												</ul>
												<img class="svg" src="./public/img/icon/cancel.svg" width="8">
											</div>

											<div class="dropdown">
												<span class="dropdown-button" data-text="Модель">Модель</span>
												<ul class="dropdown-list">
													<li data-value="Модель1">Модель1</li>
													<li data-value="Модель2">Модель2</li>
													<li data-value="Модель3">Модель3</li>
													<li data-value="Модель4">Модель4</li>
													<li data-value="Модель5">Модель5</li>
													<li data-value="Модель6">Модель6</li>
													<li data-value="Модель7">Модель7</li>
													<li data-value="Модель8">Модель8</li>
												</ul>
												<img class="svg" src="./public/img/icon/cancel.svg" width="8">
											</div>

											<div class="dropdown">
												<span class="dropdown-button" data-text="Год">Год</span>
												<ul class="dropdown-list">
													<li data-value="2000">2000</li>
													<li data-value="2001">2001</li>
													<li data-value="2002">2002</li>
													<li data-value="2003">2003</li>
													<li data-value="2004">2004</li>
													<li data-value="2005">2005</li>
													<li data-value="2006">2006</li>
													<li data-value="2007">2007</li>
													<li data-value="2008">2008</li>
												</ul>
												<img class="svg" src="./public/img/icon/cancel.svg" width="8">
											</div>

											<button class="btn bd">Найти в каталоге</button>
										</div>
									</div>
								</div>
								<!-- seacrh mob show ----->
								<div id="search-show" class="mob-search mobile-menu">
									<div class="close-circle">
										<img class="svg" src="./public/img/icon/cancel.svg" width="20">
									</div>
									<div class="search main_flex flex__align-items_start flex__jcontent_start">
										<div class="search__title">
											<h3 class="bd">Мой автомобиль</h3>
											<a href="#" class="bd">Добавить в список <img class="svg" src="./public/img/icon/double-angle-right.svg" width="7"></a>
										</div>
										<div class="search__select main_flex flex__align-items_center flex__jcontent_end flex__1">
											<div class="dropdown">
												<span class="dropdown-button" data-text="Марка">Марка</span>
												<ul class="dropdown-list">
													<li data-value="Acura">Acura</li>
													<li data-value="Alfa Romeo">Alfa Romeo</li>
													<li data-value="Audi">Audi</li>
													<li data-value="BAW">BAW</li>
													<li data-value="BMW">BMW</li>
													<li data-value="Brilliance">Brilliance</li>
													<li data-value="Byd">Byd</li>
													<li data-value="Cadillac">Cadillac</li>
												</ul>
												<img class="svg" src="./public/img/icon/cancel.svg" width="8">
											</div>

											<div class="dropdown">
												<span class="dropdown-button" data-text="Модель">Модель</span>
												<ul class="dropdown-list">
													<li data-value="Модель1">Модель1</li>
													<li data-value="Модель2">Модель2</li>
													<li data-value="Модель3">Модель3</li>
													<li data-value="Модель4">Модель4</li>
													<li data-value="Модель5">Модель5</li>
													<li data-value="Модель6">Модель6</li>
													<li data-value="Модель7">Модель7</li>
													<li data-value="Модель8">Модель8</li>
												</ul>
												<img class="svg" src="./public/img/icon/cancel.svg" width="8">
											</div>

											<div class="dropdown">
												<span class="dropdown-button" data-text="Год">Год</span>
												<ul class="dropdown-list">
													<li data-value="2000">2000</li>
													<li data-value="2001">2001</li>
													<li data-value="2002">2002</li>
													<li data-value="2003">2003</li>
													<li data-value="2004">2004</li>
													<li data-value="2005">2005</li>
													<li data-value="2006">2006</li>
													<li data-value="2007">2007</li>
													<li data-value="2008">2008</li>
												</ul>
												<img class="svg" src="./public/img/icon/cancel.svg">
											</div>

											<button class="btn bd">Найти в каталоге</button>
										</div>
									</div>
								</div>
								<!--- end search mob show ---->
							</div>
							<div class="navs__catalog main_flex flex__align-items_start">
								<div class="mobile-menu-toggler">
									<i class="fas fa-bars"></i>
									<p class="bd" style="float: left;">Каталог</p>
								</div>

								<div class="mobile-menu catalogs__show main_flex flex__align-items_start flex__jcontent_start">
									<div class="flex__9">
										<nav class="content__nav">
											<div class="content__nav--cl">
												<h2 class="bd">Интерьер</h2>
											</div>

											<ul class="content__nav--show">
												<li><a class="bd" href="#">Коврики</a></li>
												<li><a class="bd" href="#">Органайзеры</a></li>
												<li><a class="bd" href="#">Подлокотники</a></li>
												<li><a class="bd" href="#">Подогрев сидений</a></li>
												<li><a class="bd" href="#">Сумки</a></li>
												<li><a class="bd" href="#">Чехлы на сиденья</a></li>
												<li><a class="bd" href="#">Шторки багажника</a></li>
												<li><a class="bd" href="#">Аксессуары для интерьера</a></li>
											</ul>
										</nav>

										<nav class="content__nav">
											<div class="content__nav--cl">
												<h2 class="bd">Электроника</h2>
											</div>

											<ul class="content__nav--show">
												<li><a class="bd" href="#">GPS-навигаторы</a></li>
												<li><a class="bd" href="#">Автомобильные радиостанции</a></li>
												<li><a class="bd" href="#">Видеорегистраторы</a></li>
												<li><a class="bd" href="#">Зарядные устройства, адаптеры</a></li>
												<li><a class="bd" href="#">Кофеварки</a></li>
												<li><a class="bd" href="#">Магнитолы</a></li>
												<li><a class="bd" href="#">Холодильники</a></li>
											</ul>
										</nav>
									</div>

									<div class="flex__9">
										<nav class="content__nav">
											<div class="content__nav--cl">
												<h2 class="bd">Экстерьер</h2>
											</div>

											<ul class="content__nav--show">
												<li><a class="bd" href="#">Багажные системы</a></li>
												<ul class="content__nav--fx">
													<li><a class="bd" href="#">Автобоксы</a></li>
													<li><a class="bd" href="#">Багажные крепления</a></li>
													<li><a class="bd" href="#">Велобагажники</a></li>
													<li><a class="bd" href="#">Крепления для лыж</a></li>
													<li><a class="bd" href="#">Перевозка грузов</a></li>
												</ul>
												<li><a class="bd" href="#">Брызговики</a></li>
												<li><a class="bd" href="#">Защита переднего бампера</a></li>
												<li><a class="bd" href="#">Защита заднего бампера</a></li>
												<li><a class="bd" href="#">Защита кузова</a></li>
												<li><a class="bd" href="#">Крышки для кузова</a></li>
												<li><a class="bd" href="#">Подкрылки</a></li>
												<li><a class="bd" href="#">Пороги и накладки</a></li>
												<li><a class="bd" href="#">Фаркопы</a></li>
												<li><a class="bd" href="#">Аксессуары для экстерьера</a></li>
											</ul>
										</nav>
									</div>

									<div class="flex__9">
										<nav class="content__nav">
											<div class="content__nav--cl">
												<h2 class="bd">Запчасти</h2>
											</div>

											<ul class="content__nav--show">
												<li><a class="bd" href="#">Защита двигателя и КПП</a></li>
												<li><a class="bd" href="#">Наборы для ТО</a></li>
											</ul>
										</nav>

										<nav class="content__nav">
											<div class="content__nav--cl">
												<h2 class="bd">Одежда, обувь, аксессуары</h2>
											</div>
										</nav>

										<nav class="content__nav">
											<div class="content__nav--cl">
												<h2 class="bd">Одежда, обувь, аксессуары</h2>
											</div>
										</nav>

										<nav class="content__nav">
											<div class="content__nav--cl">
												<h2 class="bd">Распродажа</h2>
											</div>
										</nav>
									</div>
								</div>
							</div>
							<div class="navs__catalog mob__navs__catalog main_flex flex__align-items_start">
								<div class="mobile-menu-toggler">
									<i class="fas fa-bars"></i>
									<p class="bd" style="float: left;">Каталог</p>
								</div>
								<div class="catalog__show mobile-menu">
									<div class="close-circle">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 21.9 21.9" enable-background="new 0 0 21.9 21.9" class="svg replaced-svg">
										  <path d="M14.1,11.3c-0.2-0.2-0.2-0.5,0-0.7l7.5-7.5c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7l-1.4-1.4C20,0.1,19.7,0,19.5,0  c-0.3,0-0.5,0.1-0.7,0.3l-7.5,7.5c-0.2,0.2-0.5,0.2-0.7,0L3.1,0.3C2.9,0.1,2.6,0,2.4,0S1.9,0.1,1.7,0.3L0.3,1.7C0.1,1.9,0,2.2,0,2.4  s0.1,0.5,0.3,0.7l7.5,7.5c0.2,0.2,0.2,0.5,0,0.7l-7.5,7.5C0.1,19,0,19.3,0,19.5s0.1,0.5,0.3,0.7l1.4,1.4c0.2,0.2,0.5,0.3,0.7,0.3  s0.5-0.1,0.7-0.3l7.5-7.5c0.2-0.2,0.5-0.2,0.7,0l7.5,7.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l1.4-1.4c0.2-0.2,0.3-0.5,0.3-0.7  s-0.1-0.5-0.3-0.7L14.1,11.3z"></path>
										</svg>
									</div>
									<nav class="content__nav">
										<div class="content__nav--cl main_flex__nowrap flex__align-items_center flex__jcontent_between">
											<h2 class="bd">Интерьер</h2>
										</div>

										<ul class="content__nav--show">
											<li><a class="bd" href="#">Коврики</a></li>
											<li><a class="bd" href="#">Органайзеры</a></li>
											<li><a class="bd" href="#">Подлокотники</a></li>
											<li><a class="bd" href="#">Подогрев сидений</a></li>
											<li><a class="bd" href="#">Сумки</a></li>
											<li><a class="bd" href="#">Чехлы на сиденья</a></li>
											<li><a class="bd" href="#">Шторки багажника</a></li>
											<li><a class="bd" href="#">Аксессуары для интерьера</a></li>
										</ul>
									</nav>

									<nav class="content__nav">
										<div class="content__nav--cl">
											<h2 class="bd">Экстерьер</h2>
										</div>

										<ul class="content__nav--show">
											<li><a class="bd" href="#">Багажные системы</a></li>
											<ul class="content__nav--fx">
												<li><a class="bd" href="#">Автобоксы</a></li>
												<li><a class="bd" href="#">Багажные крепления</a></li>
												<li><a class="bd" href="#">Велобагажники</a></li>
												<li><a class="bd" href="#">Крепления для лыж</a></li>
												<li><a class="bd" href="#">Перевозка грузов</a></li>
											</ul>
											<li><a class="bd" href="#">Брызговики</a></li>
											<li><a class="bd" href="#">Защита переднего бампера</a></li>
											<li><a class="bd" href="#">Защита заднего бампера</a></li>
											<li><a class="bd" href="#">Защита кузова</a></li>
											<li><a class="bd" href="#">Крышки для кузова</a></li>
											<li><a class="bd" href="#">Подкрылки</a></li>
											<li><a class="bd" href="#">Пороги и накладки</a></li>
											<li><a class="bd" href="#">Фаркопы</a></li>
											<li><a class="bd" href="#">Аксессуары для экстерьера</a></li>
										</ul>
									</nav>

									<nav class="content__nav">
										<div class="content__nav--cl">
											<h2 class="bd">Запчасти</h2>
										</div>

										<ul class="content__nav--show">
											<li><a class="bd" href="#">Защита двигателя и КПП</a></li>
											<li><a class="bd" href="#">Наборы для ТО</a></li>
										</ul>
									</nav>

									<nav class="content__nav">
										<div class="content__nav--cl">
											<h2 class="bd">Одежда, обувь, аксессуары</h2>
										</div>
									</nav>

									<nav class="content__nav">
										<div class="content__nav--cl">
											<h2 class="bd">Электроника</h2>
										</div>

										<ul class="content__nav--show">
											<li><a class="bd" href="#">GPS-навигаторы</a></li>
											<li><a class="bd" href="#">Автомобильные радиостанции</a></li>
											<li><a class="bd" href="#">Видеорегистраторы</a></li>
											<li><a class="bd" href="#">Зарядные устройства, адаптеры</a></li>
											<li><a class="bd" href="#">Кофеварки</a></li>
											<li><a class="bd" href="#">Магнитолы</a></li>
											<li><a class="bd" href="#">Холодильники</a></li>
										</ul>
									</nav>

									<nav class="content__nav">
										<div class="content__nav--cl">
											<h2 class="bd">Распродажа</h2>
										</div>
									</nav>
								</div>
							</div>
							<a class="bd desktop" href="#">Акции</a>
							<a class="bd desktop" href="/catalog.html">Каталог</a>
							<a class="bd desktop" href="#">Сервис</a>
							<a class="bd desktop" href="/about.html">О компании</a>
							<a class="bd desktop" href="#">Контактная информация</a>
							<a href="/login.html" class="bd main_flex__nowrap flex__align-items_center log">
								<img class="svg icon" src="./public/img/icon/login.svg">Вход
							</a>
							<div class="basket full">
								<a href="javascript:void(0);" class="bd basket__link">
									<img class="svg icon" src="./public/img/icon/shopping-cart.svg">Корзина
								</a>
								<div class="basket__open">
									<ul>
										<li class="">
											<a href="#" class="main_flex flex__align-items_center flex__jcontent_between">
												<span class="basket__open--img">
													<img src="./public/img/img-table.png" alt="img">
												</span>
												<p class="rg flex__1">Ковёр в багажник автомобиля. Kia Rio 2011</p>
												<div class="basket__open--price">1035,55 BYN</div>
											</a>
										</li>
										<li>
											<a href="#" class="main_flex flex__align-items_center flex__jcontent_between">
												<div class="basket__open--img">
													<img src="./public/img/img-table.png" alt="img">
												</div>
												<p class="rg flex__1">Ковёр в багажник автомобиля. Kia Rio 2011</p>
												<div class="basket__open--price">35 BYN<span class="old-price">40,55 BYN</span></div>
											</a>
										</li>
										<li>
											<a class="main_flex flex__align-items_center flex__jcontent_between" href="#">
												<span class="basket__open--img">
													<img src="./public/img/img-table.png" alt="img">
												</span>
												<p class="rg flex__1">Ковёр в багажник автомобиля. Kia Rio 2011</p>
												<div class="basket__open--price">1035,55 BYN</div>
											</a>
										</li>
										<li>
											<a href="#" class="main_flex flex__align-items_center flex__jcontent_between">
												<div class="basket__open--img">
													<img src="./public/img/img-table.png" alt="img">
												</div>
												<p class="rg flex__1">Ковёр в багажник автомобиля. Kia Rio 2011</p>
												<div class="basket__open--price">35 BYN<span class="old-price">40,55 BYN</span></div>
											</a>
										</li>
									</ul>
									<div class="basket-open__all main_flex flex__align-items_center flex__jcontent_between">
										<div class="bd tov">2 товара</div>
										<div class="bd rub">77 руб.</div>
									</div>
									<button class="order bd">Оформить заказ</button>
								</div>
							</div>
						</div>
					</div>
					<div class="nav nav__catalog main_flex__nowrap flex__align-items_center flex__jcontent_center">
						<div class="search__auto">
							<div class="mobile-menu-toggler main_flex__nowrap flex__align-items_center fx1 show-click">
								<img class="svg icon" src="./public/img/icon/car-wheel.svg" width="20">
								<p class="bd">Поиск по авто</p>
							</div>
							<div id="search-show" class="mobile-menu">
								<div class="search main_flex flex__align-items_start flex__jcontent_start">
									<div class="search__title">
										<h3 class="bd">Мой автомобиль</h3>
										<a href="#" class="bd">Добавить в список <img class="svg" src="./public/img/icon/double-angle-right.svg" width="7"></a>
									</div>
									<div class="search__select main_flex flex__align-items_center flex__jcontent_end flex__1">
										<div class="dropdown">
											<span class="dropdown-button" data-text="Марка">Марка</span>
											<ul class="dropdown-list">
												<li data-value="Acura">Acura</li>
												<li data-value="Alfa Romeo">Alfa Romeo</li>
												<li data-value="Audi">Audi</li>
												<li data-value="BAW">BAW</li>
												<li data-value="BMW">BMW</li>
												<li data-value="Brilliance">Brilliance</li>
												<li data-value="Byd">Byd</li>
												<li data-value="Cadillac">Cadillac</li>
											</ul>
											<img class="svg" src="./public/img/icon/cancel.svg" width="8">
										</div>

										<div class="dropdown">
											<span class="dropdown-button" data-text="Модель">Модель</span>
											<ul class="dropdown-list">
												<li data-value="Модель1">Модель1</li>
												<li data-value="Модель2">Модель2</li>
												<li data-value="Модель3">Модель3</li>
												<li data-value="Модель4">Модель4</li>
												<li data-value="Модель5">Модель5</li>
												<li data-value="Модель6">Модель6</li>
												<li data-value="Модель7">Модель7</li>
												<li data-value="Модель8">Модель8</li>
											</ul>
											<img class="svg" src="./public/img/icon/cancel.svg" width="8">
										</div>

										<div class="dropdown">
											<span class="dropdown-button" data-text="Год">Год</span>
											<ul class="dropdown-list">
												<li data-value="2000">2000</li>
												<li data-value="2001">2001</li>
												<li data-value="2002">2002</li>
												<li data-value="2003">2003</li>
												<li data-value="2004">2004</li>
												<li data-value="2005">2005</li>
												<li data-value="2006">2006</li>
												<li data-value="2007">2007</li>
												<li data-value="2008">2008</li>
											</ul>
											<img class="svg" src="./public/img/icon/cancel.svg" width="8">
										</div>

										<button class="btn bd">Найти в каталоге</button>
									</div>
								</div>
							</div>
							<!-- seacrh mob show ----->
							<div id="search-show" class="mob-search mobile-menu">
								<div class="close-circle">
									<img class="svg" src="./public/img/icon/cancel.svg" width="20">
								</div>
								<div class="search main_flex flex__align-items_start flex__jcontent_start">
									<div class="search__title">
										<h3 class="bd">Мой автомобиль</h3>
										<a href="#" class="bd">Добавить в список <img class="svg" src="./public/img/icon/double-angle-right.svg" width="7"></a>
									</div>
									<div class="search__select main_flex flex__align-items_center flex__jcontent_end flex__1">
										<div class="dropdown">
											<span class="dropdown-button" data-text="Марка">Марка</span>
											<ul class="dropdown-list">
												<li data-value="Acura">Acura</li>
												<li data-value="Alfa Romeo">Alfa Romeo</li>
												<li data-value="Audi">Audi</li>
												<li data-value="BAW">BAW</li>
												<li data-value="BMW">BMW</li>
												<li data-value="Brilliance">Brilliance</li>
												<li data-value="Byd">Byd</li>
												<li data-value="Cadillac">Cadillac</li>
											</ul>
											<img class="svg" src="./public/img/icon/cancel.svg" width="8">
										</div>

										<div class="dropdown">
											<span class="dropdown-button" data-text="Модель">Модель</span>
											<ul class="dropdown-list">
												<li data-value="Модель1">Модель1</li>
												<li data-value="Модель2">Модель2</li>
												<li data-value="Модель3">Модель3</li>
												<li data-value="Модель4">Модель4</li>
												<li data-value="Модель5">Модель5</li>
												<li data-value="Модель6">Модель6</li>
												<li data-value="Модель7">Модель7</li>
												<li data-value="Модель8">Модель8</li>
											</ul>
											<img class="svg" src="./public/img/icon/cancel.svg" width="8">
										</div>

										<div class="dropdown">
											<span class="dropdown-button" data-text="Год">Год</span>
											<ul class="dropdown-list">
												<li data-value="2000">2000</li>
												<li data-value="2001">2001</li>
												<li data-value="2002">2002</li>
												<li data-value="2003">2003</li>
												<li data-value="2004">2004</li>
												<li data-value="2005">2005</li>
												<li data-value="2006">2006</li>
												<li data-value="2007">2007</li>
												<li data-value="2008">2008</li>
											</ul>
											<img class="svg" src="./public/img/icon/cancel.svg">
										</div>

										<button class="btn bd">Найти в каталоге</button>
									</div>
								</div>
							</div>
							<!--- end search mob show ---->
						</div>
						<div class="basket full">
							<a href="/cart.html" class="bd basket__link">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 19.2 19.2" style="enable-background:new 0 0 19.2 19.2;" xml:space="preserve" class="svg icon replaced-svg">
								<g>
									<g id="Layer_1_107_">
										<g>
											<path d="M19,3c-0.2-0.2-0.5-0.3-0.8-0.3H4.4L4.2,1.5C4.2,1,3.7,0.6,3.2,0.6H1c-0.6,0-1,0.4-1,1s0.4,1,1,1h1.4     l1.9,11.2c0,0,0,0.1,0,0.1c0,0.1,0,0.1,0.1,0.2c0,0.1,0.1,0.1,0.1,0.2c0,0,0.1,0.1,0.1,0.1c0.1,0.1,0.1,0.1,0.2,0.1     c0,0,0.1,0,0.1,0.1c0.1,0,0.2,0.1,0.4,0.1c0,0,11,0,11,0c0.6,0,1-0.4,1-1s-0.4-1-1-1H6.1l-0.2-1h11.3c0.5,0,0.9-0.4,1-0.9l1-7     C19.3,3.5,19.2,3.2,19,3z M17.1,4.6l-0.3,2h-3.6v-2H17.1z M12.2,4.6v2h-3v-2H12.2z M12.2,7.6v2h-3v-2H12.2z M8.2,4.6v2h-3     c-0.1,0-0.1,0-0.1,0l-0.3-2H8.2z M5.3,7.6h3v2H5.6L5.3,7.6z M13.2,9.6v-2h3.4l-0.3,2H13.2z"></path>
											<circle class="st0" cx="6.8" cy="17.1" r="1.5"></circle>
											<circle class="st0" cx="15.8" cy="17.1" r="1.5"></circle>
										</g>
									</g>
								</g>
								</svg>Корзина
							</a>
							<div class="basket__open">
								<ul>
									<li class="main_flex flex__align-items_center flex__jcontent_between">
										<a href="#" class="web-basket-link">
											<span class="basket__open--img">
												<img src="./public/img/img-table.png" alt="img">
											</span>
											<p class="rg flex__1">Ковёр в багажник автомобиля. Kia Rio 2011</p>
											<div class="basket__open--price">1035,55 BYN</div>
										</a>
									</li>
									<li class="main_flex flex__align-items_center flex__jcontent_between">
										<a href="#" class="web-basket-link">
											<div class="basket__open--img">
												<img src="./public/img/img-table.png" alt="img">
											</div>
											<p class="rg flex__1">Ковёр в багажник автомобиля. Kia Rio 2011</p>
											<div class="basket__open--price">35 BYN<span class="old-price">40,55 BYN</span></div>
										</a>
									</li>
									<li class="main_flex flex__align-items_center flex__jcontent_between">
										<a class="web-basket-link" href="#">
											<span class="basket__open--img">
												<img src="./public/img/img-table.png" alt="img">
											</span>
											<p class="rg flex__1">Ковёр в багажник автомобиля. Kia Rio 2011</p>
											<div class="basket__open--price">1035,55 BYN</div>
										</a>
									</li>
									<li class="main_flex flex__align-items_center flex__jcontent_between">
										<div class="basket__open--img">
											<img src="./public/img/img-table.png" alt="img">
										</div>
										<p class="rg flex__1">Ковёр в багажник автомобиля. Kia Rio 2011</p>
										<div class="basket__open--price">35 BYN<span class="old-price">40,55 BYN</span></div>
									</li>
								</ul>
								<div class="basket-open__all main_flex flex__align-items_center flex__jcontent_between">
									<div class="bd tov">2 товара</div>
									<div class="bd rub">77 руб.</div>
								</div>
								<button class="order bd">Оформить заказ</button>
							</div>
						</div>
					</div>
				</div>
				<!--- end nav --->
				<!--- search --->
				<div id="search">
					<div class="wrapper">
						<div class="search main_flex flex__align-items_center flex__jcontent_start">
							<div class="search__title">
								<h3 class="bd">Мой автомобиль</h3>
								<a href="#" class="bd">Добавить в список <img class="svg" src="./public/img/icon/double-angle-right.svg" width="7"></a>
							</div>
							<div class="search__select main_flex flex__align-items_center flex__1">
								<div class="dropdown">
									<span class="dropdown-button" data-text="Марка">Марка</span>
									<ul class="dropdown-list">
										<li data-value="Acura">Acura</li>
										<li data-value="Alfa Romeo">Alfa Romeo</li>
										<li data-value="Audi">Audi</li>
										<li data-value="BAW">BAW</li>
										<li data-value="BMW">BMW</li>
										<li data-value="Brilliance">Brilliance</li>
										<li data-value="Byd">Byd</li>
										<li data-value="Cadillac">Cadillac</li>
									</ul>
									<img class="svg" src="./public/img/icon/cancel.svg" width="8">
								</div>

								<div class="dropdown">
									<span class="dropdown-button" data-text="Модель">Модель</span>
									<ul class="dropdown-list">
										<li data-value="Модель1">Модель1</li>
										<li data-value="Модель2">Модель2</li>
										<li data-value="Модель3">Модель3</li>
										<li data-value="Модель4">Модель4</li>
										<li data-value="Модель5">Модель5</li>
										<li data-value="Модель6">Модель6</li>
										<li data-value="Модель7">Модель7</li>
										<li data-value="Модель8">Модель8</li>
									</ul>
									<img class="svg" src="./public/img/icon/cancel.svg" width="8">
								</div>

								<div class="dropdown">
									<span class="dropdown-button" data-text="Год">Год</span>
									<ul class="dropdown-list">
										<li data-value="2000">2000</li>
										<li data-value="2001">2001</li>
										<li data-value="2002">2002</li>
										<li data-value="2003">2003</li>
										<li data-value="2004">2004</li>
										<li data-value="2005">2005</li>
										<li data-value="2006">2006</li>
										<li data-value="2007">2007</li>
										<li data-value="2008">2008</li>
									</ul>
									<img class="svg" src="./public/img/icon/cancel.svg" width="8">
								</div>

								<button class="btn bd">Найти в каталоге</button>
							</div>
						</div>
					</div>
				</div>
				<!--- end search --->
			</div>
			<!-- seacrh mob show ----->
			<div id="search-show" class="mob-search">
				<div class="close-circle">
					<img class="svg" src="./public/img/icon/cancel.svg" width="20">
				</div>
				<div class="search main_flex flex__align-items_start flex__jcontent_start">
					<div class="search__title">
						<h3 class="bd">Мой автомобиль</h3>
						<a href="#" class="bd">Добавить в список <img class="svg" src="./public/img/icon/double-angle-right.svg" width="7"></a>
					</div>
					<div class="search__select main_flex flex__align-items_center flex__jcontent_end flex__1">
						<div class="dropdown">
							<span class="dropdown-button" data-text="Марка">Марка</span>
							<ul class="dropdown-list">
								<li data-value="Acura">Acura</li>
								<li data-value="Alfa Romeo">Alfa Romeo</li>
								<li data-value="Audi">Audi</li>
								<li data-value="BAW">BAW</li>
								<li data-value="BMW">BMW</li>
								<li data-value="Brilliance">Brilliance</li>
								<li data-value="Byd">Byd</li>
								<li data-value="Cadillac">Cadillac</li>
							</ul>
							<img class="svg" src="./public/img/icon/cancel.svg" width="8">
						</div>

						<div class="dropdown">
							<span class="dropdown-button" data-text="Модель">Модель</span>
							<ul class="dropdown-list">
								<li data-value="Модель1">Модель1</li>
								<li data-value="Модель2">Модель2</li>
								<li data-value="Модель3">Модель3</li>
								<li data-value="Модель4">Модель4</li>
								<li data-value="Модель5">Модель5</li>
								<li data-value="Модель6">Модель6</li>
								<li data-value="Модель7">Модель7</li>
								<li data-value="Модель8">Модель8</li>
							</ul>
							<img class="svg" src="./public/img/icon/cancel.svg" width="8">
						</div>

						<div class="dropdown">
							<span class="dropdown-button" data-text="Год">Год</span>
							<ul class="dropdown-list">
								<li data-value="2000">2000</li>
								<li data-value="2001">2001</li>
								<li data-value="2002">2002</li>
								<li data-value="2003">2003</li>
								<li data-value="2004">2004</li>
								<li data-value="2005">2005</li>
								<li data-value="2006">2006</li>
								<li data-value="2007">2007</li>
								<li data-value="2008">2008</li>
							</ul>
							<img class="svg" src="./public/img/icon/cancel.svg">
						</div>

						<button class="btn bd">Найти в каталоге</button>
					</div>
				</div>
			</div>
			<!--- end search mob show ---->
			<!--- hamburger nav show ---->
			<div class="hav__show">
				<div class="close-circle">
					<img class="svg" src="./public/img/icon/cancel.svg" width="20">
				</div>
				<ul class="main_flex flex__align-items_center navlink">
					<li><a class="bd" href="#">Акции</a></li>
					<li><a class="bd" href="/catalog.html">Каталог</a></li>
					<li><a class="bd" href="#">Сервис</a></li>
					<li><a class="bd" href="/about.html">О компании</a></li>
					<li><a class="bd" href="#">Контактная информация</a></li>
				</ul>
				<a href="/login.html" class="bd main_flex__nowrap flex__align-items_center log">
					<img class="svg icon" src="./public/img/icon/login.svg">Вход
				</a>
				<div class="header__form">
					<form action="" class="main_flex__nowrap flex__align-items_center">
						<input type="text" name="search">
						<input type="submit" value="найти на сайте" class="bd">
					</form>
				</div>
			</div>
			<!--- end hamburger nav show ---->
			<!--- catalog nav show ---->
			<div class="catalog__show">
				<div class="close-circle">
					<img class="svg" src="./public/img/icon/cancel.svg" width="20">
				</div>
				<nav class="content__nav">
					<div class="content__nav--cl main_flex__nowrap flex__align-items_center flex__jcontent_between">
						<h2 class="bd">Интерьер</h2>
					</div>

					<ul class="content__nav--show">
						<li><a class="bd" href="#">Коврики</a></li>
						<li><a class="bd" href="#">Органайзеры</a></li>
						<li><a class="bd" href="#">Подлокотники</a></li>
						<li><a class="bd" href="#">Подогрев сидений</a></li>
						<li><a class="bd" href="#">Сумки</a></li>
						<li><a class="bd" href="#">Чехлы на сиденья</a></li>
						<li><a class="bd" href="#">Шторки багажника</a></li>
						<li><a class="bd" href="#">Аксессуары для интерьера</a></li>
					</ul>
				</nav>

				<nav class="content__nav">
					<div class="content__nav--cl">
						<h2 class="bd">Экстерьер</h2>
					</div>

					<ul class="content__nav--show">
						<li><a class="bd" href="#">Багажные системы</a></li>
						<ul class="content__nav--fx">
							<li><a class="bd" href="#">Автобоксы</a></li>
							<li><a class="bd" href="#">Багажные крепления</a></li>
							<li><a class="bd" href="#">Велобагажники</a></li>
							<li><a class="bd" href="#">Крепления для лыж</a></li>
							<li><a class="bd" href="#">Перевозка грузов</a></li>
						</ul>
						<li><a class="bd" href="#">Брызговики</a></li>
						<li><a class="bd" href="#">Защита переднего бампера</a></li>
						<li><a class="bd" href="#">Защита заднего бампера</a></li>
						<li><a class="bd" href="#">Защита кузова</a></li>
						<li><a class="bd" href="#">Крышки для кузова</a></li>
						<li><a class="bd" href="#">Подкрылки</a></li>
						<li><a class="bd" href="#">Пороги и накладки</a></li>
						<li><a class="bd" href="#">Фаркопы</a></li>
						<li><a class="bd" href="#">Аксессуары для экстерьера</a></li>
					</ul>
				</nav>

				<nav class="content__nav">
					<div class="content__nav--cl">
						<h2 class="bd">Запчасти</h2>
					</div>

					<ul class="content__nav--show">
						<li><a class="bd" href="#">Защита двигателя и КПП</a></li>
						<li><a class="bd" href="#">Наборы для ТО</a></li>
					</ul>
				</nav>

				<nav class="content__nav">
					<div class="content__nav--cl">
						<h2 class="bd">Одежда, обувь, аксессуары</h2>
					</div>
				</nav>

				<nav class="content__nav">
					<div class="content__nav--cl">
						<h2 class="bd">Электроника</h2>
					</div>

					<ul class="content__nav--show">
						<li><a class="bd" href="#">GPS-навигаторы</a></li>
						<li><a class="bd" href="#">Автомобильные радиостанции</a></li>
						<li><a class="bd" href="#">Видеорегистраторы</a></li>
						<li><a class="bd" href="#">Зарядные устройства, адаптеры</a></li>
						<li><a class="bd" href="#">Кофеварки</a></li>
						<li><a class="bd" href="#">Магнитолы</a></li>
						<li><a class="bd" href="#">Холодильники</a></li>
					</ul>
				</nav>

				<nav class="content__nav">
					<div class="content__nav--cl">
						<h2 class="bd">Распродажа</h2>
					</div>
				</nav>
			</div>
			<!--- end catalog nav show ---->

			<!--- content --->
			<div id="content">
				<div class="wrapper">
					<div class="content main_flex flex__align-items_start flex__jcontent_between">

						<div class="flex__block content__op">
							<div class="sidebar">
	<ul class="sidebar-menu">
		<li>
			<a href="#">
				<span class="nav-ico">
					<svg width="19" height="29" viewBox="0 0 19 29" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M3 3C3 1.89543 3.89543 1 5 1H6.8414C7.94597 1 8.84141 1.89543 8.84141 3V4.38105C8.84141 4.93334 8.39369 5.38105 7.84141 5.38105H4C3.44772 5.38105 3 4.93334 3 4.38105V3Z" stroke-width="1.2"></path>
						<path d="M1.46045 8.84082C1.46045 8.28853 1.90816 7.84082 2.46045 7.84082H9.40275C9.87944 7.84082 10.2899 8.17728 10.3833 8.6447L11.6829 15.1426L12.4148 17.7044C12.7799 18.982 11.8206 20.2538 10.4918 20.2538H4.78298C4.04486 20.2538 3.32325 20.0353 2.7091 19.6259V19.6259C1.92901 19.1058 1.46045 18.2303 1.46045 17.2928V15.8728V8.84082Z" stroke-width="1.2"></path>
						<path d="M6.74216 27.3601L3.30432 24.4144C2.86717 24.0398 3.07112 23.325 3.64011 23.2374L8.64198 22.4681C10.6418 22.1604 12.6861 22.3337 14.6056 22.9736L17.0047 23.7733C17.3162 23.8771 17.5263 24.1686 17.5263 24.4969C17.5263 24.772 17.4371 25.0397 17.272 25.2597L16.7961 25.8943L16.0643 26.3811L14.6056 27.1112L13.9519 27.329C12.9329 27.6684 11.8658 27.8414 10.7918 27.8414H10.2245H8.04349C7.56618 27.8414 7.10461 27.6707 6.74216 27.3601Z" stroke-width="1.2"></path>
					</svg>
				</span>
				Интерьер
				<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"></rect>
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"></rect>
				</svg>
			</a>
			<ul class="submenu">
				<li>
					<a href="#">
						Коврики
					</a>
				</li>
				<li>
					<a href="#">
						Органайзеры
					</a>
				</li>
				<li>
					<a href="#">
						Подлокотники
					</a>
				</li>
				<li>
					<a href="#">
						Подогрев сидений
					</a>
				</li>
				<li>
					<a href="#">
						Сумки
					</a>
				</li>
				<li>
					<a href="#">
						Чехлы на сиденья
					</a>
				</li>
				<li>
					<a href="#">
						Шторки багажника
					</a>
				</li>
				<li>
					<a href="#">
						Аксессуары для интерьера
					</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">
				<span class="nav-ico">
					<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.5938 2.96875H3.40625L1.84375 10.1562H0.15625V17.0312H19.8438V10.1562H18.1562L16.5938 2.96875ZM18.5938 15.7812H17.6562H1.40625V11.4062H2.84375L4.40625 4.21875H15.5938L16.8906 10.1562H5.46875V11.4062H18.5938V15.7812Z" fill="#FFDB6B"></path>
						<path d="M17.6562 18.5938H14.8438V19.8438H17.6562V18.5938Z"></path>
						<path d="M5.15625 18.5938H2.34375V19.8438H5.15625V18.5938Z"></path>
						<path d="M4.21875 12.9688H2.96875V14.2188H4.21875V12.9688Z"></path>
						<path d="M17.0312 12.9688H15.7812V14.2188H17.0312V12.9688Z"></path>
					</svg>
				</span>
				Экстерьер
				<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"></rect>
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"></rect>
				</svg>
			</a>
			<ul class="submenu">
				<li>
					<a href="#">
						Багажные системы
						<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"></rect>
							<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"></rect>
						</svg>
					</a>
					<ul class="thirdmenu">
						<li>
							<a href="#">
								Автобоксы
							</a>
						</li>
						<li>
							<a href="#">
								Багажные крепления
							</a>
						</li>
						<li>
							<a href="#">
								Велобагажники
							</a>
						</li>
						<li>
							<a href="#">
								Крепления для лыж
							</a>
						</li>
						<li>
							<a href="#">
								Перевозка грузов
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">
						Брызговики
					</a>
				</li>
				<li>
					<a href="#">
						Защита переднего бампера
					</a>
				</li>
				<li>
					<a href="#">
						Защита заднего бампера
					</a>
				</li>
				<li>
					<a href="#">
						Защита кузова
					</a>
				</li>
				<li>
					<a href="#">
						Крышки для кузова
						<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					</svg></a>
				</li>
				<li>
					<a href="#">
						Подкрылки
					</a>
				</li>
				<li>
					<a href="#">
						Пороги и накладки
					</a>
				</li>
				<li>
					<a href="#">
						Фаркопы
					</a>
				</li>
				<li>
					<a href="#">
						Аксессуары для экстерьера
					</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">
				<span class="nav-ico">
					<svg width="19" height="19" viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.4201 2.06907C13.7269 0.714537 11.683 0.000976562 9.50602 0.000976562C7.14764 0.000976562 4.88606 0.871759 3.13241 2.4561C1.14895 4.25814 0 6.82209 0 9.49487C0 14.6833 4.18457 18.9041 9.3488 18.9888C9.39719 19.0009 9.44555 19.0009 9.49394 19.0009C9.54234 19.0009 9.59069 19.0009 9.62697 18.9888C14.8033 18.9163 19 14.6833 19 9.49487C19.012 6.59228 17.7059 3.88322 15.4201 2.06907ZM4.09994 3.53246C5.58754 2.19001 7.49841 1.45225 9.50602 1.45225C11.3443 1.45225 13.0859 2.05695 14.513 3.2059C16.2788 4.60882 17.3431 6.64063 17.5245 8.86598H12.5416C12.2393 7.46306 10.9936 6.41086 9.50602 6.41086C8.01847 6.41086 6.77273 7.46306 6.4704 8.86598H1.48759C1.64482 6.82209 2.57607 4.91119 4.09994 3.53246ZM8.76826 17.5133C4.93441 17.1626 1.87459 14.127 1.49967 10.3052H6.50668C6.79692 11.3937 7.66771 12.2524 8.76831 12.5185V17.5133H8.76826ZM9.50602 11.176C8.58689 11.176 7.83701 10.4261 7.83701 9.50695C7.83701 8.58778 8.58684 7.83794 9.50602 7.83794C10.4252 7.83794 11.175 8.58778 11.175 9.50695C11.175 10.4261 10.4252 11.176 9.50602 11.176ZM10.2196 17.5133V12.5184C11.3323 12.2523 12.2151 11.3937 12.5054 10.3052H17.5124C17.1375 14.139 14.0655 17.1747 10.2196 17.5133Z"></path>
					</svg>
				</span>
				Запчасти
				<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"></rect>
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"></rect>
				</svg>
			</a>
			<ul class="submenu">
				<li>
					<a href="#">
						Защита двигателя и КПП
					</a>
				</li>
				<li>
					<a href="#">
						Наборы для ТО
					</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">
				<span class="nav-ico">
					<svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.61097 1.01409C8.30159 1.01409 8.00941 0.945342 7.71722 1.01409L5.67191 1.52972C4.77816 1.75315 4.00472 2.30315 3.48909 3.0594L0.945345 6.85784C0.77347 7.09847 0.721907 7.40784 0.77347 7.70003C0.825032 7.99222 0.996908 8.25003 1.25472 8.40472L2.69847 9.36722C2.88753 9.48753 3.09378 9.55628 3.31722 9.55628C3.66097 9.55628 3.97034 9.40159 4.19378 9.14378L4.69222 8.52503V19.1297C4.69222 19.7485 5.19066 20.2469 5.80941 20.2469H16.1907C16.8094 20.2469 17.3078 19.7485 17.3078 19.1297V8.52503L17.8063 9.14378C18.0125 9.40159 18.3391 9.55628 18.6828 9.55628C18.9063 9.55628 19.1125 9.48753 19.3016 9.36722L20.7453 8.40472C20.986 8.23284 21.1578 7.99222 21.2266 7.70003C21.2782 7.40784 21.2266 7.11565 21.0547 6.85784L18.511 3.0594C17.9953 2.28597 17.2219 1.75315 16.3282 1.52972L14.2828 1.01409C13.9907 0.945342 13.7922 1.00028 13.5 1.00028C15.1416 1.23062 13.6254 0.623811 13.5438 1.4094C13.4063 2.73284 12.3235 3.71253 11 3.71253C9.69378 3.71253 8.6375 2.2889 8.5 0.999834C8.55156 0.999834 8.55941 1.42659 8.61097 1.42659M20.4532 7.97503L19.0094 8.93753C18.7516 9.1094 18.3907 9.05784 18.2016 8.81721L17.2391 7.63128C17.1703 7.54534 17.05 7.51097 16.9469 7.54534C16.8438 7.57972 16.775 7.68284 16.775 7.78597V19.1125C16.775 19.4391 16.5 19.7141 16.1735 19.7141H5.80941C5.48284 19.7141 5.20784 19.4391 5.20784 19.1125V7.80315C5.20784 7.70003 5.13909 7.5969 5.03597 7.56253C5.00159 7.54534 4.98441 7.54534 4.95003 7.54534C4.88128 7.54534 4.79534 7.57972 4.74378 7.64847L3.78128 8.8344C3.60941 9.05784 3.24847 9.1094 2.99066 8.93753L1.54691 7.97503C1.27191 7.78597 1.20316 7.42503 1.37503 7.13284L3.91878 3.3344C4.36566 2.68128 5.01878 2.20003 5.79222 2.01097L7.83753 1.49534C7.87191 1.47815 7.90628 1.47815 7.94066 1.47815C8.11253 3.02503 9.41878 4.22815 10.9828 4.22815C12.5641 4.22815 13.8703 3.0594 14.0422 1.49534C14.0766 1.49534 14.111 1.51253 14.1453 1.51253L16.1907 2.02815C16.9641 2.21722 17.6172 2.68128 18.0641 3.35159L20.625 7.15003C20.7969 7.42503 20.7282 7.80315 20.4532 7.97503Z" stroke-width="0.75"></path>
						<path d="M14.7384 7H12.2616C12.1221 7 12 7.23333 12 7.5C12 7.76667 12.1221 8 12.2616 8H14.7384C14.8779 8 15 7.76667 15 7.5C15 7.23333 14.8779 7 14.7384 7Z"></path>
					</svg>
				</span>
				Одежда, обувь,
				аксессуары
				<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"></rect>
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"></rect>
				</svg>
			</a>
		</li>
		<li>
			<a href="#">
				<span class="nav-ico">
				<svg width="18" height="25" viewBox="0 0 18 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12.6752 21H5.32546C2.94042 21 1 18.859 1 16.2265V10.4321C1 9.64231 1.58194 9 2.29751 9H15.7031C16.4181 9 17 9.64231 17 10.4321V16.2265C17 18.8583 15.0602 21 12.6752 21ZM2.29751 9.67901C1.92187 9.67901 1.61581 10.0168 1.61581 10.4314V16.2258C1.61581 18.4831 3.27973 20.3196 5.32546 20.3196H12.6752C14.7203 20.3196 16.3842 18.4831 16.3842 16.2258V10.4314C16.3842 10.0168 16.0787 9.67901 15.7031 9.67901H2.29751Z"></path>
					<path d="M6.1721 9.40044C5.98442 9.40044 5.83211 9.24813 5.83211 9.06046V2.69994C5.83211 2.1376 5.37448 1.67998 4.81214 1.67998H4.69994C4.1376 1.67998 3.67998 2.1376 3.67998 2.69994V9.06046C3.67998 9.24813 3.52766 9.40044 3.33999 9.40044C3.15232 9.40044 3 9.24813 3 9.06046V2.69994C3 1.76226 3.76226 1 4.69994 1H4.81146C5.74915 1 6.5114 1.76226 6.5114 2.69994V9.06046C6.51208 9.24813 6.35977 9.40044 6.1721 9.40044Z"></path>
					<path d="M14.1714 9.40044C13.9837 9.40044 13.8314 9.24813 13.8314 9.06046V2.69994C13.8314 2.1376 13.3738 1.67998 12.8115 1.67998H12.6999C12.1376 1.67998 11.68 2.1376 11.68 2.69994V9.06046C11.68 9.24813 11.5277 9.40044 11.34 9.40044C11.1523 9.40044 11 9.24813 11 9.06046V2.69994C11 1.76226 11.7623 1 12.6999 1H12.8115C13.7492 1 14.5114 1.76226 14.5114 2.69994V9.06046C14.5114 9.24813 14.3591 9.40044 14.1714 9.40044Z"></path>
					<path d="M11.5514 24.0002H6.44888C6.2612 24.0002 6.10889 23.8479 6.10889 23.6602V21.3864C6.10889 21.1987 6.2612 21.0464 6.44888 21.0464H11.5514C11.7391 21.0464 11.8914 21.1987 11.8914 21.3864V23.6602C11.8914 23.8479 11.7391 24.0002 11.5514 24.0002ZM6.78886 23.3202H11.2114V21.7264H6.78886V23.3202Z"></path>
				</svg>
				</span>
				Электроника
				<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"></rect>
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"></rect>
				</svg>
			</a>
			<ul class="submenu">
				<li>
					<a href="#">
						GPS-навигаторы
					</a>
				</li>
				<li>
					<a href="#">
						Автомобильные радиостанции
					</a>
				</li>
				<li>
					<a href="#">
						Видеорегистраторы
					</a>
				</li>
				<li>
					<a href="#">
						Зарядные устройства, адаптеры
					</a>
				</li>
				<li>
					<a href="#">
						Кофеварки
					</a>
				</li>
				<li>
					<a href="#">
						Магнитолы
					</a>
				</li>
				<li>
					<a href="#">
						Холодильники
					</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">
				<span class="nav-ico">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g clip-path="url(#clip0)">
						<path d="M18.599 7.19666V4.29602L15.6833 2.8371L12.8483 0L10 0.712253L7.15174 0L4.31671 2.8371L1.40098 4.29602V7.19666L0 10.0007L1.40098 12.8047V15.7053L4.31671 17.1642L7.15174 20.0013L10 19.2891L12.8483 20.0013L15.6833 17.1642L18.599 15.7053V12.8047L20 10.0007L18.599 7.19666ZM17.2761 12.4922V14.8871L14.9954 16.0283L12.4434 18.5345L10 17.9228L7.55655 18.5345L5.17529 16.1515L2.72258 14.8858V12.4922L1.47903 10.0007L2.72391 7.5091V5.11419L5.00463 3.97299L7.55788 1.46555L10.0013 2.07718L12.4448 1.46555L14.826 3.84855L17.2787 5.11419V7.5091L18.521 10.0007L17.2761 12.4922Z"></path>
						<path d="M13.5007 5.5614L5.56348 13.5044L6.49892 14.4405L14.4361 6.49752L13.5007 5.5614Z"></path>
						<path d="M7.35426 9.33886C8.44832 9.33886 9.33865 8.44788 9.33865 7.35302C9.33865 6.25817 8.44832 5.36719 7.35426 5.36719C6.2602 5.36719 5.36987 6.25817 5.36987 7.35302C5.36987 8.44788 6.2602 9.33886 7.35426 9.33886ZM7.35426 6.69108C7.71939 6.69108 8.01573 6.98763 8.01573 7.35302C8.01573 7.71842 7.71939 8.01497 7.35426 8.01497C6.98913 8.01497 6.6928 7.71842 6.6928 7.35302C6.6928 6.98763 6.98913 6.69108 7.35426 6.69108Z"></path>
						<path d="M12.6458 10.6626C11.5517 10.6626 10.6614 11.5536 10.6614 12.6484C10.6614 13.7433 11.5517 14.6343 12.6458 14.6343C13.7398 14.6343 14.6302 13.7433 14.6302 12.6484C14.6302 11.5536 13.7398 10.6626 12.6458 10.6626ZM12.6458 13.3104C12.2806 13.3104 11.9843 13.0138 11.9843 12.6484C11.9843 12.283 12.2806 11.9865 12.6458 11.9865C13.0109 11.9865 13.3072 12.283 13.3072 12.6484C13.3072 13.0138 13.0109 13.3104 12.6458 13.3104Z"></path>
						</g>
						<defs>
						<clipPath id="clip0">
						<rect width="20" height="20"></rect>
						</clipPath>
						</defs>
					</svg>
				</span>
				Распродажа
				<svg class="arrow-right" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 1.8125 7.07129)"></rect>
					<rect width="9.54318" height="9.54318" transform="matrix(0.671554 -0.740955 0.671554 0.740955 0 7.07129)" fill="#0C202E"></rect>
				</svg>
			</a>
		</li>
	</ul>
	<a href="#" class="loal web-item">
		<p class="bd">Программа лояльности</p>
		<img src="./public/img/money.png" alt="money">
	</a>
	<a href="#" class="loal web-item">
		<p class="bd">Программа лояльности</p>
		<img src="./public/img/money.png" alt="money">
	</a>
  <script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>
    <div id="vk_groups"></div>
  <script type="text/javascript">
    VK.Widgets.Group("vk_groups", {mode: 3}, 20003922);
  </script>
</div>						</div>

						<div class="right-col about">
							<div class="breadcrumbs">
								<a href="/" class="url rg">Главная</a><i class="fas fa-arrow-right"></i><a href="#" class="url rg">О компании</a><i class="fas fa-arrow-right"></i><span class="url rg">О нас</span>
							</div>
							<div class="shop">
								<h2 class="shop__title mt rg">О нас</h2>
								<a class="d-inline-block" href="./public/img/about.png" data-lightbox="image-1" data-title="My caption 1">
									<img class="w-100" src="./public/img/about.png" alt="img">
								</a>
								<p class="rg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ex sem, sagittis ac felis quis, tempor iaculis erat. Nulla bibendum odio vel quam viverra pellentesque. Aenean elementum lacus non suscipit lobortis. Quisque finibus ac orci posuere vehicula. Proin nulla sapien, efficitur eu consequat sit amet, gravida vel tellus. Nullam maximus posuere malesuada. Integer placerat magna a sollicitudin interdum. Sed semper purus eu risus ornare mollis. In viverra orci eget elit placerat pharetra. Fusce laoreet ut purus et interdum. Morbi eu sapien nec risus ultricies molestie id interdum erat. Vestibulum feugiat mi sit amet mauris malesuada, eget semper elit lacinia.</p>
							</div>

							<div class="item__cont right">
								<a class="d-inline-block" href="./public/img/left-img.png" data-lightbox="image-2" data-title="My caption 2">
									<img src="./public/img/left-img.png" alt="img">
								</a>
								<p class="rg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ex sem, sagittis ac felis quis, tempor iaculis erat. Nulla bibendum odio vel quam viverra pellentesque. Aenean elementum lacus non suscipit lobortis. Quisque finibus ac orci posuere vehicula. Proin nulla sapien, efficitur eu consequat sit amet, gravida vel tellus. Nullam maximus posuere malesuada. Integer placerat magna a sollicitudin interdum. Sed semper purus eu risus ornare mollis. In viverra orci eget elit placerat pharetra. Fusce laoreet ut purus et interdum. Morbi eu sapien nec risus ultricies molestie id interdum erat. Vestibulum feugiat mi sit amet mauris malesuada, eget semper elit lacinia. Phasellus viverra et dui et iaculis. Phasellus mauris justo, efficitur quis elementum sit amet, tincidunt eu tellus.</p>
							</div>

							<div class="item__head">
								<h5 class="rg">Дорожная карта</h5>
							</div>

							<div class="paragr">
								<div class="paragr__title">
									<p class="rg btm">2009</p>
									<p class="rg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ex sem, sagittis ac felis quis, tempor iaculis erat. Nulla bibendum odio vel quam viverra pellentesque.</p>
								</div>
								<div class="paragr__title">
									<p class="rg btm">2011</p>
									<p class="rg">Quisque finibus ac orci posuere vehicula. Proin nulla sapien, efficitur eu consequat sit amet, gravida vel tellus. Nullam maximus posuere malesuada. Integer placerat magna a sollicitudin interdum. Sed semper purus eu risus ornare mollis. In viverra orci eget elit placerat pharetra. Fusce laoreet ut purus et interdum.</p>
								</div>
								<div class="paragr__title">
									<p class="rg btm">2014</p>
									<p class="rg">Suspendisse ac massa congue, pharetra neque eu, cursus dolor.</p>
								</div>
								<div class="paragr__title">
									<p class="rg btm">2015</p>
									<p class="rg">Sed sagittis sapien non tincidunt placerat. Quisque nunc felis, posuere ut lorem ac, semper placerat ligula. In sed feugiat dui, id dictum eros. Sed hendrerit magna urna, nec dictum nulla convallis ut. Etiam metus ex, finibus at arcu aliquam, faucibus malesuada diam. Vestibulum in sapien iaculis, sagittis turpis eu, scelerisque nibh.</p>
								</div>
								<div class="paragr__title">
									<p class="rg btm">2018</p>
									<p class="rg">Nam nec nisl tincidunt, sollicitudin est sit amet, tempor velit. Duis fringilla tellus sit amet sapien vulputate pretium.</p>
								</div>
								<div class="paragr__title">
									<p class="rg btm">2020</p>
									<p class="rg">Aliquam ultricies semper lorem, eget fermentum orci dictum eget. Aliquam porttitor orci nulla, ac tempor orci interdum gravida. Quisque blandit, dui in porttitor viverra, erat eros suscipit justo, a scelerisque eros felis eu mauris. Fusce a ipsum arcu.</p>
								</div>
							</div>

							<div class="item__head">
								<h5 class="rg">Реквизиты</h5>
							</div>

							<div class="rekv main_flex flex__align-items_start flex__jcontent_between">
								<img src="./public/img/sertificat.png" alt="serf" class="mx-auto">
								<div class="flex__1">
									<p class="rg">Общество с дополнительной ответственностью «АМ-Трейдер»</p>
									<p class="rg"><em>Юридический адрес:</em> Беларусь, 220068, г. Минск, ул. Орловская, д. 17, пом. 2Н, магазин «Автотюнинг».</p>
									<p class="rg mb-0"><em>Банковские реквизиты:</em> расчётный счёт в белорусских рублях BY89MTBK30120001093300065884, ЗАО «МТБанк», ЦБУ №3, г. Минск, ул. Короля, д. 51, БИК MTBKBY22.</p>
									<p class="rg mb-0">При оплате за товар через отделения банка в назначении платежа указывать «Предоплата за автоаксессуары».</p>
									<a href="#">Скачать реквизиты для оплаты.</a>
									<p class="rg mb-0">Свидетельство №100253019, выдано Мингорисполкомом 18.04.2001. УНП 100253019, ОКПО 14588310.</p>
								</div>
							</div>

							<div class="instagram">
								<div class="item__head">
									<h5 class="rg">НАШИ РАБОТЫ В <img src="./public/img/icon/logo_instagram.svg" width="12"> INSTAGRAM</h5>
								</div>
								<div class="insta-back-block">
									<p class="web-title">
										Магазин автоаксессуаров и доп.оборудования "Автотюнинг". г.Минск ул.Орловская17. <br>
										Скидки постоянным клиентам! Подарки при покупке в магазине!
									</p>
									<a href="#" class="inst-btn">
										<img src="public/img/pictures/insta-back_7.png" alt="">
									</a>
									<div class="follow-info">
										<p>
											121 Followers
										</p>
										<p>
											121 Follow
										</p>
									</div>
									<div class="pictures">
										<img src="public/img/pictures/insta-back_1.png" alt="">
										<img src="public/img/pictures/insta-back_2.png" alt="">
										<img src="public/img/pictures/insta-back_3.png" alt="">
										<img src="public/img/pictures/insta-back_4.png" alt="">
										<img src="public/img/pictures/insta-back_5.png" alt="">
										<img src="public/img/pictures/insta-back_6.png" alt="">
									</div>
								</div>
							</div>

							<div class="breadcrumbs">
								<a href="/" class="url rg">Главная</a><i class="fas fa-arrow-right"></i><a href="#" class="url rg">О компании</a><i class="fas fa-arrow-right"></i><span class="url rg">О нас</span>
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

			<script src="./public/lightbox/js/lightbox.min.js"></script>
			<?include( './public/tpl/scripts.php' );?>
			<script>
				var clock;

				$(document).ready(function() {
					var clock;

					clock = $('.clock').FlipClock({
						clockFace: 'DailyCounter',
						autoStart: false,
						callbacks: {
							stop: function() {
								$('.message').html('The clock has stopped!')
							}
						}
					});

					clock.setTime(101000);
					clock.setCountdown(true);
					clock.start();

				});
			</script>
			<script>
				ymaps.ready(init);
				function init () {
					var myMap = new ymaps.Map("map", {
						center: [53.931896, 27.560942],
						zoom: 16,
						controls: ['zoomControl']
					}),
					myPlacemark = new ymaps.Placemark([53.931896, 27.560942]);
					myMap.geoObjects.add(myPlacemark);
					myMap.behaviors.disable('scrollZoom');
				}
			</script>
		</body>
		</html>
