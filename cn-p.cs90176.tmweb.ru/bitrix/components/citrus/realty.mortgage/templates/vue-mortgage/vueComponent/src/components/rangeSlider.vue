<template>
	<div class="mortgage-form__slider">
		<input ref="input" type="hidden" class="range-slider-input" >
	</div>
</template>

<script>
	import global from '../globalData';
	import store from '../vuexFields';
	import { mapGetters, mapState } from 'vuex';
	
	export default {
		name: "rangeSlider",
		props: ['fieldIndex'],
		store,
		data: function(){
			return {
				anElement: null
			}
		},
		computed: {
			field: function () {
				return store.state.fields[this.fieldIndex];
			},
			settings: function () {
				let step = this.field.decimal > 0 ? 1/(10* this.field.decimal) :
					( (this.field.max - this.field.min) > 100000 ? 10000 :
						(this.field.max - this.field.min) > 1000 ? 10 : 1 );
				return {
					type: "single",
					min: this.field.min,
					max: this.field.max,
					from: this.field.changeValue,
					grid: false,
					step: step,
					postfix: ' %',
					hide_min_max: true,
					hide_from_to: true,
				};
			}
		},
		mounted: function () {
			this.$parent.$on('changeSlider', fieldCode => {
				if (fieldCode === this.field.code) {
					this.anElement.update(this.settings);
				}
			});
			
			let settings = this.settings;
			settings['onChange'] = data => {
				this.field.value = data.from;
				this.$emit('change', this.field);
			};
			
			//doc http://ionden.com/a/plugins/ion.rangeslider/demo_advanced.html
			$(this.$refs.input).ionRangeSlider(settings);
			this.anElement = $(this.$refs.input).data('ionRangeSlider');
		}
	}
</script>