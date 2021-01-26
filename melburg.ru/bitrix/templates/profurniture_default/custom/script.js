$(document).ready(function () {
  console.log("reeeeeeeeeeeeeeeee");
  var $list = $(".menu-sidebar");
  var $showLink = $(".js-show-more-menu-sidebar");
  var $li = $list.find("li").not(".js-show-more-menu-sidebar");
  var linksWidth = $showLink.width() + 5;
  var delta = $list.width() - $showLink.width();

  $li.each(function () {
    var $this = $(this);

    linksWidth += $this.outerWidth(true);

    if (linksWidth > delta) {
      $this.addClass("js-hide");

      $showLink.removeClass("js-invisible");
    }
  });

  $li.removeClass("js-link");

  $showLink.on("click", function () {
    var $hidedLinks = $(".js-hide");

    $hidedLinks.toggle();

    $(this).text($hidedLinks.is(":visible") ? "Скрыть" : "Показать все");

    $list.toggleClass("one-line");
  });
});
