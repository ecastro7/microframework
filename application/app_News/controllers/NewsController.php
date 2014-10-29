<?php

namespace application\app_News\controllers {

    require (getcwd() . '/application/app_News/models/NewsManager.php');
    require (getcwd() . '/application/libs/email/htmlMimeMail5/htmlMimeMail5.php');

    use application\app_News\models\NewsManager as Manager;

    class NewsController {

        public static function getNews($fecha) {
            $result = Manager::SearchNews($fecha);
            $html = Manager::renderView($result);
            return $html;
        }

        public static function EnviarMail($content, $lista) {
            $lista = unserialize($lista);
            $mail = new \htmlMimeMail5();
            $mail->setFrom($lista["from"]);
            $mail->setSubject($lista["subject"]);
            $mail->setText($lista["subject"]);
            $mail->setHtml($content);
            $mail->setSMTPParams('correo.telesurtv.net', 25, null, true, 'aplicaciones@telesurtv.net', '4pl1c4c10n35');
            $mail->send($lista["lista"], 'smtp');
        }

    }

}
