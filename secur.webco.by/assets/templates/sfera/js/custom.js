$(document).ready(function () {
  $("h2.toggle_menu").click(function () {
    $(this).parent().children("ul.toggle_menu").slideToggle("fast");
  });

  $("a.print-version").click(function () {
    window.print();
    return false;
  });

  $("#main-slider").owlCarousel({
    navigation: false, // Show next and prev buttons
    slideSpeed: 300,
    paginationSpeed: 400,
    singleItem: true,
    pagination: false,
    afterMove: function () {
      if (owl.visibleItems[0] == owl.$owlItems.length - 1) {
        $("div.next i").hide();
      } else {
        $("div.next i").show();
      }
      if (owl.visibleItems[0] == 0) {
        $("div.prev i").hide();
      } else {
        $("div.prev i").show();
      }
    },
  });

  $("div.prev i").hide();
  var owl = $("#main-slider").data("owlCarousel");
  $("div.prev i").on("click", function () {
    owl.prev();
  });
  $("div.next i").on("click", function () {
    owl.next();
  });
  $("#news-slider, #sale-slider").owlCarousel({
    navigation: false, // Show next and prev buttons
    slideSpeed: 300,
    paginationSpeed: 400,
    items: 4,
    pagination: false,
  });

  $("#marks-slider").owlCarousel({
    navigation: false, // Show next and prev buttons
    slideSpeed: 300,
    paginationSpeed: 400,
    items: 4,
    pagination: false,
  });

  $(window).load(function () {
    $("#marks-slider div.owl-item img").each(function () {
      $(this).css("margin-top", ($(this).parent().height() - $(this).height()) / 2);
    });
  });

  var owl1 = $("#marks-slider").data("owlCarousel");
  $("i#butt-prev").on("click", function () {
    owl1.prev();
  });
  $("i#butt-next").on("click", function () {
    owl1.next();
  });

  $("a.hideOverlay").click(function () {
    $("div.overlay").fadeOut("fast");
    $("a.showOverlay").removeClass("hidden");
    return false;
  });
  $("a.showOverlay").click(function () {
    $("div.overlay").fadeIn("fast");
    $("a.showOverlay").addClass("hidden");
    return false;
  });

  $("#grid").click(function () {
    $("#rows").attr("src", "assets/templates/sfera/images/row_.png");
    $(this).attr("src", "assets/templates/sfera/images/grid_.png");
    $(".products-grid div.product.grid").each(function () {
      $(this).removeClass("hidden");
    });
    $.cookie("vview", $(this).parent().data("category") + ":grid");
    $(".products-grid div.product.rows").addClass("hidden");
  });

  $("#rows").click(function () {
    $("#grid").attr("src", "assets/templates/sfera/images/grid.png");
    $(this).attr("src", "assets/templates/sfera/images/row.png");
    $(".products-grid div.product.rows").each(function () {
      $(this).removeClass("hidden");
    });
    $.cookie("vview", $(this).parent().data("category") + ":row");
    $(".products-grid div.product.grid").addClass("hidden");
  });

  if ($.cookie("vview") != null && $.cookie("vview") !== "null") {
    var c = $.cookie("vview").split(":");
    //if(c == "") return;
    if (c[0] == $("[data-category]").data("category")) {
      if (c[1].toString() == "row") $("#rows").trigger("click");
      if (c[1].toString() == "grid") $("#grid").trigger("click");
    }
  }

  $("#product-images").owlCarousel({
    navigation: false, // Show next and prev buttons
    slideSpeed: 300,
    paginationSpeed: 400,
    singleItem: true,
    pagination: false,
  });
  var product_images = $("#product-images").data("owlCarousel");
  $(window).load(function () {
    $("div.prev img")
      .css("margin-top", ($("#product-images").height() - 64) / 2)
      .click(function () {
        product_images.prev();
      });
    $("div.next img")
      .css("margin-top", ($("#product-images").height() - 64) / 2)
      .click(function () {
        product_images.next();
      });
  });

  $(".vacancy div.header").click(function () {
    $("div.vacancy div.full[data-index='" + $(this).attr("data-index") + "']").slideToggle("slow");
  });
  $("div.button-file").click(function () {
    var input_file = $(this).parent().find("input[type='file']");
    input_file.trigger("click");
  });
  $("input[type='file']").change(function () {
    $(this).parent().find("input[type='text']").val($(this).val());
  });
  $("div#sale-slider").hide();
  $("div.tabs a").click(function () {
    $("div#sale-slider").hide();
    $("div#news-slider").hide();

    if ($(this).attr("href") == "new") {
      $("a.seeallnews").attr("href", "/novinki.html");
    } else {
      $("a.seeallnews").attr("href", "/rasprodazha.html");
    }
    $("div[data-slider='" + $(this).attr("href") + "']").show();
    $("div.tabs a").removeClass("active");
    $(this).addClass("active");
    return false;
  });
  if ($("div.clients div.item").size() > 8) {
    for (var i = 8; i < $("div.clients div.item").size(); i++) {
      $("div.clients div.item").eq(i).addClass("hidden");
    }
    $("div.clients").append('<a class="all-clients text-center" href="#all">Другие наши клиенты</a>');
  }

  $("a.all-clients").on("click", function () {
    $("div.clients div.item").removeClass("hidden");
    $(this).addClass("hidden");
    return false;
  });
  /*$("div.left-menu-catalog ul li a").click(function(){
		if($(this).parent().find("ul").size() > 0) {
			event.preventDefault();
			if($(this).parent().attr("class") && $(this).parent().attr("class").indexOf("active")) {
				$(this).parent().toggleClass("active");
				$(this).find("i").attr("class", "fa fa-caret-down");
			} else {
				$(this).parent().toggleClass("active");
				$(this).find("i").attr("class", "fa fa-caret-right");
			}


		}
	});*/

  $("div.left-menu-catalog i.fa.drop").click(function () {
    $(this).toggleClass("fa-plus-square-o").toggleClass("fa-minus-square-o");
    $(this).parent().children("ul").slideToggle("fast");
    $(this).parent().toggleClass("active");
    //$(this).removeClass("fa-plus-square-o").addClass("fa-minus-square-o");
  });

  $("div.left-menu-catalog li.active").each(function () {
    $(this).children("ul").slideToggle();
  });
  /*$("div.left-menu-catalog i.fa").click(function(){
		alert();
		$(this).parent().find("ul").slideUp("fast");
		$(this).removeClass("fa-minus-square-o").addClass("fa-plus-square-o");
	});*/

  /*(window.location.href == "http://sfera.alex.otsite.com/o-nas/about-company.html") {
		$("ul.top-menu>li.last>a").html("Eng");
	} */

  /*$("a[data-catalog='true']").click(function(){
		$(this).parent().addClass("visible");
		$(this).parent().append($("div.hide-cm"));
		$("div.hide-cm").removeClass("hidden");
		return false;
	});	*/

  $("ul.top-menu a[data-catalog='true']").parent().append($("div.hide-cm"));
  $("a[data-catalog='true']")
    .parent()
    .hover(
      function () {
        //if($(this).attr("class") == "active") return;
        $(this).parent().addClass("visible");
        //$(this).parent().append($("div.hide-cm"));
        $("div.hide-cm").removeClass("hidden");
      },
      function () {
        $("div.hide-cm").addClass("hidden");
      }
    );

  $("div.hide-cm > ul > li").hover(
    function () {
      $menu = $(this).children("div.right-menu");
      if ($menu.find("ul").size() > 0) {
        $menu.css("display", "table");
      }
    },
    function () {
      $(this).children("div.right-menu").css("display", "none");
    }
  );

  $(document).click(function () {
    $("div.hide-cm").addClass("hidden");
  });
  var sync1 = $("#sync1");
  var sync2 = $("#sync2");
  sync1.owlCarousel({
    singleItem: true,
    slideSpeed: 1000,
    navigation: false,
    pagination: false,
    afterAction: syncPosition,
    responsiveRefreshRate: 200,
  });
  sync2.owlCarousel({
    items: 4,
    itemsDesktop: [1199, 10],
    itemsDesktopSmall: [979, 10],
    itemsTablet: [768, 8],
    itemsMobile: [479, 4],
    pagination: false,
    responsiveRefreshRate: 100,
    afterInit: function (el) {
      el.find(".owl-item").eq(0).addClass("synced");
    },
  });

  if (sync2.find(".owl-item").size() == 1) {
    sync2.addClass("hidden");
  }

  function syncPosition(el) {
    var current = this.currentItem;
    $("#sync2").find(".owl-item").removeClass("synced").eq(current).addClass("synced");
    if ($("#sync2").data("owlCarousel") !== undefined) {
      center(current);
    }
  }
  $("#sync2").on("click", ".owl-item", function (e) {
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo", number);
  });
  function center(number) {
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for (var i in sync2visible) {
      if (num === sync2visible[i]) {
        var found = true;
      }
    }
    if (found === false) {
      if (num > sync2visible[sync2visible.length - 1]) {
        sync2.trigger("owl.goTo", num - sync2visible.length + 2);
      } else {
        if (num - 1 === -1) {
          num = 0;
        }
        sync2.trigger("owl.goTo", num);
      }
    } else if (num === sync2visible[sync2visible.length - 1]) {
      sync2.trigger("owl.goTo", sync2visible[1]);
    } else if (num === sync2visible[0]) {
      sync2.trigger("owl.goTo", num - 1);
    }
  }

  $("ul.top-menu>li").eq(2).append($("div.hide-cm-2"));
  $("ul.top-menu>li")
    .eq(2)
    .hover(
      function () {
        $(this).parent().addClass("visible");
        $("div.hide-cm-2").removeClass("hidden");
      },
      function () {
        $("div.hide-cm-2").addClass("hidden");
      }
    );

  $(document).click(function () {
    $("div.hide-cm-2").addClass("hidden");
  });

  //tags-menu
  $(".tags-menu__btn-more").click(function () {
    $(".tags-menu li").addClass("visible");
    $(".tags-menu__btn-more").css("display", "none");
    $(".tags-menu__btn-hide").css("display", "inline-block");
  });

  $(".tags-menu__btn-hide").click(function () {
    $(".tags-menu li").removeClass("visible");
    $(".tags-menu__btn-more").css("display", "inline-block");
    $(".tags-menu__btn-hide").css("display", "none");
  });
});
