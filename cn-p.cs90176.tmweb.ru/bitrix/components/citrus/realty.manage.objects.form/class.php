<?php

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Citrus\ArealtyPro\Iblock\ExternalAuthors;
use Citrus\ArealtyPro\Manage\RightsProvider;
use Citrus\ArealtyPro\Meta\Field\FieldType;
use Citrus\ArealtyPro\Meta\Field\IblockBase;
use Citrus\ArealtyPro\Meta\Field\IblockProperty;
use Citrus\Arealty\Helper;
use function Citrus\Core\array_only;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

CBitrixComponent::includeComponentClass('citrus:realty.manage.objects');

/**
 * События позволяют внести изменения в поведение компонента без его кастомизации:
 *
 * * **onManageObjectsFormShow**   перед подключением шаблона, позволяет изменить arResult, добавить свои пункты контекстного меню, действия, кнопки на панель
 * * **onManageObjectsFormAction**   обработка действий
 *
 */
class CitrusRealtyManageObjectsForm extends CitrusRealtyManageObjects
{
	/**
	 * Параметры события:
	 * * 'action'   действие (параметр запроса action)
	 * * 'component' => $this (ссылка на экземпляр текущего класса)
	 */
	const ON_BEFORE_ACTION = 'onManageObjectsFormAction';
	/**
	 * Параметры события:
	 * * 'component' => $this (ссылка на экземпляр текущего класса)
	 */
	const ON_BEFORE_SHOW = 'onManageObjectsFormShow';

	/**
	 * После успешного изменения объекта (параметры: fields, properties)
	 */
	const ON_SAVED = 'onManageObjectsFormSaved';

	/**
	 * Событие для модификации полей объекта перед сохранением
	 */
	const ON_BEFORE_SAVE = 'onBeforeManageObjectsFormSave';

	/** @var int|null */
	protected $id;

	protected $formId;
	protected $iblockArray;

	protected $varsFromForm = array();

	/** @var array[] $listProperties */
	protected $listProperties;

	function __construct($component)
	{
		parent::__construct($component);

		$this->formId = str_replace(array(':', '.'), '_', $this->getName() . ':' . $this->iblockId);
	}

	public function addCustomProps($formSettings, &$firstTab)
	{
		$tabFieldsList = [];
		foreach ($formSettings['tabs'] as $tab)
		{
			foreach ($tab['fields'] as $field)
			{
				$tabFieldsList[is_array($field) ? ($field['~id'] ?: $field['id']) : $field] = 1;
			}
		}
		$customFieldsList = [];
		foreach ($this->arParams['FIELD_CODE'] as $code)
		{
			if (substr($code, 0, 9) == 'PROPERTY_')
			{
				$code = substr($code, 9);
			}
			if (!isset($tabFieldsList[$code]))
			{
				$customFieldsList[$code] = 1;
			}
		}
		foreach ($customFieldsList as $code => $v)
		{
			$firstTab['fields'][] = $code;
		}
	}

	public function getFormTabs(array $fieldsMeta = null)
	{
		$formSettings = Main\Web\Json::decode(file_get_contents(__DIR__ . '/default_form_settings.json'));

		$fieldsMeta = $fieldsMeta ?: $this->getMeta()->getFields();
		$fieldDesc = $this->prepareFormFields($fieldsMeta);

		$isFirstTab = true;
		foreach ($formSettings['tabs'] as &$tab)
		{
			if ($isFirstTab)
			{
				$this->addCustomProps($formSettings, $tab);
				$isFirstTab = false;
			}
			foreach ($tab['fields'] as &$field)
			{
				$fieldId = is_array($field) ? ($field['~id'] ?: $field['id']) : $field;
				if (is_array($field) && $field['type'] == 'section')
				{
					continue;
				}

				if (!isset($fieldDesc[$fieldId]))
				{
					$field = null;
					continue;
				}

				if (is_array($field))
				{
					$field = array_merge($fieldDesc[$fieldId], $field, array_only($fieldDesc[$fieldId], ['id']));
				}
				else
				{
					$field = $fieldDesc[$fieldId];
				}
			}
			$tab['fields'] = array_filter($tab['fields']);
		}

		return $formSettings['tabs'];
	}

	public function onPrepareComponentParams($arParams)
	{
		$arParams = parent::onPrepareComponentParams($arParams);

		$this->setId((int)$arParams["ID"] > 0 ? (int)$arParams["ID"] : null);

		$propDraftFor = \CIBlockProperty::GetList([], [
			'IBLOCK_ID' => Helper::getIblock('offers'),
			'CODE' => 'draft_for',
			'ACTIVE' => 'Y',
		])->Fetch();
		if (empty($propDraftFor['ID']))
		{
			$arParams['DRAFT_ENABLED'] = 'N';
		}

		if ($arParams['DRAFT_ENABLED'] == 'Y')
		{
			$parentForDraft = $this->parentForDraft($this->getId());
			$arParams['IS_DRAFT'] = $parentForDraft > 0? 'Y' : 'N';
			$arParams['WF_PARENT_ELEMENT_ID'] = $parentForDraft > 0? $parentForDraft : $this->getId();

			if (!empty($_REQUEST['preview']))
			{
				if ($this->getId() && !$parentForDraft)
				{
					// если не черновик - сбросим ID чтоб создать копию элемента
					$this->setId(null);
				}
			}
		}
		else
		{
			$arParams['IS_DRAFT'] = 'N';
			$arParams['WF_PARENT_ELEMENT_ID'] = $this->getId();
		}

		$arParams["PARENT_SECTION_ID"] = (int)$arParams["PARENT_SECTION_ID"];

		$arParams["ALLOW_NEW_ELEMENT"] = $arParams["ALLOW_NEW_ELEMENT"] != "N" ? true : false;
		$arParams["ALLOW_NEW_ELEMENT"] =
			$arParams["ALLOW_NEW_ELEMENT"]
			&& $this->getRights()->canDoOperation(RightsProvider::OP_ELEMENT_NEW);

		$arParams['FIELD_CODE'] = array_filter($arParams['FIELD_CODE'], function ($value) {
			return strlen($value);
		});

		if (ExternalAuthors::userIsExternal())
		{
			/**
			 * #59544 6. Для сторонних пользователей при подаче объявления через ЛК необходимо убрать поля : Комиссия агента (%): Номер лота , Кадастровый номер, Тип сделки.
			 */
			$arParams['FIELD_CODE'] = array_diff($arParams['FIELD_CODE'], [
				'PROPERTY_agent_fee',
				'PROPERTY_lot_number',
				'PROPERTY_cadastral_number',
				'PROPERTY_deal_status',
				'PROPERTY_deal_status_new',
				'PROPERTY_deal_status_commercial',
			]);
		}

		$arParams["MAX_FILE_COUNT"] = (int)$arParams["MAX_FILE_COUNT"];
		if ($arParams["MAX_FILE_COUNT"] <= 0)
			$arParams["MAX_FILE_COUNT"]  =  6;

		return $arParams;
	}

	public function getUserTypeFunc($UT, $multiple = false)
	{
		static $methodPriority = array(
			'GetPublicEditHTMLMulty',
			'GetPublicEditHTML',
			'GetPropertyFieldHtmlMulty',
			'GetPropertyFieldHtml',
			'GetPublicViewHTML',
			'GetAdminListViewHTML',
		);

		$methods = $multiple
			? $methodPriority
			: array_diff($methodPriority, array('GetPublicEditHTMLMulty', 'GetPropertyFieldHtmlMulty'));

		foreach ($methods as $method)
		{
			if (array_key_exists($method, $UT))
			{
				return $method;
			}
		}
		return false;
	}

	/**
	 * @return mixed
	 */
	public function getFormId()
	{
		return $this->formId;
	}

	/**
	 * @param int|null $id ID объекта
	 * @param bool $checkRights Проверять права доступа
	 */
	protected function setId($id, $checkRights = true)
	{
		$this->id = $id;
		if ($checkRights)
		{
			if (CIBlockElement::GetList(
					array(),
					$this->getFilterValues(),
					false,
					false,
					array('ID')
				)->SelectedRowsCount() <= 0
			)
			{
				$this->id = null;
			}
			else
			{
				$this->id = $id;
			}
		}
	}

	/**
	 * @return int|null
	 */
	public function getId()
	{
		return $this->id;
	}

	public function fixElementForPreview($id, $parentId, $currentName)
	{
		$element = new \CIBlockElement();
		$name = Loc::getMessage('CITRUS_AREALTYPRO_EDIT_DRAFT_TITLE', ['#ID#' => $parentId]) . ' ' . $currentName;
		$element->Update($id, [
			'NAME' => $name,
		]);
		\CIBlockElement::SetPropertyValueCode($id, 'draft_for', $parentId);

		return $this->arParams['OFFERS_PATH'] . '?id=' . $id;
	}

	protected function editActions()
	{
		if (!check_bitrix_sessid())
			return;

		$arErrors = array();

		$request = $this->request;

		$event = new Main\Event(
			'citrus.arealtypro',
			static::ON_BEFORE_ACTION,
			array(
				'action' => $request->get("action"),
				'component' => $this,
			)
		);
		Main\EventManager::getInstance()->send($event);

		/**
		 * Если хотя бы один обработчик вернул результат SUCCESS   сделаем редирект
		 */
		foreach ($event->getResults() as $result)
		{
			if ($result->getType() == Main\EventResult::SUCCESS)
			{
				LocalRedirect($this->getListUrl());
			}
		}

		/**
		 * Если обработчики добавили ошибки   выведем их
		 */
		if ($this->hasErrors())
		{
			return;
		}

		if (!$request->isPost() && $request->get("action") == "delete")
		{
			$element = null;
			if ($this->getId())
			{
				$element = CIBlockElement::GetList(array(), $this->getFilterValues(), false, false, array('ID'))->Fetch();
			}


			if ($element && $element['ID'] == $this->getId())
			{
				if ($this->getRights()->canDoOperation(RightsProvider::OP_ELEMENT_DELETE, $element['ID']))
				{
					CIBlockElement::Delete($this->getId());

					$this->pushMessage(GetMessage("CIEE_DELETED_MESSAGE"));
					LocalRedirect($this->getBackUrl() ?: $this->getListUrl());
				}
				else
				{
					$this->pushError(Loc::getMessage('ACCESS_DENIED'));
				}
			}
			else
			{
				$this->pushError(GetMessage("CITRUS_AREALTY_MANAGE_DELETE_ERROR_NOT_FOUND"));
			}
			return;
		}

		if ($request->isPost() && ($_REQUEST["save"] || $_REQUEST["apply"] || $_REQUEST["preview"]))
		{
			/**
			 * Проверка прав на  Изменение 
			 */
			if ($this->getId() > 0
				&& !$this->getRights()->canDoOperation(RightsProvider::OP_ELEMENT_EDIT, $this->getId()))
			{
				$this->pushError(GetMessage("ACCESS_DENIED"));
				return;
			}

			/**
			 * Проверка прав на  Добавление 
			 */
			if ($this->getId() <= 0
				&& !$this->arParams["ALLOW_NEW_ELEMENT"])
			{
				$this->pushError(GetMessage("ACCESS_DENIED"));
				return;
			}

			if ($this->getId() || $this->arParams["ALLOW_NEW_ELEMENT"])
			{
				$updateValues = array();
				if ($this->arParams["PARENT_SECTION_ID"] > 0)
				{
					$updateValues["IBLOCK_SECTION_ID"] = $this->arParams["PARENT_SECTION_ID"];
				}

				foreach ($this->arParams["FIELD_CODE"] as $code)
				{
					$field = $this->getMeta()->getField($code);

					if (!$field->isEditable())
						continue;

					// region Сохранение значений полей элемента
					if ($field instanceof \Citrus\ArealtyPro\Meta\Field\IblockField)
					{
						if ($field->getCode() == 'IBLOCK_SECTION_ID') {
							$updateValues['IBLOCK_SECTION'] = $_POST['IBLOCK_SECTION'];
							if (!empty($updateValues['IBLOCK_SECTION'][0])) {
								$updateValues['IBLOCK_SECTION_ID'] = $updateValues['IBLOCK_SECTION'][0];
							}
						}
						else if (($field->getCode() == 'PREVIEW_TEXT' || $field->getCode() == 'DETAIL_TEXT') && !$this->getId())
						{
							$updateValues[$field->getCode()] = $_POST[$code];
							$updateValues[$code . '_TYPE'] = 'html';
						}
						elseif ($field->getType() == FieldType::FILE)
						{
							$file = CIBlock::makeFileArray(
								array_key_exists($code, $_FILES) ? $_FILES[$code]: $_REQUEST[$code],
								$_POST[$code . "_del"] === "Y",
								$_POST[$code . "_descr"],
								array('allow_file_id' => true)
							);
							if ($file["error"] == 0)
							{
								$file["COPY_FILE"] = "Y";
							}

							$updateValues[$code] = $file;
						}
						else
						{
							$updateValues[$code] = $_POST[$code];
						}
					}
					//endregion
					//region Сохранение значений свойств
					elseif ($field instanceof IblockProperty)
					{
						if ($field->getType() == FieldType::FILE)
						{
							if ($field->isMultiple())
							{
								$updateValues[$code] = array();
								if (isset($_POST[$code]) && is_array($_POST[$code]))
								{
									foreach ($_POST[$code] as $key => $file)
									{
										$fileId = is_numeric($file) ? $file : $key;
										$updateValues[$code][$fileId] = CIBlock::makeFileArray(
											$file,
											$_POST[$code . "_del"][$key] === "Y",
											$_POST[$code . "_descr"][$key],
											array('allow_file_id' => true)
										);
									}
								}
							}
							else
							{
								$updateValues[$code] = CIBlock::makeFileArray(
									array_key_exists($code, $_FILES)? $_FILES[$code]: $_REQUEST[$code],
									$_POST[$code . "_del"] === "Y",
									$_POST[$code . "_descr"],
									array('allow_file_id' => true)
								);
							}
						}
						else
						{
							$propValue = $_POST[$code . '__VALUE'];

							if (is_array($propValue))
							{
								$propValue = array_filter($propValue);
								$updateValues[$code] = array_map(function ($value, $key) use ($code) {
									return [
										"VALUE" => $value,
										"DESCRIPTION" => $_POST[$code . '__DESCRIPTION'][$key],
									];
								}, array_values($propValue), array_keys($propValue));
							}
							else
							{
								$updateValues[$code] = array(
									"VALUE" => $propValue,
									"DESCRIPTION" => $_POST[$code . '__DESCRIPTION'],
								);
							}
						}
					}
					//endregion
				}

				// region check required fields
				if (empty($arErrors))
				{
					foreach ($this->arParams["FIELD_CODE"] as $code)
					{
						$v = isset($updateValues[$code]) ?
							(is_array($updateValues[$code]) ? array_filter($updateValues[$code]) : $updateValues[$code])
							: null;
						if (
							$this->getMeta()->getField($code)->isRequired()
							&& (
								!isset($v)
								||
								(is_array($v) && !count($v))
								||
								(!is_array($v) && !strlen($v))
							)
						)
						{
							$arErrors[] = GetMessage("C_ERROR_REQ_FIELD", array("#FIELD#" => $this->getMeta()->getField($code)->getTitle()));
						}
					}
				}
				//endregion

				$this->saveDataModifier($updateValues);

				$this->getRights()->modifyFieldsBeforeSave($updateValues, $this->getId());

				(new Main\Event('citrus.arealtypro', static::ON_BEFORE_SAVE, ['fields' => &$updateValues]))->send($this);

				/**
				 * Поля и свойства собираются в один массив (св-ва с префиксом PROPERTY_)
				 * Разделим их на два отдельных и будем сохранять по-отдельности
				 */
				$fieldValues = $propertyValues = array();
				array_walk($updateValues, function ($v, $k) use (&$fieldValues, &$propertyValues) {
					static $propertyPrefix = 'PROPERTY_';
					if (strpos($k, $propertyPrefix) === 0)
					{
						$propertyValues[substr($k, strlen($propertyPrefix))] = $v;
					}
					else
					{
						$fieldValues[$k] = $v;
					}
				});

				/**
				 * Пользовательские типы свойств могут иметь значение в виде массива.
				 * CIBlockElement::SetPropertyValuesEx() массиы трактует как множественные значения свойства.
				 * Чтобы этого не происходило необходимо заворачивать значение в массив вида array('VALUE' => <оригинальное значение>)
				 *
				 * #35294
				 */
				/**
				 *
				 * @param mixed $propertyValue
				 * @return bool
				 */
				$isCorrentPropertyValueArray = static function ($propertyValue) {
					if (!is_array($propertyValue))
					{
						return false;
					}

					$keys = array_keys($propertyValue);
					return in_array(count($keys), [1,2])
						&& count(array_intersect($keys, ['VALUE', 'DESCRIPTION']));
				};
				foreach ($propertyValues as $code => &$value)
				{
					try
					{
						$field = $this->getMeta()->getField('PROPERTY_' . $code);
					}
					catch (\Exception $e)
					{
						continue;
					}

					/**
					 * Обработка значений чекбоксов с формы
					 */
					if ($field instanceof IblockProperty && $field->getType() == 'enum')
					{
						/** @var IblockProperty $field */
						$propertyFields = $field->getPropertyFields();
						$list = $field->getEnumValues();
						if ($propertyFields["LIST_TYPE"] == "C" && count($list) == 1)
						{
							$value = $value == 'Y' ? reset(array_keys($list)) : false;
						}
					}

					if ($field instanceof IblockProperty && !$field->isMultiple())
					{
						/** @var IblockProperty $field */
						if (!$isCorrentPropertyValueArray($value))
						{
							$value = array('VALUE' => $value);
						}
					}
				}
				if (isset($value))
				{
					unset($value);
				}

				if (empty($arErrors))
				{
					// TODO передавать в Update() и Add() полный набор свойств для проверки обязательных полей и правильности заполнения
					$iblockElement = new CIBlockElement();
					if ($this->getId())
					{
						if (!$iblockElement->Update(
							$this->getId(),
							$fieldValues,
							$bWorkFlow = false,
							$bUpdateSearch = false,
							$bResizePictures = true
						))
						{
							$arErrors = array($iblockElement->LAST_ERROR);
						}
					}
					else
					{
						$fieldValues["IBLOCK_ID"] = $this->getIblockId();
						$newId = $iblockElement->Add($fieldValues, $bWorkFlow = false, $bUpdateSearch = false, $bResizePictures = true);
						if ($newId <= 0)
						{
							$arErrors = array($iblockElement->LAST_ERROR);
						}
						else
						{
							$this->setId($newId, false);
						}
					}
				}

				if (empty($arErrors))
				{
					CIBlockElement::SetPropertyValuesEx($this->getId(), $this->getIblockId(), $propertyValues);

					(new Main\Event('citrus.arealtypro', static::ON_SAVED, ['fields' => $fieldValues, 'properties' => $propertyValues]))->send($this);

					CIBlockElement::UpdateSearch($this->getId(), true);

					/**
					 * #32759
					 * Фасетный индекс обновляется автоматом при CIBlockElement::Add и Update.
					 * Поскольку мы устанавливаем значения свойств позже, нужно вызавать обновления индекса явно.
					 */
					\Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex($this->getIblockId(), $this->getId());

					$this->pushMessage(GetMessage("CIEE_SAVED_MESSAGE"));
					if ($request->getPost('save'))
					{
						LocalRedirect($this->getBackUrl() ?: $this->getListUrl());
					}
					elseif (!empty($_REQUEST['preview']))
					{
						$previewUrl = $this->fixElementForPreview($this->getId(), $_POST['_WF_PARENT_ELEMENT_ID'], $fieldValues['NAME']);
						LocalRedirect($previewUrl);
					}
					else
					{
						LocalRedirect($this->getEditUrl($this->getId()));
					}
				}
				else
				{
					$this->pushError($arErrors);
					$this->varsFromForm = \Citrus\ArealtyPro\Manage\ComponentUtils::htmlspecialchars($_POST, array('PREVIEW_TEXT', 'DETAIL_TEXT'));
				}
			}
		}
		elseif ($request->isPost() && $request->getPost('cancel'))
		{
			LocalRedirect($this->getBackUrl());
		}
		elseif ($request->isPost() && $request->getPost('cancel_draft') && $this->arResult['IS_DRAFT'] == 'Y')
		{
			\CIBlockElement::Delete($this->getId());
			LocalRedirect($this->getEditUrl($this->arResult['WF_PARENT_ELEMENT_ID']));
		}

		return $updateValues;
	}

	/**
	 * Заменяет значения списочных свойств в их ID для сохранения
	 *
	 * Проверяет и (опционально) дополняет набор значений списка
	 *
	 * @param array $propertyValues Ассоциативный массив значений свойств: ['prop_code' => 'value', 'prop2_code' => 'value', ...]
	 * @param bool $createNewValues Создавать новые варианты списка из переданных значений свойства
	 * @deprecated
	 */
	protected function processListValues(&$propertyValues, $createNewValues = false)
	{
		$iblockId = $this->getIblockId();

		if (!isset($this->listProperties))
		{
			$properyIterator = \CIBlockProperty::GetList(array(), array('IBLOCK_ID' => $iblockId, 'PROPERTY_TYPE' => 'L'));
			while ($property = $properyIterator->Fetch())
			{
				$property['ENUM'] = array();
				$enumIterator = \CIBlockPropertyEnum::GetList(array('SORT' => 'ASC'), array('PROPERTY_ID' => $property['ID']));
				while ($enum = $enumIterator->Fetch())
				{
					$property['ENUM'][$enum['ID']] = $enum['VALUE'];
				}
				$this->listProperties[$property['CODE']] = $property;
			}
		}

		$checkValueExists = function (&$value, &$property) use ($createNewValues) {
			$enumId = array_search($value, $property['ENUM']);
			if (!$enumId && $createNewValues)
			{
				$enumId = \CIBlockPropertyEnum::Add(array(
					'PROPERTY_ID' => $property['ID'],
					'VALUE' => (string)$value,
				));
				if ($enumId)
				{
					$property['ENUM'][$enumId] = (string)$value;
				}
				else
				{
					throw new \RuntimeException(Loc::getMessage("CITRUS_AREALTYPRO_FORM_IBLOCK_LIST_ERROR"));
				}
			}
			$value = $enumId ? $enumId : $value;
		};

		foreach ($this->listProperties as $propertyCode => &$property)
		{
			if (array_key_exists($propertyCode, $propertyValues))
			{
				if (is_array($propertyValues[$propertyCode]))
				{
					/** @noinspection ForeachSourceInspection */
					foreach ($propertyValues[$propertyCode] as &$v) {
						$checkValueExists($v, $property);
					}
				}
				elseif (is_scalar($propertyValues[$propertyCode]))
				{
					$checkValueExists($propertyValues[$propertyCode], $property);
				}
			}
		}
		if (isset($property))
		{
			unset($property);
		}
	}

	/**
	 * @param string $code
	 * @param \Citrus\ArealtyPro\Meta\Field\IblockField $field
	 * @param mixed $value
	 * @return array
	 */
	public function getFieldDescription($code, \Citrus\ArealtyPro\Meta\Field\IblockField $field, $value)
	{
		if ($this->areVarsFromForm())
		{
			$value = $this->varsFromForm[$code == 'IBLOCK_SECTION_ID' ? 'IBLOCK_SECTION' : $code];
		}

		$result = array(
			'id' => $code,
			'name' => $field->getTitle(),
			'required' => $field->isRequired(),
			'type' => $field->getType(),
			'value' => $value,
		);

		if (!$field->isEditable())
		{
			$result['type'] = 'custom';
			$result['value'] = $field->getDisplayValue($value);
			//return $result;
		}

		switch ($field->getCode())
		{
			case 'PREVIEW_TEXT':
			case 'DETAIL_TEXT':
				// @todo support preview_text type switching
				// @todo use CFileMan::AddHTMLEditorFrame()
				if ($this->arParams['USE_HTML_EDITOR'] != 'N' && CModule::IncludeModule("fileman"))
				{
					ob_start();
					$LHE = new CLightHTMLEditor();
					$LHE->Show(array(
						'id' => preg_replace("/[^a-z0-9]/i", '', $code),
						'width' => '100%',
						'height' => '200px',
						'inputName' => $code,
						'content' => $value,
						'bUseFileDialogs' => false,
						'bFloatingToolbar' => false,
						'bArisingToolbar' => false,
						'toolbarConfig' => array(
							'Bold', 'Italic', 'Underline', 'RemoveFormat',
							'CreateLink', 'DeleteLink', 'Image',// 'Video',
							//'BackColor', 'ForeColor',
							'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull',
							'InsertOrderedList', 'InsertUnorderedList', 'Outdent', 'Indent',
							'StyleList', 'HeaderList',
							//'FontList', 'FontSizeList',
						),
					));
					$html = ob_get_contents();
					ob_end_clean();
					return array(
						'id' => $code,
						'name' => $field->getTitle(),
						'required' =>$field->isRequired(),
						'type' => 'custom',
						'value' => $html,
					);
				}
				else
				{
					return array(
						'id' => $code,
						'name' => $field->getTitle(),
						'required' =>$field->isRequired(),
						'type' => 'textarea',
						'value' => $value,
						'params' => array(
							'cols' => 50,
							'rows' => 10,
						),
					);
				}
				break;

			case 'IBLOCK_SECTION_ID':
				return array(
					'id' => 'IBLOCK_SECTION[]',
					'name' => $field->getTitle(),
					'required' => $field->isRequired(),
					'type' => 'list',
					'value' => $value,
					'items' => $field->getEnumValues(),
					'params' => array(
						'class' => 'js-citrus-arealty-kabinet-select-section',
						'multiple' => 'multiple',
						'data-placeholder' => ' ',
						'data-notchosen' => '1',
						'size' => 8,
					)
				);

			default:
				if ($field->getType() == FieldType::FILE)
				{
					return array(
						'id' => $code,
						'name' => $field->getTitle(),
						'required' => $field->isRequired(),
						'type' => 'custom',
						'value' => $this->showImageUpload($code, $value, $field),
					);
				}
				elseif ($field->getType() == FieldType::ENUM)
				{
					$arListItems = $field->getEnumValues();
					return array(
						'id' => $code,
						'name' => $field->getTitle(),
						'required' => $field->isRequired(),
						'type' => 'list',
						'value' => $value,
						'items' => $arListItems,
						'class' => 'field',
					);
				}
				else
				{
					return array(
						'id' => $code,
						'name' => $field->getTitle(),
						'required' => $field->isRequired(),
						'type' => $field->getType(),
						'value' => $value,
						'class' => $field->getType() == FieldType::FILE ? '' : 'field',
					);
				}
		}
	}

	private function hasStringKeys(array $array)
	{
		return count(array_filter(array_keys($array), 'is_string')) > 0;
	}

	/**
	 * @param string $code
	 * @param IblockProperty $field
	 * @param mixed $value
	 * @return array
	 */
	protected function getPropertyDescription($code, \Citrus\ArealtyPro\Meta\Field\IblockProperty $field, $value, $description = null)
	{
		$propertyFields = $field->getPropertyFields();
		$userType = !empty($propertyFields["USER_TYPE"]) ? "USER_TYPE" : $propertyFields['PROPERTY_TYPE'];
		if ($this->areVarsFromForm())
		{
			$applyPrefixValue = ($userType != 'F');
			$value = $this->varsFromForm[$code . ($applyPrefixValue ? '__VALUE' : '')];
		}

		if (!$field->isEditable())
		{
			return array(
				'id' => $code,
				'name' => $field->getTitle(),
				'required' => $field->isRequired(),
				'type' => 'custom',
				'value' => $value,
			);
		}

		switch ($userType)
		{
			case 'USER_TYPE':
				$UT = CIBlockProperty::GetUserType($propertyFields["USER_TYPE"]);
				$func = $this->getUserTypeFunc($UT, $field->isMultiple());

				$value = is_array($value) && !$this->hasStringKeys($value) ? $value : array($value);

				if ($func)
				{
					$html = '';
					// для свойства типа HTML/текст экранировать значения не нужно
					if ($UT['USER_TYPE'] == 'HTML')
					{
						$value = \Citrus\ArealtyPro\Manage\ComponentUtils::htmlspecialchars_back($value);
					}
					$fn = function ($code, $value) use ($propertyFields, $UT, $func) {
						$utParams = array(
							$propertyFields,
							array(
								"VALUE" => is_array($value) && isset($value['VALUE']) ? $value['VALUE'] : $value,
								"DESCRIPTION" => is_array($value) && isset($value['DESCRIPTION'])  ? $value['DESCRIPTION'] : '',
							),
							array(
								"VALUE" => $code . "__VALUE",
								"DESCRIPTION" => $code . "__DESCRIPTION",
								"FORM_NAME"=>"iblock_add",
							),
						);
						return'<div class="uf-' . htmlspecialcharsbx(strtolower($propertyFields["USER_TYPE"])) . '" style="margin-bottom: .5em">'
							. call_user_func_array($UT[$func], $utParams)
							. '</div>';

					};

					if ($field->isMultiple() && $func == 'GetPublicEditHTMLMulty')
					{
						$html .= $fn($code, $value);
					}
					elseif ($field->isMultiple())
					{
						// @todo Отфильтровать пустые значения из $value, иначе их количество пустых полей растет с каждой неудачной отправкой формы
						for ($i = 0; $i < count($value) + $propertyFields["MULTIPLE_CNT"]; $i++)
						{
							$html .= $fn($code . "[$i]", $value[$i]);
						}
					}
					else
					{
						$html .= $fn($code, reset($value));
					}
					return array(
						'id' => $code,
						'name' => $field->getTitle(),
						'required' => $field->isRequired(),
						'type' => 'custom',
						'value' => $html,
						'class' => 'field',
						'user_type' => $propertyFields["USER_TYPE"],
					);
				}
				break;

			case 'N':
			case 'S':
				if ($propertyFields["ROW_COUNT"] > 1)
				{
					$type = "textarea";
				}
				elseif ($userType == "N")
				{
					$type = "number";
				}
				else //if($userType == "S")
				{
					$type = "text";
				}

				$renderField = function ($idx, $value) use (&$propertyFields, &$html, &$type, &$code) {

					$attributes = array(
						'size' => $propertyFields["COL_COUNT"],
						'cols' => $propertyFields["COL_COUNT"],
						'rows' => $propertyFields["ROW_COUNT"],
					);
					$attributes = array_reduce(array_keys($attributes), function ($result, $attrName) use ($attributes) {
						if ($attributes[$attrName])
						{
							$result[] = $attrName . '="' . $attributes[$attrName];
						}
					});

					$html .= '<div style="margin-bottom: .5em">';
					if ($propertyFields["WITH_DESCRIPTION"] == "Y")
					{
						$desc = $propertyFields['DESCRIPTION'][$idx];
						$name = "{$code}__DESCRIPTION[{$idx}]";
						$html .= "<input type=\"text\" value=\"{$desc}\" name=\"{$name}\" />: ";
					}

					$name = "{$code}__VALUE[{$idx}]";
					if ($type == 'textarea')
					{
						$html .= "<textarea name=\"$name\"$attributes>" . htmlspecialcharsbx($value) . "</textarea>";
					}
					else
					{
						$html .= "<input name=\"$name\" type=\"text\" value=\"{$value}\"$attributes/><br />";
					}

					$html .= '</div>';
				};

				if ($propertyFields["MULTIPLE"] == "Y")
				{
					$html = '';
					$value = is_array($value) ? $value : array();

					// existing values
					foreach ($value as $idx => $idxValue)
					{
						$renderField($idx, $idxValue);
					}
					// new values
					for ($i = 0; $i < $propertyFields["MULTIPLE_CNT"]; $i++)
					{
						$idx = $i + count($value);
						$renderField($idx, '');
					}
					return array(
						'id' => $code,
						'name' => $field->getTitle(),
						'required' => $field->isRequired(),
						'type' => 'custom',
						'value' => $html,
						'class' => 'field',
					);
				}
				else
				{
					return array(
						'id' => $code . '__VALUE',
						'name' => $field->getTitle(),
						'required' => $field->isRequired(),
						'type' => $type,
						'value' => $value,
						'params' => array(
							'size' => $propertyFields["COL_COUNT"],
							'cols' => $propertyFields["COL_COUNT"],
							'rows' => $propertyFields["ROW_COUNT"],
						),
						'class' => 'field',
					);
				}
				break;

			case 'F':
				return array(
					'id' => $code,
					'name' => $field->getTitle(),
					'required' => $field->isRequired(),
					'type' => 'custom',
					'value' => $this->showImageUpload($code, $value, $field),
				);

				// @todo use file uploader component
				$html = '<table class="files-table"><tr><th>' . GetMessage("C_FILE") . '</th><th>' . GetMessage("C_FILE_DELETE") . '</th></tr>';
				if ($propertyFields["MULTIPLE"] == "Y")
				{
					$arFiles = array();
					foreach ($value as $fileID)
					{
						if ((int)$fileID > 0)
						{
							$arFile = CFile::GetFileArray($fileID);
							if (is_array($arFile))
								$arFiles[$fileID] = $arFile;
						}
					}

					foreach ($arFiles as $fileID => $arFile)
					{
						$html .= "<tr><td><a href=\"{$arFile["SRC"]}\">" .htmlspecialcharsbx($arFile["ORIGINAL_NAME"]). "</a> ({$arFile["FILE_SIZE"]} " .GetMessage("C_BYTE"). ')</td>';
						$html .= "<td class=\"center\"><input name=\"{$code}[{$fileID}]\" type=\"checkbox\" value=\"Y\"></td></tr>";
					}
					for ($i=0; $i<2; $i++)
						$html .= "<tr><td><input type=\"file\" name=\"{$code}[]\" /></td><td>&nbsp;</td></tr>";
					$html .= "<tr><td colspan=\"2\" class=\"center\"><button onclick=\"addFileRow(this, '{$code}'); return false;\">" . GetMessage("C_FILES_BUTTON") . '</button></td></tr>';
				}
				else
				{
					if ((int)$value > 0)
					{
						$arFile = CFile::GetFileArray($value);
						if (is_array($arFile))
						{
							$html .= "<tr><td><a href=\"{$arFile["SRC"]}\">" .htmlspecialcharsbx($arFile["ORIGINAL_NAME"]). "</a> ({$arFile["FILE_SIZE"]} " .GetMessage("C_BYTE"). ')</td>';
							$html .= "<td class=\"center\"><input name=\"{$code}\" type=\"checkbox\" value=\"Y\"></td></tr>";
						}
					}
					$html .= "<tr><td><input type=\"file\" name=\"{$code}\" /></td><td>&nbsp;</td></tr>";
				}
				$html .= '</table>';

				return array(
					'id' => $code,
					'name' => $field->getTitle(),
					'required' => $field->isRequired(),
					'type' => 'custom',
					'value' => $html,
				);
				break;

			case 'L':
				$list = $field->getEnumValues();
				if ($propertyFields["LIST_TYPE"] == "C" && count($list) == 1)
				{
					return array(
						'id' => $code . '__VALUE',
						'name' => $field->getTitle(),
						'required' => $field->isRequired(),
						'type' => 'checkbox',
						'value' => $value ? "Y" : '',
						'class' => 'field',
					);
				}
				else
				{
					$arListItems = $field->isMultiple() || $propertyFields["LIST_TYPE"] === 'C' ? $list : array(0 => GetMessage('CITRUS_AREALTY_MANAGE_OBJECTS_NOT_SELECTED')) + $list;

					$value = is_array($value) ? $value : array($value);
					if (!$this->areVarsFromForm())
					{
						$value = array_map(function ($v) use ($arListItems, $value) {
							return array_key_exists($v, $arListItems) ? $v : null;
						}, array_filter($value));
					}

					return array(
						'id' => $code . '__VALUE' . ($field->isMultiple() ? '[]' : ''),
						'name' => $field->getTitle(),
						'required' => $field->isRequired(),
						'type' => 'list',
						'list_type' => $propertyFields["LIST_TYPE"],
						'value' => $value,
						'params' =>
							array(
								'data-placeholder' => $arListItems[0],
							) + ($field->isMultiple() ? array('multiple' => true) : array()),
						'items' => $arListItems,
						'class' => 'field',
					);
				}
				break;
		}
		return null;
	}

	protected function copyFromDraft($apply = false)
	{
		$resElement = \CIBlockElement::GetList([], $this->getFilterValues());
		$draft = [];
		if ($item = $resElement->GetNextElement())
		{
			$draft = $item->GetFields();
			$draftId = $draft['ID'];
			$fieldsForCopy = [
				'IBLOCK_SECTION_ID' => 1,
				'IBLOCK_ID' => 1,
				'NAME' => 1,
				'ACTIVE' => 1,
				'PREVIEW_TEXT' => 1,
				'PREVIEW_TEXT_TYPE' => 1,
				'DETAIL_TEXT' => 1,
				'DETAIL_TEXT_TYPE' => 1,
				'PREVIEW_PICTURE' => 1,
				'DETAIL_PICTURE' => 1,
				'ACTIVE_FROM' => 1,
				'ACTIVE_TO' => 1,
				'SORT' => 1,
				'CREATED_BY' => 1,
				'TAGS' => 1,
			];
			foreach ($draft as $code => $v)
			{
				if (empty($fieldsForCopy[$code]))
				{
					unset($draft[$code]);
				}
				if ($code == 'DETAIL_PICTURE' || $code == 'PREVIEW_PICTURE')
				{
					if (!empty($v))
					{
						$draft[$code] = \CFile::MakeFileArray(\CFile::GetPath($v));
					}
					else
					{
						$draft[$code] = [
							'del' => 'Y',
						];
					}
				}
			}
			$draft['IBLOCK_SECTION_ID'] = [];
			$resItemGroups = \CIBlockElement::GetElementGroups($draftId, true);
			while ($tmpGroup = $resItemGroups->Fetch())
			{
				$draft['IBLOCK_SECTION_ID'][] = $tmpGroup['ID'];
			}
			$draft['IBLOCK_SECTION'] = $draft['IBLOCK_SECTION_ID'];

			$tmp = explode(Loc::getMessage('CITRUS_AREALTYPRO_EDIT_DRAFT_SEP'), $draft['NAME']);
			$draft['NAME'] = trim($tmp[1]);

			$draft['PROPERTY_VALUES'] = [];
			$filePropsForReset = [];
			foreach ($item->GetProperties() as $code => $v)
			{
				if ($code == 'draft_for')
				{
					$destElementId = $v['VALUE'];
					continue;
				}
				if ($v['PROPERTY_TYPE'] == 'F')
				{
					$filePropsForReset[$code] = ['VALUE' => ['del' => 'Y']];
					if (!empty($v['VALUE']))
					{
						foreach ($v['VALUE'] as $i => $fileValue)
						{
							$v['VALUE'][$i] = \CFile::MakeFileArray(\CFile::GetPath($fileValue));
						}
					}
					$draft['PROPERTY_VALUES'][$v['CODE']] = $v['VALUE'];
				}
				else
				{
					$draft['PROPERTY_VALUES'][$v['CODE']] = !empty($v['VALUE_ENUM_ID'])?
						$v['VALUE_ENUM_ID'] : $v['VALUE'];
				}
			}
		}
		if (!empty($draft) && !empty($destElementId))
		{
			\CIBlockElement::SetPropertyValuesEx($destElementId, $draft['IBLOCK_ID'], $filePropsForReset);
			$element = new \CIBlockElement();
			$resUpdate = $element->Update($destElementId, $draft);
			if (!$resUpdate)
			{
				$this->pushError(Loc::getMessage('CITRUS_AREALTYPRO_ERROR_APPLY_FROM_DRAFT', [
					'#ID#' => $destElementId,
					'#ERROR#' => $element->LAST_ERROR
				]));
			}
			else
			{
				\CIBlockElement::Delete($draftId);
			}

			$this->arParams['EDIT_PATH'] = trim($this->arParams['EDIT_PATH']);
			if (strlen($this->arParams['EDIT_PATH']) <= 0)
			{
				$this->arParams['EDIT_PATH'] = '#ID#/';
			}
			if ($this->hasErrors())
			{
				LocalRedirect($this->getEditUrl($draftId));
			}
			else
			{
				if ($apply)
				{
					LocalRedirect($this->getEditUrl($destElementId));
				}
				else
				{
					LocalRedirect($this->getListUrl());
				}
			}
		}
	}


	protected function parentForDraft($id)
	{
		$res = \CIBlockElement::GetList([], [
			'ID' => $id,
			'IBLOCK_ID' => Helper::getIblock('offers'),
		], false, false, ['ID', 'PROPERTY_draft_for']);
		if ($element = $res->GetNext())
		{
			if (!empty($element['PROPERTY_DRAFT_FOR_VALUE']))
			{
				return $element['PROPERTY_DRAFT_FOR_VALUE'];
			}
		}
		return 0;
	}

	protected function getDraft($parentId, $userId = null)
	{
		$result = 0;

		if (!$parentId)
		{
			return $result;
		}
		$filter = [
			'IBLOCK_ID' => Helper::getIblock('offers'),
			'PROPERTY_draft_for' => $parentId,
		];
		if ($userId)
		{
			$filter['CREATED_BY'] = $userId;
		}
		$res = \CIBlockElement::GetList([], $filter, false, false, ['ID']);
		if ($element = $res->GetNext())
		{
			return $element['ID'];
		}

		return $result;
	}

	protected function prologActions()
	{
		global $USER;

		if (!$this->getRights()->hasAccess())
		{
			throw new RuntimeException(Loc::getMessage('ACCESS_DENIED'));
		}

		if ($this->getId() && !$this->getRights()->canDoOperation(RightsProvider::OP_ELEMENT_READ, $this->getId()))
		{
			throw new RuntimeException(Loc::getMessage('ACCESS_DENIED'));
		}

		$iblock = CIBlock::GetArrayByID($this->getIblockId());
		if (!is_array($iblock))
		{
			throw new ErrorException('Iblock not found');
		}

		if (!$this->getId() && !$this->arParams["ALLOW_NEW_ELEMENT"])
		{
			throw new RuntimeException(GetMessage("ACCESS_DENIED"));
		}

		if ($this->arParams['DRAFT_ENABLED'] == 'Y')
		{
			if ($draftId = $this->getDraft($this->getId(), $USER->GetID()))
			{
				LocalRedirect($this->getEditUrl($draftId));
			}
		}

		if (!empty($_REQUEST['publish']) || !empty($_REQUEST['publish_apply']))
		{
			$this->copyFromDraft(!empty($_REQUEST['publish_apply']));
		}

		$this->arResult['IS_DRAFT'] = $this->arParams['IS_DRAFT'];
		$this->arResult['WF_PARENT_ELEMENT_ID'] = $this->arParams['WF_PARENT_ELEMENT_ID'];
	}

	protected function getFilterValues()
	{
		$arFilter = array(
			"ID" => $this->getId() ? $this->getId() : '-1',
			"IBLOCK_ID" => $this->getIblockId(),
			"IBLOCK_LID" => SITE_ID,
		);
		if ($this->arParams["PARENT_SECTION_ID"] > 0)
			$arFilter["SECTION_ID"] = $this->arParams["PARENT_SECTION_ID"];

		$arFilter = array_merge($arFilter, $this->getRights()->getFilter());

		return $arFilter;
	}

	/**
	 * Возвращает список полей для выборки из инфоблока (для CIBlockElement::GetList())
	 *
	 * @param bool $includeProperties Включать свойства (не обязательный, по умолчанию false)
	 * @return array
	 */
	protected function getSelectFields($includeProperties = false)
	{
		$arSelect = array_unique(array_merge(array(
			"ID",
			"IBLOCK_ID",
			'DETAIL_PAGE_URL',
			"NAME",
		), $this->arParams["FIELD_CODE"]));

		if (!$includeProperties)
		{
			foreach ($arSelect as $idx => $code)
			{
				if (stripos($code, 'PROPERTY_') === 0)
				{
					unset($arSelect[$idx]);
				}
			}
		}

		return $arSelect;
	}

	protected function initDateActive(&$arItem)
	{
		$str_ACTIVE_FROM = '';
		$str_ACTIVE_TO = '';
		$arIBlock = \CIBlock::GetArrayByID($this->getIblockId());

		// copied from /bitrix/modules/iblock/admin/iblock_element_edit.php:1466
		$currentTime = time() + CTimeZone::GetOffset();
		if ($arIBlock["FIELDS"]["ACTIVE_FROM"]["DEFAULT_VALUE"] === "=now")
			$str_ACTIVE_FROM = ConvertTimeStamp($currentTime, "FULL");
		elseif ($arIBlock["FIELDS"]["ACTIVE_FROM"]["DEFAULT_VALUE"] === "=today")
			$str_ACTIVE_FROM = ConvertTimeStamp($currentTime, "SHORT");

		$dayOffset = (int)$arIBlock["FIELDS"]["ACTIVE_TO"]["DEFAULT_VALUE"];
		if ($dayOffset > 0)
			$str_ACTIVE_TO = ConvertTimeStamp($currentTime + $dayOffset*86400, "FULL");

		if ($str_ACTIVE_FROM != '')
		{
			$arItem['DATE_ACTIVE_FROM'] = $str_ACTIVE_FROM;
		}
		if ($str_ACTIVE_TO != '')
		{
			$arItem['DATE_ACTIVE_TO'] = $str_ACTIVE_TO;
		}
	}

	protected function prepareFormFields(array $fields, array $arItem = null)
	{
		$fieldsDescriptions = array();
		if (!isset($arItem))
		{
			$arItem = $this->arResult["ITEM"];
		}
		foreach ($fields as $code => $field)
		{
			if (in_array($code, $this->arParams["FIELD_CODE"]))
			{
				if ($field instanceof \Citrus\ArealtyPro\Meta\Field\IblockField)
				{
					$tmpFieldDescription = $this->getFieldDescription(
						$code,
						$field,
						$arItem[$code]
					);
					$tmpFieldDescription['class'] = $tmpFieldDescription['class'] . ' field-' . $field->getCode();
				}
				elseif ($field instanceof IblockProperty)
				{
					$propertyFields = $field->getPropertyFields();
					$valueKey = $propertyFields['PROPERTY_TYPE'] == 'L' ? 'VALUE_ENUM_ID' : 'VALUE';
					$tmpFieldDescription = $this->getPropertyDescription(
						$code,
						$field,
						$arItem['PROPERTIES'][$field->getCode()][$valueKey],
						$arItem['PROPERTIES'][$field->getCode()]['DESCRIPTION']
					);
					$tmpFieldProps = $field->getPropertyFields();
					$tmpFieldDescription["params"]["data-property-id"] = $tmpFieldProps["ID"];
					$tmpFieldDescription["params"]["data-realty-form-input"] = 1;
					$tmpFieldDescription['class'] = $tmpFieldDescription['class'] . ' property-' . $field->getCode();
				}
				$fieldsDescriptions[$field->getCode()] = $tmpFieldDescription;
			}
		}

		return array_filter($fieldsDescriptions, function ($v) {
			return null !== $v;
		});
	}

	public function executeComponent()
	{
		global $APPLICATION;

		try
		{
			$fields = $this->getMeta()->getFields();

			$this->prologActions();
			$this->editActions();

			if ($this->getId())
			{
				/**
				 * Чтобы избежать ошибок MySQL на большом количестве свойств (на инфоблоках 1.0)
				 * в список полей для выборки НЕ включаются свойства (#30406)
				 *
				 * Значения свойств получаются выбираются отдельным запросом при $obElement->GetProperties()
				 */
				$rsElement = CIBlockElement::GetList(array(), $this->getFilterValues(), false, false, $this->getSelectFields());
				$arItem = false;
				if ($obElement = $rsElement->GetNextElement())
				{
					$arItem = $obElement->GetFields();
					$arItem["PROPERTIES"] = $obElement->GetProperties();
					$arItem['IBLOCK_SECTION_ID'] = array();
					$resItemGroups = \CIBlockElement::GetElementGroups($arItem['ID'], true);
					while ($tmpGroup = $resItemGroups->Fetch())
					{
						$arItem['IBLOCK_SECTION_ID'][] = $tmpGroup["ID"];
					}
					$arItem['IBLOCK_SECTION'] = $arItem['IBLOCK_SECTION_ID'];

					if ($this->arResult['IS_DRAFT'] == 'Y')
					{
						$tmp = explode(Loc::getMessage('CITRUS_AREALTYPRO_EDIT_DRAFT_SEP'), $arItem['NAME']);
						if (count($tmp) > 1)
						{
							$arItem['NAME'] = trim($tmp[1]);
						}
					}
				}
			}
			else
			{
				$textType = $this->arParams['USE_HTML_EDITOR'] == 'N' ? 'text' : 'html';
				// @todo get default values from iblock settings
				$arItem = array(
					"ACTIVE" => "Y",
					"PREVIEW_TEXT_TYPE" => $textType,
					"DETAIL_TEXT_TYPE" => $textType,
					"DATE_ACTIVE_FROM" => ConvertTimeStamp(),
					'PROPERTIES' => array(),
				);
				$this->initDateActive($arItem);
				foreach ($fields as $field)
				{
					if ($field instanceof IblockProperty)
					{
						$f = $field->getPropertyFields();
						if ($f['DEFAULT_VALUE'])
						{
							$arItem['PROPERTIES'][$field->getCode()]['VALUE'] = $f['DEFAULT_VALUE'];
						}
					}
				}
			}

			/**
			 * $APPLICATION->AddHeadString() не использовать: для компонентов в режиме ajax работать не будет (#47389)
			 */
			echo "<script>
				var CitrusRealtyManageObjectsForm_IBLOCK_ID = " . $this->getIblockId() . ";
			</script>";

			/** @deprecated  */
			$this->arResult["FORM_FIELDS"] = $this->prepareFormFields($fields, $arItem);

			if (is_array($arItem))
			{
				$this->arResult["ITEM"] = $arItem;
			}
			else
			{
				throw new RuntimeException(GetMessage("CIEE_ELEMENT_NOT_FOUND"));
			}

			$this->arResult["TOOLBAR_BUTTONS"] = array();
			$this->arResult["BACK_BUTTON"] = [
				"TEXT" => GetMessage("CIEE_TB_BACK"),
				"TITLE" => GetMessage("CIEE_TB_BACK_TITLE"),
				"LINK" => $this->getListUrl(),
			];
			if ($this->arResult['USER_CAN_ADD_ELEMENT'])
			{
				$this->arResult["TOOLBAR_BUTTONS"][] = array("TEXT" => $this->getIblockField("ELEMENT_ADD"), "ICON" => 'btn-new', "LINK" => $this->getEditUrl());
			}

			if ($this->getId())
			{
				if (isset($arItem['DETAIL_PAGE_URL']) && strlen($arItem['DETAIL_PAGE_URL']))
				{
					$btnView = array("TEXT" => GetMessage("CITRUS_AREALTY_MANAGE_VIEW_OBJECT"), "ICON" => 'btn-view', "TITLE" => GetMessage("CITRUS_AREALTY_MANAGE_VIEW_OBJECT_TITLE"), "LINK" => $arItem['DETAIL_PAGE_URL'], "LINK_PARAM" => 'target="_blank"', "RIGHT" => true);
					if ($this->arParams['DRAFT_ENABLED'] == 'Y')
					{
						$btnView['LINK'] = 'javascript:void(0);';
						$btnView['LINK_PARAM'] = 'onclick="BX(\'js_citrus_draft_preview\').click();"';
						$btnView['TEXT'] = GetMessage('CITRUS_AREALTY_MANAGE_VIEW_OBJECT_DRAFT');
					}
					$this->arResult["TOOLBAR_BUTTONS"][] = $btnView;
				}

				$delLink = $APPLICATION->GetCurPageParam('action=delete&' . bitrix_sessid_get(), array('action'));
				$elementDeleteText = CIBlock::GetArrayByID($this->iblockId, 'ELEMENT_DELETE');
				$deleteConfirmMessage = Loc::getMessage("CITRUS_AREALTYPRO_DELETE_CONFIRM", ['#ELEMENT_DELETE#' => ToLower($elementDeleteText)]);
				$delLink = "onclick=\"if (confirm('" . $deleteConfirmMessage . "')) jsUtils.Redirect({}, '$delLink'); return false;\"";
				$this->arResult["TOOLBAR_BUTTONS"][] = array("TEXT" => GetMessage("CIEE_DELETE"), "ICON" => 'btn-delete', "TITLE" => $elementDeleteText, "LINK_PARAM" => $delLink, "RIGHT" => true);
			}

			$this->arResult["TOOLBAR_BUTTONS"][] = array(
				"TEXT" => Loc::getMessage("CITRUS_AREALTYPRO_LOGOUT_BUTTON"),
				"ICON" => 'fa fa-sign-out',
				"TITLE" => Loc::getMessage("CITRUS_AREALTYPRO_LOGOUT_BUTTON_TITLE"),
				"LINK" => $APPLICATION->GetCurPageParam('logout=yes', array('logout')),
				"RIGHT" => true,
				"ADDITIONAL_CLASS" => 'mobile-hide-text'
			);

			if ($this->getId())
			{
				if ($this->arResult['IS_DRAFT'] == 'Y')
				{
					$title = GetMessage('C_EDIT_DRAFT_TITLE', ['#ID#' => $this->arResult['WF_PARENT_ELEMENT_ID']]);
				}
				else
				{
					$title = CIBlock::GetArrayByID($this->iblockId, 'ELEMENT_EDIT') . ' #' . $this->getId();
				}
			}
			else
			{
				$title = CIBlock::GetArrayByID($this->iblockId, 'ELEMENT_ADD');
			}

			if ($this->arParams["SET_TITLE"] == "Y")
			{
				$APPLICATION->SetTitle($title);
			}

			foreach ($this->arParams["CHAIN_ITEMS"] as $key => $url)
			{
				$APPLICATION->AddChainItem($key, $url);
			}

			if ($this->arParams["ADD_ITEM_CHAIN"] == "Y")
			{
				$APPLICATION->AddChainItem($title, $this->getEditUrl($this->getId()));
			}

			$this->arResult['STANDARD_BUTTONS'] = true;
			if ($this->getId() && !$this->getRights()->canDoOperation(RightsProvider::OP_ELEMENT_EDIT, $this->getId()))
			{
				$this->arResult['STANDARD_BUTTONS'] = false;
				$backurl = htmlspecialcharsbx(CUtil::addslashes($_REQUEST["backurl"]));
				if ($backurl)
				{
					$cancelBtnText = htmlspecialcharsbx(Loc::getMessage("CITRUS_AREALTY_MANAGE_OBJECTS_CANCEL_BUTTON"));
					$cancelBtnTitle = htmlspecialcharsbx(Loc::getMessage('CITRUS_AREALTY_MANAGE_OBJECTS_CANCEL_BUTTON_TITLE'));

					$this->arResult['BUTTONS_HTML'] = <<<HTML
	<input class="btn btn-secondary" type="button" value="{$cancelBtnText}" name="cancel" onclick="window.location='{$backurl}'" title="{$cancelBtnTitle}" />
HTML;
				}

			}

			$event = new Main\Event(
				'citrus.arealtypro',
				static::ON_BEFORE_SHOW,
				array(
					'component' => $this,
				)
			);
			$event->send($this);

			if (is_array($this->arResult["ITEM"]))
			{
				$this->includeComponentTemplate();
			}
		}
		catch (RuntimeException $e)
		{
			ShowError($e->getMessage());
		}
	}

	/**
	 * @return boolean
	 */
	public function areVarsFromForm()
	{
		return count($this->varsFromForm) > 0;
	}

	protected function saveDataModifier(array &$updateValues)
	{
		$fieldsSetting = $this->getIblockField('FIELDS');
		// generate SEF code
		if (isset($updateValues['NAME']) && is_array($fieldsSetting['CODE']))
		{
			/** @var \Citrus\ArealtyPro\Meta\Field\IblockField $codeField */
			$codeField = $this->getMeta()->getField('CODE');
			$codeFieldSettings = $codeField->getDefaultValue();
			if ($codeFieldSettings['TRANSLITERATION'] == 'Y')
			{
				$updateValues['CODE'] = CUtil::translit($updateValues['NAME'], LANGUAGE_ID, array(
					"max_len" => $codeFieldSettings['TRANS_LEN'],
					"change_case" => $codeFieldSettings['TRANS_CASE'],
					"replace_space" => $codeFieldSettings['TRANS_SPACE'],
					"replace_other" => $codeFieldSettings['TRANS_OTHER'],
					"delete_repeat_replace" => $codeFieldSettings['TRANS_EAT'] == 'Y',
					"safe_chars" => '',
				));
			}
		}
	}

	/**
	 * @param string $code
	 * @param string|array $value
	 * @param IblockBase $field
	 * @return string
	 * @internal param bool $isMultiple
	 */
	protected function showImageUpload($code, $value, IblockBase $field)
	{
		$isMultiple = $field instanceof IblockProperty && $field->isMultiple();
		$propertyFields = $field instanceof IblockProperty ? $field->getPropertyFields() : array();

		if (class_exists('\Bitrix\Main\UI\FileInput', true))
		{
			if ($isMultiple)
			{
				$value = is_array($value) ? $value : array($value);
				$inputValue = array();
				foreach ($value as $key => $val)
				{
					if (is_array($val))
					{
						$inputValue[$code . "[" . $key . "]"] = $val["VALUE"] ?: $val;
					}
					else
					{
						$inputValue[$code . "[" . $key . "]"] = $val;
					}
				}
				$inputValue = array_diff($inputValue, array(""));
			}
			else
			{
				$inputValue = $value;
			}
			return Main\UI\FileInput::createInstance(array(
				"name" => $code . ($isMultiple ? '[n#IND#]' : ''),
				"description" => $propertyFields['WITH_DESCRIPTION'] == 'Y',
				"upload" => true,
				"allowUpload" => "F",
				"allowUploadExt" => $propertyFields["FILE_TYPE"],
				"medialib" => false,
				"fileDialog" => true,
				"cloud" => false,
				"delete" => true,
				"maxCount" => $isMultiple ? $this->arParams['MAX_FILE_COUNT'] : 1
			))->show($inputValue, $this->areVarsFromForm());
		}
		// @todo Нет css для старого варианта файловых инпутов
		elseif (Main\Loader::includeModule('fileman'))
		{
			$info = array(
				"IMAGE" => "Y",
				"PATH" => "N",
				"FILE_SIZE" => "Y",
				"DIMENSIONS" => "Y",
				"IMAGE_POPUP" => "Y",
				"MAX_SIZE" => array(
					"W" => COption::GetOptionString("iblock", "detail_image_size"),
					"H" => COption::GetOptionString("iblock", "detail_image_size"),
				),
			);
			$params = array(
				'upload' => true,
				'medialib' => false,
				'file_dialog' => true,
				'cloud' => false,
				'del' => true,
				'description' => true,
			);
			if ($isMultiple)
			{
				return CFileInput::ShowMultiple($value, $code . ($isMultiple ? '[n#IND#]' : ''), $info, 6, $params);
			}
			else
			{
				return CFileInput::Show($code, $value, $info, $params);
			}
		}
		return '';
	}
}