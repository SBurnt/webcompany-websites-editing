<div class="popup js-popup" id="complaint-popup">
    <div class="popup-body">
        <button class="popup-close-button js-popup-close-button" type="button"></button>

        <div class="popup-content complaint-content">
            <div class="complaint-popup is-active js-complaint-popup">
                <h3 class="complaint-popup-title">Напишите нам, если вас что-то не устроило.<br/> Ваше мнение важно для нас.</h3>

                <form class="contacts-feedback-form js-complaint-feedback-form" action="/local/ajax/complaint.php" enctype="multipart/form-data" method="post">
                    <div class="contacts-feedback-form-content complaint-form-content">
                        <div class="contacts-feedback-form-item">
                            <label class="contacts-feedback-form-label" for="contacts-feedback-name-input">
                                Ваше имя
                                <span class="contacts-feedback-form-label-required-mark">*</span>
                            </label>
                            <input class="contacts-feedback-form-input" id="contacts-feedback-name-input" name="contacts-feedback-name-input" value="" type="text">
                        </div>

                        <div class="contacts-feedback-form-item">
                            <label class="contacts-feedback-form-label" for="contacts-feedback-email-input">
                                E-mail
                                <span class="contacts-feedback-form-label-required-mark">*</span>
                            </label>
                            <input class="contacts-feedback-form-input js-complaint-form-input" id="contacts-feedback-email-input" name="contacts-feedback-email-input" type="email">
                        </div>

                        <div class="contacts-feedback-form-item">
                            <label class="contacts-feedback-form-label" for="contacts-feedback-message-input">
                                Сообщение
                                <span class="contacts-feedback-form-label-required-mark">*</span>
                            </label>
                            <textarea class="contacts-feedback-form-textarea" id="contacts-feedback-message-input" name="contacts-feedback-message-input"></textarea>
                        </div>

                        <div class="contacts-feedback-form-documents-upload js-feedback-form-files-upload" data-bem-class="contacts-feedback-form-documents-upload">
                            <label class="contacts-feedback-form-documents-upload-button" for="contacts-feedback-file-input">Прикрепить вложение</label>

                            <div class="contacts-feedback-form-document contacts-feedback-form-document_hidden js-feedback-form-file-template" data-bem-class="contacts-feedback-form-document">
                                <p class="contacts-feedback-form-document-name js-feedback-form-file-name"></p>
                                <input class="contacts-feedback-form-document-input js-feedback-form-file-input" id="contacts-feedback-file-input" name="contacts-feedback-file-input[]" type="file">
                            </div>
                        </div>

                        <button class="contacts-feedback-form-submit-button" type="submit">Отправить</button>
                    </div>

                </form>
            </div>

            <div class="complaint-popup complaint-popup-success js-complaint-success">
                <h3 class="complaint-popup-title">Спасибо! <br/> Ваша претензия отправлена.</h3>
            </div>

            <div class="complaint-popup complaint-popup-error js-complaint-error">
                <h3 class="complaint-popup-title">Что-то пошло не так! <br/> Пожалуйста повторите отправку.</h3>
            </div>
        </div>
    </div>
</div>