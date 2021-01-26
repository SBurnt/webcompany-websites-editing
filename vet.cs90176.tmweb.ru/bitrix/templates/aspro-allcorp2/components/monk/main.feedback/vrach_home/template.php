<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
//pr($arParams);
if ($USER->IsAuthorized()){
    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch();
}
?>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-6 content-md">
    <h2 class="short">Форма вызова врача</h2>
    <h4 class="mf-ok-text"></h4>
    <form action="<?= POST_FORM_ACTION_URI ?>" method="POST" id="vrach">
      <?= bitrix_sessid_post() ?>
      <div class="row">
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Фамилия *</label>
            <input type="text" value="<?= $arUser['LAST_NAME'] ?>" maxlength="100" class="form-control" name="user_fio" id="user_fio" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Имя *</label>
            <input type="text" value="<?= $arUser['NAME'] ?>" maxlength="100" class="form-control" name="user_name" id="user_name" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Отчество *</label>
            <input type="text" value="<?= $arUser['SECOND_NAME'] ?>" maxlength="100" class="form-control" name="user_otch" id="user_otch" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Телефон *</label>
            <input type="text" value="<?= $arUser['PERSONAL_PHONE'] ?>" maxlength="100" class="form-control" name="phone" id="phone" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>E-mail *</label>
            <input type="email" value="<?= $arUser["EMAIL"] ?>" maxlength="100" class="form-control" name="emale" id="email" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 15px;">
            <label>Адрес *</label>
            <input type="text" value="<?= $arUser['UF_CITY'] ?>" placeholder="нас. пункт" maxlength="100" class="form-control" name="nas_pynkt" id="nas_pynkt" required>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 15px;">
            <label style="color: transparent;">Район</label>
            <input type="text" value="<?= $arUser['UF_AREA'] ?>" placeholder="район" maxlength="100" class="form-control" name="region" id="region" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" value="<?= $arUser['UF_STREET'] ?>" placeholder="улица" maxlength="100" class="form-control" name="street" id="street" required>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="text" value="<?= $arUser['UF_HOUSE'] ?>" placeholder="дом" maxlength="100" class="form-control" name="home" id="home" required>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <input type="text" value="<?= $arUser['UF_APARTMENT'] ?>" placeholder="квартира" maxlength="100" class="form-control" name="kv" id="kv" required>
          </div>
        </div>
      </div>
      <?//pr($arUser);?>
      <div class="row">
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Вид животного *</label>
            <select class="form-control" id="UF_VID" name="UF_VID" data-php="/bitrix/templates/antistress/includes/<?= LANGUAGE_ID ?>/breed.php" data-block="#breed_reg" required>
              <option value="">Выберите вид животного</option>
              <?
                            if(CModule::IncludeModule("iblock")){
                                $rsVid = CIBlockSection::GetList(array('SORT'=>'ASC'), array("ACTIVE"=>"Y","IBLOCK_ID"=>"13"), false, array(), false);
                                while($arVid = $rsVid->GetNext()):?>
              <option value="<?= $arVid["ID"] ?>"><?= $arVid["NAME"] ?></option>
              <?endwhile;?>
              <?}?>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Порода *</label>
            <select class="form-control" name="UF_BREED" id="breed_reg" data-php="/bitrix/templates/antistress/includes/<?= LANGUAGE_ID ?>/breed.php" data-block="#new_breed" required>
              <option value="">Выберите породу</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group" id="new_breed"></div>
      </div>
      <div class="row">
        <div class="form-group">
          <!-- <label>Пол *</label> -->
          <div style="padding-left: 16px;">Пол *</div>
          <div class="col-md-3 col-sm-3 col-xs-5">
            <label><input style="margin-right: 10px;" type="radio" value="Самка" name="sex" required>Самка</label>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-5">
            <label><input style="margin-right: 10px;" type="radio" value="Самец" name="sex" required>Самец</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Кличка *</label>
            <input type="text" value="<?= $arUser["UF_NICK"] ?>" maxlength="100" class="form-control" name="UF_NICK" id="email" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Договор с ОДО "Антистресс *</label>
            <!-- select select_short select_shorter contract  -->
            <select class="form-control contract">
              <option value="have">Есть договор</option>
              <option value="not have">Нет договора</option>
            </select>
            <span class="form__sep hidden-sep">-</span>
            <!-- input input_short  -->
            <input type="text" class="form-control" name="UF_NOMER" value="<?= $arUser["UF_NOMER"] ?>" placeholder="№ договора">
            <script>
              $('select.contract').change(function() {
                var disp = $("select.contract option:selected").val() == "have" ? 'inline' : 'none';
                $('input[name="UF_NOMER"]').css('display', disp);
                $('span.hidden-sep').css('display', disp);
              }).change();
            </script>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Комментарий *</label>
            <textarea maxlength="5000" rows="10" placeholder="Укажите симптомы" class="form-control" name="comment" id="comment" style="height: 138px;" required></textarea>
          </div>
        </div>
      </div>
      <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <input type="submit" name="save" value="<?= GetMessage("MFT_SUBMIT") ?>" class="btn btn-default btn-lg" data-loading-text="Loading...">
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  function ajaxpostshow(urlres, datares, wherecontent) {
    $.ajax({
      type: "POST",
      url: urlres,
      data: datares,
      dataType: "html",
      success: function(fillter) {
        $(wherecontent).html(fillter);
      }
    });
  }
  $(document).on("change", "#UF_VID", function() {
    var formsubscrube = $(this).val(),
      target_block = $(this).data('block'),
      target_php = $(this).data('php');
    formsubscrube = 'ID=' + formsubscrube + '&action=ajax';
    ajaxpostshow(target_php, formsubscrube, target_block);
    return false;
  });
  $(document).on("change", "#breed_reg", function() {
    var formsubscrube = $(this).val(),
      target_block = $(this).data('block'),
      target_php = $(this).data('php');
    formsubscrube = 'ID=' + formsubscrube + '&action=ajax';
    ajaxpostshow(target_php, formsubscrube, target_block);
    return false;
  });
  $(document).on("submit", "#vrach", function(e) {
    e.preventDefault();
    var form = $('#vrach').serialize() + '&EMAIL_TO=' + '<?= $arParams['EMAIL_TO'] ?>' + '&OK_MESSAGE=' + '<?= $arParams['OK_TEXT'] ?>' + '&PHONE_TO=' + '<?= $arParams['PHONE_TO'] ?>';
    $.ajax({
      type: "POST",
      url: '/ajax/vrach.php',
      data: form,
      success: function(fillter) {
        $("html, body").animate({
          scrollTop: 0
        }, "slow");
        $('.mf-ok-text').html(fillter);
      }
    });
  });
</script>