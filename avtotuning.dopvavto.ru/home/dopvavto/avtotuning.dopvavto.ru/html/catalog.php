<?include( './public/tpl/header.php' );?>
			<div id="content">
				<div class="wrapper">
					<div class="content clearfix">

						<div class="flex__block content__op">
							<?include( './public/tpl/sidebar.php' );?>
						</div>

						<div class="right-col rad">
							<div class="breadcrumbs">
								<a href="/" class="url rg">Главная</a><i class="fas fa-arrow-right"></i><span class="url rg">Каталог</span>
							</div>
							<!-- <div class="shop">
								<h2 class="shop__title category rg">Коврики</h2>
								<div class="order cart">
									<div class="order__block main_flex__nowrap flex__align-items_center flex__jcontent_between">
										<img class="svg" src="./public/img/icon/car-wheel.svg" width="31">
										<p class="rg">Поиск по автомобилю</p>
										<div class="clear main_flex__nowrap flex__align-items_center">
											<img class="svg" src="./public/img/icon/cancel.svg">
											<p class="rg">Очистить</p>
										</div>
										<div class="arrow"></div>
									</div>

									<div class="order__table">
										<div class="search__select main_flex flex__jcontent_between">
											<div class="dropdown">
												<span class="dropdown-button main_flex__nowrap flex__jcontent_between" data-text="Марка">Марка</span>
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
												<span class="dropdown-button main_flex__nowrap flex__jcontent_between" data-text="Модель">Модель</span>
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
												<span class="dropdown-button main_flex__nowrap flex__jcontent_between" data-text="Год">Год</span>
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
											<div class="submit">
												<button class="btn bd">Найти в каталоге</button>
												<div class="order__table--link bd">или <a href="#">выбрать из списка</a></div>
											</div>
										</div>
									</div>
								</div>

								<div class="order cart">
									<div class="order__block main_flex__nowrap flex__align-items_center flex__jcontent_between">
										<img src="./public/img/icon/paintbrush.svg" width="31">
										<p class="rg">Фильтр по параметрам</p>
										<div class="clear main_flex__nowrap flex__align-items_center">
											<img class="svg" src="./public/img/icon/cancel.svg">
											<p class="rg">Очистить</p>
										</div>
										<div class="arrow"></div>
									</div>

									<div class="order__table filters">
										<div class="search__select main_flex flex__align-items_start flex__jcontent_between flex__1">
											<div class="flex__1">
												<div class="rg order__price">Цена</div>

												<div id="price-slider">
													<div class="main_flex flex__align-items_start">
														<input type="text" id="amount-min">
														<div class="num">-</div>
														<input type="text" id="amount-max">
													</div>
													<div id="slider-range"></div>
												</div>

												<div class="md-checkbox">
													<input type="checkbox" id="i1">
													<label for="i1">В наличии</label>
												</div>

												<ul class="tag main_flex flex__align-items_start">
													<li class="rg">Хиты</li>
													<li class="rg">Распродажа</li>
													<li class="rg">Кликнутый тег</li>
													<li class="rg">Тег</li>
													<li class="rg">Тег</li>
													<li class="rg">Ещё тег</li>
												</ul>
											</div>

											<div class="flex__1">
												<div class="colors main_flex__nowrap flex__align-items_start flex__jcontent_between">
													<div class="check_city">
														<div class="rg order__city">Страна</div>
														<div class="md-checkbox">
															<input type="checkbox" id="i2">
															<label for="i2">Беларусь</label>
														</div>
														<div class="md-checkbox">
															<input type="checkbox" id="i3">
															<label for="i3">Германия</label>
														</div>
														<div class="md-checkbox">
															<input type="checkbox" id="i4">
															<label for="i4">Китай</label>
														</div>
														<div class="md-checkbox">
															<input type="checkbox" id="i5">
															<label for="i5">Россия</label>
														</div>
													</div>
													<div class="check__color">
														<div class="rg order__city">Цвет</div>
														<div class="md-checkbox">
															<input type="checkbox" id="i6">
															<label for="i6"></label>
														</div>
														<div class="md-checkbox">
															<input type="checkbox" id="i7">
															<label for="i7"></label>
														</div>
														<div class="md-checkbox">
															<input type="checkbox" id="i8">
															<label for="i8"></label>
														</div>
														<div class="md-checkbox mb-0">
															<input type="checkbox" id="i9">
															<label for="i9"></label>
														</div>
														<div class="md-checkbox mb-0">
															<input type="checkbox" id="i10">
															<label for="i10"></label>
														</div>
														<div class="md-checkbox mb-0">
															<input type="checkbox" id="i11">
															<label for="i11"></label>
														</div>
													</div>
												</div>
											</div>

											<div class="flex__1">
												<div class="rg order__producer">Производитель</div>
												<div class="check_producer">
													<div class="md-checkbox">
														<input type="checkbox" id="i12">
														<label for="i12">Autoprofi (201)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i13">
														<label for="i13">Chupa Chups (63)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i14">
														<label for="i14">Fouette (147)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i15">
														<label for="i15">Mentos (40)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i16">
														<label for="i16">Momo (13)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i17">
														<label for="i17">Sparco (45)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i18">
														<label for="i18">Зверобой (7)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i19">
														<label for="i19">Autoprofi (201)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i20">
														<label for="i20">Chupa Chups (63)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i21">
														<label for="i21">Fouette (147)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i22">
														<label for="i22">Mentos (40)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i23">
														<label for="i23">Momo (13)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i24">
														<label for="i24">Sparco (45)</label>
													</div>
													<div class="md-checkbox">
														<input type="checkbox" id="i25">
														<label for="i25">Зверобой (7)</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->

							<div class="sort main_flex flex__align-items_center">
								<h2 class="shop__title category rg">Каталог</h2>
								<div class="shop row main_flex">
									<div class="web_catalog_title">
										Коврики
									</div>
									<div class="item neon flex__1 discount-item">
											<div>
											<div class="bd price main_flex flex__align-items_center flex__jcontent_center">
												-60%
											</div>
											<div class="item__name bd">Автомобильный коврик в салон AUDI Q7</div>
											<div class="item__rating main_flex flex__align-items_center">
												<div class="rating main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												</div>
												<div class="item__message main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/chat.svg" width="16">
													<p class="rg">19</p>
												</div>
												<div class="item__article">
													<p class="rg">Артикул: NPL-Po-05-77</p>
												</div>
											</div>
											<div class="item__info main_flex flex__align-items_start flex__jcontent_center">
												<div class="item__info--img">
													<img src="./public/img/item.png" alt="item">
												</div>
												<div class="item__info--block flex__1">

													<p class="rg">Авто: AUDI Q7</p>
													<p class="rg">Год выпуска: с 2006</p>
													<p class="rg">Материал: полиуретан</p>
													<p class="rg">Цвет: чёрный</p>
													<p class="rg">Производитель: Norplast (Россия)</p>
													<button class="nal bd"><i class="fas fa-check"></i>В наличии</button>
												</div>
											</div>
										</div>
										<div>
											<div class="item__price main_flex flex__align-items_start flex__jcontent_between">
												<div class="rg coral">Старая цена: <span>3230,40</span></div>
												<div class="rg green">Экономия: <span>2000 руб.</span></div>
											</div>
											<div class="bg-price">1230,40<span>руб.</span></div>
											<div class="abs bd avalaible">В корзину</div>
										</div>
									</div>
									<div class="item neon flex__1">
										<div>
										<div class="item__name bd">Автомобильный коврик в салон AUDI Q7</div>
										<div class="item__rating main_flex flex__align-items_center">
											<div class="rating main_flex flex__align-items_center">
												<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
											</div>
											<div class="item__message main_flex flex__align-items_center">
												<img class="svg" src="./public/img/icon/chat.svg" width="16">
												<p class="rg">19</p>
											</div>
											<div class="item__article">
												<p class="rg">Артикул: NPL-Po-05-77</p>
											</div>
										</div>
										<div class="item__info main_flex flex__align-items_start flex__jcontent_center">
											<div class="item__info--img">
												<img src="./public/img/item.png" alt="item">
											</div>
											<div class="item__info--block flex__1">
												<p class="rg">Авто: AUDI Q7</p>
												<p class="rg">Год выпуска: с 2006</p>
												<p class="rg">Материал: полиуретан</p>
												<p class="rg">Цвет: чёрный</p>
												<p class="rg">Производитель: Norplast (Россия)</p>
												<p class="rg">Материал: полиуретан</p>
												<p class="rg">Цвет: чёрный</p>
												<p class="rg">Производитель: Norplast (Россия)</p>
												<p class="rg">Материал: полиуретан</p>
												<p class="rg">Цвет: чёрный</p>
												<p class="rg">Производитель: Norplast (Россия)</p>
												<p class="rg">Материал: полиуретан</p>
												<p class="rg">Цвет: чёрный</p>
												<p class="rg">Производитель: Norplast (Россия)</p>
												<p class="rg">Материал: полиуретан</p>
												<p class="rg">Цвет: чёрный</p>
												<p class="rg">Производитель: Norplast (Россия)</p>
												<button class="nal bd"><i class="fas fa-check"></i>В наличии</button>
											</div>
										</div>
									</div>
									<div>
										<div class="item__price main_flex flex__align-items_start flex__jcontent_between">
											<div class="rg coral">Старая цена: <span>3230,40</span></div>
											<div class="rg green">Экономия: <span>2000 руб.</span></div>
										</div>
										<div class="bg-price">1230,40<span>руб.</span></div>
										<div class="abs bd avalaible">В корзину</div>
									</div>
									</div>
									<div class="web_catalog_title">
										Органайзеры
									</div>
									<div class="item neon flex__1 discount-item">
											<div>
											<div class="bd price main_flex flex__align-items_center flex__jcontent_center">
												-60%
											</div>
											<div class="item__name bd">Автомобильный коврик в салон AUDI Q7</div>
											<div class="item__rating main_flex flex__align-items_center">
												<div class="rating main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												</div>
												<div class="item__message main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/chat.svg" width="16">
													<p class="rg">19</p>
												</div>
												<div class="item__article">
													<p class="rg">Артикул: NPL-Po-05-77</p>
												</div>
											</div>
											<div class="item__info main_flex flex__align-items_start flex__jcontent_center">
												<div class="item__info--img">
													<img src="./public/img/item.png" alt="item">
												</div>
												<div class="item__info--block flex__1">

													<p class="rg">Авто: AUDI Q7</p>
													<p class="rg">Год выпуска: с 2006</p>
													<p class="rg">Материал: полиуретан</p>
													<p class="rg">Цвет: чёрный</p>
													<p class="rg">Производитель: Norplast (Россия)</p>
													<button class="nal bd"><i class="fas fa-check"></i>В наличии</button>
												</div>
											</div>
										</div>
										<div>
											<div class="item__price main_flex flex__align-items_start flex__jcontent_between">
												<div class="rg coral">Старая цена: <span>3230,40</span></div>
												<div class="rg green">Экономия: <span>2000 руб.</span></div>
											</div>
											<div class="bg-price">1230,40<span>руб.</span></div>
											<div class="abs bd avalaible">В корзину</div>
										</div>
									</div>
									<div class="item neon flex__1 discount-item">
											<div>
											<div class="bd price main_flex flex__align-items_center flex__jcontent_center">
												-60%
											</div>
											<div class="item__name bd">Автомобильный коврик в салон AUDI Q7</div>
											<div class="item__rating main_flex flex__align-items_center">
												<div class="rating main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												</div>
												<div class="item__message main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/chat.svg" width="16">
													<p class="rg">19</p>
												</div>
												<div class="item__article">
													<p class="rg">Артикул: NPL-Po-05-77</p>
												</div>
											</div>
											<div class="item__info main_flex flex__align-items_start flex__jcontent_center">
												<div class="item__info--img">
													<img src="./public/img/item.png" alt="item">
												</div>
												<div class="item__info--block flex__1">

													<p class="rg">Авто: AUDI Q7</p>
													<p class="rg">Год выпуска: с 2006</p>
													<p class="rg">Материал: полиуретан</p>
													<p class="rg">Цвет: чёрный</p>
													<p class="rg">Производитель: Norplast (Россия)</p>
													<button class="nal bd"><i class="fas fa-check"></i>В наличии</button>
												</div>
											</div>
										</div>
										<div>
											<div class="item__price main_flex flex__align-items_start flex__jcontent_between">
												<div class="rg coral">Старая цена: <span>3230,40</span></div>
												<div class="rg green">Экономия: <span>2000 руб.</span></div>
											</div>
											<div class="bg-price">1230,40<span>руб.</span></div>
											<div class="abs bd avalaible">В корзину</div>
										</div>
									</div>
									<div class="web_catalog_title">
										Подлокотники
									</div>
									<div class="item neon flex__1 discount-item">
											<div>
											<div class="bd price main_flex flex__align-items_center flex__jcontent_center">
												-60%
											</div>
											<div class="item__name bd">Автомобильный коврик в салон AUDI Q7</div>
											<div class="item__rating main_flex flex__align-items_center">
												<div class="rating main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												</div>
												<div class="item__message main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/chat.svg" width="16">
													<p class="rg">19</p>
												</div>
												<div class="item__article">
													<p class="rg">Артикул: NPL-Po-05-77</p>
												</div>
											</div>
											<div class="item__info main_flex flex__align-items_start flex__jcontent_center">
												<div class="item__info--img">
													<img src="./public/img/item.png" alt="item">
												</div>
												<div class="item__info--block flex__1">

													<p class="rg">Авто: AUDI Q7</p>
													<p class="rg">Год выпуска: с 2006</p>
													<p class="rg">Материал: полиуретан</p>
													<p class="rg">Цвет: чёрный</p>
													<p class="rg">Производитель: Norplast (Россия)</p>
													<button class="nal bd"><i class="fas fa-check"></i>В наличии</button>
												</div>
											</div>
										</div>
										<div>
											<div class="item__price main_flex flex__align-items_start flex__jcontent_between">
												<div class="rg coral">Старая цена: <span>3230,40</span></div>
												<div class="rg green">Экономия: <span>2000 руб.</span></div>
											</div>
											<div class="bg-price">1230,40<span>руб.</span></div>
											<div class="abs bd avalaible">В корзину</div>
										</div>
									</div>
									<div class="item neon flex__1 discount-item">
											<div>
											<div class="bd price main_flex flex__align-items_center flex__jcontent_center">
												-60%
											</div>
											<div class="item__name bd">Автомобильный коврик в салон AUDI Q7</div>
											<div class="item__rating main_flex flex__align-items_center">
												<div class="rating main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												</div>
												<div class="item__message main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/chat.svg" width="16">
													<p class="rg">19</p>
												</div>
												<div class="item__article">
													<p class="rg">Артикул: NPL-Po-05-77</p>
												</div>
											</div>
											<div class="item__info main_flex flex__align-items_start flex__jcontent_center">
												<div class="item__info--img">
													<img src="./public/img/item.png" alt="item">
												</div>
												<div class="item__info--block flex__1">

													<p class="rg">Авто: AUDI Q7</p>
													<p class="rg">Год выпуска: с 2006</p>
													<p class="rg">Материал: полиуретан</p>
													<p class="rg">Цвет: чёрный</p>
													<p class="rg">Производитель: Norplast (Россия)</p>
													<button class="nal bd"><i class="fas fa-check"></i>В наличии</button>
												</div>
											</div>
										</div>
										<div>
											<div class="item__price main_flex flex__align-items_start flex__jcontent_between">
												<div class="rg coral">Старая цена: <span>3230,40</span></div>
												<div class="rg green">Экономия: <span>2000 руб.</span></div>
											</div>
											<div class="bg-price">1230,40<span>руб.</span></div>
											<div class="abs bd avalaible">В корзину</div>
										</div>
									</div>
									<div class="web_catalog_title">
										Подогрев
									</div>
									<div class="item neon flex__1 discount-item">
											<div>
											<div class="bd price main_flex flex__align-items_center flex__jcontent_center">
												-60%
											</div>
											<div class="item__name bd">Автомобильный коврик в салон AUDI Q7</div>
											<div class="item__rating main_flex flex__align-items_center">
												<div class="rating main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
													<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												</div>
												<div class="item__message main_flex flex__align-items_center">
													<img class="svg" src="./public/img/icon/chat.svg" width="16">
													<p class="rg">19</p>
												</div>
												<div class="item__article">
													<p class="rg">Артикул: NPL-Po-05-77</p>
												</div>
											</div>
											<div class="item__info main_flex flex__align-items_start flex__jcontent_center">
												<div class="item__info--img">
													<img src="./public/img/item.png" alt="item">
												</div>
												<div class="item__info--block flex__1">

													<p class="rg">Авто: AUDI Q7</p>
													<p class="rg">Год выпуска: с 2006</p>
													<p class="rg">Материал: полиуретан</p>
													<p class="rg">Цвет: чёрный</p>
													<p class="rg">Производитель: Norplast (Россия)</p>
													<button class="nal bd"><i class="fas fa-check"></i>В наличии</button>
												</div>
											</div>
										</div>
										<div>
											<div class="item__price main_flex flex__align-items_start flex__jcontent_between">
												<div class="rg coral">Старая цена: <span>3230,40</span></div>
												<div class="rg green">Экономия: <span>2000 руб.</span></div>
											</div>
											<div class="bg-price">1230,40<span>руб.</span></div>
											<div class="abs bd avalaible">В корзину</div>
										</div>
									</div>
									<div class="item flex__1 neon">
										<div>
										<div class="item__name bd">Автомобильный коврик в салон AUDI Q7</div>
										<div class="item__rating main_flex flex__align-items_center">
											<div class="rating main_flex flex__align-items_center">
												<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
												<img class="svg" src="./public/img/icon/star-favorite.svg" width="18">
											</div>
											<div class="item__message main_flex flex__align-items_center">
												<img class="svg" src="./public/img/icon/chat.svg" width="16">
												<p class="rg">19</p>
											</div>
											<div class="item__article">
												<p class="rg">Артикул: NPL-Po-05-77</p>
											</div>
										</div>
										<div class="item__info main_flex flex__align-items_start flex__jcontent_center">
											<div class="item__info--img">
												<img src="./public/img/item.png" alt="item">
											</div>
											<div class="item__info--block flex__1">
												<p class="rg">Авто: AUDI Q7</p>
												<p class="rg">Год выпуска: с 2006</p>
												<p class="rg">Материал: полиуретан</p>
												<p class="rg">Цвет: чёрный</p>
												<p class="rg">Производитель: Norplast (Россия)</p>
												<button class="nal bd nh"><i class="fas fa-times"></i>Нет в наличии</button>
											</div>
										</div>
										</div>
										<div>
											<div class="item__price main_flex flex__align-items_start flex__jcontent_between">
												<div class="rg coral">Старая цена: <span>3230,40</span></div>
												<div class="rg green">Экономия: <span>2000 руб.</span></div>
											</div>
											<div class="bg-price">1230,40<span>руб.</span></div>
											<div class="abs bd no-avalaible">Сообщить о поступлении</div>
										</div>
									</div>
								</div>
							</div>

<!-- 							<div class="txt1">
								<p class="rg">Для того, чтобы правильно подобрать и купить автомобильные коврики в Минске, автолюбитель должен разбираться в технических характеристиках и качестве материалов, из которых они изготовлены.</p>
								<div class="all">
									<div class="toggler">
										<button class="rg">Показать больше</button><img class='svg' src='./public/img/icon/right-angle.svg' width="10">
									</div>
									<div class="txt-seo">
										<div class="item__head">
											<h5 class="rg">Состав изделия, разновидности ковриков для авто</h5>
										</div>
										<p class="rg">Полиуретановые коврики для авто производят из полимерных материалов на севеленовой основе, что увеличивает устойчивость к износу, стиранию и механическим повреждениям. Синтетические гипоаллергенные материалы делают возможным эксплуатацию ковриков при температуре от -30 до +65 градусов.</p>
										<p class="rg">Коврики на резиновой основе изготавливаются с бортиком около 4 см, при этом специальное рельефное изображение предназначено для задерживания влаги и грязи от попадания в салон автомобиля. Такие коврики для авто сделаны из высококачественной резины с добавлением каучука (не менее 40%), что увеличивает их срок эксплуатации, а также избавляет владельца от неприятных запахов при увеличении температуры воздуха в салоне.</p>
										<p class="rg">Текстильные коврики в машину выполнены с применением синтетических материалов, что значительно увеличивает износоустойчивость даже при большом количестве влаги. Такие коврики очень удобны для использования в осенне-весенний период, благодаря чему влага с обуви просто впитывается в коврик, препятствуя попаданию грязи в салон авто. В особом уходе такие коврики не нуждаются: достаточно обычной сухой чистки пылесосом или щеткой, в редких случаях может понадобиться стирка обычными моющими средствами.</p>

										<div class="item__head">
											<h5 class="rg">Дизайн и приспособления</h5>
										</div>
										<p class="rg">Автомобильный коврики в Минске выпускаются конкретно под каждую марку авто, вплоть до микроавтобусов и джипов — это обусловлено тем, что коврики полностью соответствуют форме салона и кузова автомобиля.</p>
										<p class="rg">Такое совпадение размеров исключает произвольное скольжение коврика. Некоторые модели оснащены специальными креплениями, которое максимально надежно фиксируют коврик на полу. Для водителей обычно предусмотрен специальный вкладыш, который закрывает площадку для отдыха левой ноги водителя.</p>
										<p class="rg">Покупайте наши коврики из высококачественных материалов — это позволяет использовать их в любых погодных условиях, не причиняя вред салону автомобиля и надежно удерживая влагу и грязь.</p>
									</div>
								</div>
							</div> -->

							<div class="breadcrumbs">
								<a href="/" class="url rg">Главная</a><i class="fas fa-arrow-right"></i><span class="url rg">Каталог</span>
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
			</script>
		</body>
		</html>
