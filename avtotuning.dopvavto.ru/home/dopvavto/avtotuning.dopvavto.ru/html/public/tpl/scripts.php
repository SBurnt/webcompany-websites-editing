<script src="./public/js/jquery.min.js"></script>
<script src="./public/js/jquery-ui.min.js"></script>
<script src="./public/js/jquery.fancybox.min.js"></script>
<script src="./public/js/flipclock.js"></script>
<script src="./public/js/owl.carousel.min.js"></script>
<script src="./public/js/app.js"></script>
<script src="./public/js/common.js"></script>


<script>
      jQuery(document).ready(function() {

        var css =
          '<style>\n\
            .markup-nav { cursor: pointer; position: fixed; z-index: 5000; top: 60px; left: -176px; width: 170px; font:bold 12px/1.2 Helvetica, Arial; box-shadow: 0 0 4px rgba(0, 0, 0, .6); transition: left 200ms ease; box-sizing: border-box; }\n\
            .markup-nav__inner { background:#fff; padding: 5px 10px 5px 0; position: relative; }\n\
            .markup-nav:before { content: ""; position: absolute; left: 100%; top: 0; width: 30px; height: 24px; background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAMAAABhEH5lAAAAwFBMVEUAAAD///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABiCivsAAAAP3RSTlMAAAIEEBEVFiYsLS4vMzg5Ojs8PT5BR0tUXV5gaG5vcHd4fby9v8DBwsTFycvMzc/g4+Tl5uvs7vP09fb5+v5kF+L8AAAAsklEQVR42m3QaReBQBTG8aks2VNIthARQostmvv9v5U7V5164f/qOb9zZuYUyzLi2KAhSTl5AF5B/cuhOYkAgpHqnTWiEwAH6gPgE+2h1JaozQtJVSIb59uu1lcpjjHSwH3gshi2xBG6QxYCliiCaiAKfvSUBVWIQqY54qApaIYj3mi41rhupqxYCY4pvdgD0UsA8AaRC6V2RD7k8fyDNN/tzO9436LlHLv/f06WHl31jL67eSl1BXfldgAAAABJRU5ErkJggg==) no-repeat 75% 50% white; box-shadow: 0 0 4px rgba(0, 0, 0, .6); }\n\
            .markup-nav a { display: block; padding: 2px 10px; color: #000; /*text-shadow: 1px 1px 0 #283E68;*/text-decoration: none !important; border: none !important; }\n\
            .markup-nav a:hover { background: #edf1f5; color: #000 !important; }\n\
            .markup-nav.is-open { left: 0; }\n\
          </style>';

        var html =
          '<div class="markup-nav">\n\
            <div class="markup-nav__inner">\n\
              <a href="index.php">Главная</a>\n\
              <a href="catalog.php">Каталог</a>\n\
              <a href="catalog3.php">Каталог новый</a>\n\
              <a href="catalog2.php">Каталог подкатегории</a>\n\
              <a href="category.php">Категория</a>\n\
              <a href="category3.php">Категория подкатегории 2</a>\n\
              <a href="payment.php">Оплата</a>\n\
              <a href="delivery.php">Доставка</a>\n\
              <a href="item.php">Карточка товара</a>\n\
              <a href="item-inner.php">Карточка товара(сообщить о поступлении)</a>\n\
              <a href="search-block.php">Блок в поисков строке</a>\n\
              <a href="stock.php">Акции</a>\n\
              <a href="stock-inner.php">Акцияя</a>\n\
              <a href="about.php">О нас</a>\n\
              <a href="manafactures.php">Производители</a>\n\
              <a href="team.php">Команда</a>\n\
              <a href="news.php">Новости</a>\n\
              <a href="history.php">История</a>\n\
              <a href="profile.php">Профиль</a>\n\
              <a href="profile2.php">Профиль(ЮР)</a>\n\
              <a href="review.php">Отзывы</a>\n\
              <a href="photos.php">Фото</a>\n\
              <a href="video.php">Видео</a>\n\
              <a href="contacts.php">Контакты</a>\n\
              <a href="info-page.php">Информационная</a>\n\
              <a href="checkout.php">Оформление заказа</a>\n\
              <a href="thanks.php">Спасибо</a>\n\
              <a href="registration.php">Регистрация</a>\n\
              <a href="recovery2.php">Смена пароля</a>\n\
              <a href="recovery.php">Востановление пароля</a>\n\
              <a href="car-selection.php">Выбор автомобиля</a>\n\
              <a href="pending-goods.php">Отложенные товары</a>\n\
              <a href="cart.php">Корзина</a>\n\
            </div>\n\
          </div>'

        jQuery('body').prepend(css + html);

        jQuery('.markup-nav').on('click', function() {
          jQuery(this).toggleClass('is-open');
        });

      });
    </script>
<!--<a href="category2.php">Категория подкатегории</a>\n\-->
