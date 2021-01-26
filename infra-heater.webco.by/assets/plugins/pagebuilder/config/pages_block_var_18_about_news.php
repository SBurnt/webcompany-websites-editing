<?php

return [
    'title' => 'О компании + Новости/Статьи (Настройка - авто) (22)',

    'show_in_templates' => [5],

//        'show_in_docs' => [ 2 ],

//        'hide_in_docs' => [ 10, 63 ],

    'order' => 22,

    'container' => ['default'],

    'templates' => [
        'owner' => '
			<div class="information-main [+background+]">
				[+title+]
                <div class="container">				
                    <div class="about-wrap">
                        [+about_block+]
                        [+news_block+]
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
        'news_visible' => [
            'caption' => 'Отображать блок "Новости/статьи/услуги"',
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

        'news_title' => [
            'caption' => 'Заголовок блока "Новости"',
            'type' => 'text',
        ],
        'news_parent_id' => [
            'caption' => 'id родительского каталога для вывода новостей/статей/услуг',
            'type' => 'text',
            'default' => '8'
        ],
        'news_btn_more_text' => [
            'caption' => 'Текст для ссылки подробнее блока "О компании"',
            'type' => 'text',
            'default' => 'Все новости'
        ],
        'news_btn_more_visible' => [
            'caption' => 'Отображать ссылку подробнее для блока "Новости/статьи/услуги"',
            'type' => 'checkbox',
            'elements' => ['1' => 'Да'],
            'default' => ''
        ],
        'news_sort' => [
            'caption' => 'Сортировка вывода элементов для блока "Новости/статьи/услуги"',
            'type' => 'dropdown',
            'elements' => ['RAND()' => 'Случайно', 'c.pub_date DESC,c.createdon DESC' => 'Свежие', 'c.menuindex DESC' => 'Позиция в меню, по убыванию', 'c.menuindex ASC' => 'Позиция в меню, по возрастанию'],
            'default' => ''
        ],
    ],
    'prepare' => function ($options, &$values) {
        $values['about_block'] = '';
        $values['news_block'] = '';

        //О компании
        if ($values['about_visible'][0] === '1') {
            $a_about_params = [];
            $about_tpl = <<<EOL
<div class="company">
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
				$values['title'] = $a_about_params['title'];
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

        //Новости
        if ($values['news_visible'][0] === '1') {
            $values['news_parent_id'] = $values['news_parent_id'] ?? '8';
            $a_news_params = [];
            $news_tpl = <<<EOL
                <div class="news">
                    <div class="main-title">
                        [+title+]
                        [+more_link+]
                    </div>
                    <div class="news-wrap mobile_hidden">
                        [+news+]
                    </div>

                    <div class="news-wrap-mobile">
                        [+news+]
                    </div>
                
                    [+more_link_mobile+]
                </div>
EOL;
            //Заголовок
            if (!empty($values['news_title'])) {
                $a_news_params['title'] = "<h2>{$values['news_title']}</h2>";
            }

            //Ссылки подробнее
            if ($values['news_btn_more_visible'][0] === '1' && !empty($values['news_parent_id']) && !empty($values['news_btn_more_text'])) {
                $url = $this->modx->makeUrl($values['news_parent_id']);
                $a_news_params['more_link'] = "<a href=\"{$url}\" class=\"primary-button\">{$values['news_btn_more_text']}</a>";
                $a_news_params['more_link_mobile'] = <<<EOL
                <div class="catalog-main-lnk-wrap">
                    <a href="{$url}" class="view-more button-mobile">{$values['news_btn_more_text']}</a>
                </div>
EOL;
            }

            //Количество выводимых элементов
            if ($values['about_visible'][0] === '1') {
                $display = 4;
            } else {
                $display = 4;
            }

            //Вывод новостей
            $snippet_name = 'DocLister';
            $snippet_params = [
                'id' => 'news_index',
                'parents' => $values['news_parent_id'],
                'total' => $display,
                'tvPrefix' => '',
                'tvList' => 'services_img_prev_new,serv_action_text',
                'tpl' => 'articles_prew_index_tpl_v2',
                'orderBy' => $values['news_sort'],
                'prepare' => 'Prepare::tstr_substr,Prepare::preparethumb,Prepare::serv_action_text',
                'phumb_img' => 'services_img_prev_new',
                'phumb_options' => 'w=286,h=170,f=png,q=84,zc=C,bg=ffffff',
                'tstr' => 'title',
                'tlength' => '100'
            ];
            $a_news_params['news'] = $this->modx->runSnippet($snippet_name, $snippet_params);
            $values['news_block'] = $this->modx->parseText($news_tpl, $a_news_params, '[+', '+]');
        }

        unset($a_news_params, $snippet_params, $snippet_name, $display, $url, $news_tpl, $a_about_params, $about_tpl, $target);
    }
];

