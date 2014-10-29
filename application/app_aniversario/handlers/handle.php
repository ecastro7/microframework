<?php

namespace application\app_aniversario\handlers {

    require (getcwd() . '/application/app_aniversario/controllers/AppController.php');
    require (getcwd() . '/application/app_aniversario/config/parameters.php');

    use application\app_aniversario\controllers\AppController as App;

$list_generator = array(TODAY, TOMORROW);

    foreach ($list_generator as $fecha) {
        $content = App::getAniversario($fecha);
        if (empty($content)) {
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
        }
        App::EnviarMail($content, $parametros);
    }
}
