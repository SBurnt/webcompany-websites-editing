<h2>[+title+]</h2>

<div class="personal-page__content personal-page__history-orders">
[+phx:if=`[+notempty+]`:is=`true`:then=`

[+loop+]
<div class="orders__item">
    <div class="orders__item-top">
		<span class="orders__item-title personal-page__h4">
			Заказ в статусе «[+phaseName+] [+tracking_num+]»
		</span>
    </div>

    <div class="orders__item-content">
        <div class="orders__item-content-top">
			<span class="orders__item-content-top-title personal-page__h5">
				Заказ №[+id+] от [+date+], [+total_items+] [+plural+] на сумму <span class="bg-red-price">[+price+] [+currency+]</span>
			</span>
        </div>

        <div class="orders__item-content-bottom">
            <a href="[+link+]" class="personal-page__link">Подробнее о заказе</a>
            <!--<a href="#" class="orders__item-border-bottom orders__item-border-bottom_dark">Повторить заказ</a>-->
        </div>
    </div>
</div>
[+end_loop+]

[+pages+]

`:else=`

<br/>
<p>Нет заказов.</p>

`+]
</div>



