$(function() {
	$('.window.catalog.alt ul li > span').click(function() {
        if($(this).hasClass('on')){
            $(this).removeClass('on');
            $(this).next('div').hide();
            $(this).text('+');
        }
        else {
            $(this).addClass('on');
            $(this).next('div').show();
            $(this).text('-');
        }
    });
    $("div.buttons").on("hover","li.firstLevel",function(){
        var height = $("ul.main-catalog-ul").height() - 34;
        $(this).find(".window.catalog.alt").css("min-height",height+"px");
    });
});