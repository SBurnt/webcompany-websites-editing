/**
 * @var {object} settingsWidget - vuejs object
 */

BX.addCustomEvent('settings.widget', function(){
	window.templateSettings = new function () {
		var self = this;
		self.$items = {};

		/**
		 * Обработка изменений виджета настроек
		 * @param field - поле которое изменилось
		 * @param item - элемент который изменился (ex. поле типа 'blocks')
		 */
		self.onChangeField = function (field, item) {
			//console.log(field);

			var $items = self.$items[field.code] || $([]);
			var isItems = typeof $items !== 'undefined';
			var value = field.value;

			/**
			 * Фильтрует элементы по data-settings-rel='rel'
			 * Если rel не указан, возвращает только элементы без data-settings-rel
			 * @param [rel]
			 * @return {Object}
			 */
			var $getFilterItems = function (rel) {
				return $items.filter(function () {
					var widgetRels = $( this ).data( 'settings-rel' ).split(',');
					return widgetRels.indexOf(rel) >= 0;
				});
			};

			var $getFilteredParentItemsForHide = function ($elements, rel) {
				return $elements.filter(function () {
					var widgetRels = $(this).data('settings-rel').split(',');
					if (widgetRels.length > 1) {
						var $tmp = $(this).find('[data-settings-rel]:visible');
						if ($tmp.length > 1) {
							return false;
						}
					}
					return true;
				});
			};

			/**
			 * Скрывает или показывает родительский блок для поля
			 * Ищет по коду data-settings-container
			 * @param hide
			 */
			var isContainerChecked = false;
			var toggleSettingsContainer = function () {
				if (isContainerChecked) return;

				var hide = false;

				switch (field.type) {
					case 'checkbox':
						hide = !field.checked;
						break;
					case 'text':
						hide = value.length === 0;
						break;
					default:
                    	//colorScheme, avatar, text, checkbox, select, blocks
						return;
				}

				var $containers = $('[data-settings-container='+field.code+']');

				if ($containers.length) {
					$containers[hide ? 'addClass' : 'removeClass']('hidden');
				}
				isContainerChecked = true;
			};

			var $valueItems;
			if (typeof item !== 'undefined') {
				$valueItems = $getFilterItems(item.value);
			}

            switch (field.code) {
				case 'SCHEME_LOGO':
					$items.attr('src', value);
					break;
				case 'SCHEME_FAVICON':
					$items.attr('href', value);
					break;
				case 'SCHEME':
					//add css
					if (field.settings.FILES.css) {
						for (var cssFileName in field.settings.FILES.css) {
							var $link = $('[data-scheme-css="' + cssFileName +'"]');
							if (!$link.length) {
								$link = $('<link data-scheme-css="'+ cssFileName +'" rel="stylesheet" href="">');
								$('head').append($link);
							}
							$link.attr('href', field.settings.FILES.css[cssFileName]);
						}
					}
					window.citrusTemplateColor = value;
					window.citrusMapIcon.href = field.settings.FILES.png['map.png'];
					BX.onCustomEvent(field, 'SCHEME');
					break;
				case 'LOGO':
					// set in 'SCHEME_LOGO'
					break;
				case 'SITE_NAME':
					var arText = value.split(' ');
					$getFilterItems('text2').html(arText.pop());
					$getFilterItems('text1').html(arText.join(' '));
					$getFilterItems().html(value);
					break;
				case 'EMAIL':
                    $items.html(value);
                    $items.attr('href', 'mailto:'+value);
					break;
				case 'PHONE':
                case 'PHONE2':
					var clearValue = value.replace(/[^\d\+]/g,"");
                    $items.attr('href', 'tel:'+clearValue).html(value);
					break;
				case 'LOGO_SHOW_TEXT':
					$items[field.checked ? 'addClass' : 'removeClass']('with_desc');
					break;
				case 'CURRENCY':
					if (typeof currency !== 'undefined')
						currency.setCurrent(value, true, true);
					break;
				case 'CURRENCY_FACTOR':
					if (typeof currency !== 'undefined')
						currency.setCurrentFactor(value);
					break;
				default:
					if (!isItems) return;
					switch (field.type) {
						case 'checkbox':
							$items[field.checked ? 'removeClass' : 'addClass']('hidden');
							break;
						case 'select':
							break;
						case 'blocks':
							if (typeof $valueItems !== 'undefined') {
								if (item.checked) {
									$valueItems.addClass('settings-prepare-visible');
								} else {
									//TODO!!! подсчитать видимые блоки внутри блока - и убрать из массива  если хотя бы 1 блок видимый
									$valueItems = $getFilteredParentItemsForHide($valueItems, item.value);
									//console.log(item.checked, $valueItems);
								}
								$valueItems
									[item.checked ? 'slideDown': 'slideUp']('fast', function () {
									$valueItems.trigger('changeVisible', item.checked);
									if (item.checked) {
										$valueItems.removeClass('settings-prepare-visible');
										// после показа нужно вызвать триггер resize для обновления слайдеров
										window.dispatchEvent(new Event('resize'));
									}
								});
							} else {
								field.values.forEach(function (item) {
									self.onChangeField(field, item);
								});
							}
							break;
						default:
							$items.html(value)
								[value.length ? 'removeClass' : 'addClass']('hidden');
							break;
					}
					break;
			}
			toggleSettingsContainer();
		};
		settingsWidget.$on('change', self.onChangeField);

		// для неактивных блоков ставим display:none;
		self.checkAvalibleBlock = function(fieldRel){
			if (typeof settingsWidget === 'undefined') return;

			var $item = $('[data-settings="BLOCKS"][data-settings-rel="'+fieldRel+'"]');
			if (!$item.length) return;

			var settingsField = settingsWidget.getFieldByCode('BLOCKS');
			if (typeof settingsField !== 'undefined' && settingsField.values.length) {

				var blocks = settingsField.values;
				var fieldValueForCode = blocks.filter(function (fieldValue) {
					return fieldValue.value === fieldRel;
				});

				if (fieldValueForCode.length > 0 && !fieldValueForCode[0].checked)
					$item.hide();
			}
		};

		$(function(){
		   $('[data-settings]').each(function (index, item) {
		   	    var arSettingsName = $(this).data('settings').split(';');
			   arSettingsName.forEach(function (settingsName) {
				   if (!self.$items[settingsName]) {
					   self.$items[settingsName] = $(item);
				   } else {
					   self.$items[settingsName] = self.$items[settingsName].add($(item));
				   }
			   });
		   });

			// убираем скрытые блоки

		});
	};
});

$(function () {
    var updateSelectedLocality = function (coords) {
        var $mapLink = $('#js-settings-widget-arealty-map-link');
        var $selected = $mapLink.find('.map-link__address');
        try
        {
            coords = coords || $mapLink.data('coords');
        }
        catch (e) {
            coords = [55.751574, 37.573856];
        }
        if (coords) {
            ymaps.geocode(coords, {
                kind: 'locality',
                results: 1
            }).then(function (res) {
                var geo = res.geoObjects.get(0);
                $selected.text(geo
                    ? geo.getLocalities().join(', ')
                    : BX.message('CITRUS_AREALTY_SETTINGS_WIDGET_COORDS_NOT_SELECTED')
                );
            });
        } else {
            $selected.text(BX.message('CITRUS_AREALTY_SETTINGS_WIDGET_COORDS_NOT_SELECTED'));
        }
    };

    BX.addCustomEvent('settings.widget.tabChanged', function (e) {
        updateSelectedLocality();
    });

    $('body').on('click', '#js-settings-widget-arealty-map-link', function () {
        var $this = $(this);

        var mapItem = {
            address: $this.data('address'),
            coord: JSON.parse($this.attr('data-coords')),
            body: $this.data('body') || $this.data('address'),
            header: $this.data('header'),
            footer: $this.data('footer'),
        };

        if (mapItem.coord || mapItem.address.length)
            $.magnificPopup.open({
                items: {
                    src: '<div class="citrus-objects-map" id="magnificPopupMap" style="width: 100%;height: 100%;"></div>',
                },
                mainClass: 'full-screen-map mfp-with-zoom',
                alignTop: false,
                closeOnContentClick: false,
                callbacks: {
                    open: function () {
                        this.wrap.on('click', function (e) {
                            e.stopPropagation();
                        });
                        $().citrusObjectsMap({
                            id: 'magnificPopupMap',
                            items: [mapItem],
                            controls: ['largeMapDefaultSet'],
                            collapseButton: false,
                            canSelect: true,
                            onReady: function () {
                                var noteBtn = new ymaps.control.Button({
                                        data: {
                                            content: BX.message('CITRUS_AREALTY_SETTINGS_WIDGET_COORDS_NOTE'),
                                            //image: "ya.png"
                                        },
                                        options: {
                                            maxWidth: 350,
                                            size: 'large',
                                            selectOnClick: false,
                                            enabled: false,
                                            float: 'right',
                                        }
                                    }
                                );

                                var controls = this.yamap.controls;
                                ['routeEditor', 'rulerControl', 'trafficControl', 'typeSelector'].forEach(function (ctl) {
                                    controls.remove(ctl);
                                });
                                controls.add(noteBtn);
                            },
                            onError: function () {
                                console.log('map error');
                                $.magnificPopup.close();
                            },
                            onEmptyObject: function () {
                                $('#magnificPopupMap').html('No item');
                                setTimeout($.magnificPopup.close, 400);
                            },
                            onSelectCoords: function (coords) {
                                var value = coords.join(',');
                                var vm = window.settingsWidget;
                                var field = vm.getFieldByCode('COORDS');

                                if (!vm.changedFieldCodes.includes(field.code))
                                    vm.changedFieldCodes.push(field.code);

                                field.value = value;
                                vm.$emit('change', field);

                                $this.attr('data-coords', JSON.stringify(coords));

                                updateSelectedLocality(coords);
                            }
                        })
                    }
                }
            });
    });
});
