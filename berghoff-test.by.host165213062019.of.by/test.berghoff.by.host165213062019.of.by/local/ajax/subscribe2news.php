<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
function is_email($email) {
  return preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/", $email);
}
if(CModule::IncludeModule("subscribe")){
    $subscr = new CSubscription;
    
    if($_REQUEST["EMAIL"]){
        $_SESSION['subscremail'] = $_REQUEST["EMAIL"];
        $APPLICATION->set_cookie("subscremail", $_REQUEST["EMAIL"], time()+60*60*24*30);
        $arCurSubscr = CSubscription::GetList([], ["EMAIL"=>$_REQUEST["EMAIL"]])->Fetch();
        if($arCurSubscr["EMAIL"]){
            echo json_encode(["ERROR"=>"Y"]);
        }else{
            $arSubscr = Array(
                "USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
                "SEND_CONFIRM" => "N",
                "CONFIRMED" => "Y",
                "FORMAT" => "html",
                "EMAIL" => $_REQUEST["EMAIL"],
                "ACTIVE" => "Y",
                "RUB_ID" => ["2","3"]
            );
            $SUBSCR_ID = $subscr->Add($arSubscr);
            if($SUBSCR_ID){
              echo json_encode(["email"=>"no"]);
              // echo "Спасибо, теперь вы подписаны на рассылку свежих новостей по адресу ".htmlspecialchars($_REQUEST["EMAIL"]).", без спама.";
            }else{
              echo json_encode(["ERROR"=>"Y"]);
              //echo "<span style='color: red;'>Ошибка подписки: ".$subscr->LAST_ERROR;
            }
        }
    }
}
else{
  echo json_encode(["ERROR"=>"Y"]);
  // echo "<span style='color: red;'>Ошибка модуля подписки...<br>Попробуйте позже<br>Или сообщите нам об ошибке: <a href='mailto:".COption::GetOptionString('main', 'email_from', 'default@admin.email')."'>".COption::GetOptionString('main', 'email_from', 'default@admin.email')."</a></span>";
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>