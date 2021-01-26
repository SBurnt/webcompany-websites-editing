<?php

return [
    'title' => 'Карта (26)',

    'show_in_templates' => [5],

//        'show_in_docs' => [ 2 ],

//        'hide_in_docs' => [ 10, 63 ],

    'order' => 26,

    'container' => ['default'],

    'templates' => [
        'owner' => '
<div class="main-map-wrapper">
    <div class="main-map block-[+iteration+]" id="map-pb">
        <div class="container">
            <div class="content">
                [+map_info+]
            </div>
        </div>
        <div class="map-button-mobile">
            <img src="assets/templates/market/img/update/map-loc__m.svg" alt="" loading="lazy">
           	OPEN MAP
        </div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2350.951169917648!2d27.597888216047206!3d53.89707184101717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dbce4a4251b1eb%3A0x4884068395676445!2z0L_QtdGA0LXRg9C70L7QuiDQmtC-0LfQu9C-0LLQsCA30LAsINCc0LjQvdGB0Lo!5e0!3m2!1sru!2sby!4v1608715807868!5m2!1sen!2sus" width="100%" height="378" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
</div>',
    ],

    'fields' => [
        'map_point' => [
            'caption' => 'Координаты точки для карты на главной (широта и долгота в цифровом виде через запятую)',
            'type' => 'text',
            'default' => '53.939781, 27.601374'
        ],
        'map_zoom' => [
            'caption' => 'Приближение карты',
            'type' => 'text',
            'default' => '16'
        ],
        'map_info_visible' => [
            'caption' => 'Отображать блок с контактной информацией',
            'type' => 'checkbox',
            'elements' => ['1' => 'Да'],
            'default' => ''
        ],
        'map_info_title' => [
            'caption' => 'Заголовок блока с контактной информацией',
            'type' => 'text',
            'default' => 'Наши контакты'
        ],
        'contact_data' => [
            'caption' => 'Контакты на плашке',
            'type' => 'group',
            'fields' => [
                'icon' => [
                    'caption' => 'Изображение',
                    'type' => 'dropdown',
                    'elements' => ['map' => 'Адрес', 'email' => 'Email', 'phone' => 'Телефон'],
                    'default' => 'map'
                ],
                'cont_text' => [
                    'caption' => 'Подпись к изображению, альтернативный текст',
                    'type' => 'textarea',
                    'height' => '150px',
                ],
            ],
        ],
    ],
    'prepare' => function ($options, &$values) {
        $values['map_info'] = '';


        //Блок с контактной ннформацией
        if ($values['map_info_visible'][0] === '1') {
            $map_contacts_data = '';
            if (!empty($values['map_info_title'])) {
                $values['map_info_title'] = "<div class=\"map-info__title\">{$values['map_info_title']}</div>";
            }
            //Контактная информация
            foreach ($values['contact_data'] as &$contact_data) {
                $icon = '';
                //Иконка
                switch ($contact_data['icon']) {
                    case 'map':
                        $icon = '<svg width="22" height="28" viewBox="0 0 20 28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g id="Canvas__location" transform="translate(-11267 850)">
									<g id="placeholder">
										<g id="Group__location">
											<g id="Vector__location">
												<use xlink:href="#path0_fill__location" transform="translate(11273.4 -843.864)"/>
											</g>
											<g id="Vector">
												<use xlink:href="#path1_fill__location" transform="translate(11267 -850)"/>
											</g>
										</g>
									</g>
								</g>
								<defs>
									<path id="path0_fill__location" d="M 3.65049 0C 1.63803 0 -4.13787e-07 1.60615 -4.13787e-07 3.57945C -4.13787e-07 5.55275 1.63803 7.1589 3.65049 7.1589C 5.66295 7.1589 7.30098 5.55275 7.30098 3.57945C 7.30098 1.60615 5.66295 0 3.65049 0ZM 3.65049 6.1362C 2.21272 6.1362 1.043 4.98924 1.043 3.57945C 1.043 2.16966 2.21272 1.0227 3.65049 1.0227C 5.08826 1.0227 6.25798 2.16966 6.25798 3.57945C 6.25798 4.98924 5.08826 6.1362 3.65049 6.1362Z" />
									<path id="path1_fill__location" d="M 17.0725 2.87225C 15.1837 1.02014 12.6721 0 10.001 0C 7.32937 0 4.81836 1.02014 2.92949 2.87225C -0.566114 6.29932 -1.00052 12.7474 1.98871 16.6542L 10.001 28L 18.0013 16.67C 21.0025 12.7474 20.5681 6.29932 17.0725 2.87225ZM 17.1555 16.0722L 10.001 26.2031L 2.8351 16.0564C 0.123829 12.5117 0.512345 6.68846 3.66741 3.5953C 5.35915 1.93648 7.60838 1.0227 10.001 1.0227C 12.3936 1.0227 14.6429 1.93648 16.3351 3.5953C 19.4902 6.68846 19.8787 12.5117 17.1555 16.0722Z" />
								</defs>
							</svg>';
                        break;
                    case 'phone':
                        $icon = '<svg width="22" height="22" viewBox="0 0 13 13" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<g id="Canvas__phone-call-fill" transform="translate(-11621 837)">
						<g id="phone-call-button__phone-call-fill">
							<g id="Group__phone-call-fill">
								<g id="call__phone-call-fill">
									<g id="Vector__phone-call-fill">
										<use xlink:href="#path0__phone-call-fill" transform="translate(11621 -837)"></use>
									</g>
								</g>
							</g>
						</g>
					</g>
					<defs>
						<path id="path0__phone-call-fill" d="M 2.6 5.63333C 3.61111 7.65556 5.34444 9.31667 7.36667 10.4L 8.95556 8.81111C 9.17219 8.59447 9.46111 8.52225 9.67778 8.66667C 10.4722 8.95556 11.3389 9.1 12.2778 9.1C 12.7111 9.1 13 9.38889 13 9.82222L 13 12.2778C 13 12.7111 12.7111 13 12.2778 13C 5.48889 13 0 7.51111 0 0.722222C 0 0.288889 0.288889 0 0.722222 0L 3.25 0C 3.68333 0 3.97222 0.288889 3.97222 0.722222C 3.97222 1.58889 4.11667 2.45556 4.40556 3.32222C 4.47778 3.53889 4.40556 3.82778 4.26111 4.04444L 2.6 5.63333Z"></path>
					</defs>
				</svg>';
                        break;
                    case 'email':
                        $icon = '<svg width="22" height="18" viewBox="0 0 22 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g id="Canvas__mail" transform="translate(-11322 840)">
									<g id="mail__mail">
										<g id="Group__mail">
											<g id="Vector__mail">
												<use xlink:href="#path0_fill__mail" transform="translate(11322 -840)" />
											</g>
											<g id="Vector__mail">
												<use xlink:href="#path1_fill__mail" transform="translate(11322.5 -839.298)" />
											</g>
										</g>
									</g>
								</g>
								<defs>
									<path id="path0_fill__mail" d="M 20.2265 18L 1.77351 18C 0.79595 18 0 17.0848 0 15.9589L 0 2.04109C 0 0.915226 0.79595 -1.02777e-07 1.77351 -1.02777e-07L 20.2265 -1.02777e-07C 21.2041 -1.02777e-07 22 0.915226 22 2.04109L 22 15.9589C 22 17.0848 21.2041 18 20.2265 18ZM 1.77351 0.816437C 1.18683 0.816437 0.709403 1.3659 0.709403 2.04109L 0.709403 15.9589C 0.709403 16.6341 1.18683 17.1836 1.77351 17.1836L 20.2265 17.1836C 20.8132 17.1836 21.2906 16.6341 21.2906 15.9589L 21.2906 2.04109C 21.2906 1.3659 20.8132 0.816437 20.2265 0.816437L 1.77351 0.816437Z" />
									<path id="path1_fill__mail" d="M 10.4895 10.3495C 10.0178 10.3495 9.54603 10.1691 9.18707 9.80902L 0.12161 0.716354C -0.0259455 0.567763 -0.0415524 0.310585 0.0875589 0.140766C 0.21667 -0.0306861 0.440842 -0.0470147 0.588397 0.100761L 9.65315 9.19343C 10.1072 9.64818 10.8733 9.64736 11.3259 9.19343L 20.3885 0.101577C 20.5354 -0.0478312 20.7588 -0.0306862 20.8894 0.141582C 21.0185 0.311401 21.0029 0.568579 20.8553 0.717171L 11.792 9.8082C 11.433 10.1691 10.9613 10.3495 10.4895 10.3495Z" />
								</defs>
							</svg>';
                        break;
                }
                $map_contacts_data .= <<<EOL
<div class="map-info__el">
	<div class="map-info__img">
		{$icon}
	</div>
	<div class="map-info__txt">
		{$contact_data['cont_text']}
	</div>
</div>
EOL;
                $map_contacts_data .= PHP_EOL;
            }

            $values['map_contacts_data'] = $map_contacts_data;
            $values['map_info'] = <<<TAG

                <div class="map-info">
					{$values['map_info_title']}
					{$values['map_contacts_data']}
				</div>
TAG;
        }

        if (!empty($values['map_point']) && !empty($values['map_zoom'])) {

            $map_js_init = <<<SCRIPT

<script>
	$(document).ready(function () {


		if ( $(document).width() > 480 ) {

			var myMap;
			ymaps.ready(function () {
				myMap = new ymaps.Map('map-pb', {//id
					center: [{$values['map_point']}],
					zoom: {$values['map_zoom']},
					controls: ["smallMapDefaultSet"]
				}, {
					searchControlProvider: 'yandex#search'
				}),
					myPlacemark = new ymaps.Placemark([ {$values['map_point']} ], {
					hintContent: '',
					balloonContent: ''
				},
													  {
					preset: 'islands#redDotIcon'
				});

				myMap.behaviors.disable("scrollZoom");
				myMap.geoObjects.add(myPlacemark);
			});

		} else {

			var myMap;
			ymaps.ready(function () {
				myMap = new ymaps.Map('map-pb', {//id
					center: [{$values['map_point']}],
					zoom: {$values['map_zoom']},
					controls: []
				}, {
					searchControlProvider: 'yandex#search'
				}),
					myPlacemark = new ymaps.Placemark([{$values['map_point']}], {
					hintContent: '',
					balloonContent: ''
				},
													  {
					preset: 'islands#redDotIcon'
				});
				myMap.geoObjects.add(myPlacemark);
			});
		}
	});
</script>
SCRIPT;
            //$this->modx->regClientStartupScript('<script src="https://api-maps.yandex.ru/2.1/?lang=en-US" type="text/javascript" defer></script>');
            //$this->modx->regClientScript($map_js_init);
        }
        unset($contact_data, $icon, $map_contacts_data, $map_js_init);
    }
];

