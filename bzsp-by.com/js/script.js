$(document).ready(function () {
  $(".nav-icon").click(function () {
    $(this).toggleClass("open");
    $(this).siblings(".nav-overlay").toggleClass("open");
    $("body").toggleClass("cant-scrl");
    overlay();
  });

  function overlay() {
    $("#overlay").toggleClass("active");
  }

  $(".slider__content").slick({
    dots: true,
    nextArrow:
      '<a class="slider-item__prev"><svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 18.2L2 9.6L11 1" stroke="white" stroke-width="2" stroke-miterlimit="10"/></svg></a>',
    prevArrow:
      '<a class="slider-item__next"><svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0.799988L10 9.39999L1 18" stroke="white" stroke-width="2" stroke-miterlimit="10"/></svg></a>',
    dotsClass: "slick-dots slider-dots",
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
  });

  $(".slider__about").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    nextArrow:
      '<a class="slider-item__prev"><svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 18.2L2 9.6L11 1" stroke="white" stroke-width="2" stroke-miterlimit="10"/></svg></a>',
    prevArrow:
      '<a class="slider-item__next"><svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0.799988L10 9.39999L1 18" stroke="white" stroke-width="2" stroke-miterlimit="10"/></svg></a>',
    dotsClass: "slick-dots slider-dots",
  });

  $(".news-slider.info__slider").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    nextArrow:
      '<a class="slider-item__prev news-slider__next"><svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 18.2L2 9.6L11 1" stroke="white" stroke-width="2" stroke-miterlimit="10"/></svg></a>',
    prevArrow:
      '<a class="slider-item__next news-slider__next"><svg width="12" height="19" viewBox="0 0 12 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0.799988L10 9.39999L1 18" stroke="white" stroke-width="2" stroke-miterlimit="10"/></svg></a>',
    responsive: [
      {
        breakpoint: 1060,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 425,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $(".question__dropdown").click(function (e) {
    var $this = $(this);

    if ($this.children(".question__answer").hasClass("show")) {
      $this.children(".question__answer").removeClass("show");
      $this.children(".question__answer").slideUp(350);
      $this.removeClass("active");
    } else {
      $this.parent().find(".question__answer").removeClass("show");
      $this.siblings().removeClass("active");
      $this.addClass("active");
      $this.parent().find(".question__answer").slideUp(350);
      $this.children(".question__answer").toggleClass("show");
      $this.children(".question__answer").slideToggle(350);
    }
  });

  // to top
  $(".to-top").click(function () {
    $("body,html").animate({ scrollTop: 0 }, 3000);
  });

  $(window).scroll(function () {
    if ($(window).scrollTop() > 500) {
      $(".to-top").addClass("to-top__active");
    } else {
      $(".to-top").removeClass("to-top__active");
    }
    if ($(window).scrollTop() > 2) {
      $(".header__top").slideUp();
      $(".logo").slideUp();
      $(".logo").css({ position: "absolute", opacity: "0" }, 700);
      $(".logo__scroll").css({ position: "static", opacity: "1" }, 700);
      $(".logo__scroll").slideDown();
      $(".header__bottom").css({ height: "60px" }, 700);
      $("header").css({ "border-color": "rgba(0, 69, 191, 0.3)" }, 700);
    } else if ($(window).scrollTop() < 2) {
      $(".header__top").slideDown();
      $(".logo__scroll").slideUp();
      $(".logo__scroll").css({ position: "absolute", opacity: "0" }, 700);
      $(".logo").css({ position: "static", opacity: "1" }, 700);
      $(".header__bottom").css({ height: "105px" }, 700);
      $(".logo").slideDown();
      $("header").css({ "border-color": "#F3F4F5" }, 700);
    }
  });

  $(".search svg").click(function () {
    $(".search svg").parent().toggleClass("active");
    changeSearchWidth();
    if ($(window).width() < 785) {
      overlay();
      $("body").toggleClass("cant-scrl");
    }
  });

  $(window).resize(function () {
    changeSearchWidth();
  });

  function changeSearchWidth() {
    if ($(window).width() < 785 && $(".search").hasClass("active")) {
      $(".search__input").css(
        "width",
        $(".header__bottom").width() - 26 + "px"
      );
    } else if ($(window).width() < 785) {
      $(".search__input").css("width", "0px");
    }
  }

  $(".dropdown").click(function () {
    $(this).find(".dropdown-list").toggleClass("active");
  });

  /*var selector = document.getElementById("mask");
  var im = new Inputmask("+375 (99) 999-99-99");
  im.mask(selector);*/

  $("#file").change(function (e) {
    var numFiles = e.currentTarget.files.length;
    for (i = 0; i < numFiles; i++) {
      fileSize = parseInt(e.currentTarget.files[i].size, 10) / 1024;
      filesize = Math.round(fileSize);
      $("<li />")
        .attr("num", i)
        .text(e.currentTarget.files[i].name)
        .appendTo($("#output"));
      $("<span />").addClass("delete").text("x").appendTo($("#output li:last"));
      $("<span />")
        .addClass("filesize")
        .text(filesize + "kb")
        .appendTo($("#output li:last"));
    }
    $(".delete").click(function () {
      var num = $(this).parent().attr("num");
      $(this).parent().remove();
      e.currentTarget.files[num] = " ";
    });
  });
});

$(document).mouseup(function (e) {
  if ($(".search").hasClass("active") && $(this).width() > 785) {
    var container = $(".search");
    if (container.has(e.target).length === 0) {
      container.removeClass("active");
    }
  } else if ($(".search").hasClass("active")) {
    var container = $(".search");
    if (container.has(e.target).length === 0) {
      container.removeClass("active");
      container.find("input").css("width", "0px");
      $("body").removeClass("cant-scrl");
      $("#overlay").removeClass("active");
    }
  }
});
