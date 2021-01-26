<?php

return [
    'title' => 'Слайдер на всю ширину (1)',

    'show_in_templates' => [5],

//        'show_in_docs' => [ 2 ],

//        'hide_in_docs' => [ 10, 63 ],

    'order' => 1,

    'container' => ['default'],

    'templates' => [
        'owner' => '
        <div class="slider-main">
            <ul class="bx-slider">
                [+slider_main+]
            </ul>
        </div>
        ',
        'slider_main' => '
        <li style="background-image: url([+image_background+]);">
            <div class="full-slide container">
                <div class="content [+black_background_class+]">
                    <p class="title [+text_color_class+]">[+header+]</p>
        
                    <span class="[+text_color_class+]">[+description+]</span>
        
                    <div>
                        [+more_button+]
                        [+form_button+]
                    </div>
                </div>
                    <div class="img">
                       [+image_right+]
                    </div>
            </div>
        </li>
        ',
    ],

    'fields' => [
        'slider_main' => [
            'caption' => 'Слайдер',
            'type' => 'group',
            'fields' => [
                'header' => [
                    'caption' => 'Заголовок',
                    'type' => 'text',
                ],
                'description' => [
                    'caption' => 'Текст описания. Перенос на новую строку осуществляется тегом <br/>',
                    'type' => 'textarea',
                ],
                'url' => [
                    'caption' => 'Ссылка или id страницы в теге [~id~]',
                    'type' => 'text',
                ],
                'image_background' => [
                    'caption' => 'Изображение для фона слайда 1920x400 px',
                    'type' => 'image',
                ],
                'image_right' => [
                    'caption' => 'Изображение для слайда размещающееся справа 500x400 px',
                    'type' => 'image',
                ],
                'text_color_class' => [
                    'caption' => 'Цвет текста на слайде',
                    'type' => 'dropdown',
                    'elements' => ['white' => 'Белый', 'black' => 'Черный'],
                    'default' => 'black'
                ],
                'black_bg_visible' => [
                    'caption' => 'Отображать темную подложку',
                    'type' => 'checkbox',
                    'elements' => ['1' => 'Да'],
                    'default' => ''
                ],
                'btn_more_visible' => [
                    'caption' => 'Отображать кнопку подробнее',
                    'type' => 'checkbox',
                    'elements' => ['1' => 'Да'],
                    'default' => ''
                ],
                'btn_form_visible' => [
                    'caption' => 'Отображать кнопку заказать',
                    'type' => 'checkbox',
                    'elements' => ['1' => 'Да'],
                    'default' => ''
                ],
                'btn_form_text' => [
                    'caption' => 'текст подписи для кнопки заказать',
                    'type' => 'text',
                    'default' => 'Оставить Заявку'
                ],
                'btn_more_text' => [
                    'caption' => 'Текст подписи для кнопки Подробнее',
                    'type' => 'text',
                    'default' => 'Подробнее'
                ],
            ],
        ],
    ],
    'prepare' => function ($options, &$values) {
        //Паджер, обработанные изображения и т.д.
        $snippet_name = 'phpthumb';
        $snippet_params = [
            'input' => '',
            'options' => 'w=500,h=400,f=png,q=84,far=C,bg=ffffff'
        ];

        foreach ($values['slider_main'] as &$slider_main) {
            //Отображать темную подложку
            if ($slider_main['black_bg_visible'][0] === '1') {
                $slider_main['black_background_class'] = 'active';
            } else {
                $slider_main['black_background_class'] = '';
            }

            //Изображение правое
            if (!empty($slider_main['image_right'])) {
                $snippet_params['input'] = $slider_main['image_right'];
                $image_right_thumb = $this->modx->runSnippet($snippet_name, $snippet_params);
                $slider_main['image_right'] = "<img src=\"{$image_right_thumb}\" alt=\"Изображение правое\" loading=\"lazy\"/>";
            }

            //Кнопка подробнее
            if ($slider_main['btn_more_visible'][0] === '1') {
                $slider_main['more_button'] = "<a href=\"{$slider_main['url']}\" class=\"more-button\">{$slider_main['btn_more_text']}</a>";
            } else {
                $slider_main['more_button'] = '';
            }

            //Кнопка вызова формы обратной связи
            if ($slider_main['btn_form_visible'][0] === '1') {
                $slider_main['form_button'] = "<a href=\"#callback\" data-uk-modal class=\"buy-button\">{$slider_main['btn_form_text']}</a>";
            } else {
                $slider_main['form_button'] = '';
            }
        }

        //$values['slider_main'] = "<ul class=\"bx-slider\">{$values['slider_main']}</ul>";

        unset($slider_main, $snippet_params, $snippet_name, $image_right_thumb);
    }
];

