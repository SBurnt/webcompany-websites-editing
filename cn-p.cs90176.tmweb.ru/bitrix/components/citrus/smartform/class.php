<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * @var CBCitrusSmartForm $this Tekushtiy vizvanniy komponent
 * @var array $arResult Massiv rezulytatov raboti komponenta
 * @var array $arParams Massiv vhodyashtih parametrov komponenta, mozhet ispolyzovatysya dlya ucheta zadannih parametrov pri vivode shablona (naprimer, otobrazhenii detalynih izobrazheniy ili ssilok).
 * @var string $componentName Imya vizvannogo komponenta
 * @var string $componentPath Puty k papke s komponentom ot DOCUMENT_ROOT
 * @var string $componentTemplate Shablon vizvannogo komponenta
 * @var string $parentComponentName
 * @var string $parentComponentPath
 * @var string $parentComponentTemplate
 * @var string $templateFile Puty k shablonu otnositelyno kornya sayta, naprimer /bitrix/components/bitrix/iblock.list/templates/.default/template.php)
 * @var string $templateName Imya shablona komponenta (naprimer: .default)
 * @var string $templateFolder Puty k papke s shablonom ot DOCUMENT_ROOT (naprimer /bitrix/components/bitrix/iblock.list/templates/.default)
 * @var array $templateData Massiv dlya zapisi, obratite vnimanie, takim obrazom mozhno peredaty dannie iz template.php v fayl component_epilog.php, prichem eti dannie popadayut v kesh, t.k. fayl component_epilog.php ispolnyaetsya na kazhdom hite
 * @var CMain $APPLICATION
 */

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\SystemException;
use Bitrix\Main\IO\File;
use Bitrix\Main\Web\Json;
use Bitrix\Main\Security\Sign\Signer;

Loc::loadMessages(__FILE__);
Loc::loadMessages(__DIR__ . "/.parameters.php");

class CBCitrusSmartForm extends CBitrixComponent {
	const ACTION_ADD = 'add';
	const ACTION_UPDATE = 'update';
	const SESSION_PREFIX = 'CITRUS_FROM';

	protected static $iblocks;

	protected $action;

	var $allowRegistration = false;
	var $addGroup = false;
	var $bxPrefix = "UF_";
	var $eventPostfix = "SmartForm";
	var $LAST_ERROR = array();
	var $listFType = array("L","E","G");
	var $formID = null;
	var $templateMap;

	static $arFieldTemplates;

	static $arFTemplateType = array(
		'captcha' => array('CAPTCHA'),
		'date' => array('Date','DateTime'),
		'file' => array('F'),
		'html' => array('HTML','T'),
		'list' => array('E','G','L', 'EAutocomplete'),
		'text' => array('S','N','TEXT'),
		'number' => array("UserID"),
		'unknown' => array(),
	);

	protected $arAllowField = array(
		'VALID_ERROR_MSG',
		'VALIDRULE',
		'REGRULE',
		'ADDITIONAL',
		'DEFAULT',
		'CLASS',
		'PLACEHOLDER',
		'DESCRIPTION',
		'TITLE',
		'DEPTH_LAVEL',
		'IS_REQUIRED',
		'HIDE_FIELD',
		'ORIGINAL_TITLE',
		'GROUP_FIELD',
		'ACTIVE',
		'TEMPLATES',
		'TEMPLATE_ID'
	);

	public function onPrepareComponentParams($arParams) {
		$this->GetRequiredUserField();

		$arParams['CACHE_TIME'] = isset($arParams["CACHE_TIME"]) ? $arParams["CACHE_TIME"] : 36000000;
		$arParams['FORM_ACTIONS'] = array_key_exists('FORM_ACTIONS', $arParams) && strlen($arParams['FORM_ACTIONS']) > 0 ? trim(htmlspecialcharsbx($arParams['FORM_ACTIONS'])) : $GLOBALS['APPLICATION']->GetCurPage();

		$arParams['SEND_IMMEDIATE'] = array_key_exists('SEND_IMMEDIATE', $arParams) && $arParams['SEND_IMMEDIATE'] == "Y" ? "Y" : "N";

		$arParams['FIELDS'] = is_array($arParams['FIELDS']) ? $arParams['FIELDS'] : array();

		/**
		 * poluchim spisok polyzovatelyskih poley, i dobavim v polyzovatelyskoe svoystvo nedostayushtie polya
		 */
		$arUserFields = $this->GetUserField();
		if(!empty($arParams['FIELDS'])) {
			$arUpFields = array_merge_recursive(array_intersect_key($arParams['FIELDS'], $arUserFields),array_intersect_key($arUserFields,$arParams['FIELDS']));
			foreach($arUpFields as $code => $value) {
				$arSettings = $GLOBALS['USER_FIELD_MANAGER']->PrepareSettings(0,$value);

				/**
				 * esli regulyarnoe virazhenie dlya proverki bilo ukazano v adminke, to pereopredelim nastroyki kompanenta
				 */
				if($arSettings && array_key_exists('REGEXP', $arSettings))
					$value['VALIDRULE'] = strlen($arSettings['REGEXP']) > 0 ? $arSettings['REGEXP'] : trim($value['VALIDRULE']);

				/**
				 * pereopredelim soobshtenie ob oshibke
				 */
				$value['VALID_ERROR_MSG'] = strlen($value['ERROR_MESSAGE']) > 0 ? $value['ERROR_MESSAGE'] : $value['VALID_ERROR_MSG'];
				$arParams['FIELDS'][$code] = $value;
			}

			foreach($arParams['FIELDS'] as $code => &$value) {
				$value['CODE'] = "FIELDS[{$code}]";

				if(is_string($value['VALIDRULE']) && strlen($value['VALIDRULE']) > 0) {
					$value['VALIDRULE'] = explode(';',$value['VALIDRULE']);
				} elseif(!$value['GROUP_FIELD']) {
					$value['VALIDRULE'] = array();
				}

				/**
				 * dobavim obyazatelynie polya v pravila validatsii
				 */
				if ('Y' == $value['IS_REQUIRED'] && is_array($value["VALIDRULE"]) && !in_array('required',$value["VALIDRULE"]))
					$value["VALIDRULE"][] = "required";
			}


			if(array_key_exists('PERSONAL_GENDER', $arParams['FIELDS'])) {
				$arParams['FIELDS']['PERSONAL_GENDER']['ITEMS'] = array(
					"M" => Loc::getMessage('CP_SMARTFORM_F_P_GENDER_M'),
					"F" => Loc::getMessage('CP_SMARTFORM_F_P_GENDER_F'),
				);

				$arParams['FIELDS']['PERSONAL_GENDER']['OLD_VALUE'] = "M";
			}
		}

		if(array_key_exists('PASSWORD', $arParams['FIELDS']))
			$arParams['FIELDS']['PASSWORD']['IS_PASSWORD'] = true;

		if(array_key_exists('CONFIRM_PASSWORD', $arParams['FIELDS']))
			$arParams['FIELDS']['CONFIRM_PASSWORD']['IS_PASSWORD'] = true;

		/**
		 * esli v massive shablonov bolyshe 1 znacheniya i sushtestvuet znachneie po umolchaniyu "vse", to udalim eto znachenie
		 */
		if(array_key_exists('MAILE_EVENT_TEMPLATE', $arParams)) {
			if(!is_array($arParams['MAILE_EVENT_TEMPLATE']))
				$arParams['MAILE_EVENT_TEMPLATE'] = array($arParams['MAILE_EVENT_TEMPLATE']);

			$arParams['MAILE_EVENT_TEMPLATE'] = array_diff($arParams['MAILE_EVENT_TEMPLATE'],array("","0"));
		}
		if(!is_array($arParams['MAILE_EVENT_TEMPLATE']) || empty($arParams['MAILE_EVENT_TEMPLATE']))
			$arParams['MAILE_EVENT_TEMPLATE'] = $this->getEventTemplates($arParams['MAIL_EVENT']);

		/**
		 * proverim globalynie nastroyki po avtorizatsii
		 */
		$this->allowRegistration = COption::GetOptionString("main", "new_user_registration", "Y") == "Y" ? true : false;
		$this->addGroup = strlen(COption::GetOptionString("main", "new_user_registration_def_group", "")) > 0 ? array_merge(array(2),explode(",", COption::GetOptionString("main", "new_user_registration_def_group", ""))) : array(2);

		$arParams['FORM_ID'] = array_key_exists('FORM_ID', $arParams) && strlen($arParams['FORM_ID']) > 0 ? trim(htmlspecialcharsbx($arParams['FORM_ID'])) : null;

		/**
		 * Podklyuchaem storonnie plagini
		 */
		$this->loadExternalLibrary();

		return $arParams;
	}

	protected function getEventTemplates($mailEvent) {
		$rsMess = CEventMessage::GetList($by = "site_id", $order = "desc", Array(
			"TYPE_ID" => $mailEvent,
			"ACTIVE" => "Y",
			"SITE_ID" => SITE_ID,
		));
		while($arr = $rsMess->Fetch())
			$arMailTemplate[] = $arr['ID'];
		return $arMailTemplate;
	}

	protected function loadExternalLibrary() {
		/**
		 * Esli komponent podklyuchaetsya cherez composer, papka vendor lezhit v drugom meste, i autoload uzhe podklyuchen
		 * Podklyuchaty otdelyniy autoload nuzhno tolyko esli komponent vzyali iz git bez ispolyzovaniya composer
		 */
		if (file_exists(__DIR__ . '/vendor/autoload.php'))
		{
			require __DIR__ . '/vendor/autoload.php';
		}
	}

	/**
	 * Sohranenie parametrov komponenta v sessii
	 */
	public function saveComponentParams($FORM_ID) {
		$arParams = $this->arParams;

		$signer = new Signer;
		$paramsStr = base64_encode(Json::encode($arParams));

		$hash = preg_replace('/\:/','_',$this->getName());
		$_SESSION[self::SESSION_PREFIX][$FORM_ID] = $signer->sign($paramsStr,$hash);
	}

	/**
	 * Poluchity nabor parametrov sohranennih v sessii
	 *
	 * @param string $FORM_ID - id formi
	 *
	 * @return bool|mixed - massiv s dannimi (parametri komponenta)
	 */
	public function loadComponentParams($FORM_ID) {
		$signer = new Signer;

		if(
			!isset($_SESSION[self::SESSION_PREFIX])
			|| !isset($_SESSION[self::SESSION_PREFIX][$FORM_ID])
		) {
			return false;
		}

		$strParams = $_SESSION[self::SESSION_PREFIX][$FORM_ID];
		$hash = preg_replace('/\:/','_',$this->getName());
		$parameters = $signer->unsign($strParams, $hash);

		return Json::decode(base64_decode($parameters));
	}

	public function executeComponent() {
		global $APPLICATION, $USER;

		/**
		 * esli polyzovately ne avtorizovan to on en mozhet izmenyaty svoi lichnie dannie
		 */
		if(false === $USER->IsAuthorized() || !$ID = $USER->GetID()) {
			ShowError(Loc::getMessage('CP_SMARTFORM_E_USER_NOT_AUTHORIZED'));
			return;
		}

		$this->setFormID($this->arParams['FORM_ID']);

		$this->arResult = array(
			"ID" => $ID,
			"FORM_ID" => $this->formID,
			"FORM_ACTIONS" => $this->arParams['FORM_ACTIONS'],
			"ITEMS" => $this->arParams['FIELDS']
		);

		/**
		 * poluchim pervonachalynie dannie polyzovatelya
		 */
		$this->GetCurUserFieldValue($this->arParams['FIELDS'],$ID);

		$context = Bitrix\Main\HttpApplication::getInstance()->getContext();
		$request = $context->getRequest();
		if(
			check_bitrix_sessid()
			&& $request->get('FORM_ID') == $this->getFormID()
		) {
			try {

				/**
				 * validirovanie poley pered obnovleniem
				 */
				$arField = $this->validateFormField();
				if(false === $arField)
					throw new ArgumentException(Loc::getMessage('CP_SMARTFORM_E_VALIDATE_ERROR'),'VALIDATE_ERROR');

				/**
				 * obnovlenie poley polyzovatelya
				 */
				$isUpdate = $this->executeComponentTask($arField,$ID);
				if(false === $isUpdate)
					throw new ArgumentException(Loc::getMessage('CP_SMARTFORM_E_UPDATE_ERROR'),'UPDATE_ERROR');

				if($this->arParams['SEND_MESSAGE'] == "Y") {
					$arField['ID'] = $ID;
					$this->SendSuccessFormMessage($arField, $ID);
				}

				LocalRedirect($APPLICATION->GetCurPageParam("saccess=Y&id=" . $ID,array("saccess","id")));
			}
			catch(ArgumentException $ex) {
				if(strlen($ex->getParameter()) > 0)
					$this->arResult['ERROR_TITLE'][$ex->getParameter()] = $ex->getMessage();
				else
					$this->arResult['ERROR_TITLE'] = $ex->getMessage();
				$this->arResult['ERRORS'] = $this->LAST_ERROR;
			}
		}

		if(array_key_exists("CAPTCHA", $this->arParams['FIELDS']))
			$this->arResult["CAPTCHA_CODE"] = htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

		$this->includeComponentTemplate();
	}

	public function GetCurUserFieldValue(&$arFieldList,$id = false) {
		global $USER;
		if(false === $id || IntVal($id) <= 0)
			return;

		$objFireld = $USER->GetByID($id);
		if(!is_object($objFireld) || !$arField = $objFireld->Fetch())
			return;

		foreach ($arFieldList as $key => &$value) {
			if(
				!array_key_exists($key, $arField)
				|| ($key == "CONFIRM_PASSWORD" || $key == "PASSWORD")
			) {
				continue;
			}

			$value['OLD_VALUE'] = $arField[$key];
			if(true === $this->IsUserField($key)) {
				$value['ENTITY_VALUE_ID'] = $arField[$key];
				$value['VALUE'] = $arField[$key];
			}
		}
	}

	public function executeComponentTask($arFields = array(),$ID = false) {
		global $USER;
		if(empty($arFields) || false === $ID || IntVal($ID) <= 0)
			return true;

		$res = $USER->Update($ID, $arFields);
		if(false === $res)
			$this->LAST_ERROR[] = $USER->LAST_ERROR;

		return $res;
	}

	protected function cleanOldValue() {
		foreach($this->arParams['FIELDS'] as $code => &$filed)
			$filed['OLD_VALUE'] = '';
	}

	/**
	 * @todo perepisaty f-iyu valadtsii, ona ne dolzhna zaodno formirovaty massiv poley dlya peredachi v modely
	 * @return bool|mixed
	 */
	public function validateFormField() {
		global $APPLICATION;
		$context = Bitrix\Main\HttpApplication::getInstance()->getContext();
		$request = $context->getRequest();

		$this->laodAction();

		try {
			/**
			 * poluchim spisok poley peredavayemih formoy. Esli dannih net, to vivedem oshibku
			 */
			/** @var array $arPostData */
			$arPostData = $request->get('FIELDS');
			if(false === $arPostData || !is_array($arPostData))
				throw new ArgumentException(Loc::getMessage('CP_SMARTFORM_E_REQUEST_ARRAY_F_EMPTY'),'NOT_FIELDS');

			//Proverka antispama
			if($this->arParams['HIDDEN_ANTI_SPAM'] !== "N" && (bool) $request->get('GIFT'))
				$this->LAST_ERROR['HIDDEN_ANTI_SPAM'] = Loc::getMessage('CP_SMARTFORM_E_GIFT');

			/**
			 * poluchim spisok poley po umolchaniyu
			 */
			$arDefaultFields = $this->GetDefaultFields();

			/**
			 * Sobitie pozvolyaet izmenity polya pered validatsiey
			 */
			$db_events = GetModuleEvents("main", "OnBeforeValidateFieldForm{$this->eventPostfix}");
			while($arEvent = $db_events->Fetch())
				ExecuteModuleEventEx($arEvent, array(&$arDefaultFields, &$arPostData));

			/**
			 * Protsedura proverki poley na validnosty
			 */
			foreach($this->arResult['ITEMS'] as $code => $arField) {
				/**
				 * Proverka yavlyaetsya li dannoe pole funktsionalynim.
				 *
				 * Kazhdoe pole proveryaetsya, trebuet li zapolneniya ili proverki.
				 * Polya tipa - gruppa poley ne trebuetsya proveryaty. Takim obrazom vozmozhno ubraty iz protseduri
				 * validatsii lyuboe pole.
				 * Pole "gruppa" - neset lishy esteticheskoe naznachenie.
				 * */
				if(isset($arField['GROUP_FIELD']) && 'Y' === $arField['GROUP_FIELD'])
					continue;

				/**
				 * Pole CAPTCHA
				 * Dannoe pole imeet spetsificheskuyu proverku. Emu nelyzya naznachity regulyarnoe virazhenie.
				 * */
				if($code == "CAPTCHA" && 'Y' == $arField['IS_REQUIRED']) {

					/**
					 * Esli ispolyzuetsya google reCapcha to proverim eio
					 * inache shtatnaya proverka Bitriks Capcha
					 */
					if('Y' == $this->arParams['USE_GOOGLE_RECAPTCHA']) {
						$reCaptcha = new \ReCaptcha\ReCaptcha($this->arParams['GOOGLE_RECAPTCHA_PRIVATE_KEY']);
						$gRecaptchaResponse = $request->get('g-recaptcha-response');
						$resp = $reCaptcha->verify($gRecaptchaResponse, $_SERVER['REMOTE_ADDR']);
						if (!$resp->isSuccess()) {
							$this->LAST_ERROR['CAPTCHA'] = $resp->getErrorCodes();
						}
					}
					else {
						if(!$APPLICATION->CaptchaCheckCode($request->get("captcha_word"), $request->get("captcha_sid")))
							$this->LAST_ERROR['CAPTCHA'] = Loc::getMessage("CP_SMARTFORM_E_REQUIRED_F_EMPTY" ,array("#FIELD#" => $this->arParams['FIELDS']['CAPTCHA']['TITLE']));
					}
					continue;
				}

				/**
				 * Polya tipa - fayl.
				 * Proverka proishodit v otdelynoy funktsii - getFile
				 * */
				if($arField['TYPE'] == "F") {
					if ($code == "PREVIEW_PICTURE" || $code == "DETAIL_PICTURE")
					{
						// FIX for upload PREVIEW_PICTURE DETAIL_PICTURE
					}
					else
					{
						$arFile = $this->getFile($code, $arField['MULTIPLE'] === "Y");
						if(!$arFile && $arField['IS_REQUIRED'])
							$this->LAST_ERROR[$code] = Loc::getMessage("CP_SMARTFORM_E_REQUIRED_F_EMPTY" ,array("#FIELD#" => $arField['TITLE']));
						else
							$arAddUser[$code] = $arFile;
					}
					continue;
				}

				/**
				 * Proverka obyazatelynih poley.
				 *
				 * Proverim sushtestvuet li dannoe pole v massive zaprosa. Esli dannoe pole ne bilo peredano v forme,
				 * to vivedem soobshtenie ob oshibke
				 * */
				if('Y' == $arField['IS_REQUIRED'] && !array_key_exists($code, $arPostData)) {
					$this->LAST_ERROR[$code] = Loc::getMessage("CP_SMARTFORM_E_REQUIRED_F_EMPTY" ,array("#FIELD#" => $arField['TITLE']));
					continue;
				}

				$fieldVal = $arPostData[$code];
				$bxError = false;
				if($arField['IS_REQUIRED'] == 'Y') {
					if(
						true === $this->IsUserField($code) &&
						($arField['MULTIPLE'] !="Y" && !in_array($arField['TYPE'],$this->listFType))
						&& strlen($fieldVal) <= 0
					) {
						$bxError = true;
					}
					/*elseif(
						true === $this->IsUserField($code) &&
						($arField['MULTIPLE'] !="Y" && in_array($arField['TYPE'],$this->listFType))
					){
						$bxError = true;
					}*/
					elseif(
						true === $this->IsUserField($code) &&
						($arField['MULTIPLE'] =="Y" && is_array($fieldVal))
						&& !in_array($arField['TYPE'],$this->listFType)
					) {
						$fieldVal = array_diff($fieldVal,array(""));
						if(empty($fieldVal))
							$bxError = true;
					}/*
					elseif(
						true === $this->IsUserField($code) &&
						($arField['MULTIPLE'] =="Y" && is_array($fieldVal))
					) {
						$fieldVal = array_diff($fieldVal,array(""));
						if(empty($fieldVal))
							$bxError = true;
					}*/
					elseif(strlen($arPostData[$code]) <= 0) {
						$bxError = true;
					}

					if(true === $bxError) {
						$this->LAST_ERROR[$code] = Loc::getMessage("CP_SMARTFORM_E_REQUIRED_F_EMPTY" ,array("#FIELD#" => $arField['TITLE']));
						continue;
					}
				}

				if(false === $this->prepaData($fieldVal,$arField,$code)) {
					if(!array_key_exists($code,$this->LAST_ERROR))
						$this->LAST_ERROR[$code] = Loc::getMessage("CP_SMARTFORM_E_VALIDATION_FIELD" ,array("#FIELD#" => $arField['TITLE']));
				}

				if($arField['GROUP_FIELD'] != "Y")
					$arAddUser[$code] = $fieldVal;

				/**
				 * zapominaem staroe znachenie formi, znachenie isklyuchim s poley paroly i potverzhdenie parolya
				 */
				if(
					$code != "CONFIRM_PASSWORD" && $code != "PASSWORD"
				) {
					$this->arParams['FIELDS'][$code]['OLD_VALUE'] = $fieldVal;
				}

				if($arField['TYPE'] == "USER_FIELD") {
					$this->arResult['ITEMS'][$code]['ENTITY_VALUE_ID'] = $fieldVal;
					$this->arResult['ITEMS'][$code]['VALUE'] = $fieldVal;
				}
			}

			/**
			 * proverim ukazan li paroly dlya izmeneniya i sovpadaet li noviy paroly i potverzhdenniy paroly
			 */
			if(
				array_key_exists('CONFIRM_PASSWORD', $arPostData)
				&& array_key_exists('PASSWORD', $arPostData)
				&& (
					strlen($arPostData['PASSWORD']) > 0 || strlen($arPostData['CONFIRM_PASSWORD']) > 0
				)
				&& $arPostData['PASSWORD'] != $arPostData['CONFIRM_PASSWORD']
			) {
				throw new ArgumentException(Loc::getMessage("CP_SMARTFORM_F_CONFIRM_PASSWORD_NOT_SUCCESS_ERROR"),'CONFIRM_PASSWORD_NOT_SUCCESS');
			}

			if(count($this->LAST_ERROR) <= 0) {
				/**
				 * zapolnim obyazatelynie polyzovatelyskie polya,esli oni ne bili v spiske poley
				 */
				global $USER_FIELD_MANAGER;
				// @todo Ne ponyatno, nuzhno li eto
				$arRequiredUserField = $this->GetRequiredUserField($arAddUser);
				if(!$USER_FIELD_MANAGER->CheckFields("USER", 0, $arAddUser)) {
					if($err = $APPLICATION->GetException())
						throw new ArgumentException($err->GetString(),'USER_FIELD_CHACK');
				}
			}
		}
		catch(ArgumentException $ex) {
			if(strlen($ex->getParameter()) > 0)
				$this->LAST_ERROR[$ex->getParameter()] = $ex->getMessage();
			else
				$this->LAST_ERROR[] = $ex->getMessage();
			return false;
		}

		$db_events = GetModuleEvents("main", "OnAfterValidateFieldForm{$this->eventPostfix}");
		while($arEvent = $db_events->Fetch()) {
			ExecuteModuleEventEx($arEvent, array(&$arDefaultFields, &$arPostData,&$this->LAST_ERROR));
		}

		if(array_key_exists('CAPTCHA',$arAddUser))
			unset($arAddUser['CAPTCHA']);

		return !empty($this->LAST_ERROR) ? false : $arAddUser;
	}

	/**
	 * Otpravlyaet soobshtenie esli eto trebuetsya
	 *
	 * @param $arAddUser - Dostupnie polya dlya pochtovogo sobitiya
	 * @param $ID - identifikator dobavlennogo elementa
	 */
	public function SendSuccessFormMessage($arAddUser, $ID) {
		$bxSendMail = true;
		$arEventFields = $this->getMailField($ID,$arAddUser);

		$arEventFields['USER_ID'] = $arEventFields['ID'];

		$events = GetModuleEvents("main", "OnBeforeUpdateFormSendMail{$this->eventPostfix}");
		while ($arEvent = $events->Fetch())
			$bxSendMail = ExecuteModuleEventEx($arEvent, array(&$arEventFields,$ID));

		if(!isset($bxSendMail) || true === $bxSendMail) {
			$event = new \CEvent;
			foreach ($this->arParams['MAILE_EVENT_TEMPLATE'] as $value) {
				$arFile = isset($arAddUser['FILES']) ? $arAddUser['FILES'] : false;
				if(false !== $arFile && !is_array($arFile))
					$arFile = array($arFile);
				if($this->arParams['SEND_IMMEDIATE'] == "N")
					$event->Send($this->arParams['MAIL_EVENT'], SITE_ID, $arEventFields,"N",$value,$arFile);
				else
					$event->SendImmediate($this->arParams['MAIL_EVENT'], SITE_ID, $arEventFields,"N",$value,$arFile);
			}
		}

		$events = GetModuleEvents("main", "OnAfterUpdateFormSendMail{$this->eventPostfix}");
		while ($arEvent = $events->Fetch())
			ExecuteModuleEventEx($arEvent, array(&$arEventFields,$ID));
	}

	protected function addMissingField() {
		$this->initComponentTemplate();
		if($this->__template instanceof CBitrixComponentTemplate)
			$templatePath = $_SERVER['DOCUMENT_ROOT'] . $this->__template->__folder;
		else
			$templatePath = null;

		$arFTemplate = $this->getFieldTemplate($templatePath);

		$defaultField = $this->GetDefaultFields();
		foreach ($this->arResult['ITEMS'] as $code => &$dField) {
			if(!array_key_exists($code, $defaultField))
				continue;

			$dField = array_merge($defaultField[$code],$dField);

			$dField['CODE'] = $dField['MULTIPLE'] == "N" ? $dField["CODE"] : $dField["CODE"] . "[]";


			if(isset($dField['USER_TYPE']) && strlen($dField['USER_TYPE']) > 0)
				$fieldType = $this->getTemplateType($dField['USER_TYPE']);
			else
				$fieldType = $this->getTemplateType($dField['TYPE']);

			if(!isset($arFTemplate[$fieldType]))
				continue;

			if(isset($dField['TEMPLATE_ID']) && isset($arFTemplate[$fieldType][$dField['TEMPLATE_ID']]))
				$templateField = $arFTemplate[$fieldType][$dField['TEMPLATE_ID']];
			else
				$templateField = $arFTemplate[$fieldType]['.default'];

			if(!($templateField instanceof Bitrix\Main\IO\Directory))
				continue;

			$dField['TEMPLATE'] = array(
				"TYPE" => $fieldType,
				"PATH" => $templateField->getPhysicalPath()
			);
		}
	}

	/**
	 * Spisok poley po umolchaniyu
	 *
	 * Funktsiya pozvolyaet poluchity spisok vseh poley, kotorie dostupni v forme.
	 * Kazhdoe pole soderzhit spisok dostupnih atributov:
	 *  ORIGINAL_TITLE - originalynoe nazvanie polya
	 *  TITLE - nimenovanie polya, kotoroe mozhno izmenity pri nastroyke komponenta
	 *  TYPE - tip polya (F - fayl, S - stroka, L - spisok, E - privyazka k elementu IB, G - privyazka k razdelu)
	 *  TOOLTIP - proizvolyniy tekst, podskazka dlya polya
	 *  IS_REQUIRED - priznak obyazatelynosti polya
	 *  VALIDRULE - pravilol validatsii dlya formi (v vide regulyarnogo virazheniya)
	 *  VALID_ERROR_MSG - tekst oshibki pri proverki pravilom validatsii
	 *  HIDE_FIELD - priznak skritoe pole ili net
	 *
	 * @return array(FIELDS,USER_FIELD) USER_FIELD - spisok polyzovatelyskih poley, FIELDS - spisok poley formi
	 */
	public function GetDefaultFields() {
		$arCountry = array();
		$arCountryList = GetCountryArray();
		foreach($arCountryList['reference_id'] as $index => $val) {
			$arCountry[$val] = $arCountryList['reference'][$index];
		}

		$arDefaultFields = array(
			"NAME" => array("ORIGINAL_TITLE" => Loc::getMessage('CP_SMARTFORM_F_NAME_TITLE'),"TITLE" => Loc::getMessage('CP_SMARTFORM_F_NAME_TITLE'),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"LAST_NAME" => array("ORIGINAL_TITLE" => Loc::getMessage('CP_SMARTFORM_F_LAST_NAME_TITLE'),"TITLE" => Loc::getMessage('CP_SMARTFORM_F_LAST_NAME_TITLE'),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"SECOND_NAME" => array("ORIGINAL_TITLE" => Loc::getMessage('CP_SMARTFORM_F_SECOND_NAME_TITLE'),"TITLE" => Loc::getMessage('CP_SMARTFORM_F_SECOND_NAME_TITLE'),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"EMAIL" => array("ORIGINAL_TITLE" => Loc::getMessage('CP_SMARTFORM_F_EMAIL_TITLE'),"TITLE" => Loc::getMessage('CP_SMARTFORM_F_EMAIL_TITLE'),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => true,"VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"LOGIN" => array("ORIGINAL_TITLE" => Loc::getMessage('CP_SMARTFORM_F_LOGIN_TITLE'),"TITLE" => Loc::getMessage('CP_SMARTFORM_F_LOGIN_TITLE'),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => true,"VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PASSWORD" => array("ORIGINAL_TITLE" => Loc::getMessage('CP_SMARTFORM_F_PASSWORD_TITLE'),"TITLE" => Loc::getMessage('CP_SMARTFORM_F_PASSWORD_TITLE'),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => true,"VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"CONFIRM_PASSWORD" => array("ORIGINAL_TITLE" => Loc::getMessage('CP_SMARTFORM_F_CONFIRM_PASSWORD_TITLE'),"TITLE" => Loc::getMessage('CP_SMARTFORM_F_CONFIRM_PASSWORD_TITLE'),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => true,"VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),

			"PERSONAL_BIRTHDAY" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_BIRTHDAY_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_BIRTHDAY_TITLE"),"TYPE" => "DATE","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_PHOTO" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_PHOTO_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_PHOTO_TITLE"),"TYPE" => "F","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_GENDER" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_GENDER_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_GENDER_TITLE"),"TYPE" => "L","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_PROFESSION" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_PROFESSION_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_PROFESSION_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => true,"VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_WWW" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_WWW_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_WWW_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_ICQ" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_ICQ_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_ICQ_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_PHONE" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_PHONE_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_PHONE_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_FAX" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_FAX_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_FAX_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_MOBILE" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_MOBILE_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_MOBILE_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_PAGER" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_PAGER_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_PAGER_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_MAILBOX" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_MAILBOX_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_MAILBOX_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_COUNTRY" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_COUNTRY_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_COUNTRY_TITLE"),"TYPE" => "L","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y","ITEMS" => $arCountry),
			"PERSONAL_STATE" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_STATE_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_STATE_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "", "HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_CITY" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_CITY_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_CITY_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_STREET" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_STREET_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_STREET_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_ZIP" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_ZIP_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_ZIP_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"PERSONAL_NOTES" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_P_NOTES_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_P_NOTES_TITLE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),

			"WORK_COMPANY" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_COMPANY"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_COMPANY"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_DEPARTMENT" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_DEPARTMENT"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_DEPARTMENT"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_POSITION" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_POSITION"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_POSITION"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_WWW" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_WWW"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_WWW"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_PROFILE" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_PROFILE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_PROFILE"),"TYPE" => "T","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_LOGO" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_LOGO"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_LOGO"),"TYPE" => "F","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_PHONE" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_PHONE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_PHONE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_FAX" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_FAX"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_FAX"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_PAGER" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_PAGER"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_PAGER"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_COUNTRY" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_COUNTRY"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_COUNTRY"),"TYPE" => "L","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y","ITEMS" => $arCountry),
			"WORK_STATE" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_STATE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_STATE"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_CITY" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_CITY"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_CITY"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_ZIP" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_ZIP"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_ZIP"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_STREET" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_STREET"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_STREET"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_MAILBOX" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_MAILBOX"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_MAILBOX"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),
			"WORK_NOTES" => array("ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_W_NOTES"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_W_NOTES"),"TYPE" => "S","TOOLTIP" => "","IS_REQUIRED" => "N","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),

			"CAPTCHA" => Array("IS_REQUIRED" => true, "ORIGINAL_TITLE" => Loc::getMessage("CP_SMARTFORM_F_CAPTCHA_TITLE"), "TITLE"=> Loc::getMessage("CP_SMARTFORM_F_CAPTCHA_TITLE"), "TOOLTIP" => Loc::getMessage("CP_SMARTFORM_F_CAPTCHA_TOOLTIP_TITLE"),"TYPE" => "CAPTCHA","VALIDRULE" => "","VALID_ERROR_MSG" => "","HIDE_FIELD" => "N", "ACTIVE" => "Y"),

		);

		$arDefaultUserFields = array();
		$arUserFields = $this->GetUserField();
		if($arUserFields) {
			foreach($arUserFields as $key => $value) {
				$arDefaultUserFields[$key] = array(
					"ORIGINAL_TITLE" => strlen($value['LIST_COLUMN_LABEL']) > 0 ? $value['LIST_COLUMN_LABEL'] : $value['FIELD_NAME'],
					"TITLE" => strlen($value['LIST_COLUMN_LABEL']) > 0 ? $value['LIST_COLUMN_LABEL'] : $value['FIELD_NAME'],
					"TYPE" => "USER_FIELD",
					"IS_REQUIRED" => $value['MANDATORY'] == "Y" ? true : false,
					"TOOLTIP" => $value['HELP_MESSAGE'],
					"VALID_ERROR_MSG" => $value['ERROR_MESSAGE'],
					"VALIDRULE" => isset($value['SETTINGS']['REGEXP']) ? $value['SETTINGS']['REGEXP'] : '',
					"HIDE_FIELD" => "N", "ACTIVE" => "Y",
				);

				if(isset($value['SETTINGS']['REGEXP']) && strlen($value['SETTINGS']['REGEXP']) > 0) {
					$arDefaultUserFields[$key]['REGEXP'] = true;
				}
			}
		}
		$db_events = GetModuleEvents("main", "OnBeforeGetDefaultValueForm{$this->eventPostfix}");
		while($arEvent = $db_events->Fetch())
			ExecuteModuleEventEx($arEvent, array(&$arDefaultFields, &$arDefaultUserFields));

		return array(
			"FIELDS" => $arDefaultFields,
			"USER_FIELD" => $arDefaultUserFields
		);
	}

	/**
	 * poluchity spisok dostupnih polyzovatelyskih poley
	 *
	 * @return array - spisok dostupnih polyzovatelyskih poley
	 */
	public function GetUserField() {
		$arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("USER", 0, LANGUAGE_ID);
		if($arUserFields) {
			foreach($arUserFields as $key => $value) {
				$value['ORIGINAL_FIELD_NAME'] = $value['FIELD_NAME'];
				$value['FIELD_NAME'] = "FIELDS[" . $value['FIELD_NAME'] . "]";
				$arDefaultUserFields[$key] = $value;
			}
		}
		return !isset($arDefaultUserFields) ? array() : $arDefaultUserFields;
	}

	/**
	 * opredelyaem polyzovatelyskoe pole eto ili net
	 **/
	private function IsUserField($code) {
		return substr($code,0,strlen($this->bxPrefix)) == $this->bxPrefix ? true : false;
	}

	protected function getFile($code, $multiple)
	{
		$request = $this->request;

		$validate = function($file) use ($code)
		{
			$error = $file['error'];
			if ($error != 4 && $error > 0)
			{
				throw new ArgumentException(Loc::getMessage("CP_SMARTFORM_UPLOAD_FILE_ERROR_CODE_{$error}"), $code);
			}

			if ($file['del'] !== 'Y' && !(is_readable($file['tmp_name']) && is_file($file['tmp_name'])))
			{
				throw new ArgumentException(Loc::getMessage("CP_SMARTFORM_UPLOAD_FILE_UNKNOWN_ERROR"), $code);
			}
		};

		$normalize = function($file, &$idx = null) use ($code, $request, $validate, &$sentAsFile)
		{
			$del = $sentAsFile ? $request->getPost('del_FIELDS') : $request->getPost('FIELDS_del');
			$descr = $sentAsFile ? $request->getPost("descr_FIELDS") : $request->getPost("FIELDS_descr");

			$del = is_null($idx) ? $del[$code] === 'Y' : $del[$code][$idx] === 'Y';
			$descr = is_null($idx) ? $descr[$code] : $descr[$code][$idx];

			$fileId = is_numeric($file) ? $file : 'n' . (isset($idx) ? ++$idx : 0);

			if (is_numeric($file) && $del)
			{
				return array('id' => $file, 'del' => 'Y');
			}

			$file = \CIBlock::makeFileArray(
				$file,
				$del,
				$descr,
				array('allow_file_id' => true)
			);

			$validate($file);

			$file['id'] = $fileId;

			return $file;
		};

		$fields = $this->request->get('FIELDS');
		$fileFields = $this->request->getFile('FIELDS');
		$sentAsFile = $fileFields && is_array($fileFields) && isset($fileFields[$code]);

		$result = null;
		if ($sentAsFile)
		{
			$result = $fileFields[$code];
		}
		elseif (is_array($fields) && isset($fields[$code]))
		{
			$result = $fields[$code];
		}
		elseif ($request->get($code))
		{
			$result = $request->get($code);
		}

		if (!$result)
		{
			return null;
		}

		if ($multiple)
		{
			$idx = 0;
			$result = array_reduce($result, function ($result, $file) use (&$idx, &$normalize){

				$file = $normalize($file, $idx);

				$result[$file['id']] = $file;
				unset($result[$file['id']]['id']);

				return $result;

			}, array());
		}
		else
		{
			$result = $normalize($result);
		}

		return $result;
	}

	public function prepaData(&$value,$arField,$code) {
		global $DB;

		$value = is_array($value) ? array_diff($value, array("")) : $value;
		if (empty($value)) {
			return $value;
		}
		$arValue = is_array($value) ? $value : array($value);
		foreach($arValue as $index => &$itVal) {
			switch($arField['TYPE']) {
				case 'USER_FIELD':
					if($arField['USER_TYPE_ID'] == "enumeration") {
						if(!is_array($itVal) && $itVal == '0')
							$itVal = false;
						if(is_array($value) && in_array('0',$value)) {
							$itVal = false;
						}
					}
					return true;
					break;

				case 'DATE':
					if (strlen($itVal) > 0 && !$DB->IsDate($itVal, FORMAT_DATETIME, LANGUAGE_ID))
						return false;
					break;

				case 'E':
					if(is_array($itVal) && !isset($itVal['VALUE']))
						unset($value[$index]);
					break;
				case 'G':
				case 'L':
					//if($arField['ITEMS'])
					break;

				case 'F':
					$itVal = IntVal($itVal);
					if ($itVal > 0)
						$itVal = CFile::MakeFileArray($itVal);
					else
						return false;
					break;

				case 'T':
					if(is_array($itVal) && !isset($itVal['VALUE'])) {

					}
					else {
						$itVal = trim(htmlspecialcharsbx($itVal));
					}
					break;
				case 'N':
					$itVal = IntVal($itVal);
					break;

				default:
					$itVal = trim(htmlspecialcharsbx($itVal));
			}
		}

		if('ACTIVE' == $code) {
			$value = (is_array($value) && in_array('Y',$value) ? 'Y' : '');
		}

		if(
			$this->arParams['USE_SERVER_VALIDATE'] == "Y" &&
			$arField['TYPE'] != "USER_FIELD" && strlen($arField['VALIDRULE']) > 0 && !preg_match($arField['VALIDRULE'], $value)
		) {
			$this->LAST_ERROR[$code] = strlen($arField['VALID_ERROR_MSG']) > 0 ? htmlspecialchars_decode($arField['VALID_ERROR_MSG']) : Loc::getMessage("CP_SMARTFORM_E_VALIDATION_FIELD" ,array("#FIELD#" => $arField['TITLE']));
			return false;
		}

		return true;
	}

	public function GetRequiredUserField(&$arIsField = array()){
		global $USER_FIELD_MANAGER;

		$arFields = array();
		$rsData = CUserTypeEntity::GetList(array(),array("ENTITY_ID" => "USER","MANDATORY" => "Y"));
		while($arRes = $rsData->Fetch())
			if(!array_key_exists($arRes['CODE'], $arIsField))
				$arFields[$arRes['FIELD_NAME']] = $arRes;

		if(empty($arFields)) return false;

		foreach ($arFields as $CODE => $arField) {
			$arSettings = $USER_FIELD_MANAGER->PrepareSettings(0,$arField);
			if(isset($arSettings['SMARTFORM_VALUE']))
				$arIsField[$CODE] = $arField['MULTIPLE'] == "Y" ? array($arSettings['SMARTFORM_VALUE']) : $arSettings['SMARTFORM_VALUE'];
		}

		return $arFields;
	}

	public function __generationPassword() {
		$def_group = COption::GetOptionString("main", "new_user_registration_def_group", "");
		if($def_group!="")
			$arPolicy = CUser::GetGroupPolicy(explode(",", $def_group));
		else
			$arPolicy = CUser::GetGroupPolicy(array());

		$password_min_length = intval($arPolicy["PASSWORD_LENGTH"]);
		if($password_min_length <= 0)
			$password_min_length = 6;

		$pass = randString($password_min_length + 5, array(
			"abcdefghijklnmopqrstuvwxyz",
			"ABCDEFGHIJKLNMOPQRSTUVWXYZ",
			"0123456789",
			",.<>/?;:[]{}\\|~!@#\$%^&*()-_+=",
		));

		return $pass;
	}

	public function getFormID() {
		return $this->formID;
	}

	public function setFormID($id = null) {
		if(null === $id)
			$this->formID = md5(serialize($this->arParams) . $this->GetName());
		else
			$this->formID = $id;
	}

	public function GetParametrsFieldInput($title = '',$btnTitle = '',$groupName = 'BASE',$path = null) {
		$arDefaultFields = $this->GetDefaultFields();
		$arData = array_merge($arDefaultFields['FIELDS'],$arDefaultFields['USER_FIELD']);
		$componentPath = $path != null ? $path : $this->getPath();

		return array(
			'NAME' => strlen($title) > 0 ? $title : Loc::getMessage('CP_SMARTFORM_PARAM_TITLE'),
			'TYPE' => 'CUSTOM',
			'JS_COMPONENT_PATH' => $componentPath,
			'JS_FILE' => $componentPath . '/settings/settings.js',
			'JS_EVENT' => 'OnCitrusSmartFormSettingsEdit',
			'JS_DATA' => $arData,
			'PARENT' => $groupName,
		    'MESSAGE' => Loc::loadLanguageFile(__DIR__ . "/settings.php")
		);
	}

	public function GetComponentParametrs($arGroup = array(),$arCurrent = array()) {
		$arComponentParams = self::GetDefaultComponentParametrs($arGroup,$arCurrent);

		$arComponentParams['PARAMETERS']['FIELDS'] = $this->GetParametrsFieldInput(
			Loc::getMessage('PAR_SMARTFORM_FIELDS_NAME'),
			Loc::getMessage('PAR_SMARTFORM_FIELD_DATA_SET'),
			'FIELDS'
		);

		return $arComponentParams;
	}

	/**
	 * Vozvrashtaet papku, soderzhashtuyu tekushtiy komponenta.
	 * Metod dolzhen pereopredelyatysya v kazhdom iz nasleduemih komponentov!
	 *
	 * @return string
	 */
	protected static function getClassPath()
	{
		return __DIR__;
	}

	public function getFieldTemplate($templatePath) {
		$className = get_parent_class($this);
		/** @var static $className */
		if ($className instanceof CBitrixComponent)
			$className = get_class($this);

		$path = $className::getClassPath();

		if(null === self::$arFieldTemplates)
			self::$arFieldTemplates = $this->loadFieldTemplate($path);

		$arTemplate = self::$arFieldTemplates;
		if(null !== $templatePath) {
			$rSub = $this->loadFieldTemplate($templatePath);
			$arTemplate = array_merge_recursive($arTemplate,$rSub);
		}

		$arResult = array();
		foreach($arTemplate as $type => $list) {
			if(!isset($arResult[$type])) {
				$arResult[$type] = array();
				$this->templateMap[$type] = array();
			}

			/**
			 * @var $dir Bitrix\Main\IO\Directory;
			 */
			foreach($list as $dir) {
				$templateName = $dir->getName();
				$arResult[$type][$templateName] = $dir;

				$descFile = $dir->getPhysicalPath() . '/.description.php';
				if(!\Bitrix\Main\IO\File::isFileExists($descFile))
					$this->templateMap[$type][$templateName] = array(
						'title' => $dir->getName()
					);
				else
					$this->templateMap[$type][$templateName] = require($descFile);
			}
		}

		return $arResult;
	}

	protected function loadFieldTemplate($path) {
		$arTemplate = array();
		$path = $path . '/field/';

		$dir = new \Bitrix\Main\IO\Directory($path);
		if(false === $dir->isExists())
			return $arTemplate;

		$arChaild = $dir->getChildren();

		foreach($arChaild as $dir) {
			if ($dir->isDirectory())
			{
				/** @var \Bitrix\Main\IO\Directory $dir*/
				$type = $dir->getName();
				$arTemplate[$type] = $dir->getChildren();
			}
		}

		return $arTemplate;
	}

	protected function prepeaParamsBeforeOpenSetting(array $arFields) {
		$arAllow = array_flip($this->arAllowField);

		foreach($arFields as &$f) {
			$f = array_intersect_key($f,$arAllow);
		}
		return $arFields;
	}

	protected function getTemplateType($type) {
		$returnType = 'unknown';
		if(null === $type)
			return $returnType;

		foreach(self::$arFTemplateType as $rtype => $arVariant){
			if(!in_array($type,$arVariant))
				continue;
			return $rtype;
		}

		return $returnType;
	}

	protected function parseParamFieldValue($strValue) {
		if(is_array($strValue))
			return $strValue;

		if(
			(substr($strValue, 0, 2) == "={" || substr($strValue, 0, 2) == "Y{")
			&& substr($strValue, -1, 1)=="}" && strlen($strValue)>3
		){
			$strValue = eval('return ' . substr($strValue, 2, -1) . ';');
		}
		return $strValue;
	}

	public static function GetDefaultComponentParametrs($arGroup = array(),$arCurrent = array()) {
		if(empty($arGroup))
			return false;
		else
			$arGroup = array_flip($arGroup);

		$arComponentParam  = array(
			"GROUPS" => array(
				"FIELDS" => array(
					"NAME" => Loc::getMessage("PAR_SMARTFORM_G_FIELDS"),
					"SORT" => 100
				),
				"MAIL_SETTINGS" => array(
					"NAME" => Loc::getMessage("PAR_SMARTFORM_G_SETTINGS"),
					"SORT" => 200
				),
				"VISUAL" => array(
					"NAME" => Loc::getMessage("PAR_SMARTFORM_G_VISUAL"),
					"SORT" => 300
				),
			),
			"PARAMETERS" => array(
				'USE_SERVER_VALIDATE' => array(
					"PARENT" => "VISUAL",
					"NAME" => Loc::getMessage("PAR_SMARTOFRM_USE_SERVER_VALIDATE"),
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "N",
				),
				'FORM_TITLE' => array(
					"PARENT" => "VISUAL",
					"NAME" => Loc::getMessage("PAR_SMARTFORM_F_FORM_TITLE"),
					"TYPE" => "STRING",
				),
				'SUCCESS_TEXT' => array(
					"PARENT" => "VISUAL",
					"NAME" => Loc::getMessage("PAR_SMARTFORM_F_SUCCESS_TEXT"),
					"TYPE" => "STRING",
				),
				'ERROR_TEXT' => array(
					"PARENT" => "VISUAL",
					"NAME" => Loc::getMessage("PAR_SMARTFORM_F_ERROR_TEXT"),
					"TYPE" => "STRING",
				),
				'BUTTON_TITLE' => array(
					"PARENT" => "VISUAL",
					"NAME" => Loc::getMessage("PAR_SMARTFORM_F_BUTTON_TITLE"),
					"TYPE" => "STRING",
				),
				'BEFORE_FORM_TOOLTIP' => array(
					"PARENT" => "VISUAL",
					"NAME" => Loc::getMessage("PAR_SMARTFORM_F_BEFORE_FORM_TOOLTIP"),
					"TYPE" => "STRING",
				),
				'AFTER_FORM_TOOLTIP' => array(
					"PARENT" => "VISUAL",
					"NAME" => Loc::getMessage("PAR_SMARTFORM_F_AFTER_FORM_TOOLTIP"),
					"TYPE" => "STRING",
				),
				"SEND_MESSAGE" => array(
					"PARENT" => "MAIL_SETTINGS",
					"NAME" => Loc::getMessage("PAR_SMARTFORM_SEND_MESSAGE_SET"),
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "N",
					"REFRESH" => "Y"
				)
			)
		);

		$arComponentParam['GROUPS'] = array_intersect_key($arComponentParam['GROUPS'],$arGroup);
		if(empty($arComponentParam['GROUPS']))
			return false;

		foreach($arComponentParam['PARAMETERS'] as $code => $val) {
			if(!array_key_exists($val['PARENT'],$arComponentParam['GROUPS']))
				unset($arComponentParam['PARAMETERS'][$code]);
		}

		if($arCurrent['SEND_MESSAGE'] == "Y") {
			$rsEventType = CEventType::GetList(array( "LID" => LANGUAGE_ID));
			$arMailEvent = array();
			while($arEvent = $rsEventType->Fetch()) {
				$arMailEvent[$arEvent['EVENT_NAME']] = "[".$arEvent["EVENT_NAME"]."] ".$arEvent["NAME"];
			}

			$arMailTemplate = array(
				0 => Loc::getMessage('PAR_SMARTFORM_ALL_MAILE_EVENT_TEMPLATE')
			);

			if(isset($arCurrent['MAIL_EVENT']) && strlen($arCurrent['MAIL_EVENT']) > 0) {
				$arMailTemplate = array();
				$rsMess = CEventMessage::GetList($by = "site_id", $order = "desc", Array("TYPE_ID" => $arCurrent['MAIL_EVENT'], "ACTIVE" => "Y"));
				while($arr = $rsMess->Fetch())
					$arMailTemplate[$arr['ID']] = "[" . $arr['ID'] ."]" . $arr['SUBJECT'];
			}

			$arComponentParam['PARAMETERS']['MAIL_EVENT'] = array(
				"PARENT" => "MAIL_SETTINGS",
				"NAME" => Loc::getMessage("PAR_SMARTFORM_MAIL_EVENT_SET"),
				"TYPE" => "LIST",
				"MULTIPLE" => "N",
				"VALUES" => $arMailEvent,
				"REFRESH" => "Y"
			);
			$arComponentParam['PARAMETERS']['MAILE_EVENT_TEMPLATE'] = array(
				"PARENT" => "MAIL_SETTINGS",
				"NAME" => Loc::getMessage("PAR_SMARTFORM_MAILE_EVENT_TEMPLATE_SET"),
				"TYPE" => "LIST",
				"MULTIPLE" => "Y",
				"VALUES" => $arMailTemplate,
			);
			$arComponentParam['PARAMETERS']['SEND_IMMEDIATE'] = array(
				"PARENT" => "MAIL_SETTINGS",
				"NAME" => Loc::getMessage("PAR_SMARTFORM_SEND_IMMEDIATE"),
				"TYPE" => "CHECKBOX",
				"DEFAULT" => "N",
			);
		}
		return $arComponentParam;
	}

	public function getComponentPathByClassName($componentName) {
		$path2Comp = CComponentEngine::MakeComponentPath($componentName);
		return getLocalPath("components".$path2Comp);
	}

	/**
	 * Podklyuchaet shablon polya
	 *
	 * @param $field - dannie polya
	 * @param bool $showError - flag otobrazhaty oshibki ili net
	 * @param bool $includeCss - esli true to idet podklyuchenie stiley iz shablona polya
	 * @param bool $includeJS - esli true to idet podklyuchenie skriptov iz shablona polya
	 */
	public function includeFieldTemplate(&$field,$showError = false,$includeCss = true,$includeJS = true) {
		try {
			if(null === $field || !is_array($field))
				throw new SystemException(Loc::getMessage("CITRUS_SMARTFORM_MISSING_FIELD_CODE"));

			if(!is_array($field['TEMPLATE']) || strlen($field['TEMPLATE']['PATH']) <= 0)
				throw new SystemException(Loc::getMessage("CITRUS_SMARTFORM_CANT_FIND_FIELD_TEMPLATE"));

			$documentRoot = Main\SiteTable::getDocumentRoot(SITE_ID);
			$assetsPath = str_replace($documentRoot, '', $field['TEMPLATE']['PATH']);

			if(File::isFileExists($field['TEMPLATE']['PATH'] . '/style.css') && true === $includeCss)
				$this->__template->addExternalCss($assetsPath . '/style.css');

			if(File::isFileExists($field['TEMPLATE']['PATH'] . '/script.js') && true === $includeJS)
				$this->__template->addExternalJs($assetsPath . '/script.js');

			/**
			 * Dannie peremennie ispolyzuyutsya v podklyuchaemom shablone
			 *
			 * $arResult - massi s dannimi
			 * $arParams - soderzhit nastroyki komponenta
			 * $component - ekzemplyar klassa, sam komponent
			 * $fieldInfo - dannie po tekushtemu polyu
			 */
			$arResult = $this->arResult;
			$arParams = $this->arParams;
			$component = $this;
			$fieldInfo = &$field;

			if(File::isFileExists($field['TEMPLATE']['PATH'] . '/template.php'))
				include $field['TEMPLATE']['PATH'] . '/template.php';
		}
		catch (SystemException $ex) {
			if(true === $showError) {
				ShowError($ex->getMessage());
			}
		}
	}

	protected function laodAction() {
		if(
			$this->arParams['EDIT_ELEMENT'] == "Y" && $this->arParams['ELEMENT_ID'] > 0
		) {
			$elementID = (int)$this->arParams['ELEMENT_ID'];
			$isUpdate = CUser::GetByID($elementID)->fetch();
			if($isUpdate)
				$this->action = self::ACTION_UPDATE;
			else
				$this->action = self::ACTION_ADD;
		}
		else {
			$this->action = self::ACTION_ADD;
		}
	}

	public function isUpdateAction() {
		return ($this->action == self::ACTION_UPDATE);
	}

	public function isAddAction() {
		return ($this->action == self::ACTION_ADD);
	}


	/**
	 * Vozvrashtaet ID infobloka na tekushtem sayte po ego kodu
	 *
	 * @param string $code Simvolyniy kod infobloka
	 * @param int $siteId ID sayta (ne obyazatelyniy)
	 * @param bool $raiseException
	 * @return int ID infobloka
	 * @throws Bitrix\Main\ArgumentException
	 * @throws \ErrorException
	 */
	public static function getIblock($code, $siteId = null, $raiseException = true)
	{
		$iblocks = self::getIBlockIds($siteId);

		if ($code == "")
		{
			throw new Bitrix\Main\ArgumentException("Empty \$code parameter", 'code');
		}
		if (array_key_exists($code, $iblocks))
		{
			return $iblocks[$code];
		}
		if ($raiseException)
		{
			throw new \ErrorException("IBlock „{$code}“ not found");
		}
		return null;
	}

	/**
	 * Vozvrashtaet massiv s sootvetstviyami simvolynih kodov infoblokov ih ID (dlya tekushtego sayta)
	 *
	 * @param int $siteId ID sayta (ne obyazatelyniy)
	 * @return array Assotsiativniy massiv, gde klyuchi   simvolynie kodi infoblokov, a znacheniya   ih ID
	 * @throws \Exception
	 */
	public static function getIBlockIds($siteId = null)
	{
		if (null === $siteId)
		{
			$siteId = defined('WIZARD_SITE_ID')
				? WIZARD_SITE_ID
				: defined('ADMIN_SECTION') ? null : SITE_ID;
		}

		if (null === static::$iblocks || !isset(static::$iblocks[$siteId]))
		{
//			static::$iblocks = Cache::remember(__METHOD__ . $siteId, 30 * 60 * 24, function () use ($siteId)
//			{
				if (!Bitrix\Main\Loader::includeModule("iblock"))
				{
					throw new \Exception(Loc::getMessage("CITRUS_AREALTY_IBLOCK_MODULE_NOT_FOUND"));
				}

				$iblocks = array();
				$iblocks[$siteId] = array();
				$filter = Array("!CODE" => false, "CHECK_PERMISSIONS" => "N");
				if ($siteId)
				{
					$filter["SITE_ID"] = $siteId;
				}
				$dbIblock = \CIBlock::GetList(
					Array(),
					$filter,
					$bIncCnt = false
				);
				while ($iblock = $dbIblock->Fetch())
				{
//					Cache::registerIblockCacheTag($iblock['ID']);
					if (array_key_exists($iblock["CODE"], $iblocks) && !is_array($iblocks[$iblock["CODE"]]))
					{
						$iblocks[$siteId][$iblock["CODE"]] = array($iblocks[$iblock["CODE"]]);
						$iblocks[$siteId][$iblock["CODE"]][] = (int)$iblock["ID"];
					}
					else
					{
						$iblocks[$siteId][$iblock["CODE"]] = (int)$iblock["ID"];
					}
				}

				static::$iblocks[$siteId] = $iblocks[$siteId];

//				return $iblocks;
//			}, __FUNCTION__);
		}

		return static::$iblocks[$siteId];
	}

	public function getMailField($newID, $arUpdateFieldValues) {
		$arMailFields = array();

		/**
		 * dobavim vozmozhnosty ispolyzovaniya ID dobavlennogo elementa v shablone pochtovogo sobitiya
		 */
		if (isset($newID) && $newID)
			$arMailFields['ID'] = $newID;

		$arMailFields = array_merge($arMailFields, $arUpdateFieldValues);

		$bxSendMail = true;
		$events = GetModuleEvents("main", "OnPrepeaDataBeforeSendEmail");
		while ($arEvent = $events->Fetch()) {
			$bxSendMail = ExecuteModuleEventEx($arEvent, array(&$arMailFields));
		}

		return true === $bxSendMail || null === $bxSendMail ? $arMailFields : false;
	}
}
