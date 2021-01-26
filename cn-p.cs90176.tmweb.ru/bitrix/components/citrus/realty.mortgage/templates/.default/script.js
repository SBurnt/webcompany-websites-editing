(function( $ ) {

    $.fn.citrusRealtyMortgage = function( options  ) {

        // This is the easiest way to have default options.
        var settings = $.extend({
                minFullPrice: 500000,
                maxFullPrice: 30000000,
                defaultFullPrice: 3000000,
                minFirstPrice: 0,
                defaultFirstPrice: 450000,
                defaultFirstPriceUnits: 'R',
                minFirstPercent: 0,
                maxFirstPercent: 70,
                minPercent: 1,
                maxPercent: 30,
                defaultPercent: 11.5,
                minYear: 1,
                maxYear: 50,
                defaultYear: 15,
                defaultFirstPercent: null,
                discountPercent: 0.5
            }, options ),
            self = this;

        settings.defaultFirstPercent = settings.defaultFirstPrice / settings.defaultFullPrice * 100;

        var priceFormat = wNumb({decimals: 0, thousand: " ", mark: "."});
        var totalPriceFormat = wNumb({decimals: 2, thousand: " ", mark: ","});
        var percentFormat = wNumb({decimals: 1, thousand: "", mark: ","});

        function changeSliderInput(sliderName, sliderVal) {
            if (self.find("." + sliderName + "-val").hasClass("input-percent")) {
                sliderVal = percentFormat.to(sliderVal);
            } else {
                sliderVal = priceFormat.to(sliderVal);
            }
            self.find("." + sliderName + "-val").val(sliderVal);
        }

        function createSlider(sliderName, value, min, max, step_stat) {
            var step = 1;
            if (step_stat != false) {
                if (sliderName == 'full-price' || sliderName == 'first-price')
                    step = 50000;
            }

            self.find("." + sliderName).slider({
                value: value,
                min: min,
                max: max,
                range: 'max',
                step: step,
                slide: function (event, ui) {
                    var new_value = ui.value;
                    if (sliderName.indexOf('percent') >= 0)
                        new_value /= 10;
                    handleUserInput(sliderName, new_value, true);
                }
            });
        }

        function calculate() {
            var totalFullPrice = getCurrent('full-price');
            var totalFirstPrice = getCurrent('first-price');
            var totalPercent = getCurrent('percent');
            var totalYears = getCurrent('years');

            self.find('.years-val')[0].nextSibling.nodeValue = ' ' + declOfNum(totalYears, BX.message('citrus.year.titles').split('|'));

            /* Преобразования выполнены */
            var amountPayment = totalFullPrice - totalFirstPrice;
            var percentMonth = totalPercent / (12 * 100);
            var monthPayment = amountPayment * (percentMonth + (percentMonth / (Math.pow((1 + percentMonth), totalYears * 12) - 1)));
            var overpayment = monthPayment * totalYears * 12 - amountPayment;

            var percentMonthWD = (totalPercent - settings.discountPercent) / (12 * 100);
            var monthPaymentWD = amountPayment * (percentMonthWD + (percentMonthWD / (Math.pow((1 + percentMonthWD), totalYears * 12) - 1)));
            var overpaymentWD = monthPaymentWD * totalYears * 12 - amountPayment;

            self.find('.monthly-payment').text(totalPriceFormat.to(monthPayment));
            self.find('.overpayment').text(priceFormat.to(overpayment));
            self.find('.economy').text(totalPriceFormat.to(overpayment - overpaymentWD)).parents('.result-row').toggle(overpayment - overpaymentWD > 0);

            var requestComment = $('#PREVIEW_TEXT'),
                val = requestComment.val() || "---\n",
                requestContent = val.replace(/---\n[\S\s]*/m, "---\n");
            self.find('.service-form-row').each(function () {
                var labelText = $(this).find('label').text(),
                    input = $(this).find('input');
                if (labelText) {
                    requestContent += labelText + ' ' + input.val() + ' ' + input[0].nextSibling.nodeValue.trim();
                    if (input.hasClass('first-price-val')) {
                        requestContent += " (" + getCurrent('first-percent') + "%)";
                    }
                    requestContent += "\n";
                }
            });
            requestComment.val(requestContent.trim());
        }

        function fillDefaultValues() {
            self.find('.full-price-val').val(priceFormat.to(parseInt(settings.defaultFullPrice)));
            self.find('.first-price-val').val(priceFormat.to(parseInt(settings.defaultFirstPrice)));
            self.find('.first-percent-val').val(percentFormat.to(parseFloat(settings.defaultFirstPercent)));
            self.find('.percent-val').val(percentFormat.to(parseFloat(settings.defaultPercent)));
            self.find('.years-val').val(settings.defaultYear);
        }

        function formatValues() {
            var fullPriceVal = self.find('.full-price-val').val();
            fullPriceVal = fullPriceVal.replace(/[^\d,]/g, '');
            self.find('.full-price-val').val(priceFormat.to(parseInt(fullPriceVal)));

            var firstPriceVal = self.find('.first-price-val').val();
            firstPriceVal = firstPriceVal.replace(/[^\d,]/g, '');
            self.find('.first-price-val').val(priceFormat.to(parseInt(firstPriceVal)));

            var firstPercentVal = self.find('.first-percent-val').val();
            firstPercentVal = firstPercentVal.replace(/[,]/g, '.');
            firstPercentVal = firstPercentVal.replace(/[^\d.]/g, '');
            self.find('.first-percent-val').val(percentFormat.to(parseFloat(firstPercentVal)));

            var percentVal = self.find('.percent-val').val();
            percentVal = percentVal.replace(/[,]/g, '.');
            percentVal = percentVal.replace(/[^\d.]/g, '');
            self.find('.percent-val').val(percentFormat.to(parseFloat(percentVal)));

            var yearsVal = self.find('.years-val').val();
            yearsVal = yearsVal.replace(/[^\d]/g, '');
            self.find('.years-val').val(yearsVal);
        }

        function declOfNum(number, titles)
        {
            var cases = [2, 0, 1, 1, 1, 2];
            return titles[ (number%100>4 && number%100<20)? 2 : cases[Math.min(number%10, 5)] ];
        }

        function getCurrent(which)
        {
            switch (which) {
                case 'full-price':
                case 'first-price':
                case 'first-percent':
                case 'percent':
                case 'years':
                    if (which.indexOf('percent') >= 0)
                        return parseFloat(percentFormat.from(self.find('.' + which + '-val').val()));
                    else
                        return parseInt(priceFormat.from(self.find('.' + which + '-val').val()));
                default:
                    console.error('Invalid "which" argument: ', which);
                    return null;
            }
        }

        function handleUserInput(which, new_value, fromSlider)
        {
            var firstPrice, firstPercent, newFirstPrice, newFirstPercent;

            fromSlider = fromSlider || false;
            switch (which) {
                // Сумма кредита
                case 'full-price':
                    createSlider('full-price', new_value, settings.minFullPrice, settings.maxFullPrice);
                    if (settings.defaultFirstPriceUnits == 'R') {
                        firstPrice = getCurrent('first-price');
                        createSlider('first-price', firstPrice, 0, new_value * settings.maxFirstPercent /  100);
                        changeSliderInput('first-price', firstPrice);
                        createSlider('first-percent', firstPrice / new_value * 100 * 10, settings.minFirstPercent * 10, settings.maxFirstPercent * 10);
                        changeSliderInput('first-percent', firstPrice / new_value * 100);
                    }
                    else {
                        firstPercent = getCurrent('first-percent');
                        newFirstPrice = firstPercent * new_value / 100;
                        createSlider('first-price', newFirstPrice, 0, new_value * settings.maxFirstPercent / 100);
                        changeSliderInput('first-price', newFirstPrice);
                    }
                    break;
                // Первоначальный взнос в рублях
                case 'first-price':
                    if (settings.defaultFirstPriceUnits == 'R') {
                        newFirstPercent = new_value / getCurrent('full-price') * 100;
                        createSlider('first-price', new_value, settings.minFirstPrice, getCurrent('full-price') * settings.maxFirstPercent / 100);
                        createSlider('first-percent', newFirstPercent * 10, settings.minFirstPercent * 10, settings.maxFirstPercent * 10);
                        changeSliderInput('first-percent', newFirstPercent)
                    }
                    else {
                        newFirstPercent = new_value * 100 / getCurrent('full-price');
                        createSlider('first-percent', newFirstPercent, settings.minFirstPercent, settings.maxFirstPercent);
                        changeSliderInput('first-percent', newFirstPercent)
                    }
                    break;
                // Первоначальный взнос в процентах
                case 'first-percent':
                    newFirstPrice = getCurrent('full-price') * new_value / 100;
                    createSlider('first-percent', new_value, settings.minFirstPercent * 10, settings.maxFirstPercent * 10);
                    createSlider('first-price', newFirstPrice, settings.minFirstPrice, getCurrent('full-price') * settings.maxFirstPercent / 100, false);
                    changeSliderInput('first-price', newFirstPrice);
                    break;
                // Процентная ставка по кредиту
                case 'percent':
                    createSlider('percent', new_value, settings.minPercent*10, settings.maxPercent * 10);
                    break;
                case 'years':
                    createSlider('years', new_value, settings.minYear, settings.maxYear);
                    break;
                default:
                    console.error('Invalid "where" argument: ', which);
            }
            if (fromSlider) {
                changeSliderInput(which, new_value);
            }
            calculate();
        }

        function changeValues($element)
        {
            formatValues();
            var new_value = parseInt(priceFormat.from($element.val()));
            if ($element.hasClass('full-price-val')) {
                handleUserInput('full-price', new_value);
            }
            else if ($element.hasClass('first-price-val'))
            {
                handleUserInput('first-price', new_value);
            }
            else if ($element.hasClass('first-percent-val'))
            {
                handleUserInput('first-percent', new_value);
            } else if($element.hasClass('percent-val'))
            {
                handleUserInput('percent', new_value);
            } else if($element.hasClass('years-val'))
            {
                handleUserInput('years', new_value);
            }
        }

        fillDefaultValues();
        createSlider('full-price', settings.defaultFullPrice, settings.minFullPrice, settings.maxFullPrice);
        createSlider('first-price', settings.defaultFirstPrice, settings.minFirstPrice, settings.defaultFullPrice * settings.maxFirstPercent / 100);
        /*Проценты умножим на 10 и поделим на 10, а то проблематично показывать десятые*/
        createSlider('first-percent', settings.defaultFirstPercent * 10, settings.minFirstPercent * 10, settings.maxFirstPercent * 10);
        createSlider('percent', settings.defaultPercent * 10, settings.minPercent*10, settings.maxPercent * 10);
        createSlider('years', settings.defaultYear, settings.minYear, settings.maxYear);
        calculate();

        self.find("input")
            .blur(function () {
                changeValues($(this));
            })
            .keyup(function (event) {
                if (event.keyCode == 13)
                    $(this).blur();
            });

    };

}(jQuery));