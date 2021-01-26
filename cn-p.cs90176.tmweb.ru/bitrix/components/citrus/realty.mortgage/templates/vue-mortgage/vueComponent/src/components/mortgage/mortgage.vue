<template>
	<div class="mortgage">
		<div class="mortgage-form">

			<div class="mortgage-form__row" v-for="(field, fieldIndex) in dataFields">
				<label class="mortgage-form__label">
					<span class="mortgage-form__input-title">
						<span v-if="field.name" class="mortgage-form__input-name">{{field.name}}:</span>
						<span v-if="field.name && (field.min || field.max)" class="mortgage-form__input-description">
							(
							<template v-if="field.min > 0">
								{{lang.from}}
								<vue-autonumeric
									v-if="field.min > 0"
									:options="getAutonumericSettings(field)"
									tag="span"
									:value="field.min" />
							</template>
							<template v-if="field.max > 0">
								{{lang.to}}
								<vue-autonumeric
									:options="getAutonumericSettings(field)"
									tag="span"
									:value="field.max" />
							</template>
							)
						</span>
					</span>

					<vue-autonumeric
						@change.native="change(field)"
						v-on:autoNumeric:initialized.native="autonumericInit(field, $event)"
						:options="getAutonumericSettings(field)"
						class="mortgage-form__input"
						v-model="field.value" />

					<span class="mortgage-form__input-sign">
						<template v-if="field.sign === 'currency'">
							<span data-currency-icon></span>
						</template>
						<template v-else-if="field.code === 'year'">
							<span ref="yearSign"></span>
						</template>
						<template v-else-if="field.sign">{{field.sign}}</template>
					</span>
				</label>
				<range-slider
					:fieldIndex="fieldIndex"
					@change="sliderChange"></range-slider>
			</div>

		</div>

		<div class="mortgage-result">
			<div class="mortgage-result__row">
				<div class="mortgage-result__row-title">{{lang.resultMonth}}:</div>
				<div class="mortgage-result__row-value theme--color _month-pay" data-currency-icon>
					<vue-autonumeric
						ref="monthPay"
						tag="b"
						:value="monthPay"
						:options="getAutonumericSettings({decimal: 2, readOnly: true})"></vue-autonumeric>
				</div>
			</div>

			<div class="mortgage-result__row" v-if="settings.showOverpaymentBlock">
				<div class="mortgage-result__row-title">{{lang.resultOverpay}}:</div>
				<div class="mortgage-result__row-value _all-overpay" data-currency-icon>
					<vue-autonumeric
						tag="b"
						:value="overpay"
						:options="getAutonumericSettings({readOnly: true})"></vue-autonumeric></div>
			</div>

			<div class="mortgage-result__row mortgage-result__discont theme--border-color" v-if="economy > 0">
				<div class="mortgage-result__row-title">{{lang.resultProfit}}:</div>
				<div class="mortgage-result__row-value theme--color"
				     data-currency-icon>
					<vue-autonumeric
					tag="b"
					:value="economy"
					:options="getAutonumericSettings({decimal: 0, readOnly: true})"></vue-autonumeric></div>
			</div>
		</div>
	</div>
</template>


<script src="./mortgage.js"></script>
<style src="./mortgage.css"></style>
