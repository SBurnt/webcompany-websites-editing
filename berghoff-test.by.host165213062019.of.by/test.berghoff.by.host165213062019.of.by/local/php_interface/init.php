<?
define("CATALOG_IBLOCK_ID", "27");
CModule::IncludeModule('nologostudio.main');
CModule::IncludeModule('iblock');
\Bitrix\Main\Loader::includeModule('ceteralabs.uservars');
AddEventHandler("main", "OnProlog", "SetVisitorCookie");
function SetVisitorCookie() {
   global $APPLICATION;
   $kk = $APPLICATION->get_cookie("FIRST_SITE_VIZIT");
   if ($kk != "YYY") {
      $APPLICATION->set_cookie("FIRST_SITE_VIZIT", "YYY", time()+60*60*12);
      $APPLICATION->set_cookie("FIRST_SITE_VIZIT_SHOW", "DO");
   } else {
      $APPLICATION->set_cookie("FIRST_SITE_VIZIT_SHOW", "NOT");
   }
}

AddEventHandler('main', 'OnBeforeEventSend', 'OnBeforeEventSendHandler');
function OnBeforeEventSendHandler($arFields, $arTemplate){
    if($arTemplate["ID"]==30){
        // Шаблон письма: Вы оформили новый заказ!
        // file_put_contents($_SERVER["DOCUMENT_ROOT"]."/event_send.log",date("d-m-Y H:i:s")."; arFields=".print_r($arFields,1)."; arTemplate=".print_r($arTemplate,1).";",FILE_APPEND);
    }
}
$welcomePage = \Ceteralabs\UserVars::GetVar('BASKET_OFF');
$_SESSION["BASKET_OFF"] = $welcomePage["VALUE"];
AddEventHandler("main", "OnAfterUserRegister", Array("UserActionClass", "OnAfterUserRegisterHandler"));
class UserActionClass{
    function OnAfterUserRegisterHandler(&$arFields){
        // file_put_contents($_SERVER["DOCUMENT_ROOT"]."/user_register.log",date("d-m-Y H:i:s")."; date=".print_r($arFields,1).";\n",FILE_APPEND);
        if($arFields["EMAIL"] && CModule::IncludeModule("subscribe")){
            $subscr = CSubscription::GetList(["ID"=>"ASC"], ["EMAIL"=>$arFields["EMAIL"]]);
            $arSubscr = $subscr->Fetch();
            if(!$arSubscr["ID"]){
                $arSubscr = Array(
                    "USER_ID" => $arFields["USER_ID"]?$arFields["USER_ID"]:false,
                    "SEND_CONFIRM" => "N",
                    "CONFIRMED" => "Y",
                    "FORMAT" => "html",
                    "EMAIL" => $arFields["EMAIL"],
                    "ACTIVE" => "Y",
                    "RUB_ID" => ["2","3"]
                );
                $subscr = new CSubscription;
                $SUBSCR_ID = $subscr->Add($arSubscr);
            }
        }
        
        if($arFields["USER_ID"] && CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog")){
            $el = new CIBlockElement;
            $PROMO = randString(6, ["ABCDEFGHIJKLNMOPQRSTUVWXYZ", "0123456789"]);
            $arLoadProductArray = [
                "MODIFIED_BY"    => 1,
                "IBLOCK_SECTION_ID" => false,
                "IBLOCK_ID"      => 23,
                "PROPERTY_VALUES"=> [
                        "191" => "500", // Скидка на сумму корзины
                        "187" => "2000", // Минимальная сумма корзины при которой сработает правило
                        "188" => "127" // Не учитывать товары с зачёркнутой ценой
                    ],
                "NAME"           => "Скидка за регистрацию USER_ID:".$arFields["USER_ID"],
                "CODE" => $PROMO,
                "ACTIVE"         => "Y"
            ];

            if($PRODUCT_ID = $el->Add($arLoadProductArray)){
                $_SESSION["NEW_COUPON"] = $PROMO;
            }else{
                echo "Error: ".$el->LAST_ERROR;
            }
            
            // Генерируем подарочный купон за регистрацию!
            /*
            $activeFrom = new \Bitrix\Main\Type\DateTime();
            $activeTo = new \Bitrix\Main\Type\DateTime();
            $activeTo = $activeTo->add('365 day');
            $coupon = \Bitrix\Sale\Internals\DiscountCouponTable::generateCoupon(true);
            $addDb = \Bitrix\Sale\Internals\DiscountCouponTable::add(array(
                            'DISCOUNT_ID' => 3,
                            'COUPON' => $coupon,
                            'TYPE' => \Bitrix\Sale\Internals\DiscountCouponTable::TYPE_ONE_ORDER,
                            'ACTIVE_FROM' => $activeFrom,
                            'ACTIVE_TO' => $activeTo,
                            'MAX_USE' => 1,
                            'USER_ID' => $arFields["USER_ID"],
                            'DESCRIPTION' => ''
                        ));
            if ($addDb->isSuccess()){
                $_SESSION["NEW_COUPON"] = $coupon;
            } else {
               echo $addDb->getErrorMessages();
            }
            */
        }
    }
}

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "OnBeforeIBlockElementUpdateHandler");
function OnBeforeIBlockElementUpdateHandler(&$arFields){
    if($arFields["IBLOCK_ID"]=="12" && $arFields["DETAIL_TEXT"] && is_array($arFields["PROPERTY_VALUES"]["180"])){
        $email = reset($arFields["PROPERTY_VALUES"]["180"]);
        $userName = reset($arFields["PROPERTY_VALUES"]["86"]);
        $product = reset($arFields["PROPERTY_VALUES"]["85"]);
        $arProduct = CIBlockElement::GetList([],["IBLOCK_ID"=>"4", "ID"=>$product["VALUE"]],false,false,["ID","NAME","DETAIL_PAGE_URL"])->GetNext();
        $link = "https://".$_SERVER["SERVER_NAME"].$arProduct["DETAIL_PAGE_URL"];
        CEvent::SendImmediate("NEW_RESPONSE_TO_REVIEW", "s1", [
            "USER_EMAIL" => $email["VALUE"],
            "USER_NAME" => $userName["VALUE"],
            "PRODUCT_NAME" => $arProduct["NAME"],
            "PRODUCT_URL" => $link
            ]
        );
        // file_put_contents($_SERVER["DOCUMENT_ROOT"]."/elem_update.log",date("d-m-Y H:i:s")."; arFields=".print_r($arFields,1).";",FILE_APPEND);
    }
}


function NLSSettings_GetSettings() {
    return array(
        "CONTENT" => array(
            "NAME" => "Контент для сайта ",
            "VARS" => array(
                "nls_phone" => array(
                    "NAME" => "Телефон",
                    "DEFAULT" => ""
                ),
                "nls_youtube" => array(
                    "NAME" => "Ссылка на Youtube о компании",
                    "DEFAULT" => ""
                ),
                "nls_youtube_sort" => array(
                    "NAME" => "СОРТИРОВКА для блока Youtube",
                    "DEFAULT" => ""
                ),
                "nls_main_tab_sort" => array(
                    "NAME" => "СОРТИРОВКА для блока Продукты на главной странице",
                    "DEFAULT" => ""
                ),
                "nls_blackbanchtext_on" => array(
                    "NAME" => "Включить чёрную плашку",
                    "TYPE" => "SELECT",
                    "DEFAULT" => "",
                    "VARIANTS" => ["Да","Нет"]
                ),
                "nls_blackbanchtext_top" => array(
                    "NAME" => "Текст на чёрной плашке (верх)",
                    "DEFAULT" => ""
                ),
                "nls_blackbanchtext_bot" => array(
                    "NAME" => "Текст на чёрной плашке (низ)",
                    "DEFAULT" => ""
                ),
            )
        ),
        "SOCIAL" => array(
            "NAME" => "Ссылки на социальные сети",
            "VARS" => array(
                "soc_fb" => array(
                    "NAME" => "Facebook",
                    "DEFAULT" => ""
                ),
                "soc_vk" => array(
                    "NAME" => "ВКонтакте",
                    "DEFAULT" => ""
                ),
                "soc_inst" => array(
                    "NAME" => "Instagramm",
                    "DEFAULT" => ""
                ),
                "soc_youtube" => array(
                    "NAME" => "Youtube",
                    "DEFAULT" => ""
                ),
                "soc_twitter" => array(
                    "NAME" => "Twitter",
                    "DEFAULT" => ""
                ),
                "soc_linkedin" => array(
                    "NAME" => "Linkedin",
                    "DEFAULT" => ""
                ),
            )
        ),
    );
}
function pr($arr){
    echo '<pre>',print_r($arr,1),'</pre>';
}

function add_excel(){
    define("NO_AGENT_CHECK", true);
    define("NO_KEEP_STATISTIC", true);
    CModule::IncludeModule('sale');
    CModule::IncludeModule('catalog');
    CModule::IncludeModule("nkhost.phpexcel");
    global $PHPEXCELPATH;
    require_once $PHPEXCELPATH.'/PHPExcel.php';
    $pExcel = new PHPExcel();

    $pExcel->setActiveSheetIndex(0);
    $aSheet = $pExcel->getActiveSheet();
    $aSheet->setTitle('Заказ');

//ID-заказа, ID-пользователя, Дата, ID-оплаты, ID-Доставки
    $arOrdersID = array();
    $dbOrders = CSaleOrder::GetList(array("ID" => "DESC"), array(), false, array('nTopCount' => 1), array("ID", "USER_ID", 'DATE_INSERT_FORMAT','PAY_SYSTEM_ID','DELIVERY_ID'));
    while ($arOrder = $dbOrders->Fetch()) {
        $arOrdersID = $arOrder;
    }

//$arDeliv['NAME']
    $arDeliv = CSaleDelivery::GetByID($arOrdersID['DELIVERY_ID']);
//$arPaySys['NAME']
    $arPaySys = CSalePaySystem::GetByID($arOrdersID['PAY_SYSTEM_ID']);
//Адрес и время доставки
    $dbOrderProps = CSaleOrderPropsValue::GetList(
        array("SORT" => "ASC"),
        array("ORDER_ID" => $arOrdersID['ID'])
    );
    while ($arOrderProps = $dbOrderProps->GetNext()):
        $OrderProps[] = $arOrderProps;
    endwhile;

//Название и количество
    $dbBasketItems = CSaleBasket::GetList(array(), array("ORDER_ID" => $arOrdersID['ID']), false, false, array("ID", "NAME", "PRODUCT_ID", "QUANTITY","PRICE","DISCOUNT_PRICE"));
    while ($arItems = $dbBasketItems->Fetch()) {
        $macciw[] = $arItems;
    }
    $i=1;
    $j=0;

    $style_wrap = array(
        // рамки
        'borders'=>array(
            // внешняя рамка
            'outline' => array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN,
            ),
            // внутренняя
            'allborders'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN,
            )
        )
    );
    $border = array(
        'borders'=>array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
            )
        )
    );
    if (count($macciw) > 1) {
        foreach ($macciw as $arMacciw) {
            $db_props = CIBlockElement::GetProperty(4, $arMacciw['PRODUCT_ID'], array("sort" => "asc"), Array("CODE"=>"CML2_ARTICLE"));
            $ar_props[] = $db_props->Fetch();

            $aSheet->setCellValue('C'.($i+13),$ar_props[$j]['VALUE']);
            $aSheet->setCellValue('D'.($i+13),$arMacciw['NAME']);
            $aSheet->setCellValue('E'.($i+13),$arMacciw['QUANTITY']);
            $aSheet->getStyle('E'.($i+13))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
            $aSheet->setCellValue('F'.($i+13),$arMacciw['PRICE']+$arMacciw['DISCOUNT_PRICE']);
            $aSheet->setCellValue('G'.($i+13),$arMacciw['PRICE']);
            $aSheet->setCellValue('H'.($i+13),($arMacciw['PRICE']+$arMacciw['DISCOUNT_PRICE'])*$arMacciw['QUANTITY']);
            $aSheet->setCellValue('I'.($i+13),$arMacciw['PRICE']*$arMacciw['QUANTITY']);
            $aSheet->getStyle('F'.($i+13).':I'.($i+13))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            $price_all += ($arMacciw['PRICE']+$arMacciw['DISCOUNT_PRICE'])*$arMacciw['QUANTITY'];
            $price_disc += $arMacciw['PRICE']*$arMacciw['QUANTITY'];
            $j++;
            $i++;
        }
    } else {
        //Артикул ar_props["VALUE"]
        $db_props = CIBlockElement::GetProperty(4, $macciw[0]["PRODUCT_ID"], "sort", "asc", Array("CODE" => "CML2_ARTICLE"));
        $ar_props = $db_props->Fetch();

        $aSheet->setCellValue('C14',$ar_props['VALUE']);
        $aSheet->setCellValue('D14',$macciw[0]['NAME']);
        $aSheet->setCellValue('E14',$macciw[0]['QUANTITY']);
        $aSheet->getStyle('E14')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
        $aSheet->setCellValue('F14',$macciw[0]['PRICE']+$macciw[0]['DISCOUNT_PRICE']);
        $aSheet->setCellValue('G14',$macciw[0]['PRICE']);
        $aSheet->setCellValue('H14',($macciw[0]['PRICE']+$macciw[0]['DISCOUNT_PRICE'])*$macciw[0]['QUANTITY']);
        $aSheet->setCellValue('I14',$macciw[0]['PRICE']*$macciw[0]['QUANTITY']);
        $aSheet->getStyle('F14:I14')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $aSheet->mergeCells('E16:G16');
        $aSheet->mergeCells('E17:G17');
        $aSheet->mergeCells('E18:G18');
        $aSheet->setCellValue('E16','Общая стоимость заказа: (сумма без скидки)');
        $aSheet->setCellValue('E17','Размер текущей скидки: (сумма скидки на все товары)');
        $aSheet->setCellValue('E18','Итого к оплате:(общая сумма заказа со скидкой)');
        $aSheet->getStyle("E16:E18")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $aSheet->mergeCells('H16:I16');
        $aSheet->mergeCells('H17:I17');
        $aSheet->mergeCells('H18:I18');
        $aSheet->setCellValue('H16',($macciw[0]['PRICE']+$macciw[0]['DISCOUNT_PRICE'])*$macciw[0]['QUANTITY']);
        $aSheet->setCellValue('H17',$macciw[0]['DISCOUNT_PRICE']*$macciw[0]['QUANTITY']);
        $aSheet->setCellValue('H18',$macciw[0]['PRICE']*$macciw[0]['QUANTITY']);
        $aSheet->getStyle("E18:H18")->getFont()->setBold(true);
        $aSheet->getStyle("H16:H18")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $aSheet->getStyle('E16:I16')->applyFromArray($border);
        $aSheet->getStyle('C13:I14')->applyFromArray($style_wrap);
        $aSheet->getStyle("C2:I14")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    }

    if($price_all && $price_disc){
        $aSheet->setCellValue('H'.($i+14), $price_all);
        $aSheet->setCellValue('H'.($i+15), $price_all-$price_disc);
        $aSheet->setCellValue('H'.($i+16), $price_disc);
        $aSheet->getStyle('E'.($i+16).':H'.($i+16))->getFont()->setBold(true);
        $aSheet->getStyle('H'.($i+14).':H'.($i+16))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $aSheet->getStyle('E'.($i+14).':I'.($i+14))->applyFromArray($border);
        $aSheet->getStyle('C13:I'.($i+12))->applyFromArray($style_wrap);
        $aSheet->getStyle("C2:I".($i+12))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $aSheet->mergeCells('E'.($i+14).':G'.($i+14));
        $aSheet->mergeCells('E'.($i+15).':G'.($i+15));
        $aSheet->mergeCells('E'.($i+16).':G'.($i+16));
        $aSheet->setCellValue('E'.($i+14),'Общая стоимость заказа: (сумма без скидки)');
        $aSheet->setCellValue('E'.($i+15),'Размер текущей скидки: (сумма скидки на все товары)');
        $aSheet->setCellValue('E'.($i+16),'Итого к оплате:(общая сумма заказа со скидкой)');
        $aSheet->getStyle('E'.($i+14).':E'.($i+16))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $aSheet->mergeCells('H'.($i+14).':I'.($i+14));
        $aSheet->mergeCells('H'.($i+15).':I'.($i+15));
        $aSheet->mergeCells('H'.($i+16).':I'.($i+16));
    }

    $aSheet->getColumnDimension('C')->setWidth(30);
    $aSheet->getColumnDimension('D')->setWidth(50);
    $aSheet->getColumnDimension('E')->setWidth(20);
    $aSheet->getColumnDimension('F')->setWidth(20);
    $aSheet->getColumnDimension('G')->setWidth(20);
    $aSheet->getColumnDimension('H')->setWidth(20);
    $aSheet->getColumnDimension('I')->setWidth(20);
    $aSheet->setCellValue('C2','№ заказа');
    $aSheet->setCellValue('D2',$arOrdersID['ID']);
    $aSheet->setCellValue('C3','Дата заказа');
    $aSheet->setCellValue('D3',$arOrdersID['DATE_INSERT_FORMAT']);
    $aSheet->getStyle('D3')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DATETIME);
    $aSheet->setCellValue('C4','Оплата');
    $aSheet->setCellValue('D4',$arPaySys['NAME']);

    $aSheet->setCellValue('C6','Имя пользователя:');
    $aSheet->setCellValue('D6',$OrderProps[0]['VALUE']);
    $aSheet->setCellValue('C7','Телефон:');
    $aSheet->setCellValue('D7',$OrderProps[2]['VALUE']);
    $aSheet->getStyle('D7')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
    $aSheet->setCellValue('C8','E-mail:');
    $aSheet->setCellValue('D8',$OrderProps[1]['VALUE']);
    $aSheet->setCellValue('C9','Адрес доставки:');
    $aSheet->setCellValue('D9',$OrderProps[3]['VALUE']);
    $aSheet->setCellValue('C10','Способ доставки:');
    $aSheet->setCellValue('D10',$arDeliv['NAME']);
    $aSheet->setCellValue('C11','Комментарий:');
    $aSheet->setCellValue('D11',$OrderProps[4]['VALUE']);
    $aSheet->getStyle("C2:D11")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

    $aSheet->setCellValue('C13','Артикул');
    $aSheet->setCellValue('D13','Наименование');
    $aSheet->setCellValue('E13','Кол-во');
    $aSheet->setCellValue('F13','Цена за единицу, бел. руб.');
    $aSheet->setCellValue('G13','Цена со скидкой за единицу, бел. руб.');
    $aSheet->setCellValue('H13','Общая цена, бел. руб.');
    $aSheet->setCellValue('I13','Общая цена со скидкой, бел. руб.');
    $aSheet->getStyle('C13:I13')->getAlignment()->setWrapText(true);

    $objWriter = PHPExcel_IOFactory::createWriter($pExcel, 'Excel2007');
    $objWriter->save("order_" . $arOrdersID["ID"] . ".xlsx");

    $file = $_SERVER['DOCUMENT_ROOT']."/upload/order/order_" . $arOrdersID["ID"] . ".xlsx";
    copy("order_" . $arOrdersID["ID"] . ".xlsx", $file); // делаем копию
    unlink("order_" . $arOrdersID["ID"] . ".xlsx"); // удаляем оригинал
}
?>