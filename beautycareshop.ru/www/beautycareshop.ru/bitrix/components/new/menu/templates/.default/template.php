<div class="bootstrap_container">
	<nav class="navbar navbar-default w3_megamenu navbar-new" role="navigation">
		<div class="navbar-header">
			<button type="button" data-toggle="collapse" data-target="#defaultmenu" class="navbar-toggle">Меню каталога</button>
			<!-- <a href="#" class="navbar-brand"><i class="fa fa-home"></i></a> -->
		</div>
		<div id="defaultmenu" class="navbar-collapse collapse">
			<ul class="nav navbar-nav" style="width: 100%;float: none;text-align: center;display: block;">

				<?php foreach ($arResult['ITEM'] as $data) : ?>
					<?if($data['PARENT'] != 1){?>
					<?if($data['DEPTH_LEVEL'] < 2){?>
					<li class="dropdown w3_megamenu-fw">
						<a href="<?= $data['URL'] ?>"><?= $data['NAME'] ?></a>
					</li>
					<?}?>
					<?}else{?>
					<li class="dropdown w3_megamenu-fw dropdown__arrow">
						<a href="<?= $data['URL'] ?>"><?= $data['NAME'] ?></a>
						<svg class="dropdown__arrow-ico" width="5" height="3" viewBox="0 0 5 3" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M2.96431 2.77895L4.86563 0.560085C4.9535 0.457613 5 0.354366 5 0.268547C5 0.102633 4.83333 -7.28537e-09 4.55435 -1.94801e-08L0.445035 -1.99104e-07C0.166375 -2.11284e-07 2.86057e-05 0.102504 2.85985e-05 0.26803C2.85948e-05 0.353978 0.0465731 0.455576 0.134684 0.558274L2.03597 2.77818C2.15844 2.92094 2.32325 3 2.50024 3C2.67711 3.00003 2.84187 2.92188 2.96431 2.77895Z" fill="white" />
						</svg>
						<ul class="dropdown__submenu">
							<?php foreach ($arResult['ITEM'] as $data2) : ?>
								<?if($data2['DEPTH_LEVEL'] == 2){?>
								<li class="dropdown w3_megamenu-fw dropdown__submenu-li">
									<a href="<?= $data2['URL'] ?>"><?= $data2['NAME'] ?></a>
								</li>
								<?}?>
							<?php endforeach; ?>
						</ul>
					</li>
					<?}?>
				<?php endforeach; ?>
			</ul>
		</div>
	</nav>
</div>