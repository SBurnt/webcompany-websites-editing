<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Оформление заказа");
$APPLICATION->SetPageProperty("hidesidebar", "Y");
$APPLICATION->SetTitle("Оформление заказа");
?>
<div class="arrange-page">
  <form class="arrange__form" action="#" method="post">
    <div class="arrange__block-wrap">
      <div class="arrange__title-wrap">
        <span class="arrange__title-num">1</span>
        <span class="arrange__title">Покупатель</span>
      </div>
      <div class="arrange__customer">
        <div class="customer__wrap">
          <div class="customer__input-item">
            <label class="customer__input-label" for="form__customer-name">ФИО <span>*</span></label>
            <div class="customer__input-wrap">
              <input class="customer__input" id="form__customer-name" type="text" name="name" required>
              <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.4436 17.6616C1.4436 17.6616 0 17.6616 0 16.218C0 14.7744 1.4436 10.4436 8.66162 10.4436C15.8796 10.4436 17.3232 14.7744 17.3232 16.218C17.3232 17.6616 15.8796 17.6616 15.8796 17.6616H1.4436ZM8.66162 9C9.81022 9 10.9118 8.54372 11.724 7.73153C12.5362 6.91935 12.9924 5.81779 12.9924 4.66919C12.9924 3.52059 12.5362 2.41903 11.724 1.60684C10.9118 0.79466 9.81022 0.338379 8.66162 0.338379C7.51302 0.338379 6.41146 0.79466 5.59928 1.60684C4.78709 2.41903 4.33081 3.52059 4.33081 4.66919C4.33081 5.81779 4.78709 6.91935 5.59928 7.73153C6.41146 8.54372 7.51302 9 8.66162 9Z" fill="#CACACA" />
              </svg>
            </div>
          </div>
          <div class="customer__input-item">
            <label class="customer__input-label" for="form__customer-email">E-mail <span>*</span></label>
            <div class="customer__input-wrap">
              <input class="customer__input" id="form__customer-email" type="email" name="email" required>
              <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.8015 1.00359L13.7427 7.02342L19.8015 13.0433C19.9111 12.8143 19.9775 12.5613 19.9775 12.291V1.75584C19.9775 1.48556 19.9111 1.23252 19.8015 1.00359Z" fill="#CACACA" />
                <path d="M18.2217 0H1.75567C1.48538 0 1.23234 0.0664496 1.00342 0.175976L8.74727 7.88081C9.43198 8.56551 10.5454 8.56551 11.2301 7.88081L18.974 0.175976C18.7451 0.0664496 18.492 0 18.2217 0Z" fill="#CACACA" />
                <path d="M0.175976 1.00359C0.0664496 1.23252 0 1.48556 0 1.75584V12.291C0 12.5613 0.0664496 12.8144 0.175976 13.0433L6.23483 7.02342L0.175976 1.00359Z" fill="#CACACA" />
                <path d="M12.9151 7.85106L12.0578 8.70843C10.9169 9.84931 9.06047 9.84931 7.91959 8.70843L7.06227 7.85106L1.00342 13.8709C1.23234 13.9804 1.48538 14.0469 1.75567 14.0469H18.2217C18.492 14.0469 18.7451 13.9804 18.974 13.8709L12.9151 7.85106Z" fill="#CACACA" />
              </svg>
            </div>
          </div>
          <div class="customer__input-item">
            <label class="customer__input-label" for="form__customer-phone">Телефон <span>*</span></label>
            <div class="customer__input-wrap">
              <input class="customer__input" id="form__customer-phone" type="tel" inputmode="tel" name="tel" placeholder="+ 375 (__) ___-__-__" required>
              <svg class="phone" width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.6966 11.9017C10.5338 13.907 9.10152 15.9112 8.18262 15.3788C6.86828 14.6172 5.98675 13.8829 4.18671 16.3334C2.3874 18.7826 4.4728 19.5415 5.74632 20.2786C7.21656 21.1306 11.252 18.8791 14.3912 13.4631C17.5292 8.04625 17.4728 3.42636 16.0016 2.57468C14.7275 1.83558 13.0384 0.403069 11.8082 3.18206C10.5769 5.96133 11.6514 6.36127 12.968 7.12334C13.8839 7.65661 12.8582 9.89556 11.6966 11.9017Z" fill="#CACACA" />
              </svg>
            </div>
          </div>
          <div class="customer__input-item">
            <label class="customer__input-label" for="form__customer-addres">Адрес доставки <span>*</span></label>
            <div class="customer__input-wrap">
              <textarea class="customer__input" id="form__customer-addres" name="message"></textarea>
              <svg width="14" height="19" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0C3.13 0 0 3.05444 0 6.83102C0 10.9004 4.42 16.5116 6.24 18.6487C6.64 19.1171 7.37 19.1171 7.77 18.6487C9.58 16.5116 14 10.9004 14 6.83102C14 3.05444 10.87 0 7 0ZM7 9.27067C6.33696 9.27067 5.70107 9.01364 5.23223 8.55612C4.76339 8.09859 4.5 7.47806 4.5 6.83102C4.5 6.18399 4.76339 5.56345 5.23223 5.10593C5.70107 4.64841 6.33696 4.39137 7 4.39137C7.66304 4.39137 8.29893 4.64841 8.76777 5.10593C9.23661 5.56345 9.5 6.18399 9.5 6.83102C9.5 7.47806 9.23661 8.09859 8.76777 8.55612C8.29893 9.01364 7.66304 9.27067 7 9.27067Z" fill="#CACACA" />
              </svg>
            </div>
          </div>
          <div class="customer__input-item">
            <label class="customer__input-label" for="form__customer-message">Комментарий к заказу</label>
            <div class="customer__input-wrap">
              <textarea class="customer__input" id="form__customer-message" name="message"></textarea>
              <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.60599 13.9564L12.1062 6.45628L8.54372 2.89384L1.04355 10.394C0.940297 10.4974 0.86695 10.6268 0.83129 10.7685L0 15L4.2307 14.1687C4.37275 14.1332 4.50269 14.0598 4.60599 13.9564ZM14.5274 4.03504C14.83 3.73234 15 3.32185 15 2.89384C15 2.46582 14.83 2.05533 14.5274 1.75263L13.2474 0.472603C12.9447 0.169995 12.5342 0 12.1062 0C11.6781 0 11.2677 0.169995 10.965 0.472603L9.68493 1.75263L13.2474 5.31507L14.5274 4.03504Z" fill="#CACACA" />
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="arrange__block-wrap">
      <div class="arrange__title-wrap">
        <span class="arrange__title-num">2</span>
        <span class="arrange__title">Доставка</span>
      </div>
      <div class="arrange__delivery">
        <div class="delivery__wrap">
          <label class="delivery__label">
            <input class="delivery__input" type="radio" name="delivery" value="Курьером" checked>
            <div class="delivery__text">
              <span class="delivery__title">Курьером</span>
              <span class="delivery__subtitle">Доставка осуществляется в течение дня в удобное для вас время.</span>
              <div class="delivery__cost">Стоимость: <span>50 р.</span></div>
            </div>
          </label>
          <label class="delivery__label">
            <input class="delivery__input" type="radio" name="delivery" value="Самовывоз г. Минск ул. Бабушкина, 62">
            <div class="delivery__text">
              <span class="delivery__title">Самовывоз г. Минск</span>
              <span class="delivery__subtitle">г. Минск, ул. Бабушкина, 62, 4 этаж</span>
              <div class="delivery__cost">Стоимость: <span>0 р.</span></div>
            </div>
          </label>
          <label class="delivery__label">
            <input class="delivery__input" type="radio" name="delivery" value="Самовывоз г. Минск пр-т Победителей, 17">
            <div class="delivery__text">
              <span class="delivery__title">Самовывоз г. Минск</span>
              <span class="delivery__subtitle">г. Минск, пр-т Победителей, 17 (магазин "Королевство меха")</span>
              <div class="delivery__cost">Стоимость: <span>0 р.</span></div>
            </div>
          </label>
          <label class="delivery__label">
            <input class="delivery__input" type="radio" name="delivery" value="Самовывоз г. Гродно">
            <div class="delivery__text">
              <span class="delivery__title">Самовывоз г. Гродно</span>
              <span class="delivery__subtitle">г. Гродно, пр-т Я. Купалы, 16а-1, ТЦ "Корона" пав.10</span>
              <div class="delivery__cost">Стоимость: <span>0 р.</span></div>
            </div>
          </label>
          <label class="delivery__label">
            <input class="delivery__input" type="radio" name="delivery" value="Самовывоз г. Могилев">
            <div class="delivery__text">
              <span class="delivery__title">Самовывоз г. Могилев</span>
              <span class="delivery__subtitle">г. Могилев, ул. Комсомольская 6а (магазин "Королевство меха")</span>
              <div class="delivery__cost">Стоимость: <span>0 р.</span></div>
            </div>
          </label>
        </div>
      </div>
    </div>
    <div class="arrange__block-wrap">
      <div class="arrange__title-wrap">
        <span class="arrange__title-num">3</span>
        <span class="arrange__title">Оплата</span>
      </div>
      <div class="arrange__payment">
        <div class="payment__wrap">
          <label class="payment__label">
            <input class="delivery__input" type="radio" name="payment" value="Наличными курьеру" checked>
            <div class="delivery__text">
              <span class="delivery__title">Наличными курьеру</span>
              <div class="delivery__subtitle-wrap">
                <img class="delivery__subtitle-img" src="/bitrix/images/basket-products/ico-payment-01.svg" alt="Наличными курьеру">
                <span class="delivery__subtitle">Оплата производится наличными деньгами, в момент получения заказа.</span>
              </div>
            </div>
          </label>
          <label class="payment__label">
            <input class="delivery__input" type="radio" name="payment" value="Банковской картой">
            <div class="delivery__text">
              <span class="delivery__title">Банковской картой</span>
              <div class="delivery__subtitle-wrap">
                <img class="delivery__subtitle-img" src="/bitrix/images/basket-products/ico-payment-02.svg" alt="Банковской картой">
                <span class="delivery__subtitle">Оплата производится банковской картой через сервис Яндекс.Касса.</span>
              </div>
            </div>
          </label>
          <label class="payment__label">
            <input class="delivery__input" type="radio" name="payment" value="Вариант 3">
            <div class="delivery__text">
              <span class="delivery__title">Вариант 3</span>
              <div class="delivery__subtitle-wrap">
                <img class="delivery__subtitle-img" src="/bitrix/images/basket-products/ico-payment-03.svg" alt="Вариант 3">
                <span class="delivery__subtitle">Описание еще одного варианта оплаты</span>
              </div>
            </div>
          </label>
        </div>
      </div>
    </div>
    <div class="basket__middle">
      <div class="basket__total-amount-wrap">
        <div class="basket__total-amount">ИТОГО:<span>10 344 р.</span></div>
        <button class="basket__arrange-btn" type="submit">Оформить заказ</button>
      </div>
    </div>
    <div class="arrange__thanks">
      <p class="arrange__thanks-text">Спасибо за заказ! С вами в ближайшее время свяжется наш менеджер для подтверждения заказа.</p>
    </div>
  </form>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>