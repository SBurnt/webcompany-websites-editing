


export default new Vue({
	data: {
		fields: [],
		methods: {
			getField: function (code) {
				return this.fields.filter( field => field.code === code)[0];
			},
			getFieldValue: function (code) {
				return this.getField(code)['value'];
			}
		},
	}
});