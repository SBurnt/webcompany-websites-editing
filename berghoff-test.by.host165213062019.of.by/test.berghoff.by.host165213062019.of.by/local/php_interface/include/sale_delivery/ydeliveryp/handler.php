<?
namespace Sale\Handlers\Delivery;

use Bitrix\Sale\Delivery\CalculationResult;
use Bitrix\Sale\Delivery\Services\Base;

class YdeliverypHandler extends Base
{
    public static function getClassTitle()
        {
            return 'Яндекс Доставка';
        }
        
    public static function getClassDescription()
        {
            return 'Доставка Яндекс Доставка!';
        }
        
    protected function calculateConcrete(\Bitrix\Sale\Shipment $shipment)
        {
            $result = new CalculationResult();
            $price = floatval($this->config["MAIN"]["PRICE"]);
            $weight = floatval($shipment->getWeight()) / 1000;
        
            $ydPrice = 0;
            if($_REQUEST["ORDER_PROP_27"]) $ydPrice = roundEx($_REQUEST["ORDER_PROP_27"], 2);
            $result->setDeliveryPrice($ydPrice);
            $result->setPeriodDescription($_REQUEST["ORDER_PROP_26"]);
            if(false)throw new SystemException("YDELIVERY Error !!!");
                else return $result;
        }
        
    protected function getConfigStructure()
        {
            return array(
                "MAIN" => array(
                    "TITLE" => 'Настройка обработчика',
                    "DESCRIPTION" => 'Настройка обработчика',"ITEMS" => array(
                        "PRICE" => array(
                                    "TYPE" => "NUMBER",
                                    "MIN" => 0,
                                    "NAME" => 'Стоимость доставки за килограмм'
                        )
                    )
                )
            );
        }
        
    public function isCalculatePriceImmediately()
        {
            return true;
        }
        
    public static function whetherAdminExtraServicesShow()
        {
            return true;
        }
}
?>