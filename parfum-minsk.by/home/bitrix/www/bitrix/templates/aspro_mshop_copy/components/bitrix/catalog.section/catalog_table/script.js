
$(document).ready(function(){
    $(".show-more-description").click(function(e){
        e.preventDefault();
        var text = $(".full-text");
        if(text.css("height") == text.data("height")){
            text.css("height", "100%");
            $(this).text($(this).data("to-short"));
        }
        else{
            text.css("height", text.data("height"));
            $(this).text($(this).data("to-full"));
        }
    });
});