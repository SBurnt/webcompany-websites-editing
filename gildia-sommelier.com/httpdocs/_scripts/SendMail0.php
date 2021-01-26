<?php

namespace FlexMedia;

class SendMail
{
    const SEND_TO = "info@gildia-sommelier.com";
    const SUBJECT = "Заполнена форма";

    protected $send_to;
    protected $subject;

    public function __construct(Array $fields, Array $params = [])
    {
        if (empty($fields) || !is_array($fields)) {
            return;
        }

        if (!empty($params)) {
            if (isset($params['send_to'])) {
                $this->send_to = $params['send_to'];
            }
            if (isset($params['subject'])) {
                $this->subject = $params['subject'];
            }
        }

        $str_html = $this->makeContent($fields);

        $this->send($str_html);

    }

    protected function makeContent(Array $fields)
    {
	    $lang = [
			'card'  => 'Номер карты',
		    'name'  => 'ФИО',
		    'birth' => 'Дата рождения',
		    'email' => 'E-mail',
		    'tel'   => 'Телефон',
		    'rules' => 'Согласие на подписку'
	    ];
		$result = '<h2 style="font-family: sans-serif; font-size: 18px; color: #2b2c2d; font-weight: bold">Детали заявки:</h2>';
        $result .= '<table role="presentation" aria-hidden="true" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">';

        foreach ($fields['FIELDS'] as $name => $value) {
            $result .= <<<ROW
                <tr>
                <td width="10%" style="font-family: sans-serif; font-size: 14px; color: #616365; font-weight: normal; padding: 8px 0;"><b>{$lang[$name]}: </b></td>
                    <td style="font-family: sans-serif; font-size: 14px; color: #2b2c2d; font-weight: bold">{$value}</td>
                </tr>
ROW;
        }

        $result .= "</table>";

        return $result;
    }

    public function send($str_html)
    {
        $send_to = !empty($this->send_to) ? $this->send_to : self::SEND_TO;
        $subject = !empty($this->subject) ? $this->subject : self::SUBJECT;
        $headers  = "Content-type: text/html; charset=UTF-8 \r\n";
	    $headers .= "From: Гильдия Сомелье <info@gildia-sommelier.com>\r\n";
	    return mail($send_to, $subject, $str_html, $headers);
    }
}
