<?php
//echo "<pre>";
//print_r($arResult['ITEMS']);
//echo "</pre>";
?>
<section class="newproduct bgwhite p-t-45 p-b-105">
	<div class="container">
		<div class="sec-title p-b-60">
			<h3 class="m-text5 t-center">
				<?= $arParams["VALUE_BLOCK"] ?>
			</h3>
		</div>

		<!-- Slide2 -->
		<div class="wrap-slick2">
			<div class="slick2">


				<?php foreach ($arResult['ITEMS'] as $data) : ?>
					<?php
					$style_block = "";
					if ($data["PROPERTIES"]["novinka"]["VALUE"] === "Да") :
						$style_block .= " block2-labelnew";
					elseif ($data["PROPERTIES"]["hit_prodaj"]["VALUE"] === "Да") :
						$style_block .= " block-labelhit";
					elseif ($data["PROPERTIES"]["aktciya"]["VALUE"] === "Да") :
						$style_block .= " block-labelackci";
					elseif ($data["PROPERTIES"]["must_have"]["VALUE"] === "Да") :
						$style_block .= " block-labelMustHave";
					endif; ?>
					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative <?= $style_block ?>">
								<img src="<?= $data['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $data['NAME'] ?>">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>
									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<!-- <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button> -->
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="<?= $data['DETAIL_PAGE_URL'] ?>" class="block2-name dis-block s-text3 p-b-5">
									<?= $data['NAME'] ?>
								</a>

								<span class="block2-price m-text6 p-r-5">
									<?= $data['ITEM_PRICES']['PRINT_BASE_PRICE'] ?>
								</span>

							</div>
						</div>
					</div>
				<?php endforeach; ?>

			</div>
		</div>

	</div>
</section>