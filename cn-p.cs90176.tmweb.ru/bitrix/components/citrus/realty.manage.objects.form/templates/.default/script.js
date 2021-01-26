BX.ready(function () {
	var table = $(".bx-edit-tab");
	if (table.length === 0) {
		return;
	}
	var selectSection = document.querySelector(".js-citrus-arealty-kabinet-select-section");
	if (!selectSection) {
		return;
	}

	function hideEmptyTabs() {
    $('table.bx-edit-table').each(function () {
      var $this = $(this),
          hasActiveInputs = $this.find('tr._visible').length > 0,
          tabId = $this.parents('.bx-edit-tab-inner').data('tabId');

      if (tabId)
      {
        $('#tab_cont_' + tabId).toggle(hasActiveInputs);
      }
    });
  }

	function updateFields(sectionId) {
		var url = "/bitrix/components/citrus/realty.manage.objects.form/api.section_props.php";

    $.ajax({
      dataType: "json",
      url: url,
      cache: true,
      data: {
        "IBLOCK_ID": window.CitrusRealtyManageObjectsForm_IBLOCK_ID,
        "IBLOCK_SECTION": sectionId
      },
      success: function (sectionProps) {
        if (sectionProps == null) {
          return;
        }
        table.find('[data-realty-form-input="1"]').each(function (idx) {
          var $this = $(this),
              blockInput = $this.closest("tr"),
              propertyId = $this.data('propertyId');

          if (propertyId)
          {
            blockInput
              .toggleClass('_visible', !!sectionProps[propertyId])
              .toggle(!!sectionProps[propertyId]);
          }
        });

        hideEmptyTabs();
      }
    });
	}

  $(selectSection).on('change', function () {
    updateFields(this.value);
  });

	// need a delay for components' ajax-mode: BX.ready fires before inline scripts execution (#47389)
	window.setTimeout(function () {
		updateFields(selectSection.value);
  }, 1);

});
