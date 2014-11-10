<?php

namespace application\app_aniversario\handlers {

    $ruta = '/home/ecastro/TELESUR/composer/Telesur/demo/microframework/';
    ini_set('include_path', $ruta);
    require ('application/app_aniversario/controllers/AppController.php');
    require ('application/app_aniversario/config/parameters.php');

    use application\app_aniversario\controllers\AppController as App;


}
