<?

use Citrus\Arealty\Cache;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

__IncludeLang($_SERVER['DOCUMENT_ROOT'].'/bitrix/components/citrus/realty.send_event/lang/'.LANGUAGE_ID.'/fields.php');

if (!function_exists('CSE_htmlspecialchars')):
    function CSE_htmlspecialchars($mixed, $quote_style = ENT_QUOTES, $charset = false)
    {
		if ($charset === false)
			$charset = SITE_CHARSET;
        if (is_array($mixed))
        {
            foreach($mixed as $key => $value)
            {
                $mixed[$key] = CSE_htmlspecialchars($value, $quote_style, $charset); 
            } 
        }
        elseif (is_string($mixed))
        { 
            $mixed = htmlspecialcharsbx(htmlspecialchars_decode($mixed, $quote_style), $quote_style, $charset);
        } 
        return $mixed; 
    }
endif;

if (!function_exists('CSE_GetFields')):     
/*
$arFields = Array(
	"kod polya" => Array(
			"ACTIVE" => true, // vivodity li pole na forme, po-umolchaniyu true
			"ORIGINAL_TITLE" => "Originalynoe nazvanie polya ili svoystva",
			"TITLE" => "Nazvanie polya (podpisy po-umolchaniyu)",
			"IS_REQUIRED" => false, // po-umolchaniyu false
			"TOOLTIP" => "", // podskazka po zapolneniyu
			"IS_EMAIL" => false, // yavlyaetsya e-mail'om, po-umolchaniyu false
	)
);
*/
	function CSE_GetFields($eventType)
	{
		$cacheKey = array($eventType);
		$arDefaultFields = Cache::remember($cacheKey, 24*30*60, function () use ($eventType) {

			$arType = CEventType::GetByID($eventType, LANGUAGE_ID)->fetch();
			$arDescr = explode("\n", $arType["DESCRIPTION"]);

			$arFields = array();
			foreach ($arDescr as $field)
			{
				if (preg_match('/^#([^#]+)#/', $field, $arMatches))
					$arFields[$arMatches[1]] = array("ORIGINAL_TITLE" => $field);
			}

			$arFields = array_merge(
				$arFields,
				array("__CAPTCHA__" => array("IS_REQUIRED" => true, "ORIGINAL_TITLE" => GetMessage("CSE_F_CAPTCHA"), "TITLE"=> GetMessage("CSE_F_CAPTCHA"), "TOOLTIP" => GetMessage("CSE_F_CAPTCHA_TOOLTIP")))
			);

			return $arFields;
		}, __FUNCTION__);

		return $arDefaultFields;
	}
endif;

if (!function_exists('htmlspecialcharsbx')):
	function htmlspecialcharsbx($string, $flags=ENT_COMPAT)
	{
		//shitty function for php 5.4 where default encoding is UTF-8
		return htmlspecialchars($string, $flags, (defined("BX_UTF")? "UTF-8" : "ISO-8859-1"));
	}
endif;

if (!function_exists('getSenderHeader')):
	/**
	 * Vozvrashtaet znachenie pochtovogo zagolovka Sender dlya pisyma, otpravlyaemogo s sayta s zadannim Id
	 * 
	 * Esli v $from bil peredan adres marat@citrus-soft.ru, to znacheniem zagolovka budet milo vida marat@<adres sayta> (iz $_SERVER["HTTP_HOST"]),
 	 * inache znachenie budet vzyato iz:
	 * 	 1. nastroyki "E-Mail adres po umolchaniyu" sayta (esli etot email zadan)
	 *   2. nastroyki "E-Mail administratora sayta (otpravitely po umolchaniyu)" glavnogo modulya (esli email sayta ne zadan).
	 * Esli poluchenniy email sovpadaet s $from, to verniot pustuyu stroku.
	 * 
 	 * @param array $siteId					Id sayta
  	 * @param string $from					Znachenie zagolovka From
	 * @return string
	 */
	function getSenderHeader($siteId, $from)
	{
		$arSite = CSite::getById($siteId)->fetch();
		$defaultEmailFrom = COption::GetOptionString("main", "email_from");

		if (toLower($from) == "marat@citrus-soft.ru")
		{
			$url = "http://" . $_SERVER["HTTP_HOST"];
			$arUrl = parse_url($url);
			$sender = "marat@" . $arUrl["host"];
		}	
		elseif (strlen($arSite["EMAIL"]))
			$sender = $arSite["EMAIL"];
	    else
			$sender = $defaultEmailFrom;
		if ($sender == $from)
			$sender = "";

		return $sender;
	}
endif;
