var width = $(window).width();
if (width > 710) {
  $(".menu-link-a").on("click", function (e) {
    e.preventDefault();
    $(this).parent().toggleClass("active");
    $(this).find(">:first-child").toggleClass("mark");
    $(this).find(">:first-child").toggleClass("fa-bookmark");
    $(this).find(">:first-child").toggleClass("fa-bookmark-o");

  });
}

if (width <= 710) {
  $(".menu > li > .menu-link-a").on("click", function (e) {
    e.preventDefault();
    $(this).parent().toggleClass("active");
    $(this).find(">:first-child").toggleClass("mark");
    $(this).find(">:first-child").toggleClass("fa-bookmark");
    $(this).find(">:first-child").toggleClass("fa-bookmark-o");
  });
}

$("#carousel").flexslider({
  animation: "slide",
  controlNav: false,
  animationLoop: true,
  slideshow: false,
  itemWidth: 80,
  itemMargin: 15,
  asNavFor: "#slider",
});

$("#slider").flexslider({
  animation: "slide",
  controlNav: false,
  animationLoop: true,
  slideshow: true,
  slideshowSpeed: 7000,
  sync: "#carousel",
  start: function (slider) {
    $("body").removeClass("loading");
  },
});
