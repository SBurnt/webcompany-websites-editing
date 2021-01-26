<?if($arNotification["ID"]){?>
    <div class="popup js-popup" id="delivery-popup">
        <div class="popup-body">
            <button class="popup-close-button js-popup-close-button" type="button"></button>
            <div class="popup-content delivery-content">
                <div class="delivery-popup">
                    <h3 class="delivery-popup-title"><?=$arNotification["NAME"]?></h3>
                    <div class="delivery-popup-text">
                        <?=$arNotification["DETAIL_TEXT"]?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?}?>