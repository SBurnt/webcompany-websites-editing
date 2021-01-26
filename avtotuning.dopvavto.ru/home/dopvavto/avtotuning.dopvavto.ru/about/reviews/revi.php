<!--- popup modal --->
<div class="modal-window web-modal" id="rewiew">
    <div class="overlay"></div>
    <div class="wrapper">
        <div class="modal one-click-modal modal-review">
            <div class="close main_flex flex__align-items_center flex__jcontent_center">
                <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/cancel.svg" width="22">
            </div>
            <p class="rg account">Оставить отзыв магазину</p>
            <form action="" id="form--modal-2" >
                
                <div class="mess"></div>
                <div class="form__name clearfix">

                    <div class="flex__1">
                        <div class="form__name--p main_flex flex__jcontent_between">
                            <p class="rg">Оценка</p>
                            <div class="rating main_flex flex__align-items_center review-mark">
                                <label class="favorite_label">
                                    <img class="svg favorite1" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <input type="radio" name="favorite" value="1"/>
                                </label>
                                <label class="favorite_label">
                                    <img class="svg favorite2" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <input type="radio" name="favorite" value="2"/>
                                </label>
                                <label class="favorite_label">
                                    <img class="svg favorite3" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <input type="radio" name="favorite" value="3"/>
                                </label>
                                <label class="favorite_label">
                                    <img class="svg favorite4" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <input type="radio" name="favorite" value="4"/>
                                </label>
                                <label class="favorite_label">
                                    <img class="svg favorite5" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <input type="radio" name="favorite" value="5"/>
                                </label>
                            </div>
                        </div>
                        <div class="form__name--p main_flex flex__jcontent_between">
                            <p class="rg">Имя</p>
                            <input type="text" name="name_review" required>
                        </div>
                        <div class="form__name--p main_flex flex__jcontent_between">
                            <p class="rg">Отзыв</p>
                            <textarea style="height:130px; max-width: auto!important;" class="rg" name="comment_review" required></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <button class="abs review">Отправить</button>
        </div>
    </div>
</div>
<script>
    $('input[name="favorite"]').change(function () {
        for( let i = 1; i <= 5; i++){
            $('.favorite'+i).css('fill','#bec9d1');
        }
        var star = $(this).val();
        for( let i = 1; i <= star; i++){
            $('.favorite'+i).css('fill','#ffdb6b');
        }

    });
    $('.review').click(function () {
        var data = $('#form--modal-2').serialize();
        $.ajax({
            type: "POST",
            url: "/ajax/reviews.php",
            data: data,
            success: function(msg){
                // $('#form--modal-2').css('height','370px')
                $('#form--modal-2').css('height','490px')
                $('.mess').html(msg);
            }
        });
        return false;
    })
</script>
<!--- end popup modal --->





<style>
    .favorite_label {
        padding-right: 10px;
    }
    .modal-review .rating {
        height: 40px;
    }
    .favorite_label > input{
        display: none;
        opacity: 0;
    }
    .modal-review .rating, .modal-review .form__name .form__name--p textarea, .modal-review .form__name .form__name--p input
    {max-width: 100%!important;
        width: 100%;
    }
    .review-content .review-btn {
        margin: 25px auto 17px auto;
    }
</style>