/**
 * helpers
 */
(function () {
  //swiper helper function
  {
    // swiper param pagination: { renderBullet: swiperRenderBullets }
    window.swiperRenderBullets = function (index, className) {
      var maxWidth = (100 / this.slides.length).toFixed(6),
        style = "max-width: calc( " + maxWidth + "% - 8px );";
      return '<span style="' + style + '" class="' + className + '"></span>';
    };

    window.resizeSliderContainer = function () {
      if (!this.slidesSizesGrid.length) return;

      var sum = 0;
      for (var i = 0; i < this.slidesSizesGrid.length; i++) {
        sum += this.slidesSizesGrid[i];
      }
      sum += +this.params.spaceBetween * (this.slidesSizesGrid.length - 1);

      this.$wrapperEl.css("width", sum + "px");
    };
  }

  window.smoothScroll = function ($target, params) {
    $target = typeof $target === "string" ? $($target) : $target;
    params = $.extend(
      {
        offsetTop: 0,
        duration: 400,
      },
      params || {}
    );
    if ($target.length)
      $("html, body").animate({ scrollTop: $target.offset().top - params.offsetTop }, params.duration);
  };

  window.clickOff = function ($el, callback) {
    if (!$el) return false;
    $(document).on("click", function (e) {
      if ($el.has(e.target).length === 0 && !$el.is(e.target)) {
        callback($el);
      }
    });
  };

  // split in rows by bottom position and equal height
  window.equalHeightBot = function ($items) {
    var calc = function ($items) {
      var rows = {};
      $items.each(function () {
        var offsetBot = $(this).offset().top + $(this).height();
        if (!rows[offsetBot]) rows[offsetBot] = $([]);
        rows[offsetBot] = rows[offsetBot].add($(this));
      });

      for (var rowKey in rows) {
        if (!rows.hasOwnProperty(rowKey)) continue;
        var $rows = rows[rowKey];
        $rows.css("min-height", "0");

        if ($rows.length < 2) return;

        var maxHeight = 0;
        $rows.each(function () {
          if ($(this).height() > maxHeight) maxHeight = $(this).height();
        });
        $rows.css("min-height", maxHeight + "px");
      }
    };
    calc($items);

    $(window).resize(function () {
      calc($items);
    });
  };
})();

var cui = {
  clickOff: function ($el, callback) {
    if (!$el) return false;
    $(document).on("click", function (e) {
      if ($el.has(e.target).length === 0 && !$el.is(e.target)) {
        callback($el);
      }
    });
  },

  ifdefined: function (v) {
    return typeof v !== "undefined" && v !== null;
  },
};

$(function () {
  var $overlay = $(".main-overlay"),
    $mobileSidebar = $(".mobile-sidebar"),
    $humburger = $(".js-open-menu");
  $humburger.on("click", function (event) {
    event.preventDefault();
    $mobileSidebar.addClass("_active");
    $overlay.addClass("_active");
    $("body").addClass("_overflow");
  });
  $overlay.on("click", function (event) {
    event.preventDefault();
    $mobileSidebar.removeClass("_active");
    $overlay.removeClass("_active");
    $("body").removeClass("_overflow");
  });
});

$(document).ready(function () {
  if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = function (callback, thisArg) {
      thisArg = thisArg || window;
      for (let i = 0; i < this.length; i++) {
        callback.call(thisArg, this[i], i, this);
      }
    };
  }

  var $cityGeoOpen = $(".js-city-geo");
  var $cityGeoPopup = $(".header__center-popup");
  var $cityGeoBtnYes = $(".header__center-popup-btn-yes");
  var $cityGeoBtnNo = $(".header__center-popup-btn-no");
  var $cityGeoBtnClose = $(".header-city-modal-close");
  var $html = $("html");
  var cityGeoSelect = document.querySelectorAll(".header-city-modal-cities-item");

  $cityGeoOpen.on("click", function (event) {
    event.preventDefault();
    // $cityGeoPopup.addClass("open");
    $html.addClass("open-city");
  });

  $cityGeoBtnYes.on("click", function (event) {
    event.preventDefault();
    $cityGeoPopup.removeClass("open");
  });

  $cityGeoBtnNo.on("click", function (event) {
    event.preventDefault();
    $cityGeoPopup.removeClass("open");
    $html.addClass("open-city");
  });

  $cityGeoBtnClose.on("click", function (event) {
    event.preventDefault();
    $html.removeClass("open-city");
  });

  cityGeoSelect.forEach(function (items) {
    items.addEventListener("click", function (event) {
      event.preventDefault();
      $html.removeClass("open-city");
    });
  });
});

$(document).ready(function () {
  const catalogCardsItem = document.querySelectorAll(".objects-content .catalog-cards__item");
  const catalogCardsItemThList = document.querySelectorAll(".objects-content .catalog-item");
  const catalogCardsItemTableSlider = document.querySelectorAll(".objects-content .table-slider__td");

  if (catalogCardsItem.length > 0 || catalogCardsItemThList.length > 0 || catalogCardsItemTableSlider.length > 0) {
    // функция по расположению карты в разделах недвижимость
    const windowInnerHeight = window.innerHeight;
    const windowInnerWidth = document.documentElement.clientWidth;

    // устанавливаем высоту карты на всю высоту экрана
    const heightMapInObjectsContent = function () {
      const mapInObjectsContent = document.querySelector(".objects-content-right > div");
      mapInObjectsContent.style.maxHeight = windowInnerHeight + "px";
    };

    // устанавливаем ширину карты
    const widthMapInObjectsContent = function () {
      // const objectsContent = document.querySelector(".objects-content");
      const widthObjectsContent = document.querySelector(".objects-content").clientWidth;
      const widthObjectsContentLeft = document.querySelector(".objects-content-left").clientWidth;

      const widthMapScreen = (windowInnerWidth - widthObjectsContent) / 2;
      const objectsContentRight = document.querySelector(".objects-content-right");
      objectsContentRight.style.right = widthMapScreen + "px";
      objectsContentRight.style.width = widthObjectsContent - widthObjectsContentLeft - 10 + "px";
    };

    // фиксируем карту при скролле страницы
    const offset = function () {
      const objectsContentRight = document.querySelector(".objects-content-right");
      const rect = objectsContentRight.getBoundingClientRect();
      // const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      const fixMap = function () {
        const top = $(document).scrollTop();

        if (top > rect.top + scrollTop) {
          $(".objects-content-right").addClass("fixed");
        } else {
          $(".objects-content-right").removeClass("fixed");
        }

        if (top > rect.bottom - windowInnerHeight + scrollTop) {
          $(".objects-content-right").removeClass("fixed");
          $(".objects-content-right").css("margin-top", "auto");
        } else {
          $(".objects-content-right").css("margin-top", "");
        }
      };

      $(window).scroll(function () {
        fixMap();
      });

      fixMap();
    };

    const showMapMobile = function () {
      const objectsContentRight = document.querySelector(".objects-content-right");
      const btnShowMap = document.querySelector(".objects-content-switcher .show-map");
      const btnHideMap = document.querySelector(".objects-content-switcher .show-list");
      const body = document.querySelector("body");

      btnShowMap.addEventListener("click", function () {
        objectsContentRight.classList.add("active");
        btnShowMap.classList.remove("active");
        btnHideMap.classList.add("active");
        body.classList.add("fixed-body");
      });

      btnHideMap.addEventListener("click", function () {
        objectsContentRight.classList.remove("active");
        btnShowMap.classList.add("active");
        btnHideMap.classList.remove("active");
        body.classList.remove("fixed-body");
      });
    };

    // window.addEventListener('scroll', function() {
    //   if (condition) {

    //   }
    // })

    $(window).resize(function () {
      widthMapInObjectsContent();
    });

    heightMapInObjectsContent();
    widthMapInObjectsContent();
    offset();
    showMapMobile();
  } else {
    return false;
  }
});
