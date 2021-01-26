
import VueAutonumeric from 'vue-autonumeric/dist/vue-autonumeric.min';
import rangeSlider from '../rangeSlider';
import global from '../../globalData';
import store from '../../vuexFields';
import { mapGetters, mapState } from 'vuex';

export default {
    name: "mortgage",
    props: ['fields', 'lang', 'settings'],
	store,
    data: function () {
        return {
            /**
             * параметры для плагина autoNumeric https://github.com/autoNumeric/autoNumeric
             */
            autonumericSettings : {
                digitGroupSeparator: ' ',
                decimalCharacter: ',',
                minimumValue: 0,
                decimal: 0,
	            emptyInputBehavior: 'zero'
            },
            isCurrencyDefined: typeof currency !== 'undefined',
        }
    },
    components: {rangeSlider},
    created: function(){
        let fields =  this.fields.map(field=>{
	        field.changeValue = field.value;
	        return field;
        });
	    global.fields = fields;
	    store.commit('setFields', fields);
	    store.commit('setSettings', this.settings);
    },
    mounted: function(){
	    this.updateYearSign();
	    if (this.isCurrencyDefined) {
		    this.updateCurrencyFields();
		    currency.on('update', () => {
			    this.updateCurrencyFields();
		    });
		    currency.updateHtmlCurrency($(this.$el).find('[data-currency-icon]'));
        }
        // on document ready update textarea
        $(() => this.updateTextArea());
    },
    computed: {
        ...mapState({
            'dataFields': 'fields'
        }),
	    ...mapGetters([
	        'percent',
	        'fullPrice',
		    'firstPrice',
		    'year',

		    'monthPay',
		    'overpay',
            'economy',
	    ]),
    },
    methods: {
	    updateCurrencyFields: function(){
		    let firstPrice = this.getDataField('firstPrice'),
                fullPrice = this.getDataField('fullPrice');

		    [fullPrice, firstPrice].forEach(field => {
		        if (field.sign !== 'currency') return;

		        if (field.currency && field.currency !== currency.current) {
			        field.min = currency.convertToBase(field.min, field.currency);
			        field.max = currency.convertToBase(field.max, field.currency);
			        field.value = currency.convertToBase(field.value, field.currency);
                }

                if (field.currency !== currency.current) {
	                field.min = currency.convertBaseToCurrent(field.min);
	                field.max = currency.convertBaseToCurrent(field.max);
	                field.value = currency.convertBaseToCurrent(field.value);
	                field.changeValue = field.value;

	                field.currency = currency.current;
                }
            });

		    [fullPrice, firstPrice].forEach(field => this.change(field))
        },
	    changeSlider: function(changedValue, settings) {
            let field = this.getDataField(settings.code);
		    field.value = changedValue;
		    this.change(field, true);
        },
        cloneData: function (data) {
            let skipProperties = ['__ob__', 'reactiveGetter', 'reactiveSetter'];
            //array
            if (Array.isArray(data)) {
                let cloneArray = [];
                data.forEach((dataArrayItem, dataArrayIndex) => {
                    if (skipProperties.indexOf(dataArrayIndex) > -1) return;
                    cloneArray[dataArrayIndex] = this.cloneData(dataArrayItem);
                });
                return cloneArray;
            }
            //object
            if (typeof data === 'object' && data.toString && data.toString() === "[object Object]") {
                let cloneObject = {};
                let dataObjectItemKey;
                for (dataObjectItemKey in data) {
                    if (skipProperties.indexOf(dataObjectItemKey) > -1) continue;
                    cloneObject[dataObjectItemKey] = this.cloneData(data[dataObjectItemKey]);
                }
                return cloneObject;
            }
            return data;
        },
        /**
         * Польный список параметров
         * @param item
         * @return {Object} - параметры для плагина autoNumeric
         */
        getAutonumericSettings: function(item = {}){
            let settings = this.cloneData(this.autonumericSettings);
            //settings.minimumValue = 1;
            //settings.maximumValue = item.max || 999999999;
            settings.decimalPlaces = item.decimal || 0;
            settings.readOnly = !!item.readOnly;
            return settings;
        },
        getDataField: function(fieldCode){
            return this.dataFields.filter( field => field.code === fieldCode)[0];
        },
        getFieldValue: function (fieldCode) {
            let field = this.dataFields.filter( field => field.code === fieldCode);
            return field.length ? field[0].changeValue : 0;
        },
        change: function(field, fromSlider){
            let fullPriceField = this.getDataField('fullPrice'),
                firstPercentField = this.getDataField('firstPercent'),
                firstPriceField = this.getDataField('firstPrice');

            let fieldIndex = this.dataFields.indexOf(field);

            let newValue;

            if (field.min > 0 && field.value < field.min) field.value = field.min;
	        if (field.max > 0 && field.value > field.max) field.value = field.max;

	        field.changeValue = field.value;
	        store.commit('updateField', fieldIndex);
	        if (!fromSlider) this.$emit('changeSlider', field.code);

            switch (field.code){
                case 'fullPrice':
	            case 'firstPrice':
	                //  значение процентов
                    newValue = firstPriceField.changeValue / fullPriceField.changeValue * 100;
                    if (newValue < firstPercentField.min) newValue = firstPercentField.min;
                    if (newValue > firstPercentField.max) newValue = firstPercentField.max;
                    firstPercentField.value = newValue;
	                firstPercentField.changeValue = newValue;

		            store.commit('updateFieldByCode', 'firstPercent');
		            this.$emit('changeSlider', 'firstPercent');

	                // максимальное значение для процентов
                    if (field.code === 'fullPrice') {
                        firstPriceField.max = fullPriceField.changeValue * firstPercentField.max / 100;
	                    if (firstPriceField.changeValue > firstPriceField.max) {
		                    firstPriceField.value = firstPriceField.max;
		                    firstPriceField.changeValue = firstPriceField.max;
                        }
	                    store.commit('updateFieldByCode', 'firstPrice');
	                    this.$emit('changeSlider', 'firstPrice');
                    }
                    break;
                case 'firstPercent':
                    newValue = fullPriceField.changeValue * firstPercentField.changeValue / 100;

                    // первый взнос
                    firstPriceField.value = newValue;
	                firstPriceField.changeValue = newValue;
	                store.commit('updateFieldByCode', 'firstPrice');
	                this.$emit('changeSlider', 'firstPrice');
                    break;
                case 'year':
                    this.updateYearSign();
                    break;
            }
            this.$nextTick(this.updateTextArea);
        },
        sliderChange: function(field){
            this.change(field, true);
        },
	    // не используем computed свойство потому что сбрасывается фокус со слайдера
        updateYearSign: function () {
            let field = this.getDataField('year');
	        let cases = [2, 0, 1, 1, 1, 2];
	        let number = field.changeValue;
	        let newSign = this.lang.yearSign[ (number%100>4 && number%100<20)? 2 : cases[Math.min(number%10, 5)] ];
	        if (newSign !== field.sign) {
		        field.sign = newSign;
		        this.$refs.yearSign[0].innerHTML = field.sign;
            }
        },
	    getSign: function(sign){
		    if (sign === 'currency') {
			    if (typeof currency !== 'undefined'){
				    sign = currency.items[currency.current]['SIGN'];
			    } else if (this.settings.currency) {
				    sign = this.settings.currency;
			    }
		    }
		    return sign;
	    },
        // обновляем поле формы
        updateTextArea: function () {
	        let requestComment = $('.js-mortgage-textarea-container textarea'),
		        val = requestComment.val() || "---\n",
		        requestContent = val.replace(/---[\S\s]*/m, "---\n"),
	            formatData = {};

	        this.dataFields.forEach( field => {
		        if (field.code === 'firstPercent') return;
		        let formatDataItem = {};

		        formatDataItem.name = field.name;
		        formatDataItem.value = field.input.value;

		        formatDataItem.value += ' '+this.getSign(field.sign);
		        if (field.code === 'firstPrice') {
			        let firstPercentField = this.getDataField('firstPercent');
			        formatDataItem.value += ' ('+firstPercentField.input.value+firstPercentField.sign+')';
                }
		        formatData[field.code] = formatDataItem;
	        });

	        if (this.$refs['monthPay']) {
		        formatData['monthPay'] = {
			        'name': this.lang.resultMonth,
			        'value': this.$refs['monthPay']['$el']['innerHTML'] + ' ' + this.getSign('currency')
		        };
	        }

	        requestContent += Object.keys(formatData).reduce( (arStrings, key) => {
	        	let item = formatData[key];
		        arStrings.push( item.name + ': ' + item.value);
		        return arStrings;
	        }, []).join('\n');
	        requestComment.val(requestContent.trim());

	        BX.onCustomEvent(this, 'mortgageUpdate', [formatData]);
        },

        autonumericInit: function (field, event) {
	        field.input = event.target;
        }
    },
}
