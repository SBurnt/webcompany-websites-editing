<?php
//echo "<pre>";
//print_r($arResult['ITEMS']);
//echo "</pre>";

?>
<section class="blog bgwhite p-t-25 p-b-20">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Beauty Blog
				</h3>
			</div>

			<div class="row">
                            <?php foreach ( $arResult['ITEMS'] as $key=>$data):?>
				<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
					<!-- Block3 -->
					<div class="block3">
						<a href="<?=$data['DETAIL_PAGE_URL']?>" class="block3-img dis-block hov-img-zoom">
							<img src="<?=$data['PREVIEW_PICTURE']['SRC']?>" alt="IMG-BLOG">
						</a>

						<div class="block3-txt p-t-14">
							<h4 class="p-b-7">
								<a href="<?=$data['DETAIL_PAGE_URL']?>" class="m-text11">
									<?=$data['NAME']?>
								</a>
							</h4>

							 <span class="s-text7"><?=$data['ACTIVE_FROM']?></span>
							<p class="s-text8 p-t-16">
								<?=$data['PREVIEW_TEXT']?>
							</p>
						</div>
					</div>
				</div>
<?php endforeach; ?>
				

				
			</div>
		</div>
	</section>




