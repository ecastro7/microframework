<?php

namespace application\app_aniversario\controllers {

    require (getcwd() . '/application/app_aniversario/models/AppManager.php');
    require (getcwd() . '/application/libs/email/htmlMimeMail5/htmlMimeMail5.php');

    use application\app_aniversario\models\AppManager as Manager;

    class AppController {

        public static function getAniversario($fecha) {
            $result = Manager::SearchNews($fecha);
            $html = Manager::renderView($result);
            return $html;
        }

        public static function EnviarMail($content, $options) {
            $mail = new \htmlMimeMail5();
            $mail->setFrom("ecastro@telesurtv.net");
            $mail->setSubject($options["subject"]);
            $mail->setText($options["subject"]);
            $mail->setHtml($content);
            $mail->setSMTPParams('correo.telesurtv.net', 25, null, true, 'aplicaciones@telesurtv.net', '4pl1c4c10n35');
            $mail->send($options["to"], 'smtp');
        }

    }

}
