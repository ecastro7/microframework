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
        $arrayResult = App::getAniversario($fecha);
        if (empty($arrayResult)) {
            /**
             * No hay aniversario
             */
            $parametros = array(
                "subject" => NOT_ANIVERSARIO,
                "to" => array(DESTINO_APLICACIONES)
            );
        } else {
            /**
             * Si hay aniversario
             */
            $parametros = array(
                "subject" => SUBJECT_ANIVERSARIO,
                "to" => array(DESTINO_TELESUR)
            );
            /**
             * Segundo foreach para recorrer el array que contiene las tarjeta a enviar 
             * Envio de la tarjeta genera
             * Envio de la tarjeta individual
             * Por este metodo reutilizamos el codigo del metodo getAniversario
             */
            foreach ($list_tarjeta as $type) {
                $html = App::renderView($arrayResult, URLIMG, $type);
            }
        }
        foreach ($parametros as $key => $value) {
             App::EnviarMail($content, $parametros);
        }
    }
}
