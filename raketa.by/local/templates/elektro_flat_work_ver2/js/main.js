$(document).on("ready", function () {
  $(".product_slider").slick({
    slidesToShow: 1,
    infinite: true,
    dots: false,
    lazyLoad: "ondemand",
  });

  $(".more_photo").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    centerMode: true,
    focusOnSelect: true,
    arrows: false,
    asNavFor: ".detail_picture",
    dots: false,
    responsive: [
      {
        breakpoint: 500,
        settings: {
          slidesToShow: 2,
        },
      },
    ],
  });

  $(".detail_picture").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    fade: true,
    arrows: true,
    draggable: false,
    asNavFor: ".more_photo",
    responsive: [
      {
        breakpoint: 425,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  $(".section-vertical").click(function () {
    $("body").toggleClass("scrl");
  });
});

$(window).on("scroll", function () {
  if ($(document).scrollTop() > 151) {
    $(".header_5").insertAfter($("header.clone").find(".header_4"));
    $("header:last-child").find(".header_5").remove();
  }
  if ($(document).scrollTop() < 151) {
    $(".header_5").insertAfter($("#header").find(".header_4"));
  }
});

$(function () {
  $(".title-search-result").addClass("top");
  //SCROLL_UP//
  var top_show = 150,
    delay = 500;
  $("body").append(
    $("<a />")
      .addClass("scroll-up")
      .attr({ href: "javascript:void(0)", id: "scrollUp" })
      .append($("<i />").addClass("fa fa-angle-up"))
  );
  $("#scrollUp").click(function (e) {
    e.preventDefault();
    $("body, html").animate({ scrollTop: 0 }, delay);
    return false;
  });

  $("#test").click(function (e) {
    $("body, html").animate({ scrollTop: 0 }, delay);
    return false;
  });

  if (document.body.clientWidth < 778) {
    $(window).scroll(function () {
      /*if($(document).scrollTop() > 30 && $(document).scrollTop() > 161 && $(document).scrollTop() < 200){
			//$('.header_1, .header_3').css('display', 'none');
			$('.header_2, .header_5, .top_panel').css({ "opacity": "0", "top": "0", "position": "fixed"});
		}
		if($(document).scrollTop() > 200){
			$('.header_2, .header_5, .top_panel').css({ "opacity": "1"});
		}
		if ($(document).scrollTop() < 30) {
			$('.header_2, .header_5, .top_panel').css({ "opacity": "1"});
		}*/
      /*if($(document).scrollTop() < 175){
			$('.header_2, .header_5, .top_panel').css({ "opacity": "1"});
		}
		if($(document).scrollTop() < 180){
			$('.header_2, .header_5, .top_panel').css({ "position": "absolute"});
		}
		if($(document).scrollTop() < 185){
			$('.header_2, .header_5, .top_panel').css({"top": "165px"});
		}
		if($(document).scrollTop() > 185){
			$('.header_2, .header_5, .top_panel').css({ "opacity": "0", "top": "0px"});
		}
		if($(document).scrollTop() > 186 && $(document).scrollTop() < 200){
			$('.header_2, .header_5, .top_panel').css({ "position": "fixed"});
		}
		if($(document).scrollTop() > 200){
			$('.header_2, .header_5, .top_panel').css({ "opacity": "1"});
		}*/
      if ($(document).scrollTop() < 165) {
        $(".header_2, .header_5, .top_panel").delay(2000).css({ opacity: "1" });
        $(".title-search-result").addClass("top");
      }
      if ($(document).scrollTop() < 180) {
        $(".header_2, .header_5, .top_panel").css({
          position: "absolute",
          top: "100px",
        });
      }
      // if($(document).scrollTop() < 190 && $(document).scrollTop() > 170){
      // 	$('.header_2, .header_5, .top_panel').delay(2000).css({ "opacity": "0"});
      // }
      // if($(document).scrollTop() > 200){
      // 	$('.header_2, .header_5, .top_panel').delay(2000).css({ "opacity": "0"});
      // }
      if ($(document).scrollTop() > 100) {
        $(".header_2, .header_5, .top_panel").css({
          position: "fixed",
          top: "0px",
        });
      }
      if ($(document).scrollTop() > 240) {
        $(".header_2, .header_5, .top_panel").delay(2000).css({ opacity: "1" });
        $(".title-search-result").removeClass("top");
      }
    });
  }

  $(window).scroll(function () {
    if ($(this).scrollTop() > top_show) {
      $("#scrollUp").fadeIn();
    } else {
      $("#scrollUp").fadeOut();
    }
  });

  //DISABLE_FORM_SUBMIT_ENTER//
  $(".add2basket_form").on("keyup keypress", function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });

  //CALLBACK//
  var callbackBtn = BX("callbackAnch");
  if (!!callbackBtn)
    BX.bind(
      callbackBtn,
      "click",
      BX.delegate(function () {
        openFormCallback();
      }, this)
    );

  //BTN_ANIMATION
  setInterval(
    BX.delegate(function () {
      openbtn();
    }, this),
    5000
  );

  //TOP_PANEL_CONTACTS//
  $(".showcontacts").click(function () {
    var clickitem = $(this);
    if (clickitem.parent("li").hasClass("")) {
      clickitem.parent("li").addClass("active");
    } else {
      clickitem.parent("li").removeClass("active");
    }
    if ($(".showsection").parent("li").hasClass("active")) {
      $(".showsection").parent("li").removeClass("active");
      $(".showsection")
        .parent("li")
        .find(".catalog-section-list")
        .css({ display: "none" });
    }
    if ($(".showsubmenu").parent("li").hasClass("active")) {
      $(".showsubmenu").parent("li").removeClass("active");
      $(".showsubmenu")
        .parent("li")
        .find("ul.submenu")
        .css({ display: "none" });
    }
    if ($(".showsearch").parent("li").hasClass("active")) {
      $(".showsearch").parent("li").removeClass("active");
      $(".header_2").css({ display: "none" });
      $(".title-search-result").css({ display: "none" });
    }
    $(".header_4").slideToggle();
  });

  //TOP_PANEL_SEARCH//
  $(".showsearch").click(function () {
    var clickitem = $(this);
    if (clickitem.parent("li").hasClass("")) {
      clickitem.parent("li").addClass("active");
    } else {
      clickitem.parent("li").removeClass("active");
      $(".title-search-result").css({ display: "none" });
    }
    if ($(".showsection").parent("li").hasClass("active")) {
      $(".showsection").parent("li").removeClass("active");
      $(".showsection")
        .parent("li")
        .find(".catalog-section-list")
        .css({ display: "none" });
    }
    if ($(".showsubmenu").parent("li").hasClass("active")) {
      $(".showsubmenu").parent("li").removeClass("active");
      $(".showsubmenu")
        .parent("li")
        .find("ul.submenu")
        .css({ display: "none" });
    }
    if ($(".showcontacts").parent("li").hasClass("active")) {
      $(".showcontacts").parent("li").removeClass("active");
      $(".header_4").css({ display: "none" });
    }
    $(".header_2").slideToggle();
  });

  //TABS_MAIN//
  if ($(".tabs__box.new .filtered-items").length < 1)
    $(".tabs__tab.new, .tabs__box.new").remove();
  if ($(".tabs__box.hit .filtered-items").length < 1)
    $(".tabs__tab.hit, .tabs__box.hit").remove();
  if ($(".tabs__box.discount .filtered-items").length < 1)
    $(".tabs__tab.discount, .tabs__box.discount").remove();

  $(".tabs-main .tabs__tab").first().addClass("current");
  $(".tabs-main .tabs__box").first().css({ display: "block" });

  //ITEMS_HEIGHT//
  var itemsTable = $(".filtered-items:visible .catalog-item-card");
  if (!!itemsTable && itemsTable.length > 0) {
    $(window).resize(function () {
      adjustItemHeight(itemsTable);
    });
    adjustItemHeight(itemsTable);
  }

  //CHANGE_TAB//
  $("body").on("click", ".tabs__tab:not(.current)", function () {
    $(this)
      .addClass("current")
      .siblings()
      .removeClass("current")
      .parent()
      .siblings(".tabs__box")
      .eq($(this).index())
      .fadeIn(150)
      .siblings(".tabs__box")
      .hide();

    //ITEMS_HEIGHT//
    var itemsTable = $(this)
      .parent()
      .siblings(".tabs__box")
      .eq($(this).index())
      .find(".catalog-item-card");
    if (!!itemsTable && itemsTable.length > 0) {
      $(window).resize(function () {
        adjustItemHeight(itemsTable);
      });
      adjustItemHeight(itemsTable);
    }
  });

  $(".header_5").mouseenter(function () {
    $(this).find(".wrap_basket_line").addClass("block_basket_line_display");
    console.log($(this).find(".wrap_basket_line"));
  });

  $(".search_close").click(function () {
    $(this).parent().removeClass("block_basket_line_display");
  });

  if (document.body.clientWidth > 768) {
    var $header2 = $("header");
    $clone = $header2.before($header2.clone().addClass("clone center"));
    $(".clone").removeAttr("id");
    $(".clone").find(".header_1");
    $(".clone").find(".header_5").remove();
    $(".clone").find(".header_2").find(".form-box").remove("");
    $(".clone").find(".header_2").addClass("title_search_php");
    $(".clone")
      .find(".header_3")
      .find(".schedule")
      .html("<b>Наш магазин</b>:<br>Минск, Туровского,10<br>");
    $(".clone").find(".header_4").find(".text").remove();
    $(".clone").find(".header_4").find(".soc").remove();
    $.ajax({
      // method: "POST",
      url: "/ajax/search-title.php",
      success: function (msg) {
        $(".title_search_php").html(msg);
      },
    });
  }
  $(window).on("scroll", function () {
    var fromTop = $(document).scrollTop();
    $("body").toggleClass("down", fromTop > 145);
  });

  //DELAY//
  var currPage = window.location.pathname;
  var delayIndex = window.location.search;
  if (
    currPage == "/personal/cart/" &&
    document.getElementById("id-shelve-list") &&
    delayIndex == "?delay=Y"
  ) {
    $("#id-shelve-list").show();
    $("#id-cart-list").hide();
  } else {
    $("#id-shelve-list").hide();
    $("#id-cart-list").show();
  }

  //CUSTOM_FORMS//
  $(".custom-forms").customForms({});

  //CATALOG_MENU_HIDDEN//
  var flag = 1;
  $("#catalog_wrap_btn").click(function () {
    $("#catalog_wrap").slideToggle("slow");
    if (flag == 0) {
      flag = 1;
      $("#catalog_wrap_btn .showfilter .fa-angle-down").css({
        display: "block",
      });
      $("#catalog_wrap_btn .showfilter .fa-angle-up").css({ display: "none" });
    } else {
      flag = 0;
      $("#catalog_wrap_btn .showfilter .fa-angle-down").css({
        display: "none",
      });
      $("#catalog_wrap_btn .showfilter .fa-angle-up").css({ display: "block" });
    }
  });
});

/*window.onscroll = function() {
    var scrolled = window.pageYOffset || document.documentElement.scrollTop;
    var header = document.getElementById('header');
    var top_panel = document.getElementById('top_panel');
    var box = header.getBoundingClientRect();
    if(scrolled>0 && (flag || document.body.clientWidth<787)){

        if(document.body.clientWidth>768){
            header.classList.add("header-fixed");
						$('header').css('opacity', '1');
		}
        if(document.body.clientWidth<1013 ) {
            document.getElementById('header_2').classList.add("header_2-fixed");
            header.classList.add("header-fixed");
						$('header').css('opacity', '1');

        }
        if(document.body.clientWidth<778){

            top_panel.classList.add("header-fixed");

           document.getElementById('header_1').style.display = "none";
            document.getElementById('header_2').style.top = "0px";
            document.getElementById('top_panel').style.top = "0px";
            document.getElementById('header_5').style.top = "0px";
            document.getElementById('header_3').style.display = "none";



		}else{
            top_panel.classList.remove("header-fixed");
		}
	}else{
    	//header.classList.remove("header-fixed");
				$('header').css('opacity', '0');
        top_panel.classList.remove("header-fixed");
        document.getElementById('header_2').classList.remove("header_2-fixed");





	}


}*/
document.addEventListener("DOMContentLoaded", function (event) {
  window.onresize = function () {
    resize_screen();
  };
});
window.onload = function () {
  resize_screen();
};

function resize_screen() {
  if (document.body.clientWidth > 768) {
    if ($(document).scrollTop() > 151) {
      $(".clone").css("opacity", "1");
    } else {
      $(".clone").css("opacity", "0");
    }
  }

  /*if(window.pageYOffset>10 && document.body.clientWidth<768){
        document.getElementById('header').classList.add("header-fixed");
    }else{
        document.getElementById('header_1').style.display = "table-cell";
        document.getElementById('header_2').style.top = "115px";
        document.getElementById('top_panel').style.top = "115px";
        document.getElementById('header_5').style.top = "115px";
        document.getElementById('header_3').style.display = "table-cell";
    }

    if(window.pageYOffset>270 && document.body.clientWidth<1013) {
        var header_2 = document.getElementById('header_2');
        header_2.classList.add("header_2-fixed");
    }else{
        document.getElementById('header').classList.add("header-fixed");
    }


    if(window.pageYOffset>370) {

        if (document.body.clientWidth < 1013 ) {
            var header_2 = document.getElementById('header_2');
            header_2.classList.add("header_2-fixed");
        }

        if( document.body.clientWidth<768){
            document.getElementById('header').classList.add("header-fixed");
						$('header').css('opacity', '1');
		}
    }else{

        document.getElementById('header').classList.add("header-fixed");
				$('header').css('opacity', '1');

        if( document.body.clientWidth<768) {
            document.getElementById('header_1').style.display = "table-cell";
            document.getElementById('header_2').style.top = "150px";
            document.getElementById('top_panel').style.top = "150px";
            document.getElementById('header_5').style.top = "150px";
            document.getElementById('header_3').style.display = "table-cell";
        }
        if( document.body.clientWidth<420) {
            document.getElementById('header_2').style.top = "115px";
            document.getElementById('top_panel').style.top = "115px";
            document.getElementById('header_5').style.top = "115px";
        }
	}

    if(window.pageYOffset>0) {
        if( document.body.clientWidth<768) {
            document.getElementById('header').classList.add("header-fixed");
						$('header').css('opacity', '1');

        }
    }

    if(window.pageYOffset==0) {
        document.getElementById('header').classList.add("header_pos");
        document.getElementById('top-menu').classList.add("header_pos2");
    }else{
        document.getElementById('header').classList.remove("header_pos");
        document.getElementById('top-menu').classList.remove("header_pos2");
    }
		*/
}
var scrollPos = 0;
var flag;
$(window).scroll(function () {
  var st = $(this).scrollTop();
  if (st > scrollPos) {
    flag = false;
  } else {
    flag = true;
  }
  resize_screen();
  scrollPos = st;
});
