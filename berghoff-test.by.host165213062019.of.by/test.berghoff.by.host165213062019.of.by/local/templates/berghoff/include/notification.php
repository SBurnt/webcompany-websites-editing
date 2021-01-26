<?
if(isset($_SESSION['notification']) && is_array($_SESSION['notification'])) $arNotification = $_SESSION['notification'];
    elseif($APPLICATION->get_cookie('notification')) $arNotification = explode(";", $APPLICATION->get_cookie('notification'));
        else $arNotification=[];
$arNotification = CIBlockElement::GetList(["SORT"=>"ASC"], ["IBLOCK_ID"=>"6", "ACTIVE"=>"Y", "!ID"=>$arNotification], false, false, ["ID","NAME","PROPERTY_LINK","DETAIL_TEXT"])->GetNext();
if($arNotification["ID"]){?>
      <div class="delivery-notification js-delivery-notification" data-id="delivery-popup">
          <div class="delivery-notification-body">
              <?=$arNotification["NAME"]?> <a href="#">Подробнее</a>
              <?if(false && $arNotification["PROPERTY_LINK_VALUE"]){?><a href="<?=$arNotification["PROPERTY_LINK_VALUE"]?>">Подробнее</a><?}?>
              <button class="delivery-notification-close-button js-delivery-notification-close-button" type="button" hidden onclick="saveNotification(<?=$arNotification["ID"]?>)"></button>
          </div>
      </div>
    <script>
    function saveNotification(ID){
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/local/ajax/save_notification.php?ID="+ID, true);
        xhr.send();
    }
    </script>
<?}?>