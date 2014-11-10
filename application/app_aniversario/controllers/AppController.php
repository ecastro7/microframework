<?php

namespace application\app_aniversario\controllers {

    require ('application/app_aniversario/models/AppManager.php');
    require ('application/libs/email/htmlMimeMail5/htmlMimeMail5.php');

    use application\app_aniversario\models\AppManager as Manager;

    class AppController {

        public static function getAniversario($fecha) {
            return Manager::SearchNews($fecha);
        }

        public static function getListEmail() {
            return Manager::SearchListEmail();
        }

        public static function renderInfo($result, $imgURL, $type, $subject, $Emails) {
            $img = unserialize($imgURL);
            if ($type == "INDIVIDUAL") {
                $html = self::renderInfoIndividual($result, $img, $type, $subject, $Emails);
            } else {
                $html = self::renderInfoGeneral($result, $type, $subject);
            }
            return $html;
        }

        private static function renderInfoIndividual($result, $img, $type, $subject, $Emails) {
            $img_path = $img["imgURL"]["individual"];
            $html = array();
            $render = array();
            $diccionario = array(
                'img_path' => $img_path,
                'type_title' => "Felicitaciones" . $subject,
                'type_table' => "individual"
            );
            foreach ($result as $key => $obj) {
                $html = Manager::renderView(array($obj), $type);
                $render[$key]["html"] = Manager::renderDinamicView($html, $diccionario);
                $render[$key]["subject"] = $subject . " " . $obj->primer_nombre . " " . $obj->primer_apellido;
                $render[$key]["to"] = self::getEmail($obj, $Emails);
            }
            return $render;
        }

        private static function renderInfoGeneral($result, $type, $subject) {
            if ($type == "GENERAL" && count($result) > 8) {
                $type_table = "generalDoble";
            } else {
                $type_table = "general";
            }
            $diccionario = array(
                'type_title' => "Felicitaciones",
                'type_table' => $type_table
            );
            $render = array();
            $html = Manager::renderView($result, $type);
            $render[0]["html"] = Manager::renderDinamicView($html, $diccionario);
            $render[0]["subject"] = $subject;
            $render[0]["to"] = "ecastro@telesurtv.net";
            return $render;
        }

        private static function getEmail($obj, $Emails) {
            foreach ($Emails as $mail) {
                if ($mail->cedula == $obj->cedula) {
//                    $to = $mail->username . "@telesurtv.net";
                    $to = "ecastro@telesurtv.net";
                }
            }
            return $to;
        }

        public static function EnviarMail($parametros) {
//            print_r($parametros);
            $mail = new \htmlMimeMail5();
            $mail->setFrom("ecastro@telesurtv.net");
            $mail->setSubject($parametros["subject"]);
            $mail->setText($parametros["subject"]);
            $mail->setHtml($parametros["html"]);
            $mail->setSMTPParams('correo.telesurtv.net', 25, null, true, 'aplicaciones@telesurtv.net', '4pl1c4c10n35');
            $mail->send(array($parametros["to"]), 'smtp');
        }

    }

}
