import Vuex from 'vuex'
Vue.use(Vuex);

let getFieldValue = fieldCode => {
	if (typeof store === 'undefined') return;
	let field = store.state.fields.filter( field => field.code === fieldCode);
	return field.length ? field[0].changeValue : 0;
};

const store = new Vuex.Store({
	state: {
		fields: [],
		settings: {}
	},
	getters: {
		percent: state => {
			return getFieldValue('percent');
		},
		fullPrice: state => {
			return getFieldValue('fullPrice');
		},
		firstPrice: state => {
			return getFieldValue('firstPrice');
		},
		year: state => {
			return getFieldValue('year');
		},
		
		amountPayment: (state, getters) => {
			let aPay = getters.fullPrice - getters.firstPrice;
			return aPay > 0 ? aPay: 0;
		},
		monthPay: (state, getters) => {
			let year = state.fields.length ? state.fields.filter( field => field.code === 'year')[0]['changeValue'] : 0;
			const months = year * 12;

			if (getters.percent) {
				let percentMonth = getters.percent / (12 * 100);
				return getters.amountPayment * (percentMonth + (percentMonth / (Math.pow((1 + percentMonth), months) - 1)));
			}

			return getters.amountPayment / months;
		},
		overpay: (state, getters) => {
			return getters.monthPay * getters.year * 12 - getters.amountPayment;
		},
		economy: (state, getters) => {
			let percentMonthWD = (getters.percent - state.settings.discountPercent) / (12 * 100); // 0.5 - settings.discountPercent
			let monthPaymentWD = getters.amountPayment * (percentMonthWD + (percentMonthWD / (Math.pow((1 + percentMonthWD), getters.year * 12) - 1)));
			let overpaymentWD = monthPaymentWD * getters.year * 12 - getters.amountPayment;
			return getters.overpay - overpaymentWD;
		},
	},
	mutations: {
		setFields: function (state, fields) {
			state.fields = fields;
		},
		setSettings: (state, settings) => {
			state.settings = settings;
		},
		updateChangeValue: function (state, {fieldCode, value}) {
			let field = state.fields.filter(field => {
				return field.code === fieldCode;
			})[0];
			let index = state.fields.indexOf(field);
			
			field['changeValue'] = value;
			Vue.set(state.fields, index, field);
			//state.fields[index]['changeValue'] = value;
		},
		updateFieldByCode: (state, fieldCode) => {
			let field = store.state.fields.filter( field => field.code === fieldCode)[0];
			let index = state.fields.indexOf(field);
			Vue.set(state.fields, index, state.fields[index]);
		},
		updateField: (state, index) => {
			Vue.set(state.fields, index, state.fields[index]);
		}
	}
});

export default store;
