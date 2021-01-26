(function (exports) {
    'use strict';

    /**
     * @typedef SmartFilterStationCheckbox
     * @type {object}
     * @property {string} [CHECKED] Станция выбрана
     * @property {string} [DISABLED] Станция не может быть выбрана (не будет результата фильтрации с учетом других критериев)
     * @property {string} CONTROL_ID
     * @property {string} CONTROL_NAME
     * @property {string} CONTROL_NAME_ALT
     * @property {string} HTML_VALUE
     * @property {string} HTML_VALUE_ALT
     * @property {string} VALUE — Название станции из справочника
     * @property {number} SORT
     * @property {string} UPPER - Название станции из справочника в верхнем регистре
     * @property {boolean} FLAG
     * @property {string} URL_ID
     * @property {string} FACET_VALUE
     * @property {number} ELEMENT_COUNT - Количество объектов с этой станцией
     **/

    /**
     * Описание станции из входных параметров компонента Vue (и из справочника АСАН)
     * @typedef AsanMetroStation
     * @type {object}
     * @property {numeric} ID ID станции в справочнике АСАН
     * @property {numeric} CITY_ID ID города в справочнике АСАН
     * @property {string} NAME Название станции
     * @property {number[]} LINE Идентификаторы веток, на которых находится станция
     * @property {string} SVG_ID ID элемента со станцией на карте (в svg)
     * @property {boolean} [isActive] Станция активна (кликабельна)
     * @property {boolean} [isStation] Используется для разделения станций и веток (@todo но ветки должны быть отдельно!?)
     * @property tippy ???
     * @property {SVGElement} mapGroup Элемент на карте
     **/

    /**
     * Описание станции из входных параметров компонента Vue (и из справочника АСАН)
     * @typedef AsanMetroLine
     * @type {object}
     * @property {numeric} ID ID ветки в справочнике АСАН
     * @property {numeric} CITY_ID ID города в справочнике АСАН
     * @property {string} NAME Название ветки
     * @property {string} SVG_ID ID элемента с веткой на карте (в svg)
     * @property {string} COLOR Цвет ветки (css)
     * @property {'Y'|'N'} IS_GROUP Является условной группой станций или официальной веткой?
     * @property {boolean} disable Ветка не активна (на ней нет активных стацний?)
     **/

    /**
     * @typedef MetroComponentViewModel
     * @type object
     * @property {AsanMetroStation[]} vm.stations - Станции из справочника АСАН
     * @property {AsanMetroLine[]} vm.lines - Линии (ветки) метро из справочника АСАН
     * @property {object} vm.lang - языковые фразы
     * @property {object} vm.popup - Всплывающие списки в поиске или селекте
     * @property {string} vm.searchText - Строка поиска
     * @property {array} vm.result - Результат выбора метро
     */
    var vm;
    Vue.component('metro', {
      template: "#metro-template",
      props: ['stations', 'lines', 'lang', // доступные для выбора станции из компонента bitrix:catalog.smart.filter (копируются в this.checkboxLocal, и обновляются ajax-ом через событие citrus-filter-start-json-load)
      'checkbox', // режим для разработки и тестирования корректности заполнения справочников и точек на карте
      'debug'],
      data: function data() {
        return {
          popup: {
            'metro-lines': false,
            'metro-search-result': false
          },
          searchText: '',
          maxSearchResult: 10,
          searchHighlightIndex: -1,
          selectedStations: [],
          result: [],
          backupResult: [],
          activeTippy: {},
          checkboxLocal: this.checkbox,
          stationsMissingFromSvg: [],
          stationsWithSeveralMatchingSvgIds: []
        };
      },
      created: function created() {
        vm = this;
      },
      computed: {
        searchStations: function searchStations() {
          if (!vm.searchText.length) return [];
          var searchStations = vm.stations.filter(function (station) {
            var stationName = station.NAME.toLowerCase();
            return stationName.indexOf(vm.searchText.toLowerCase()) > -1 || stationName.indexOf(vm.autoReplaceKeyboard(vm.searchText.toLowerCase())) > -1;
          });
          if (searchStations.length > vm.maxSearchResult) searchStations.splice(vm.maxSearchResult - 1, searchStations.length - vm.maxSearchResult);
          return searchStations;
        },
        activeSearchStations: function activeSearchStations() {
          return vm.searchStations.filter(function (station) {
            return station.isActive;
          });
        },
        // если все станции ветки выбраны то выбираем ветку
        // и удаляем из результата все станции ветки
        formatResult: function formatResult() {
          var checkedLineIds = [];
          var result = [];
          var excludeStations = [];
          vm.result.forEach(function (station, resultKey) {
            station.LINE.forEach(function (lineId) {
              if (checkedLineIds.indexOf(lineId) > -1) return;
              checkedLineIds.push(lineId);
              var lineStation = vm.getStationsByLineId(lineId);
              var resultLineStation = vm.result.filter(function (station1) {
                return station1.LINE.indexOf(lineId) > -1 && station1.isActive;
              });

              if (lineStation.length === resultLineStation.length && lineStation.length >= 1) {
                result = result.concat(vm.getLinesById(lineId));
                excludeStations = excludeStations.concat(lineStation);
              }
            });
            if (excludeStations.indexOf(station) === -1) result.push(station);
          });
          return result;
        },
        activeStations: function activeStations() {
          return vm.stations.filter(function (station) {
            return vm.checkboxLocal.filter(function (cb) {
              return cb.VALUE === station.NAME && !cb.DISABLED;
            }).length > 0;
          });
        },
        activeLines: function activeLines() {
          return vm.lines.map(function (line) {
            line.disable = vm.getStationsByLineId(line.ID).length < 1;
            return line;
          });
        }
      },
      methods: {
        /**
         * Добавляет активные станции на карту
         * @param {object} item - станция или ветка
         */
        addToSvg: function addToSvg(item) {
          item = [].concat(item);
          item.forEach(function (oneItem) {
            if (oneItem.isStation) {
              $(oneItem.mapGroup).addClass('_active');
            } else {
              // @todo мы тут можем оказаться? addToSvg не вызывается для веток (isStation === false)
              vm.addToSvg(vm.getStationsByLineId(oneItem.ID));
            }
          });
        },
        removeFromSvg: function removeFromSvg(item) {
          item = [].concat(item);
          item.forEach(function (oneItem) {
            if (oneItem.isStation) {
              $(oneItem.mapGroup).removeClass('_active');
            } else {
              vm.removeFromSvg(vm.getStationsByLineId(oneItem.ID));
            }
          });
        },
        removeFromResult: function removeFromResult(arItems) {
          arItems = [].concat(arItems);
          arItems.forEach(function (oneItem) {
            if (oneItem.isStation) {
              vm.removeFromSvg(oneItem);
              vm.$delete(vm.result, vm.result.indexOf(oneItem));
            } else {
              var lineStations = vm.getStationsByLineId(oneItem.ID); // удаляются только станции которых нет в других выбранных ветках
              // (для станций в нескольких группах)
              // но станций должно быть больше 1

              lineStations = lineStations.filter(function (station) {
                var result = vm.formatResult.filter(function (resultLine) {
                  return !resultLine.isStation && resultLine.ID !== oneItem.ID && station.LINE.indexOf(resultLine.ID) > -1;
                });
                return result.length <= 1;
              });
              vm.removeFromResult(lineStations);
            }
          });
        },
        addToResult: function addToResult(arItems) {
          arItems = [].concat(arItems);
          arItems.forEach(function (oneItem) {
            if (vm.inResult(oneItem)) return;

            if (oneItem.isStation) {
              vm.result.unshift(oneItem);
              vm.addToSvg(oneItem);
            } else {
              if (!oneItem.disable) vm.addToResult(vm.getStationsByLineId(oneItem.ID));
            }
          });
        },
        inResult: function inResult(item) {
          return vm.result.indexOf(item) > -1 || vm.formatResult.indexOf(item) > -1;
        },

        /**
         * добавляет в результат
         * @param {object} item - станция или ветка
         */
        toggleResult: function toggleResult(item) {
          vm[vm.inResult(item) ? 'removeFromResult' : 'addToResult'](item);
        },

        /* выбор станции из поиска */
        onClickSearchResult: function onClickSearchResult(station, event) {
          if (!station.isActive) {
            if (vm.activeTippy.destroyAll) {
              vm.activeTippy.destroyAll();
              vm.activeTippy = {};
            }

            var o = event.target;
            console.log('tippy', tippy);
            station.tippy = vm.activeTippy = tippy(o, {
              placement: 'bottom-start',
              performance: true,
              trigger: 'custom',
              zIndex: 9999
            });
            setTimeout(function () {
              o._tippy.show();
            }, 0);
            setTimeout(function () {
              station.tippy.destroyAll();
            }, 1000);
            return;
          }

          vm.searchText = '';
          vm.searchHighlightIndex = -1;
          if (typeof station !== 'undefined') vm.addToResult(station);
        },

        /**
         * Изменение подвеченной в результатах поиска станции
         *
         * @param {number} index На какой количество позиций сместить порядковый номер (индекс) подсвеченной станции (+ или -)
         */
        highlightSearchResult: function highlightSearchResult(index) {
          var resultLength = vm.activeSearchStations.length;
          if (!resultLength) return;
          var startSearchIndex = vm.searchHighlightIndex;
          vm.searchHighlightIndex += index;

          if (index < 0 && startSearchIndex === -1) {
            vm.searchHighlightIndex = resultLength - 1;
          }

          if (vm.searchHighlightIndex > resultLength) vm.searchHighlightIndex = -1;
          if (vm.searchHighlightIndex < -1) vm.searchHighlightIndex = -1;
        },

        /**
         * Выбор станции, подсвеченной в результатах поиска или единственной в результатах поиска
         */
        clickHighlightResultItem: function clickHighlightResultItem() {
          vm.onClickSearchResult(vm.activeSearchStations.length === 1 ? vm.activeSearchStations[0] : vm.activeSearchStations[vm.searchHighlightIndex]);
        },
        getLinesById: function getLinesById(arId) {
          arId = [].concat(arId);
          return vm.lines.filter(function (line) {
            return arId.indexOf(line.ID) > -1;
          });
        },
        getStationsByLineId: function getStationsByLineId(lineId) {
          return vm.activeStations.filter(function (station) {
            return station.LINE.indexOf(lineId) > -1;
          });
        },
        togglePopup: function togglePopup(popupName) {
          vm.popup[popupName] = !vm.popup[popupName];
        },
        openPopup: function openPopup(popupName) {
          vm.popup[popupName] = true;
        },
        hidePopup: function hidePopup(popupName) {
          vm.popup[popupName] = false;
        },
        saveBackUpResult: function saveBackUpResult() {
          vm.backupResult = vm.result.reduce(function (ar, resultItem) {
            ar.push(resultItem);
            return ar;
          }, []);
        },
        resetResult: function resetResult() {
          vm.removeFromResult(vm.result);
          vm.addToResult(vm.backupResult);
        },
        saveResult: function saveResult() {
          vm.saveBackUpResult();
          $.magnificPopup.close();
          smartFilter.updateDuplicate();
          smartFilter.reload();
        },
        inResultStationName: function inResultStationName(stationName) {
          return vm.result.filter(function (resultItem) {
            return resultItem.NAME === stationName;
          }).length > 0;
        },
        autoReplaceKeyboard: function autoReplaceKeyboard(str) {
          var replacer = vm.lang['AUTO_REPLACE_EN_RU'];
          return str.replace(/[A-z/,.;\'\]\[]/g, function (x) {
            return x == x.toLowerCase() ? replacer[x] : replacer[x.toLowerCase()].toUpperCase();
          });
        },
        getStationsByName: function getStationsByName(name) {
          return vm.stations.filter(function (station) {
            return station.NAME === name;
          });
        },

        /**
         * Инициализация точки станции на svg карты
         *
         * @param {AsanMetroStation} station
         **/
        processStation: function processStation(station) {
          station.isActive = !!this.debug || vm.checkboxLocal.filter(function (cb) {
            return cb.VALUE === station.NAME && !cb.DISABLED;
          }).length > 0;
          var $mapGroup = $(vm.$map).find("#".concat(station.SVG_ID));
          station.mapGroup = $mapGroup.get(0);

          if (vm.debug) {
            if ($mapGroup.length <= 0) {
              vm.stationsMissingFromSvg.push(Object.assign({}, station));
            } else if ($mapGroup.length > 1) {
              vm.stationsWithSeveralMatchingSvgIds.push(Object.assign({}, station));
            } else if (station.mapGroup) {
              var nameInRef = station.NAME.replace("\u0451", "\u0435");
              var nameOnMap = station.mapGroup.textContent.trim().replace(/\s+/g, ' ').replace("\u0451", "\u0435");

              if (nameOnMap.toUpperCase().replace(/\s+/g, '') !== nameInRef.toUpperCase().replace(/\s+/g, '')) {
                console.warn("\u041D\u0430\u0437\u0432\u0430\u043D\u0438\u0435 \u0441\u0442\u0430\u043D\u0446\u0438\u0438 \u0438\u0437 \u0441\u043F\u0440\u0430\u0432\u043E\u0447\u043D\u0438\u043A\u0430 (".concat(nameInRef, ") \u043D\u0435 \u0441\u043E\u0432\u043F\u0430\u0434\u0430\u0435\u0442 \u0441 \u043D\u0430\u0437\u0432\u0430\u043D\u0438\u0435\u043C \u043D\u0430 \u043A\u0430\u0440\u0442\u0435 (").concat(nameOnMap, ")"), station.mapGroup);
              }
            }
          }

          if (station.isActive) $mapGroup.addClass('_clickable');else $mapGroup.removeClass('_clickable');
          $mapGroup.find('text').addClass('metro-map-name');
          return station;
        }
      },
      mounted: function mounted() {
        cui.clickOff($(vm.$refs.popupLinesLabel).add($(vm.$refs.popupLines)), function () {
          vm.hidePopup('metro-lines');
        });
        cui.clickOff($(vm.$refs.searchInput).add($(vm.$refs.searchResult)), function () {
          vm.hidePopup('metro-search-result');
        });
        /** элемент с svg карты */

        vm.$map = $('#metro-map-container'); // привязка станций к точкам из справочника

        Vue.nextTick(function () {
          if (vm.debug) {
            console.info("\u0421\u0442\u0430\u043D\u0446\u0438\u0438 \u0438\u0437 \u0441\u043F\u0440\u0430\u0432\u043E\u0447\u043D\u0438\u043A\u0430 (vm.stations)", vm.stations);
            console.log("\u0421\u0442\u0430\u043D\u0446\u0438\u0438 \u0434\u043E\u0441\u0442\u0443\u043F\u043D\u044B\u0435 \u0434\u043B\u044F \u0432\u044B\u0431\u043E\u0440\u0430 \u0432 \u0444\u0438\u043B\u044C\u0442\u0440\u0435 (vm.checkboxLocal)", vm.checkboxLocal);
          }
        });
        vm.stations.map(function (station) {
          vm.processStation(station);
          station.isStation = true;
          $(station.mapGroup).addClass('metro-map-group').on('click', function (event) {
            if (station.isActive) vm.toggleResult(station);
          });
          var grouppedStations = $(station.mapGroup).find('g');
          var $stationGroup = grouppedStations.length ? grouppedStations : $(station.mapGroup);
          $stationGroup.each(function () {
            $(this).find('circle,ellipse').last().addClass('metro-map-point');
          });
          return station;
        });
        Vue.nextTick(function () {
          if (vm.debug) {
            if (vm.stationsMissingFromSvg.length) {
              console.warn("\u0412 \u0441\u043F\u0440\u0430\u0432\u043E\u0447\u043D\u0438\u043A\u0435 \u043D\u0430\u0439\u0434\u0435\u043D\u044B \u0441\u0442\u0430\u043D\u0446\u0438\u0438, \u043A\u043E\u0442\u043E\u0440\u044B\u0445 \u043D\u0435\u0442 \u0432 svg (vm.stationsMissingFromSvg)");
              console.table(vm.stationsMissingFromSvg.map(function (o) {
                return JSON.parse(JSON.stringify(o));
              }));
            }

            if (vm.stationsWithSeveralMatchingSvgIds.length) {
              console.warn("\u0412 \u0441\u043F\u0440\u0430\u0432\u043E\u0447\u043D\u0438\u043A\u0435 \u043D\u0430\u0439\u0434\u0435\u043D\u044B \u0441\u0442\u0430\u043D\u0446\u0438\u0438, \u0434\u043B\u044F \u043A\u043E\u0442\u043E\u0440\u044B\u0445 \u043D\u0430 \u043A\u0430\u0440\u0442\u0435 \u0435\u0441\u0442\u044C \u043D\u0435\u0441\u043A\u043E\u043B\u044C\u043A\u043E \u043F\u043E\u0434\u0445\u043E\u0434\u044F\u0449\u0438\u0445 \u0438\u0434\u0435\u043D\u0442\u0438\u0444\u0438\u043A\u0430\u0442\u043E\u0440\u043E\u0432 (vm.stationsWithSeveralMatchingSvgIds)");
              console.table(vm.stationsWithSeveralMatchingSvgIds.map(function (o) {
                return JSON.parse(JSON.stringify(o));
              }));
            }

            var idsOnMap = babelHelpers.toConsumableArray(vm.$map.get(0).querySelectorAll('[id]')).map(function (el) {
              return el.id;
            }),
                allIdsCount = idsOnMap.length,
                removeFromIdsOnMap = function removeFromIdsOnMap(item) {
              var idx = idsOnMap.findIndex(function (id) {
                return id === item.SVG_ID;
              });

              if (idx >= 0) {
                idsOnMap.splice(idx, 1);
              }
            };

            vm.stations.forEach(removeFromIdsOnMap);
            vm.lines.forEach(removeFromIdsOnMap);

            if (idsOnMap.length) {
              console.log("\u0412\u0441\u0435\u0433\u043E \u0438\u0434\u0435\u043D\u0442\u0438\u0444\u0438\u043A\u0430\u0442\u043E\u0440\u043E\u0432 \u0432 svg: ".concat(allIdsCount, ", \u0438\u0437 \u043D\u0438\u0445 \u043D\u0435 \u043E\u0442\u043D\u043E\u0441\u0438\u0442\u0441\u044F \u043A \u0441\u0442\u0430\u043D\u0446\u0438\u044F\u043C \u0438 \u0432\u0435\u0442\u043A\u0430\u043C: ").concat(idsOnMap.length), idsOnMap);
            }
          }
        }); // сортируем станции по активности

        vm.stations.sort(function (a, b) {
          return b.isActive - a.isActive;
        });
        vm.checkboxLocal.forEach(function (cb) {
          if (cb.CHECKED) {
            vm.addToResult(vm.getStationsByName(cb.VALUE));
          }
        });
        $(this.$refs.checkbox).on('change', function () {
          vm[$(this).prop('checked') ? 'addToResult' : 'removeFromResult'](vm.getStationsByName($(this).data('name')));
        });
        vm.saveBackUpResult(); // обновлениие станций после того, как с сервера пришло новое сотояние умного фильтра

        BX.addCustomEvent('citrus-filter-start-json-load', function (params) {
          var metroValues;

          for (var i in params.ITEMS) {
            if (params.ITEMS[i].CODE == 'metro_stations') {
              metroValues = Object.values(params.ITEMS[i].VALUES);
              break;
            }
          }

          if (metroValues) {
            /** @param checkboxLocal {SmartFilterStationCheckbox[]} Доступные для выбора станции из компонента bitrix:catalog.smart.filter */
            vm.checkboxLocal = metroValues;
            vm.stations.map(vm.processStation);
          }
        });
      }
    });

    window.SMARTFILTER_LOCATION = function (id) {
      var $label = $('#filter-label-' + id); //popup

      $label.on('click', function (event) {
        event.preventDefault();
        $.magnificPopup.open({
          items: {
            src: '#filter-values-' + id
          },
          type: 'inline',
          midClick: true,
          callbacks: {
            'close': function close() {
              vm.resetResult();
            }
          }
        });
      });
    };

}((this.window = this.window || {})));
//# sourceMappingURL=script.js.map
