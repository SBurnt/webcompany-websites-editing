<div class="personal-page__content personal-page__orders personal-page__orders-more">

    <a href="[+backLink+]" class="personal-page__orders-link-back"><svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.693163 4.5L0.346146 4.17221L-0.000880718 4.5L0.346146 4.8278L0.693163 4.5ZM4.76299 2.67737e-09L0.346146 4.17221L1.04018 4.8278L5.45703 0.655598L4.76299 2.67737e-09ZM0.346146 4.8278L4.76299 9L5.45703 8.34441L1.04018 4.17221L0.346146 4.8278Z" fill="#F82900"/><path d="M0.694021 4.96353L11 4.96353V4.03638L0.694021 4.03638V4.96353Z" fill="#F82900"/></svg>
        Вернуться в список покупок
    </a>

    <div class="orders__item">
        <div class="orders__item-content">
            <div class="orders__item-content-top">
									<span class="orders__item-content-top-title personal-page__h5">
										Заказ №[+id+] от [+date+], [+total_items+] [+plural+] на сумму <span class="bg-red-price">[+totalPrice+] [+currency+]</span>
									</span>
            </div>

            <div class="orders__item-content-item wrap-show-info">
                <div class="orders-more__row orders-more__row-info">
										<span class="personal-page__h5 orders-more__row-info-title">
											Информация о заказе
										</span>

                    <div class="orders-more__row-list orders-more__row-info-list">
                        <div class="orders-more__row-item">
                            <span class="personal-page__small-text-gray">Ф.И.О.:</span>
                            <span class="personal-page__small-text-dark">
													[+webuser.fullname+]
												</span>

                            <span data-active-text="скрыть" data-text="показать" class="btn-show-info">
													<span class="btn-show-info-text">показать</span>

													<svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.59821 4.85714C9.59821 4.78571 9.5625 4.70536 9.50893 4.65179L5.34821 0.491071C5.29464 0.4375 5.21429 0.401786 5.14286 0.401786C5.07143 0.401786 4.99107 0.4375 4.9375 0.491071L0.776786 4.65179C0.723214 4.70536 0.6875 4.78571 0.6875 4.85714C0.6875 4.92857 0.723214 5.00893 0.776786 5.0625L1.22321 5.50893C1.27679 5.5625 1.35714 5.59821 1.42857 5.59821C1.5 5.59821 1.58036 5.5625 1.63393 5.50893L5.14286 2L8.65179 5.50893C8.70536 5.5625 8.78571 5.59821 8.85714 5.59821C8.9375 5.59821 9.00893 5.5625 9.0625 5.50893L9.50893 5.0625C9.5625 5.00893 9.59821 4.92857 9.59821 4.85714Z" fill="#00AA5C"/>
													</svg>
												</span>
                        </div>

                        <div class="orders-more__row-item">
                            <span class="personal-page__small-text-gray">Текущий статус:</span>
                            <span class="personal-page__small-text-dark">
													[+status+]
												</span>
                        </div>
                        <div class="orders-more__row-item">
                            <span class="personal-page__small-text-gray">Сумма:</span>
                            <span class="personal-page__small-text-dark">
                            <div class="bg-red-price">
													<strong>[+totalPrice+] [+currency+]</strong>
												</span></div>
                        </div>

                        <div class="orders-more__row-item">

                            [[if? &is=`[+refresh_allowed+]:=:true` &then=`
                            <form action="[+backLink+]&amp;pid=[+id+]" method="post">
                                <input type="hidden" name="pid" value="[+id+]" />
                                <input type="submit" class="personal-page__btn" name="shk_refresh" value="Повторить заказ" />
                            </form>
                            `]]
                            <br>
                            [[if? &is=`[+cancel_allowed+]:=:true` &then=`
                            <form action="[+backLink+]&amp;pid=[+id+]" method="post" onsubmit="if(confirm('Вы уверены, что хотите отменить заказ?')) return true; else return false;">
                                <input type="hidden" name="pid" value="[+id+]" />
                                <input type="submit" class="orders__item-border-bottom" name="shk_del" value="Отменить заказ" />
                            </form>
                            `]]
                        </div>
                    </div>



                </div>

                <div class="orders-more__item-info show-info">
                    [+contact+]
                </div>
            </div>

        </div>
    </div>


    <div class="orders__item">
        <div class="orders__item-content">
            <div class="orders__item-content-top">
									<span class="orders__item-content-top-title personal-page__h5">
										Содержимое заказа
									</span>
            </div>

            <div class="orders__item-wrap-table">
                <table class="orders__item-table-products">
                    <tr class="row-titles">
                        <td>Наименование</td>
                        <td>Цена</td>
                        <td>Скидка</td>
                        <td>Количество</td>
                        <td>Сумма</td>
                    </tr>
                    [+loop+]
                    <tr>
                        <td>
                            <div class="wrap-product-info">
                                <div class="wrap-img">
                                    <a href="[+link+]"><img src="[+product_prev+]" alt=""></a>
                                </div>
                                <div class="product-title">
                                    <a href="[+link+]">[+name+]</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="bg-red-price">
                                <strong>[+price+] [+currency+]</strong>
                            </div>
                        </td>
                        [[basket_sale_persent? &sale_persent_val=`[+sale_persent+]` &old_price_val=`[+old_price+]` &sale_lbl_val=`[+sale+]`]]
                        <td>[+count+] шт</td>
                        <td><div class="bg-red-price"><strong>[+price_count+] [+currency+]</strong></div></td>
                    </tr>
                    [+end_loop+]
                </table>

                <div class="wrap-product-mobile">

                </div>
            </div>

            <div class="orders__item-content-item orders__item-table-bottom">
                <div class="item-column">
                    <span>Итого:</span>
                </div>

                <div class="item-column">
                    <span class="bg-red-price">[+totalPrice+] [+currency+]</span>
                </div>
            </div>

        </div>
    </div>

    <a href="[+backLink+]" class="personal-page__orders-link-back"><svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.693163 4.5L0.346146 4.17221L-0.000880718 4.5L0.346146 4.8278L0.693163 4.5ZM4.76299 2.67737e-09L0.346146 4.17221L1.04018 4.8278L5.45703 0.655598L4.76299 2.67737e-09ZM0.346146 4.8278L4.76299 9L5.45703 8.34441L1.04018 4.17221L0.346146 4.8278Z" fill="#F82900"/><path d="M0.694021 4.96353L11 4.96353V4.03638L0.694021 4.03638V4.96353Z" fill="#F82900"/></svg>
        Вернуться в список покупок
    </a>

</div>