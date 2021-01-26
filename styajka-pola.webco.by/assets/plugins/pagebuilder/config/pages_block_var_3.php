<?php

return [
    'title' => 'Вид 5 - Услуги/Товары/Проекты/Статьи/Новости (4)',

    'show_in_templates' => [5],

//        'show_in_docs' => [ 2 ],

//        'hide_in_docs' => [ 10, 63 ],

    'order' => 5,

    'container' => ['tabs', 'default'],

    'templates' => [
        'owner' => '
			<section class="services [+background+]">
				<div class="container">
					<div class="services__title__wrap">
						<h2 class="services__title title">[+title+]</h2>
						<a href="[+link_url+]" class="primary-button">[+link_title+]</a>
					</div>
					<p class="services__text">[+before_text+]</p>
					<ul class="services-third">
						[+links_block+]
					</ul>
				</div>
			</section>
            ',
        'links_block' => '
			<li class="services-third__item"><img src="[+image_lb+]" alt="[+link_title_lb+]" loading="lazy"><a class="services-third__item__wrap" href="[+link_url_lb+]">
              <div class="services-third__item__info"><span class="services-third__item__subject">[+group_title_lb+]</span>
                <h3 class="services-third__item__title">[+link_title_lb+]</h3>
              </div></a></li>
			
		'
    ],

    'fields' => [
        'title' => [
            'caption' => 'Заголовок',
            'type' => 'text',
        ],
        'background' => [
            'caption' => 'Серый фон',
            'type' => 'checkbox',
            'elements' => ['gray-bg' => 'Да'],
            'default' => ''
        ],
        'link_title' => [
            'caption' => 'Текст для общей ссылки',
            'type' => 'text',
        ],
        'link_url' => [
            'caption' => 'Ссылка или id страницы в теге id',
            'type' => 'text',
        ],
        'before_text' => [
            'caption' => 'Текст до ссылок',
            'type' => 'textarea',
            'default' => '',
            'height' => '300px',
        ],
        'links_block' => [
            'caption' => 'Ссылки с изображениями',
            'type' => 'group',
            'fields' => [
                'image_lb' => [
                    'caption' => 'Изображение для ссылки 383x255 px',
                    'type' => 'image',
                ],

                'link_url_lb' => [
                    'caption' => 'Ссылка или id страницы в теге id',
                    'type' => 'text',
                ],
                'link_title_lb' => [
                    'caption' => 'Текст для ссылки',
                    'type' => 'text',
                ],
                'group_title_lb' => [
                    'caption' => 'Текст группы ресурсов (полупрозрачный текст над основным)',
                    'type' => 'text',
                ],
            ],
        ],
    ],
];

