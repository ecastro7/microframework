<?php

namespace application\app_aniversario\controllers {

    require ('application/app_aniversario/models/AppManager.php');
    require ('application/libs/email/htmlMimeMail5/htmlMimeMail5.php');

    use application\app_aniversario\models\AppManager as Manager;

    class AppController {

        /**
         * Obtener todos los aniversarios segun una fecha
         * @param date $fecha
         * @return array
         */
        public static function getAniversario($fecha) {
            return Manager::SearchNews($fecha);
        }

        /**
         * Obtener lista de email de todos los trabajadores
         * @return type
         */
        public static function getListEmail() {
            return Manager::SearchListEmail();
        }

        /**
         * Renderizar la vista segun el tipo de notificacion
         * @param array $result lista de notificaciones
         * @param constant $imgURL path de la imagen individual
         * @param string $type tipo de notificacion
         * @param string $subject asunto que sera enviado por correo
         * @param array $Emails lista de email
         * @return mixed Notificacion rederizada
         */
        public static function renderInfo($result, $imgURL, $type, $subject, $Emails) {
            $img = unserialize($imgURL);
            if ($type == "INDIVIDUAL") {
                $html = self::renderInfoIndividual($result, $img, $type, $subject, $Emails);
            } else {
                $html = self::renderInfoGeneral($result, $type, $subject);
            }
            return $html;
        }

        /**
         * Renderizar la notificacion individual
         * @param array $result
         * @param string $img
         * @param string $type
         * @param string $subject
         * @param array $Emails
         * @return mixed
         */
        private static function renderInfoIndividual($result, $img, $type, $subject, $Emails) {
            $img_path = $img["imgURL"]["individual"];
            $html = array();
            $render = array();
            $diccionario = array(
                'img_path' => $img_path,
                'type_title' => "Felicitaciones" . $subject,
                'type_table' => "individual"
            );
            /**
             * renderizar la notificacion individual para cada trabajado de la lista $result
             */
            foreach ($result as $key => $obj) {
                $html = Manager::renderView(array($obj), $type);
                $render[$key]["html"] = Manager::renderDinamicView($html, $diccionario);
                $render[$key]["subject"] = $subject . " " . $obj->primer_nombre . " " . $obj->primer_apellido;
                $render[$key]["to"] = self::getEmail($obj, $Emails);
            }
            return $render;
        }

        /**
         * Renderizar la notificacion general
         * @param array $result
         * @param string $type
         * @param string $subject
         * @return mixed
         */
        private static function renderInfoGeneral($result, $type, $subject) {
            $render = array();
            $html = Manager::renderView($result, $type);
            $render[0]["html"] = $html;
            $render[0]["subject"] = $subject;
            $render[0]["to"] = "ecastro@telesurtv.net";
            return $render;
        }

        /**
         * Obtener el email de los trabajadores
         * @param object $obj contiene un aniversario
         * @param array $Emails
         * @return string
         */
        private static function getEmail($obj, $Emails) {
            foreach ($Emails as $mail) {
                if ($mail->cedula == $obj->cedula) {
//                    $to = $mail->username . "@telesurtv.net";
                    $to = "ecastro@telesurtv.net";
                }
            }
            return $to;
        }

        /**
         * Enviar correos electronicos
         * @param array $parametros
         */
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
