						<?CMax::checkRestartBuffer();?>
						<?IncludeTemplateLangFile(__FILE__);?>
							<?if(!$isIndex):?>
								<?if($isHideLeftBlock && !$isWidePage):?>
									</div> <?// .maxwidth-theme?>
								<?endif;?>
								</div> <?// .container?>
							<?else:?>
								<?CMax::ShowPageType('indexblocks');?>
							<?endif;?>
							<?CMax::get_banners_position('CONTENT_BOTTOM');?>
						</div> <?// .middle?>
					<?//if(($isIndex && $isShowIndexLeftBlock) || (!$isIndex && !$isHideLeftBlock) && !$isBlog):?>
					<?if(($isIndex && ($isShowIndexLeftBlock || $bActiveTheme)) || (!$isIndex && !$isHideLeftBlock)):?>
						</div> <?// .right_block?>
						<?if($APPLICATION->GetProperty("HIDE_LEFT_BLOCK") != "Y" && !defined("ERROR_404")):?>
							<?CMax::ShowPageType('left_block');?>
						<?endif;?>
					<?endif;?>
					</div> <?// .container_inner?>
				<?if($isIndex):?>
					</div>
				<?elseif(!$isWidePage):?>
					</div> <?// .wrapper_inner?>
				<?endif;?>
			</div> <?// #content?>

			<?CMax::get_banners_position('FOOTER');?>
		</div><?// .wrapper?>

		<footer id="footer">
			<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer_include/under_footer.php'));?>
			<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer_include/top_footer.php'));?>
<script type='application/ld+json'> 
{
  "@context": "https://www.schema.org",
  "@type": "LocalBusiness",
  "name": "Arttex",
  "url": "http://arttex.ru/",
  "logo": "http://arttex.ru/upload/medialibrary/424/logo%20%D0%BA%D0%BE%D0%BF%D0%B8%D1%8F.png",
  "image": "http://arttex.ru/upload/medialibrary/424/logo%20%D0%BA%D0%BE%D0%BF%D0%B8%D1%8F.png",
  "description": "Arttex - карнизы, ролунные шторы и аксессуары к ним.",
  "telephone" : " +7 495 783 87 92",
  "email" : "info@arttex.ru",
  "priceRange" : "RUB",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ул. Ленинская Слобода, д.26",
    "addressLocality": "Москва",
    "postalCode": "115280 ",
    "addressCountry": "Россия"
  }
}
 </script>
</footer>
		<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer_include/bottom_footer.php'));?>
	</body>
</html>