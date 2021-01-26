<?php

use Citrus\ArealtyPro\Manage\RightsProvider;
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

CBitrixComponent::includeComponentClass('citrus:realty.manage.objects');

/**
 * Sobitiya pozvolyayut vnesti izmeneniya v povedenie komponenta bez ego kastomizatsii:
 *
 * * **onManageObjectsListShow**   pered podklyucheniem shablona, pozvolyaet izmenity arResult, dobavity svoi punkti kontekstnogo menyu, deystviya, knopki na panely
 * * **onManageObjectsListAction**   obrabotka deystviy (po knopkam, punktam menyu i t.p.)
 *
 */
class CitrusRealtyManageObjectsList extends CitrusRealtyManageObjects
{
	/**
	 * Parametri sobitiya:
	 * * 'action'   deystvie (parametr zaprosa action)
	 * * 'ids' => $actionIds (ID vibrannih elementov)
	 * * 'filter' => $actionFilter (filytr dlya CIBlockElement::GetList)
	 * * 'component' => $this (ssilka na ekzemplyar tekushtego klassa)
	 */
	const ON_BEFORE_ACTION = 'onManageObjectsListAction';
	/**
	 * Parametri sobitiya:
	 * * 'component' => $this (ssilka na ekzemplyar tekushtego klassa)
	 */
	const ON_BEFORE_SHOW = 'onManageObjectsListShow';

	protected $filter;

	/**
	 * Poluchity tekushtiy filytr dlya viborki zapisey
	 *
	 * @return mixed[]
	 */
	public function getFilter()
	{
		return $this->filter;
	}

	/**
	 * Ustanovity filytr dlya viborki zapisey spiska
	 *
	 * @param mixed[] $filter
	 */
	public function setFilter($filter)
	{
		$this->filter = $filter;
	}

	/**
	 * Obrabotka gruppovih deystviy i knopok na paneli.
	 *
	 * Proveryaet sessiyu pered vipolneniem
	 *
	 * @internal
	 */
	protected function processActions()
	{
		if (!check_bitrix_sessid())
		{
			return;
		}

		$actionFilter = $this->getFilter();
		$actionIds = array();

		if (isset($_REQUEST['ID']))
		{
			if (is_array($_REQUEST['ID']))
			{
				foreach ($_REQUEST['ID'] as $key => $ID)
				{
					$ID = (int)$ID;
					if ($ID > 0 && !in_array($ID, $actionIds))
					{
						$actionIds[] = $ID;
					}
				}
			}
			elseif (is_numeric($_REQUEST['ID']))
			{
				$actionIds[] = (int)$_REQUEST['ID'];
			}
		}
		$actionFilter["ID"] = count($actionIds) ? $actionIds : -1;
		$action = $_REQUEST['action'];

		$event = new Main\Event(
			'citrus.arealtypro',
			static::ON_BEFORE_ACTION,
			array(
				'action' => $action,
				'ids' => $actionIds,
				'filter' => $actionFilter,
				'component' => $this,
			)
		);
		Main\EventManager::getInstance()->send($event);

		/**
		 * Esli hotya bi odin obrabotchik vernul rezulytat SUCCESS   sdelaem redirekt
		 */
		foreach ($event->getResults() as $result)
		{
			if ($result->getType() == Main\EventResult::SUCCESS)
			{
				LocalRedirect($this->getBackUrl() ?: $this->getListUrl());
			}
		}

		/**
		 * Esli obrabotchiki dobavili oshibki   sdelaem redirekt
		 */
		if ($this->hasErrors())
		{
			LocalRedirect($this->getBackUrl() ?: $this->getListUrl());
		}

		if ($action === 'delete')
		{
			$rsElementDel = CIBlockElement::GetList(array(), $actionFilter, false, false, array("ID"));
			$obElementDel = new CIBlockElement();
			$cnt = 0;
			while ($arElementDel = $rsElementDel->Fetch())
			{
				if (!$this->getRights()->canDoOperation(RightsProvider::OP_ELEMENT_DELETE, $arElementDel['ID']))
				{
					$this->pushError(Loc::getMessage('C_ELEMENT_DELETE_ACCESS_DENIED', ['ID' => $arElementDel['ID']]));
				}

				if ($obElementDel->Delete($arElementDel["ID"]))
				{
					$cnt++;
				}
			}

			if ($cnt > 0)
			{
				$this->pushMessage(Loc::getMessage('C_ELEMENTS_DELETED'));
			}

			LocalRedirect($this->getBackUrl() ?: $this->getListUrl());
		}
	}

	public function onBeforeShow()
	{
		$event = new Main\Event(
			'citrus.arealtypro',
			static::ON_BEFORE_SHOW,
			array(
				'component' => $this,
			)
		);
		Main\EventManager::getInstance()->send($event);
	}

	public function executeComponent()
	{
		$this->__includeComponent();
	}

	public function onPrepareComponentParams($arParams)
	{
		$arParams = parent::onPrepareComponentParams($arParams);

		$arParams["ALLOW_NEW_ELEMENT"] = $arParams["ALLOW_NEW_ELEMENT"] != "N" ? true : false;
		$arParams["ALLOW_NEW_ELEMENT"] =
			$arParams["ALLOW_NEW_ELEMENT"]
			&& $this->getRights()->canDoOperation(RightsProvider::OP_ELEMENT_NEW);

		return $arParams;
	}
}