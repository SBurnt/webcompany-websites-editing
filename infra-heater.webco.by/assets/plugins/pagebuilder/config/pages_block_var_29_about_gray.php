<?php

return [
    'title' => 'О компании + серый текстовый блок (31)',

    'show_in_templates' => [5],

//        'show_in_docs' => [ 2 ],

//        'hide_in_docs' => [ 10, 63 ],

    'order' => 32,

    'container' => ['default'],

    'templates' => [
        'owner' => '
			<div class="information-main [+background+]">
                <div class="container">	
                    <div class="about-wrap">
                        [+about_block+]
                        [+gray_block+]
                    </div>				
                </div>
            </div>
            ',
    ],

    'fields' => [
        'background' => [
            'caption' => 'Серый фон',
            'type' => 'checkbox',
            'elements' => ['gray-bg' => 'Да'],
            'default' => ''
        ],
        'about_visible' => [
            'caption' => 'Отображать блок "О компании"',
            'type' => 'checkbox',
            'elements' => ['1' => 'Да'],
            'default' => ''
        ],
        'gray_visible' => [
            'caption' => 'Отображать блок правый с серым блоком',
            'type' => 'checkbox',
            'elements' => ['1' => 'Да'],
            'default' => ''
        ],
        'about_title' => [
            'caption' => 'Заголовок блока "О компании"',
            'type' => 'text',
            'default' => 'О компании'
        ],
        'about_description' => [
            'caption' => 'Текст основной блока "О компании"',
            'type' => 'richtext',
            'default' => '',
            'theme' => 'editor',
            'options' => [
                'height' => '150px',
            ],
        ],
        'about_url' => [
            'caption' => 'Ссылка или id страницы в теге id блока "О компании"',
            'type' => 'text',
            'default' => '[~2~]'
        ],
        'about_target' => [
            'caption' => 'Открывать в новой вкладке для ссылки подробнее блока "О компании"',
            'type' => 'checkbox',
            'elements' => ['1' => 'Да'],
            'default' => ''
        ],
        'about_btn_more_text' => [
            'caption' => 'Текст для ссылки подробнее блока "О компании"',
            'type' => 'text',
            'default' => 'Читать подробнее'
        ],
        'about_btn_more_visible' => [
            'caption' => 'Отображать ссылку подробнее для блока "О компании"',
            'type' => 'checkbox',
            'elements' => ['1' => 'Да'],
            'default' => ''
        ],

        'gray_title' => [
            'caption' => 'Заголовок правого блока с серым фоном',
            'type' => 'text',
        ],

		'gray_description' => [
            'caption' => 'Текст основной блока правого блока с серым фоном',
            'type' => 'richtext',
            'default' => '',
            'theme' => 'editor',
            'options' => [
                'height' => '150px',
            ],
        ],
		'gray_url' => [
            'caption' => 'Ссылка или id страницы в теге id правого блока с серым фоном',
            'type' => 'text',
            'default' => '[~2~]'
        ],
        'gray_target' => [
            'caption' => 'Открывать в новой вкладке для ссылки подробнее правого блока с серым фоном',
            'type' => 'checkbox',
            'elements' => ['1' => 'Да'],
            'default' => ''
        ],
        'gray_btn_more_text' => [
            'caption' => 'Текст для ссылки подробнее правого блока с серым фоном',
            'type' => 'text',
            'default' => 'Все новости'
        ],
        'gray_btn_more_visible' => [
            'caption' => 'Отображать ссылку подробнее для правого блока с серым фоном',
            'type' => 'checkbox',
            'elements' => ['1' => 'Да'],
            'default' => ''
        ],
    ],
    'prepare' => function ($options, &$values) {
        $values['about_block'] = '';
        $values['gray_block'] = '';

        //О компании
        if ($values['about_visible'][0] === '1') {
            $a_about_params = [];
            $about_tpl = <<<EOL
<div class="company">
    [+title+]
	[+content+]
	[+more_link+]
</div>
EOL;
            //Заголовок
            if (!empty($values['about_title'])) {
                $a_about_params['title'] = "
                    <div class=\"main-title\">
                        <h2>
                            {$values['about_title']}
                        </h2>
                    </div>";
				// $values['title'] = $a_about_params['title'];
            }
            //Контент
            if (!empty($values['about_description'])) {
                $a_about_params['content'] = $values['about_description'];
            }
            //Ссылка подробнее
            if ($values['about_btn_more_visible'][0] === '1') {
                if ($values['about_target'][0] === '1') {
                    $target = 'target="_blank"';
                } else {
                    $target = '';
                }
                $a_about_params['more_link'] = <<<TAG
                    <div class="company__lnk">
                        <a href="{$values['about_url']}" class="primary-button" {$target}>{$values['about_btn_more_text']}</a>
                    </div>
TAG;
            }
            $values['about_block'] = $this->modx->parseText($about_tpl, $a_about_params, '[+', '+]');
        }

        //Правый серый блок
        if ($values['gray_visible'][0] === '1') {
            $a_gray_params = [];
            $gray_tpl = <<<EOL
                <div class="news">
					[+title+]
					[+content+]
					[+more_link+]
                </div>
EOL;
            //Заголовок
            if (!empty($values['gray_title'])) {
                $a_gray_params['title'] = "<div class=\"main-title\">
                        <h2>
                            {$values['gray_title']}
                        </h2>
                    </div>";
            }

            //Контент
            if (!empty($values['gray_description'])) {
                $a_gray_params['content'] = "<div class=\"right_gray_block gray_background\">{$values['gray_description']}</div>";
            }
            //Ссылка подробнее
            if ($values['gray_btn_more_visible'][0] === '1') {
                if ($values['gray_target'][0] === '1') {
                    $target = 'target="_blank"';
                } else {
                    $target = '';
                }
                $a_about_params['more_link'] = <<<TAG
                    <div class="company__lnk">
                        <a href="{$values['gray_url']}" class="primary-button" {$target}>{$values['gray_btn_more_text']}</a>
                    </div>
TAG;
            }


            $values['gray_block'] = $this->modx->parseText($gray_tpl, $a_gray_params, '[+', '+]');
        }

        unset($a_gray_params, $snippet_params, $snippet_name, $display, $url, $gray_tpl, $a_about_params, $about_tpl, $target);
    }
];

