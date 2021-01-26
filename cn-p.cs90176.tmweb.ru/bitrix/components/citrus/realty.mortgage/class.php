<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

class CitrusRealtyMortage extends CBitrixComponent
{
	protected $id;

	/**
	 * Primitivnaya proverka pravilynosti zapolneniya parametrov i podstanovka znacheniy po umolchaniyu
	 * Na osnove opisaniya parametrov komponenta v .parameters.php
	 *
	 * @param array $paramValues
	 */
	protected function processParams(array &$paramValues)
	{
		// set default value for missing parameters, simple param check
		$componentParams = CComponentUtil::GetComponentProps($this->getName());
		if (is_array($componentParams))
		{
			foreach ($componentParams["PARAMETERS"] as $paramName => $paramArray)
			{
				if (!is_set($paramValues, $paramName) && is_set($paramArray, "DEFAULT"))
					$paramValues[$paramName] = $paramArray["DEFAULT"];

				$paramArray["TYPE"] = ToUpper(is_set($paramArray, "TYPE") ? $paramArray["TYPE"] : "STRING");
				switch ($paramArray["TYPE"]) {
					case 'INT':
						$paramValues[$paramName] = is_numeric($paramValues[$paramName]) ? $paramValues[$paramName] : $paramArray["DEFAULT"];
						break;

					case 'LIST':
						if ($paramArray['MULTIPLE'] == "Y")
						{
							foreach ($paramValues[$paramName] as $key=> $value)
							{
								if (!($value && array_key_exists($value, $paramArray['VALUES'])))
									unset($paramValues[$paramName][$key]);
							}
							if (empty($paramValues[$paramName]))
								$paramValues[$paramName] = $paramArray["DEFAULT"];
						}
						elseif (!($paramValues[$paramName] && array_key_exists($paramValues[$paramName], $paramArray['VALUES'])))
							$paramValues[$paramName] = $paramArray["DEFAULT"];
						break;

					case 'CHECKBOX':
						$paramValues[$paramName] = ($paramValues[$paramName] == (is_set($paramArray, 'VALUE') ? $paramArray['VALUE'] : 'Y'));
						break;

					case 'STRING':
						$paramValues[$paramName] = strlen($paramValues[$paramName]) ? $paramValues[$paramName] : $paramArray["DEFAULT"];
						break;

					default:
						// string etc.
						break;
				}
			}
		}
	}

	public function onPrepareComponentParams($arParams)
	{
		$this->processParams($arParams);

		$this->id = __CLASS__ . '_' . $this->randString();

		$arParams = parent::onPrepareComponentParams($arParams);

		$arParams['DEFAULT_FULL_PRICE'] =
			isset($arParams['DEFAULT_FULL_PRICE']) && is_numeric($arParams['DEFAULT_FULL_PRICE'])
				? $arParams['DEFAULT_FULL_PRICE']
				: 3000000;

        if ($arParams['DEFAULT_FIRST_PRICE_UNITS'] == 'R')
        {
            $arParams['DEFAULT_FIRST_PRICE'] =
                isset($arParams['DEFAULT_FIRST_PRICE']) && is_numeric($arParams['DEFAULT_FIRST_PRICE'])
                    ? $arParams['DEFAULT_FIRST_PRICE']
                    : 450000;
        }
        else
        {
            $percent = isset($arParams['DEFAULT_FIRST_PRICE']) && is_numeric($arParams['DEFAULT_FIRST_PRICE'])
                ? $arParams['DEFAULT_FIRST_PRICE']
                : 15;

            if ($percent < 0 || $percent > 100)
                $percent = 15;

            $arParams['DEFAULT_FIRST_PRICE'] = $percent * $arParams['DEFAULT_FULL_PRICE'] / 100;
        }

		return $arParams;
	}

	public function executeComponent()
	{
		if (!\Bitrix\Main\Loader::includeModule('citrus.arealtypro'))
		{
			ShowError(Loc::getMessage('CITRUS_AREALTYPRO_MODULE_NOT_INSTALLED'));
			return;
		}

		$defaultFirstPrice = $this->arParams['DEFAULT_FIRST_PRICE'];
		$defaultFullPrice = $this->arParams['DEFAULT_FULL_PRICE'];

		$theme = COption::GetOptionString("main", "wizard_" . \Citrus\Arealty\Wizard::TEMPLATE . "_theme_id", null);
		if (!$theme)
		{
			$theme = CUserOptions::GetOption("main.interface", "global", array("theme" => 'red'));
			$theme = is_array($theme) && isset($theme['theme']) ? $theme['theme'] : null;
		}

		$this->arResult = array(
			'theme' => $theme,

			'minFullPrice' => 500000,
			'maxFullPrice' => 30000000,

			'minPercent' => 0,
			'maxPercent' => 30,

			'minFirstPercent' => 0,
			'maxFirstPercent' => $this->arParams['MAX_FIRST_PRICE_PERC'],

			'minFirstPrice' => 0,

			'minYear' => 1,
			'maxYear' => 50,

			'defaultFullPrice' => $defaultFullPrice,
			'defaultFirstPrice' => $defaultFirstPrice,
			'defaultFirstPriceUnits' => $this->arParams['DEFAULT_FIRST_PRICE_UNITS'],
			'defaultFirstPercent' => $defaultFirstPrice / $defaultFullPrice * 100,
			'defaultPercent' => $this->arParams['DEFAULT_PERCENT'],
			'defaultYear' => $this->arParams['DEFAULT_YEAR'],

			'discountPercent' => $this->arParams['DISCOUNT_PERCENT'],
		);

		$this->includeComponentTemplate();
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
}