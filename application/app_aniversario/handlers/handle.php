<?php

namespace application\app_aniversario\handlers {

    $ruta = '/home/ecastro/TELESUR/composer/Telesur/demo/microframework/';
    ini_set('include_path', $ruta);
    require ('application/app_aniversario/controllers/AppController.php');
    require ('application/app_aniversario/config/parameters.php');

    use application\app_aniversario\controllers\AppController as App;

$list_generator = array(TODAY, TOMORROW);
    $list_tarjeta = array("GENERAL", "INDIVIDUAL");
    /**
     * Primer foreach para recorrer al array que contiene la fecha actual y la fecha posterior
     */
    foreach ($list_generator as $fecha) {
        /**
         * Obtengo los aniversarios segun la fecha pasada por parametros
         */
        $array_response = array();
        $arrayResult = App::getAniversario($fecha);
        if (empty($arrayResult)) {
            /**
             * No hay aniversario
             */
            $array_response["subject"] = NOT_ANIVERSARIO;
            $array_response["to"] = array(DESTINO_APLICACIONES);
            $array_response["html"] = array();
        } else {
            $arrayResultEmail = App::getListEmail();
            /**
             * Si hay aniversario
             * 
             * Segundo foreach para recorrer el array que contiene las tarjeta a enviar 
             * Envio de la tarjeta genera
             * Envio de la tarjeta individual
             * Por este metodo reutilizamos el codigo del metodo getAniversario
             */
            $allContent = array();
            foreach ($list_tarjeta as $type) {
                $allContent[] = App::renderInfo($arrayResult, URLIMG, $type, SUBJECT_ANIVERSARIO, $arrayResultEmail);
            }
        }
        foreach ($allContent as $arrayValue) {
            foreach ($arrayValue as $parametros) {
                App::EnviarMail($parametros);
            }
        }
    }
}
