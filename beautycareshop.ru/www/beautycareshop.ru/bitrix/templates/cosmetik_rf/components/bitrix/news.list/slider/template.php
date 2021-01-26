  <section class="slide1">
    <div class="wrap-slick1">
      <div class="slick1">
        <?php foreach ($arResult['ITEMS'] as $key => $data) : ?>
          <!-- <div class="item-slick1 item<?= $key + 1 ?>-slick1" style="background-image: url(<?= $data['PREVIEW_PICTURE']['SRC'] ?>);">
            <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">

              <span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
                <?= $data['NAME'] ?>
              </span>

              <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="rollIn">
                <?= $data['DETAIL_TEXT'] ?>
              </h2>

              <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">

                <a href="<?= $data['PROPERTIES']['URL']['VALUE'] ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                  Купить
                </a>
              </div>
            </div>
          </div> -->
          <div class="item<?= $key + 1 ?>-slick1 new-slider-no-text">
            <div class="wrap-content-slide1 sizefull flex-col-c-m">
              <a href="<?= $data['PROPERTIES']['URL']['VALUE'] ?>">
                <img src="<?= $data['PREVIEW_PICTURE']['SRC'] ?>" alt="">
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>