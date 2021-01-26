<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true ); ?>
<?if($arResult["ITEMS"]):?>
<div class="maxwidth-theme">
	<div class="col-md-12 ">
		<div class="advantages">
			<div class="advantages__wrap">
				<div class="advantages__col col1">
					<h3 class="advantages__title">Преимущества работы с нами</h3>
					<div class="advantages__item">
						<img class="advantages__img" src="/bitrix/templates/aspro-allcorp2/images/svg/advant/ico-com.svg" alt="команда">
						<div class="advantages__item-text">
							<span class="advantages__item-title">Команда</span>
							<span class="advantages__item-desc">Квалифицированные, сильные специалисты, нацеленные на решение ваших задач</span>
						</div>
					</div>
					<div class="advantages__item">
						<img class="advantages__img" src="/bitrix/templates/aspro-allcorp2/images/svg/advant/ico-price.svg" alt="цена">
						<div class="advantages__item-text">
							<span class="advantages__item-title">Цена</span>
							<span class="advantages__item-desc">Адекватная и гибкая система оплаты</span>
						</div>
					</div>
				</div>
				<div class="advantages__col col2">
					<div class="advantages__item">
						<img class="advantages__img" src="/bitrix/templates/aspro-allcorp2/images/svg/advant/ico-warranty.svg" alt="Гарантия">
						<div class="advantages__item-text">
							<span class="advantages__item-title">Гарантия</span>
							<span class="advantages__item-desc">Гарантия и ответственность за то, что мы делаем</span>
						</div>
					</div>
					<div class="advantages__item">
						<img class="advantages__img" src="/bitrix/templates/aspro-allcorp2/images/svg/advant/ico-experience.svg" alt="Опыт">
						<div class="advantages__item-text">
							<span class="advantages__item-title">Опыт</span>
							<span class="advantages__item-desc">Более 20 лет опыта</span>
						</div>
					</div>
					<div class="advantages__item">
						<img class="advantages__img" src="/bitrix/templates/aspro-allcorp2/images/svg/advant/ico-dev.svg" alt="Развитие и обучение">
						<div class="advantages__item-text">
							<span class="advantages__item-title">Развитие и обучение</span>
							<span class="advantages__item-desc">Постоянное развитие и повышение квалификации сотрудников</span>
						</div>
					</div>
					<div class="advantages__item">
						<img class="advantages__img" src="/bitrix/templates/aspro-allcorp2/images/svg/advant/ico-time.svg" alt="Время">
						<div class="advantages__item-text">
							<span class="advantages__item-title">Время</span>
							<span class="advantages__item-desc">Мы ценим свое время и время наших клиентов</span>
						</div>
					</div>
					<div class="advantages__item">
						<img class="advantages__img" src="/bitrix/templates/aspro-allcorp2/images/svg/advant/ico-partn.svg" alt="Партнеры">
						<div class="advantages__item-text">
							<span class="advantages__item-title">Партнеры</span>
							<span class="advantages__item-desc">Официальный диллер и сервисный центр многих заводов - производителей по Мангистауской области</span>
						</div>
					</div>
					<div class="advantages__item">
						<img class="advantages__img" src="/bitrix/templates/aspro-allcorp2/images/svg/advant/ico-equipment.svg" alt="Оснащенность">
						<div class="advantages__item-text">
							<span class="advantages__item-title">Оснащенность</span>
							<span class="advantages__item-desc">Собственное производство, полный пакет разрешительной документации</span>
						</div>
					</div>
				</div>
			</div>

			<div class="advantages__btn">
				<span class="callback-block animate-load" data-event="jqm" data-param-id="<?= CAllcorp2::getFormID("monk_konsul"); ?>" data-name="callback">
					получить бесплатную консультацию
				</span>
			</div>
		</div>
		<!-- <div class="tizers_block2 item-views blocks advantages">
			<div class="title_block">
				<h3>Преимущества работы с нами</h3>
			</div>
			<div class="items row flexbox advantages__wrap">
				<?
					$qntyItems = count($arResult['ITEMS']);
					$colmd = ($qntyItems > 3 ? 3 : ($qntyItems > 2 ? 4 : 6));
					$colsm = ($qntyItems > 1 ? 6 : 12);
					if(isset($arParams['ONE_ROW'] ) && $arParams['ONE_ROW'] == 'Y')
					{
						$colmd = $colsm = 12;
					}
					?>
				<?foreach($arResult["ITEMS"] as $arItem){
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						$name = $arItem['NAME'];
						?>
				<div class="col-md-6 col-sm-12">
					<div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="item">
						<?if($arItem["PREVIEW_PICTURE"]["SRC"]){?>
						<div class="img">
							<?if($arItem["PROPERTIES"]["LINK"]["VALUE"]):?>
							<a class="name" href="<?= $arItem["PROPERTIES"]["LINK"]["VALUE"] ?>">
								<?endif;?>
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $name; ?>" title="<?= $name; ?>" />
								<?if($arItem["PROPERTIES"]["LINK"]["VALUE"]):?>
							</a>
							<?endif;?>
						</div>
						<?}?>
						<div class="title">
							<?if($arItem["PROPERTIES"]["LINK"]["VALUE"]):?>
							<a class="name dark-color" href="<?= $arItem["PROPERTIES"]["LINK"]["VALUE"] ?>">
								<?endif;?>
								<span class="top-text"><?= $name; ?></span>
								<?if($arItem["PREVIEW_TEXT"]):?>
								<span class="desc-text"><?= $arItem["PREVIEW_TEXT"]; ?></span>
								<?endif;?>
								<?if($arItem["PROPERTIES"]["LINK"]["VALUE"]):?>
							</a>
							<?endif;?>
						</div>
					</div>
				</div>
				<?}?>

			</div>

			<div class="inner-table-block advantages__btn">
				<span class="callback-block animate-load colored  btn-transparent-bg btn-default btn" data-event="jqm" data-param-id="<?= CAllcorp2::getFormID("monk_konsul"); ?>" data-name="callback">
					получить бесплатную консультацию
				</span>
			</div>
		</div> -->
	</div>
</div>
<?endif;?>