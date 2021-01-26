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

let vm;

Vue.component('metro', {
    template: "#metro-template",
    props: [
        'stations',
        'lines',
        'lang',
        // доступные для выбора станции из компонента bitrix:catalog.smart.filter (копируются в this.checkboxLocal, и обновляются ajax-ом через событие citrus-filter-start-json-load)
        'checkbox',
        // режим для разработки и тестирования корректности заполнения справочников и точек на карте
        'debug',
    ],
    data: function () {
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
            stationsWithSeveralMatchingSvgIds: [],
        }
    },
    created: function () {
        vm = this;
    },
    computed: {
        searchStations: function () {
            if (!vm.searchText.length) return [];
            var searchStations = vm.stations.filter(station => {
                var stationName = station.NAME.toLowerCase();
                return stationName.indexOf(vm.searchText.toLowerCase()) > -1 ||
                    stationName.indexOf(vm.autoReplaceKeyboard(vm.searchText.toLowerCase())) > -1

            });
            if (searchStations.length > vm.maxSearchResult)
                searchStations.splice(vm.maxSearchResult - 1, searchStations.length - vm.maxSearchResult);

            return searchStations
        },
        activeSearchStations: function () {
            return vm.searchStations.filter(station => station.isActive);
        },
        // если все станции ветки выбраны то выбираем ветку
        // и удаляем из результата все станции ветки
        formatResult: function () {
            const checkedLineIds = [];
            let result = [];
            let excludeStations = [];

            vm.result.forEach((station, resultKey) => {

                station.LINE.forEach(lineId => {
                    if (checkedLineIds.indexOf(lineId) > -1) return;

                    checkedLineIds.push(lineId);

                    const lineStation = vm.getStationsByLineId(lineId);
                    const resultLineStation = vm.result.filter(function (station1) {
                        return station1.LINE.indexOf(lineId) > -1 && station1.isActive;
                    });
                    if (lineStation.length === resultLineStation.length && lineStation.length >= 1) {
                        result = result.concat(vm.getLinesById(lineId));
                        excludeStations = excludeStations.concat(lineStation)
                    }
                });
                if (excludeStations.indexOf(station) === -1) result.push(station);
            });
            return result;
        },
        activeStations: function () {
            return vm.stations.filter(station => (vm.checkboxLocal.filter(cb => cb.VALUE === station.NAME && (!cb.DISABLED)).length > 0));
        },
        activeLines: function () {
            return vm.lines.map(line => {
                line.disable = (vm.getStationsByLineId(line.ID).length < 1);
                return line;
            });
        },
    },
    methods: {
        /**
         * Добавляет активные станции на карту
         * @param {object} item - станция или ветка
         */
        addToSvg: function (item) {
            item = [].concat(item);
            item.forEach(oneItem => {
                if (oneItem.isStation) {
                    $(oneItem.mapGroup).addClass('_active');
                } else {
                    // @todo мы тут можем оказаться? addToSvg не вызывается для веток (isStation === false)
                    vm.addToSvg(vm.getStationsByLineId(oneItem.ID));
                }
            });
        },
        removeFromSvg: function (item) {
            item = [].concat(item);
            item.forEach(oneItem => {
                if (oneItem.isStation) {
                    $(oneItem.mapGroup).removeClass('_active');
                } else {
                    vm.removeFromSvg(vm.getStationsByLineId(oneItem.ID));
                }
            });
        },

        removeFromResult: function (arItems) {
            arItems = [].concat(arItems);
            arItems.forEach(oneItem => {
                if (oneItem.isStation) {
                    vm.removeFromSvg(oneItem);
                    vm.$delete(vm.result, vm.result.indexOf(oneItem));
                } else {
                    let lineStations = vm.getStationsByLineId(oneItem.ID);
                    // удаляются только станции которых нет в других выбранных ветках
                    // (для станций в нескольких группах)
                    // но станций должно быть больше 1
                    lineStations = lineStations.filter(function (station) {
                        var result = vm.formatResult.filter(function (resultLine) {
                            return !resultLine.isStation &&
                                resultLine.ID !== oneItem.ID &&
                                (station.LINE.indexOf(resultLine.ID) > -1);
                        });
                        return result.length <= 1;
                    });
                    vm.removeFromResult(lineStations);
                }
            });
        },
        addToResult: function (arItems) {
            arItems = [].concat(arItems);
            arItems.forEach(oneItem => {
                if (vm.inResult(oneItem)) return;
                if (oneItem.isStation) {
                    vm.result.unshift(oneItem);
                    vm.addToSvg(oneItem);
                } else {
                    if (!oneItem.disable) vm.addToResult(vm.getStationsByLineId(oneItem.ID));
                }
            });
        },
        inResult: function (item) {
            return vm.result.indexOf(item) > -1 || vm.formatResult.indexOf(item) > -1;
        },
        /**
         * добавляет в результат
         * @param {object} item - станция или ветка
         */
        toggleResult: function (item) {
            vm[vm.inResult(item) ? 'removeFromResult' : 'addToResult'](item);
        },

        /* выбор станции из поиска */
        onClickSearchResult: function (station, event) {
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
                    zIndex: 9999,
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
        highlightSearchResult: function (index) {
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
        clickHighlightResultItem: function () {
            vm.onClickSearchResult(vm.activeSearchStations.length === 1 ?
                vm.activeSearchStations[0] : vm.activeSearchStations[vm.searchHighlightIndex]);
        },

        getLinesById: function (arId) {
            arId = [].concat(arId);
            return vm.lines.filter(line => arId.indexOf(line.ID) > -1);
        },
        getStationsByLineId: function (lineId) {
            return vm.activeStations.filter(station => station.LINE.indexOf(lineId) > -1);
        },

        togglePopup: function (popupName) {
            vm.popup[popupName] = !vm.popup[popupName];
        },
        openPopup: function (popupName) {
            vm.popup[popupName] = true;
        },
        hidePopup: function (popupName) {
            vm.popup[popupName] = false;
        },

        saveBackUpResult: function () {
            vm.backupResult = vm.result.reduce((ar, resultItem) => {
                ar.push(resultItem);
                return ar;
            }, []);
        },
        resetResult: function () {
            vm.removeFromResult(vm.result);
            vm.addToResult(vm.backupResult);
        },
        saveResult: function () {
            vm.saveBackUpResult();
            $.magnificPopup.close();
            smartFilter.updateDuplicate();
            smartFilter.reload();
        },

        inResultStationName: function (stationName) {
            return (vm.result.filter(resultItem => resultItem.NAME === stationName).length > 0);
        },

        autoReplaceKeyboard: function (str) {
            var replacer = vm.lang['AUTO_REPLACE_EN_RU'];

            return str.replace(/[A-z/,.;\'\]\[]/g, function (x) {
                return x == x.toLowerCase() ? replacer[x] : replacer[x.toLowerCase()].toUpperCase();
            });
        },
        getStationsByName: function (name) {
            return vm.stations.filter(station => station.NAME === name);
        },
        /**
         * Инициализация точки станции на svg карты
         *
         * @param {AsanMetroStation} station
         **/
        processStation: function (station) {
            station.isActive = !!this.debug || (vm.checkboxLocal.filter(function (cb) {
                return (cb.VALUE === station.NAME) && (!cb.DISABLED);
            }).length > 0);

            var $mapGroup = $(vm.$map).find(`#${station.SVG_ID}`);
            station.mapGroup = $mapGroup.get(0);
            if (vm.debug) {
                if ($mapGroup.length <= 0) {
                    vm.stationsMissingFromSvg.push(Object.assign ({}, station));
                } else if ($mapGroup.length > 1) {
                    vm.stationsWithSeveralMatchingSvgIds.push(Object.assign ({}, station));
                } else if (station.mapGroup) {
                    const nameInRef = station.NAME.replace(`ё`, `е`);
                    const nameOnMap = station.mapGroup.textContent.trim().replace(/\s+/g, ' ').replace(`ё`, `е`);
                    if (nameOnMap.toUpperCase().replace(/\s+/g, '') !== nameInRef.toUpperCase().replace(/\s+/g, '')) {
                        console.warn(`Название станции из справочника (${nameInRef}) не совпадает с названием на карте (${nameOnMap})`, station.mapGroup);
                    }
                }
            }
            if (station.isActive)
                $mapGroup.addClass('_clickable');
            else
                $mapGroup.removeClass('_clickable');
            $mapGroup.find('text').addClass('metro-map-name');

            return station;
        }
    },
    mounted: function () {
        cui.clickOff($(vm.$refs.popupLinesLabel).add($(vm.$refs.popupLines)), () => {
            vm.hidePopup('metro-lines');
        });

        cui.clickOff($(vm.$refs.searchInput).add($(vm.$refs.searchResult)), () => {
            vm.hidePopup('metro-search-result');
        });

        /** элемент с svg карты */
        vm.$map = $('#metro-map-container');

        // привязка станций к точкам из справочника
        Vue.nextTick(() => {
            if (vm.debug) {
                console.info(`Станции из справочника (vm.stations)`, vm.stations);
                console.log(`Станции доступные для выбора в фильтре (vm.checkboxLocal)`, vm.checkboxLocal);
            }
        });
        vm.stations.map(station => {
            vm.processStation(station);

            station.isStation = true;
            $(station.mapGroup)
                .addClass('metro-map-group')
                .on('click', function (event) {
                    if (station.isActive) vm.toggleResult(station);
                });
            var grouppedStations = $(station.mapGroup).find('g');
            var $stationGroup = grouppedStations.length ?
                grouppedStations : $(station.mapGroup);
            $stationGroup.each(function () {
                $(this).find('circle,ellipse').last().addClass('metro-map-point');
            });

            return station;
        });
        Vue.nextTick(() => {
            if (vm.debug) {
                if (vm.stationsMissingFromSvg.length) {
                    console.warn(`В справочнике найдены станции, которых нет в svg (vm.stationsMissingFromSvg)`);
                    console.table(vm.stationsMissingFromSvg.map(o => JSON.parse(JSON.stringify(o))));
                }
                if (vm.stationsWithSeveralMatchingSvgIds.length) {
                    console.warn(`В справочнике найдены станции, для которых на карте есть несколько подходящих идентификаторов (vm.stationsWithSeveralMatchingSvgIds)`)
                    console.table(vm.stationsWithSeveralMatchingSvgIds.map(o => JSON.parse(JSON.stringify(o))));
                }

                const idsOnMap = [...vm.$map.get(0).querySelectorAll('[id]')].map(function (el) {
                        return el.id;
                    }),
                    allIdsCount = idsOnMap.length,
                    removeFromIdsOnMap = function (item) {
                        var idx = idsOnMap.findIndex(id => id === item.SVG_ID);
                        if (idx >= 0) {
                            idsOnMap.splice(idx, 1);
                        }
                    };

                vm.stations.forEach(removeFromIdsOnMap);
                vm.lines.forEach(removeFromIdsOnMap);

                if (idsOnMap.length) {
                    console.log(`Всего идентификаторов в svg: ${allIdsCount}, из них не относится к станциям и веткам: ${idsOnMap.length}`, idsOnMap);
                }
            }
        });

        // сортируем станции по активности
        vm.stations.sort((a, b) => b.isActive - a.isActive);

        vm.checkboxLocal.forEach(cb => {
            if (cb.CHECKED) {
                vm.addToResult(vm.getStationsByName(cb.VALUE));
            }
        });

        $(this.$refs.checkbox).on('change', function () {
            vm[$(this).prop('checked') ? 'addToResult' : 'removeFromResult'](vm.getStationsByName($(this).data('name')));
        });

        vm.saveBackUpResult();

        // обновлениие станций после того, как с сервера пришло новое сотояние умного фильтра
        BX.addCustomEvent('citrus-filter-start-json-load', function (params) {
            let metroValues;
            for (const i in params.ITEMS) {
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
    },
});

window.SMARTFILTER_LOCATION = function (id) {
    var $label = $('#filter-label-' + id);

    //popup
    $label.on('click', event => {
        event.preventDefault();
        $.magnificPopup.open({
            items: {
                src: '#filter-values-' + id
            },
            type: 'inline',
            midClick: true,
            callbacks: {
                'close': function () {
                    vm.resetResult();
                },
            }
        });
    });
};
