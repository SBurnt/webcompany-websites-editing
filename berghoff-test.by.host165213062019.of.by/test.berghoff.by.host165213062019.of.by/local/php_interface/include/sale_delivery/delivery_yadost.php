<?
$module_id="ipol.yadost";
CModule::IncludeModule($module_id);

// ��������� ����� CIPOLYadost::Init � �������� ����������� �������
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$module_id.'/classes/general/CIPOLYadost.php'))
	AddEventHandler("sale", "onSaleDeliveryHandlersBuildList", array('CIPOLYadost', 'Init'));