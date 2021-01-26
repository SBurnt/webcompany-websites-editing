<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Citrus\Arealty\Template\TemplateHelper;
use Citrus\ArealtyPro\Manage\RightsFactory;

Loc::loadMessages(__FILE__);

class CitrusRealtyManageObjects extends CBitrixComponent
{
	const MESSAGES_KEY = __CLASS__;

	/** @var string[] */
	protected $errors;
	/** @var string[] */
	protected $messages;

	/** @var int */
	protected $iblockId;

	/** @var array */
	protected $iblockArray;

	/** @var \Citrus\ArealtyPro\Manage\RightsProvider */
	private $rights;

	function __construct($component)
	{
		try
		{
			if (!CModule::IncludeModule("citrus.arealty"))
			{
				throw new \Bitrix\Main\LoaderException(Loc::getMessage('CITRUS_AREALTY_MODULE_NOT_INSTALLED'));
			}

			if (!CModule::IncludeModule("citrus.arealtypro"))
			{
				throw new \Bitrix\Main\LoaderException(Loc::getMessage('CITRUS_AREALTYPRO_MODULE_NOT_INSTALLED'));
			}

			if (!CModule::IncludeModule("iblock"))
			{
				throw new \Bitrix\Main\LoaderException(Loc::getMessage('CITRUS_IBLOCK_MODULE_NOT_INSTALLED'));
			}
		}
		catch (\Bitrix\Main\LoaderException $e)
		{
			ShowError($e->getMessage());
			throw $e;
		}

		$this->iblockId = \Citrus\Arealty\Helper::getIblock('offers');

		parent::__construct($component);

		$this->messagesInit();
	}

	protected function messagesInit()
	{
		if (!is_array($_SESSION[static::MESSAGES_KEY]))
		{
			$_SESSION[static::MESSAGES_KEY] = array(
				'errors' => array(),
				'messages' => array(),
			);
		}
		if (!is_array($_SESSION[static::MESSAGES_KEY]['errors']))
		{
			$_SESSION[static::MESSAGES_KEY]['errors'] = array();
		}
		if (!is_array($_SESSION[static::MESSAGES_KEY]['messages']))
		{
			$_SESSION[static::MESSAGES_KEY]['messages'] = array();
		}

		$this->errors = &$_SESSION[static::MESSAGES_KEY]['errors'];
		$this->messages = &$_SESSION[static::MESSAGES_KEY]['messages'];
	}

	/**
	 * @return string[]
	 */
	public function popErrors()
	{
		$errors = $this->errors;
		$this->errors = null;
		return $errors;
	}

	public function hasErrors()
	{
		return (bool)count($this->errors);
	}

	public function hasMessages()
	{
		return (bool)count($this->messages);
	}

	/**
	 * @return string[]
	 */
	public function popMessages()
	{
		$messages = $this->messages;
		$this->messages = null;
		return $messages;
	}

	/**
	 * @param string|\Exception|\CApplicationException|string[] $error
	 * @throws \Bitrix\Main\ArgumentTypeException
	 */
	public function pushError($error)
	{
		if (is_string($error))
		{
			$this->errors[] = $error;
		}
		elseif ($error instanceof \Exception)
		{
			$this->errors[] = $error->getMessage();
		}
		elseif ($error instanceof \CApplicationException)
		{
			$this->errors[] = $error->GetString();
		}
		elseif (is_array($error))
		{
			array_walk($error, function ($v) {
				if (!is_string($v))
				{
					throw new \Bitrix\Main\ArgumentTypeException('error', 'string, Exception, CApplicationException or array of strings');
				}
			});
			$this->errors = array_merge($this->errors, $error);
		}
		else
		{
			throw new \Bitrix\Main\ArgumentTypeException('error', 'string, Exception, CApplicationException or array of strings');
		}
	}

	/**
	 * @param string $message
	 * @throws \Bitrix\Main\ArgumentTypeException
	 */
	public function pushMessage($message)
	{
		if (is_string($message))
		{
			$this->messages[] = $message;
		}
		else
		{
			throw new \Bitrix\Main\ArgumentTypeException('message', 'string');
		}
	}

	/**
	 * @return int
	 * @throws ErrorException
	 */
	public function getIblockId()
	{
		if (!isset($this->iblockId))
		{
			throw new ErrorException('iblockId is not set');
		}
		return $this->iblockId;
	}

	/**
	 * @return \Citrus\ArealtyPro\Meta\MetaProvider
	 */
	public function getMeta()
	{
		static $metaInstances = array();

		if (!isset($metaInstances[$this->iblockId]))
		{
			$metaInstances[$this->iblockId] = new \Citrus\ArealtyPro\Meta\Iblock($this->iblockId, $this->getRights());
		}

		return $metaInstances[$this->iblockId];
	}

	/**
	 * @param string $pathTemplate
	 * @param string [string] $variables
	 * @param array [string] $params
	 * @return string
	 */
	public static function makePath($pathTemplate, $variables, $params = array())
	{
		$url = \CComponentEngine::makePathFromTemplate($pathTemplate, $variables);
		if (count($params))
		{
			$params = array_map(function ($key, $value) {
				return $key . '=' . rawurlencode($value);
			}, array_keys($params), array_values($params));

			$url .= (strpos($url, '?') === false ? '?' : '&') . implode('&', $params);
		}
		return $url;
	}

	public function getBackUrl()
	{
		return $this->request->get('backurl') ? $this->request->get('backurl') : null;
	}

	public function getListUrl()
	{
		$this->arParams["LIST_PATH"] = trim($this->arParams["LIST_PATH"]);
		if (strlen($this->arParams["LIST_PATH"]) <= 0)
			$this->arParams["LIST_PATH"] = "";

		return $this->arParams['LIST_PATH'];
	}

	/**
	 * Formiruet ssilku na redaktirovanie elementa
	 *
	 * @param int $id
	 * @return string
	 */
	public function getEditUrl($id = 0)
	{
		global $APPLICATION;

		$this->arParams["EDIT_PATH"] = trim($this->arParams["EDIT_PATH"]);
		if (strlen($this->arParams["EDIT_PATH"]) <= 0)
			$this->arParams["EDIT_PATH"] = "#ID#/";

		return static::makePath($this->arParams['EDIT_PATH'], array('ID' => $id), array(
			"backurl" => $this->getBackUrl() ?: $APPLICATION->GetCurPageParam('', array('backurl')),
		));
	}

	/**
	 * Formiruet ssilku na stranitsu redaktirovaniya profilya
	 *
	 * @return string
	 */
	public function getProfileUrl()
	{
		global $APPLICATION;

		if (isset($this->arResult['FOLDER'], $this->arResult["URL_TEMPLATES"]))
		{
			$template = $this->arResult['FOLDER'] . CComponentEngine::makePathFromTemplate($this->arResult["URL_TEMPLATES"]['profile'], []);
		}
		else
		{
			$template = trim($this->arParams["PROFILE_PATH"]);
			if (strlen($template) <= 0)
			{
				$template = SITE_DIR . "/kabinet/profile/";
			}
		}

		return static::makePath($template, [], [
			"backurl" => $APPLICATION->GetCurPageParam('', ['backurl']),
		]);
	}

	/**
	 * Formiruet ssilku na udalenie elementa
	 *
	 * @param int $id
	 * @return string
	 */
	public function getDeleteUrl($id)
	{
		global $APPLICATION;

		$this->arParams["EDIT_PATH"] = trim($this->arParams["EDIT_PATH"]);
		if (strlen($this->arParams["EDIT_PATH"]) <= 0)
			$this->arParams["EDIT_PATH"] = "#ID#/";

		return static::makePath($this->arParams['LIST_PATH'], array(), array(
			'ID' => $id,
			'action' => 'delete',
			'sessid' => bitrix_sessid(),
			"backurl" => $APPLICATION->GetCurPageParam('', array('backurl')),
		));
	}

	public function getIblockField($field = null)
	{
		if (null === $this->iblockArray)
		{
			$this->iblockArray = \CIBlock::GetArrayByID($this->getIblockId());
		}

		return $field === null ? $this->iblockArray : $this->iblockArray[$field];
	}

	/**
	 * @return \Citrus\ArealtyPro\Manage\RightsProvider
	 */
	public function getRights()
	{
		return $this->rights ?: RightsFactory::getInstance($this->iblockId);
	}

	public function onPrepareComponentParams($arParams)
	{
		/** @noinspection PhpUnusedLocalVariableInspection */
		$arCurrentValues = $arParams;
		include __DIR__ . '/.parameters.php';
		/** @var array $arComponentParameters*/

		if (isset($arParams['RIGHTS_PROVIDER']) && class_exists($arParams['RIGHTS_PROVIDER']))
		{
			$classname = $arParams['RIGHTS_PROVIDER'];
			$this->rights = new $classname($this->getIblockId());
			if (!($this->rights instanceof \Citrus\ArealtyPro\Manage\RightsProvider))
			{
				throw new \Bitrix\Main\SystemException('RIGHTS_PROVIDER must be an instance of \Citrus\ArealtyPro\Manage\RightsProvider');
			}
		}

		if (!is_array($arParams["FIELD_CODE"]))
		{
			$arParams["FIELD_CODE"] = array();
		}

		$arParams['FIELD_CODE'][] = 'PROPERTY_contact';
		$arParams['FIELD_CODE'][] = 'CREATED_BY';

		$availableFields = $this->getMeta()->getFields();
		foreach ($arParams["FIELD_CODE"] as $key=>$val)
		{
			if (!$val || !isset($availableFields[$val]))
			{
				unset($arParams["FIELD_CODE"][$key]);
				continue;
			}

			if (!$this->getRights()->canViewField($availableFields[$val]))
			{
				unset($arParams["FIELD_CODE"][$key]);
				continue;
			}
		}

		$arParams['FIELD_CODE'] = array_unique($arParams['FIELD_CODE']);

		$arParams['USE_HTML_EDITOR'] = isset($arParams['USE_HTML_EDITOR']) && $arParams['USE_HTML_EDITOR'] == 'N' ? 'N' : 'Y';

		if ($arParams["USE_FILTER"] == "Y")
		{
			if (strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
			{
				$arParams["FILTER_NAME"] = "arrFilter";
			}
		}
		else
		{
			$arParams["FILTER_NAME"] = "";
		}

		if (
			(empty($arParams['PROFILE_FIELDS']) || !is_array($arParams['PROFILE_FIELDS']))
			&& ($default = \Citrus\Core\array_get($arComponentParameters, 'PARAMETERS.PROFILE_FIELDS.DEFAULT'))
		)
		{
			$arParams['PROFILE_FIELDS'] = $default;
		}

		if (
			(empty($arParams['REGISTER_FIELDS']) || !is_array($arParams['REGISTER_FIELDS']))
			&& ($default = \Citrus\Core\array_get($arComponentParameters, 'PARAMETERS.REGISTER_FIELDS.DEFAULT'))
		)
		{
			$arParams['REGISTER_FIELDS'] = $default;
		}

		return parent::onPrepareComponentParams($arParams);
	}

	public function executeComponent()
	{
		global $APPLICATION, $USER;

		$arDefaultUrlTemplates404 = array(
			"list" => "",
			"form" => "#ID#/",
			"auth" => "auth/",
			"register" => "register/",
			"profile" => "profile/",
		);

		$arDefaultVariableAliases404 = array();

		$arComponentVariables = array("ID");

		if ($this->arParams["SEF_MODE"] == "Y")
		{
			$arVariables = array();

			$arUrlTemplates = CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404, $this->arParams["SEF_URL_TEMPLATES"]);
			$arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases404, $this->arParams["VARIABLE_ALIASES"]);

			$componentPage = CComponentEngine::parseComponentPath(
				$this->arParams["SEF_FOLDER"],
				$arUrlTemplates,
				$arVariables
			);

			$b404 = false;
			if (!$componentPage)
			{
				$componentPage = "list";
				$b404 = true;
			}

			if ($componentPage == "form"
				&& isset($arVariables["ID"]) && intval($arVariables["ID"])."" !== $arVariables["ID"]
			)
				$b404 = true;

			if ($b404 && $this->arParams["SET_STATUS_404"] === "Y")
			{
				$folder404 = str_replace("\\", "/", $this->arParams["SEF_FOLDER"]);
				if ($folder404 != "/")
					$folder404 = "/".trim($folder404, "/ \t\n\r\0\x0B")."/";
				if (substr($folder404, -1) == "/")
					$folder404 .= "index.php";

				if ($folder404 != $APPLICATION->GetCurPage(true))
					CHTTP::SetStatus("404 Not Found");
			}

			CComponentEngine::initComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);
			$this->arResult = array(
				"FOLDER" => $this->arParams["SEF_FOLDER"],
				"URL_TEMPLATES" => $arUrlTemplates,
				"VARIABLES" => $arVariables,
				"ALIASES" => $arVariableAliases
			);
		}
		else
		{
			throw new \Bitrix\Main\SystemException(GetMessage("CITRUS_AREALTY_SEF_MODE_REQUIRED"));
		}

		$this->checkUserInfo($componentPage);

		if ($this->hasMessages())
		{
			TemplateHelper::showAlert(implode("<br>\n", $this->popMessages()), TemplateHelper::ALERT_SUCCESS);
		}

		if ($this->hasErrors())
		{
			TemplateHelper::showAlert(implode("<br>\n", $this->popErrors()), TemplateHelper::ALERT_DANGER);
		}

		if (!$USER->IsAuthorized() && !in_array($componentPage, ['auth', 'register']))
		{
			$APPLICATION->ShowAuthForm('');
			return;
		}

		$this->includeComponentTemplate($componentPage);
	}

	/**
	 * Proveryaet zapolnennosty poley profilya s kontaktnimi dannimi
	 *
	 * Nuzhni dlya otobrazheniya v bloke kontaktov po obaektam
	 *
	 * @param string $componentPage
	 */
	protected function checkUserInfo($componentPage)
	{
		global $USER;

		$user = $USER->GetByID($USER->GetID())->Fetch();
		if (in_array($componentPage, ['list', 'form'])
			&& (!$user['NAME'] || empty(array_filter([$user['PERSONAL_MOBILE'], $user['WORK_PHONE']])))
		)
		{
			TemplateHelper::showAlert(Loc::getMessage("CITRUS_AREALTYPRO_INCOMPLETE_PROFILE", ['#PROFILE_URL#' => $this->getProfileUrl()]), TemplateHelper::ALERT_WARNING);
		}
	}
}