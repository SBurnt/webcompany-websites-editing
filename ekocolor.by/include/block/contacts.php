<section class="contacts<?=$lastBlock=='Y' ? ' last': ''?>" id="contacts">
	<div class="container">
		<h2 class="subtitle"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_contacts/h2_title.php", Array(), Array("MODE" => "html")); ?></h2>
		<div class="items" itemscope itemtype="http://schema.org/Organization">
                    <meta itemprop="name" content="<?=\Nextype\Premium\CLanding::$options['SITE_NAME']?>">
			<div class="item">
				<div class="name">Телефон</div>
				<div class="content">
					<div class="icon icon-phone"></div>
					<div>
						<div class="text" itemprop="telephone"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_contacts/phone_1.php", Array(), Array("MODE" => "html")); ?></div>				
						<div class="text" itemprop="telephone"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_contacts/phone_2.php", Array(), Array("MODE" => "html")); ?></div>
					</div>
				</div>
			</div>
			<div class="item">				
				<div class="name">Почта</div>
				<div class="content">
					<div class="icon icon-mail"></div>
					<div>
						<div class="text" itemprop="email"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_contacts/email.php", Array(), Array("MODE" => "html")); ?></div>
					</div>
				</div>
			</div>
			<div class="item">				
				<div class="name">Время работы</div>
				<div class="content">
					<div class="icon icon-time"></div>
					<div>
						<div class="text">
                                                    <? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_contacts/work_time.php", Array(), Array("MODE" => "html")); ?>
                                                    
                                                </div>
					</div>
				</div>
			</div>
			<div class="item" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">				
				<div class="name">Адрес</div>
				<div class="content">
					<div class="icon icon-placeholder"></div>
					<div>
						<div class="text">
                                                    <span itemprop="addressLocality">
                                                    <? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_contacts/city.php", Array(), Array("MODE" => "html")); ?>
                                                    </span>
                                                    <span itemprop="streetAddress">
                                                        <? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_contacts/address.php", Array(), Array("MODE" => "html")); ?>
                                                    </span>
                                                </div>
					</div>
				</div>
			</div>
		</div>
		<div class="map">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	".default", 
	array(
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:3:{s:10:\"yandex_lat\";d:55.75999999999371;s:10:\"yandex_lon\";d:37.63999999999997;s:12:\"yandex_scale\";i:10;}",
		"MAP_WIDTH" => "100%",
		"MAP_HEIGHT" => "350",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "SMALLZOOM",
			2 => "MINIMAP",
			3 => "TYPECONTROL",
			4 => "SCALELINE",
		),
		"OPTIONS" => array(
			0 => "ENABLE_DRAGGING",
		),
		"MAP_ID" => "yam_1",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
                    
                </div>
	</div>
</section>