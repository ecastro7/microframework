<?php

namespace application\app_aniversario\controllers {

    require ('application/app_aniversario/models/AppManager.php');
    require ('application/libs/email/htmlMimeMail5/htmlMimeMail5.php');

    use application\app_aniversario\models\AppManager as Manager;

    class AppController {

        public static function getAniversario($fecha) {
            return Manager::SearchNews($fecha);
        }

        public static function renderView($result, $imgURL, $type) {
            $imgURL = unserialize($imgURL);
            if ($type == "INDIVIDUAL") {
                $html = self::renderViewIndividual($result);
            } else {
                $html = self::renderViewGeneral($result);
            }
            return $html;
        }

        public static function renderViewIndividual($param) {
            $img_path = $imgURL["imgURL"]["individual"];
            foreach ($array as $value) {
                $html = Manager::renderView($result, $type);
                $diccionario = array('img_path' => $img_path);
                $html[] = Manager::renderDinamicView($html, $diccionario);
            }
            return $html;
        }

        public static function renderViewGeneral($param) {
            if ($type == "GENERAL" && count($result) > 14) {
                $img_path = $imgURL["imgURL"]["generalDoble"];
            } else {
                $img_path = $imgURL["imgURL"]["general"];
            }
            $diccionario = array('img_path' => $img_path);
            $html = Manager::renderView($result, $type);
            $html[] = Manager::renderDinamicView($html, $diccionario);
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
