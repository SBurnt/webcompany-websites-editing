<section class="company<?=$lastBlock=='Y' ? ' last': ''?>" id="company">
	<div class="container">
		<div class="content">
			<div class="image"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/image.php", Array(), Array("MODE" => "html")); ?></div>
			<div class="text">
				<h2 class="subtitle"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/h2_title.php", Array(), Array("MODE" => "html")); ?></h2>
				<div class="description">
					<? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/description.php", Array(), Array("MODE" => "html")); ?>
				</div>
				<div class="counters" id="company-counts">
					<div class="item">
						<div class="number spincrement"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/counter_1.php", Array(), Array("MODE" => "html")); ?></div>
						<div class="desc"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/counter_title_1.php", Array(), Array("MODE" => "html")); ?></div>
					</div>
					<div class="item">
						<div class="number spincrement"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/counter_2.php", Array(), Array("MODE" => "html")); ?></div>
						<div class="desc"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/counter_title_2.php", Array(), Array("MODE" => "html")); ?></div>
					</div>
					<div class="item">
						<div class="number spincrement"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/counter_3.php", Array(), Array("MODE" => "html")); ?></div>
						<div class="desc"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/counter_title_3.php", Array(), Array("MODE" => "html")); ?></div>
					</div>
					<div class="item">
						<div class="number spincrement"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/counter_4.php", Array(), Array("MODE" => "html")); ?></div>
						<div class="desc"><? $APPLICATION->IncludeFile(SITE_DIR . "include/block/ex_company/counter_title_4.php", Array(), Array("MODE" => "html")); ?></div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>