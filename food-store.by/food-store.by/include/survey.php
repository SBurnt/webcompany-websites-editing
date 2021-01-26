<div class="feedback-up">
    <div class="feedback-up__wrap">
        <div class="feedback-up__content">
            <button class="feedback-up__close">
                <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                        <path
                                d="M4.59548 4.50099L7.87669 0.809627C8.04111 0.624635 8.04111 0.324718 7.87669 0.139743C7.71225 -0.0452485 7.44564 -0.0452485 7.28122 0.139743L3.99999 3.83111L0.71878 0.139743C0.554343 -0.0452485 0.287749 -0.0452485 0.123328 0.139743C-0.0410937 0.324735 -0.0411093 0.624653 0.123328 0.809627L3.40454 4.50099L0.123328 8.19236C-0.0411093 8.37735 -0.0411093 8.67727 0.123328 8.86224C0.287765 9.04723 0.554358 9.04722 0.71878 8.86224L3.99999 5.17088L7.28119 8.86224C7.44563 9.04723 7.71223 9.04722 7.87666 8.86224C8.04108 8.67725 8.04108 8.37733 7.87666 8.19236L4.59548 4.50099Z"
                                fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect width="8" height="9" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </button>
            <div class="feedback-up__title"><?=$arFields['NAME']?></div>
            <form class="feedback-up__form">
                <label class="feedback-up__question" for="#feedback-up__answer"><?=$arFields['PROPERTY_VOPROS_VALUE']?></label>
                <textarea class="feedback-up__answer layout-scrollbar" id="feedback-up__answer" name="feedback-up-answer"
                          cols="30" rows="6" style="resize:none;border:none;"></textarea>
                <input type="hidden" name="capcha_yes_name" value="<?=$arFields['PROPERTY_KAPCHA_VALUE']=='Да'? 'Да' : 'Нет'?>" class="capcha_yes"/>
                <?if($arFields['PROPERTY_KAPCHA_VALUE']=='Да'){?>
                    <div class="text-danger" id="recaptchaError"></div>
                    <div class="feedback-up__recaptcha g-recaptcha" data-sitekey="6Lflh7UZAAAAAEl1nKccuxzLS2PH6LCiTd2nI3e4"></div>
                <?}?>
                <button class="feedback-up__btn-send">Отправить</button>
            </form>
        </div>
    </div>
</div>
<div class="feedback-turn">
    <div class="feedback-turn__wrap">
        <svg class="feedback-turn__ico" width="37" height="37" viewBox="0 0 37 37" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <rect width="37" height="37" rx="18.5" fill="#f00001" />
            <path
                d="M15.2567 17.8968C15.3763 17.7926 15.4961 17.6882 15.6103 17.5901C13.1209 15.3264 9.28175 11.8142 8.01172 10.6518L15.2567 17.8968ZM28.9878 10.6518C27.7173 11.8146 23.8787 15.3265 21.3892 17.5902C23.8704 19.7213 27.7102 23.3618 28.9909 24.5831C29.0135 24.5016 29.0414 24.4219 29.0414 24.3333V10.9167C29.0414 10.8228 29.0131 10.7376 28.9878 10.6518ZM19.8366 18.9975C19.4422 19.3536 18.9798 19.5417 18.4998 19.5417C18.0197 19.5417 17.5573 19.3536 17.1624 18.997C16.9336 18.7908 16.6433 18.528 16.3255 18.2397C16.2 18.347 16.0685 18.461 15.9361 18.5762L22.6517 25.2917H28.0831C28.1598 25.2917 28.2277 25.265 28.2992 25.2479C26.976 23.9864 23.1119 20.3249 20.6741 18.2397C20.3561 18.5281 20.0656 18.7912 19.8366 18.9975Z"
                fill="url(#paint0_linear)" />
            <path
                d="M28.0833 9H8.91668C7.85958 9 7 9.85958 7 10.9167V24.3334C7 25.3904 7.85958 26.25 8.91668 26.25H28.0834C29.1404 26.25 30 25.3904 30 24.3333V10.9167C30 9.85958 29.1404 9 28.0833 9Z"
                fill="white" />
            <path
                d="M8.91676 25.2917C8.84021 25.2917 8.77215 25.265 8.70068 25.2479C10.0235 23.9869 13.8881 20.3251 16.3258 18.2397C16.6436 18.528 16.9339 18.7908 17.1627 18.997C17.5577 19.3536 18.02 19.5417 18.5001 19.5417C18.9802 19.5417 19.4425 19.3536 19.837 18.9975C20.0659 18.7912 20.3564 18.5281 20.6743 18.2397C23.1122 20.3249 26.9762 23.9864 28.2995 25.2479C28.228 25.265 28.16 25.2917 28.0834 25.2917H8.91676Z"
                fill="#C41230" />
            <path
                d="M21.3896 17.5902C23.8791 15.3264 27.7177 11.8146 28.9882 10.6517C29.0136 10.7375 29.0419 10.8228 29.0419 10.9166V24.3333C29.0419 24.4219 29.0138 24.5016 28.9913 24.5831C27.7106 23.3618 23.8709 19.7214 21.3896 17.5902Z"
                fill="#C41230" />
            <path
                d="M28.0833 9.95831C28.1539 9.95831 28.2162 9.98405 28.2824 9.99861C26.6231 11.5173 21.1208 16.5509 19.1954 18.2857C19.0447 18.4214 18.8018 18.5833 18.5 18.5833C18.1982 18.5833 17.9553 18.4214 17.8042 18.2853C15.8789 16.5507 10.3764 11.5168 8.71729 9.9987C8.78368 9.98414 8.84603 9.95836 8.91669 9.95836H28.0833V9.95831Z"
                fill="#C41230" />
            <path
                d="M8.00908 24.5831C7.98648 24.5016 7.9585 24.4219 7.9585 24.3333V10.9167C7.9585 10.8228 7.9868 10.7376 8.01213 10.6518C9.28216 11.8142 13.1214 15.3264 15.6108 17.5901C13.1294 19.7216 9.28922 23.3624 8.00908 24.5831Z"
                fill="#C41230" />
            <defs>
                <linearGradient id="paint0_linear" x1="13.2559" y1="5.40876" x2="30.711" y2="22.8639"
                                gradientUnits="userSpaceOnUse">
                    <stop stop-opacity="0.64" />
                    <stop offset="1" stop-opacity="0" />
                </linearGradient>
            </defs>
        </svg>
        <div class="feedback-turn__text">Оставить сообщение</div>
    </div>
</div>
<?if($arFields['PROPERTY_KAPCHA_VALUE']=='Да'){?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
<?}?>
