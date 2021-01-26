<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($_REQUEST['json']) && $_REQUEST['json'] == 'y') {
    $APPLICATION->RestartBuffer();
    header("Content-type: application/json");
    echo json_encode($arResult);
    die();
}

    function setCalcParams($items) {
        $count = count($items);
        if ($count <= 0)
            return false;
        elseif($count === 1) {
            $item = $items[0]["UF_NAME"];
            $item_id = $items[0]['UF_XML_ID'];
            return "<h1 class='mt30 mb0 text-regular' data-id=$item_id>$item</h1>";
        } else {
            $result = '';
            $result .= "<div class='select-carousel mt10'>";
            $result .= "<div class='swiper-container js-slider-select'>";
            $result .= "<div class='swiper-wrapper'>";
            foreach ($items as $item) {
                $name = $item['UF_NAME'];
                $xml_id = $item['UF_XML_ID'];
                $result .= "<div class='swiper-slide'>$name <input type='hidden' value=$xml_id></div>";
            }
            $result .= "</div></div></div>";
            return $result;
        }
    }
    $hl = $arResult['HL'];
?>
<div class="calc calc__none-select" id="calc">
    <div class="row vert-center">
        <div class="col-12 mt20 mb10">
            <div class="text-small-caps">Карат</div>
            <div class="input--no-border js-keyboard-input"></div>
            <div class="js-keyboard-input">
                <h1 id="elem" :class="carat.classing" class="calc__h1 calc__fsс text-regular mt0 js-keyboard-input-text dom-loaded" @click="putFocus('carat')">{{ carat.text }}</h1>
                <input type="hidden">
            </div>
        </div>
    </div>
    <div class="table-spec">
        <?/*?><div class="table-spec__item js-calc-props" data-prop="form" data-alone="Y">
            <div class="text-small-caps">Форма</div>
            <?=setCalcParams($hl['form']['items'])?>
        </div><?*/?>
        <div class="table-spec__item js-calc-props" data-prop="form">
            <div class="text-small-caps">Форма</div>
            <?=setCalcParams($hl['form']['items'])?>
        </div>
        <div class="table-spec__item js-calc-props" data-prop="color">
            <div class="text-small-caps">Цвет</div>
            <?=setCalcParams($hl['colors']['items'])?>
        </div>
        <div class="table-spec__item js-calc-props" data-prop="quality">
            <div class="text-small-caps">Чистота</div>
            <?=setCalcParams($hl['quantity']['items'])?>
        </div>
        <div class="table-spec__item js-calc-rap">
            <div class="text-small-caps">%RAP</div>
            <div class="select-carousel mt10">
                <div class="swiper-container js-slider-rap" data-slide="100">
                    <div class="swiper-wrapper">
                    <?for ($i = -100; $i < 101; $i++) {?>
						<div class="swiper-slide"><?=$i?> <input type="hidden" value="<?=$i?>"></div>
						<?if($i != 100){?>
						<div class="swiper-slide"><?=$i+'.5'?> <input type="hidden" value="<?=$i+'.5'?>"></div>
						<?}?>
                    <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row js-calc-items">
        <div :class="item.classing" class="col-12 panel-bordered" v-for="item in prices">
            <div class="row">
                <div class="col-l-6 panel-bordered__item">
                    <div class="text-small-caps">Цена \ ct</div>
                    <h1 class="mt0 text-regular js-calc-price calc__fsс dom-loaded" data-price="0">${{item.price}}</h1>
                </div>
                <div class="col-l-6 panel-bordered__item">
                    <div class="text-small-caps">Итого</div>
                    <h1 :class="item.sumClass" class="calc__h1 calc__fsс mt0 text-regular js-calc-res dom-loaded" @click="putFocus('sum')">${{item.sum}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="keyboard js-keyboard">
        <div class="keyboard-container">
            <div class="keyboard__item" @touchStart="btnNum(1)">1</div>
            <div class="keyboard__item" @touchStart="btnNum(2)">2</div>
            <div class="keyboard__item" @touchStart="btnNum(3)">3</div>
            <div class="keyboard__item" @touchStart="btnNum(4)">4</div>
            <div class="keyboard__item" @touchStart="btnNum(5)">5</div>
            <div class="keyboard__item" @touchStart="btnNum(6)">6</div>
            <div class="keyboard__item" @touchStart="btnNum(7)">7</div>
            <div class="keyboard__item" @touchStart="btnNum(8)">8</div>
            <div class="keyboard__item" @touchStart="btnNum(9)">9</div>
            <div class="keyboard__item" @touchStart="btnComma">,</div>
            <div class="keyboard__item" @touchStart="btnNum(0)">0</div>
            <div class="keyboard__item keyboard__item-delete" @touchStart="del"></div>
        </div>
        <div class="keyboard-button">
            <button class="keyboard__item keyboard-button-compare js-calc-clear" @touchStart="clear">Сбросить</button>
            <button class="keyboard__item keyboard-button-reset" @touchStart="compare">Сравнить</button>
        </div>
    </div>
		<div class="" style="height: 62px; background-color: #797979;"></div>
</div>
<?/*
<div id="js-prices" style="display: none">
    <?foreach ($arResult['ITEMS'] as $item) {?>
        <div class="js-price-item"
            data-carat="<?=$item['carat']?>"
            data-color="<?=$item['color']?>"
            data-form="<?=$item['form']?>"
            data-qual="<?=$item['quality']?>"
            data-price="<?=$item['price']?>"
        ></div>
    <?}?>
</div>
*/?>

<script>
    BXMobileApp.UI.Page.Refresh.setEnabled(false);
</script>
<script src="<?=SITE_TEMPLATE_PATH?>/assets/js/vue.js"></script>
<script>
	try {
		Vue.config.devtools = true
		var calc = new Vue({
			el: '#calc',
			data: {
				items: <?=json_encode($arResult['ITEMS'])?>,
				focusProps: {
					carat: {
						text: '',
						classing: {
							fakeInputPulse: false
						}
					},
					sum: {
						text: 0,
						classing: {
							fakeInputPulse: false
						}
					},
				},
				carat: {
					text: '',
					classing: {
						fakeInputPulse: false
					}
				},
				focus: 'carat',
				props: {
					color: '<?=$hl['colors']['items'][0]['UF_XML_ID']?>',
					form: '<?=$hl['form']['items'][0]['UF_XML_ID']?>',
					quality: '<?=$hl['quantity']['items'][0]['UF_XML_ID']?>',
					rap: 0
				},
				prices: [{
					classing: {
						"panel-light-gray": false
					},
					price: 0,
					sum: 0,
					fixedPrice: 0,
					sumClass: {
						fakeInputPulse: false
					}
				}],
			},
			methods: {
				putFocus: function (name) {
					if (name === 'sum' && this.focusProps.sum.text == '0')
						return;
					this.focus = name;
					this.activateFocus();
				},
				activateFocus: function () {
					for (let prop in this.focusProps)
						this.focusProps[prop].classing.fakeInputPulse = false;
					this.focusProps[this.focus].classing.fakeInputPulse = true;
					this.activateProps()
						//alert('activateFocus');
				},
				btnNum: function (val) {
					this.focusProps[this.focus].text += '' + val;
					this.activateProps()
					this.calc()
				},
				btnComma: function () {
					var curr = this.focusProps[this.focus].text;
					var comma = ',';
	
					if (curr.length < 1)
						curr = '0' + comma;
					if (curr.indexOf(',') !== -1)
						comma = '';
					curr += comma;
	
					this.focusProps[this.focus].text = curr;
					this.activateProps()
					this.calc()
				},
				del: function () {
					var curr = this.focusProps[this.focus].text + '';
					if (curr === '0,') {
						this.focusProps[this.focus].text = '';
					} else {
						this.focusProps[this.focus].text = curr.substring(0, curr.length - 1);
					}
					this.activateProps();
					this.calc()
				},
				calc: function () {
					if (this.focus === 'carat')
						this.calcCaratPrice();
					else
						this.calcRapPrice();
				},
				calcCaratPrice: function() {
					var carat = this.focusProps.carat.text;
					carat = carat.replace(',', '.');
					var carat_num = +(carat);
					var carat_num_real = carat_num;
					// костылики для отсутствующих диапазонов
					if(carat_num>=6 && carat_num<10){
						carat_num = 5.5;
					}
					if(carat_num>=11){
						carat_num = 10.5;
					}

					/*alert(carat_num);
					if (carat_num < 0.3) {
						carat = "0";
					} else if (carat_num <= 0.39) {
						carat = "3_39";
					} else if (carat_num <= 0.49) {
						carat = "4_49"
					} else if (carat_num <= 0.69) {
						carat = "5_69";
					} else {
						carat = 0;
					}*/
					//this.props.form = 'br';
					var price = 0;
					for (var index in this.items) {
						var curr_item = this.items[index];
						if (parseFloat(curr_item.carat_from) <= parseFloat(carat_num)
							&&
							parseFloat(curr_item.carat_to) >= parseFloat(carat_num)
							&&
							curr_item.color == this.props.color
							&&
							curr_item.form == this.props.form
							&&
							curr_item.quality == this.props.quality
						) {
							price = curr_item.price;
						}
					}
					//alert(carat_num + ' ' + this.props.color + ' ' + this.props.form + ' ' + this.props.quality);
					this.prices[0].fixedPrice = price;
					var percent = this.props.rap;
					if (price) {
						this.prices[0].price = Math.round(+(price) + (price/100 * percent));
						this.prices[0].sum = Math.round(this.prices[0].price * carat_num_real);
					} else {
						this.prices[0].price = 0;
						this.prices[0].sum = 0;
					}
					this.focusProps.sum.text = this.prices[0].sum;
				},
				calcRapPrice: function () {
					var carat = this.focusProps.carat.text;
					carat = carat.replace(',', '.');
	
					var carat_num = +(carat);
	
					var price = this.prices[0].fixedPrice;
					var sum = this.focusProps.sum.text;
					var old_sum = Math.round(this.prices[0].fixedPrice * carat_num);
	
					var percent = sum / old_sum * 100;
					if (isNaN(percent))
						this.prices[0].price = 0;
					else
						this.prices[0].price = Math.round(price / 100 * percent);
				},
				compare: function () {
					this.prices[0].classing['panel-light-gray'] = true;
					this.prices[0].sumClass.fakeInputPulse = false;
					this.prices.unshift({
						classing: {
							"panel-light-gray": false
						},
						price: 0,
						sum:0,
						sumClass: {
							fakeInputPulse: false
						}
					});
					this.calc()
				},
				clear: function () {
					this.focusProps.carat.text = '';
					this.focusProps.sum.text = 0;
					this.prices = [{
						classing: {
							"panel-light-gray": false
						},
						price: 0,
						sum:0,
						sumClass: {
							fakeInputPulse: false
						}
					}];
					this.activateProps()
				},
				setProp: function(name, val) {
					this.props[name] = val;
				},
				activateProps : function () {
					this.carat.text = this.focusProps.carat.text;
					this.carat.classing.fakeInputPulse = this.focusProps.carat.classing.fakeInputPulse;
					this.prices[0].sum = this.focusProps.sum.text;
					this.prices[0].sumClass.fakeInputPulse = this.focusProps.sum.classing.fakeInputPulse;
				}
			},
	
			mounted() {
				this.activateProps()
			}
		})
	
		calc.activateFocus()
	
		window.Calc = calc;
	} catch (err) {
		alert(err);
	}

	document.addEventListener('DOMContentLoaded', showCalc);

	function showCalc() {
		var elements = document.getElementsByClassName('dom-loaded');
		for (var i = 0; i < elements.length; i++) {
			elements[i].style.display = 'inline';
		}
	}

</script>


<style>
    /*.test-select {*/
        /*-moz-user-select: none;*/
        /*-khtml-user-select: none;*/
        /*-webkit-user-select: none;*/
        /*user-select: none;*/
    /*}*/
    /*.no-transition {*/
        /*-webkit-tap-highlight-color: transparent;*/
    /*}*/
</style>