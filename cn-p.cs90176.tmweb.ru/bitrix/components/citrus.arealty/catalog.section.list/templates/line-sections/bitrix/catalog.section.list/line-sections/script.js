;(function () {
    $(function () {
        $('.js-line-sections-button').on('click', function () {
            var $mobile = $(this).parent(),
                $lineSections = $mobile.siblings('.line-sections:not(._mobile)'),
                $modalContainer = $mobile.siblings('.modal-content'),
                $modalBody = $modalContainer.find('.modal-body');

            $modalBody.html($lineSections.clone());

            $.magnificPopup.open({
                items: {
                    src: $modalContainer,
                },
                callbacks: {
                    close: function () {
                        $modalBody.empty();
                    }
                }
            });
        });
    });

})();