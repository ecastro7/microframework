<?php

namespace application\app_demo\controllers;

require (getcwd().'/application/app_demo/models/NewsManager.php');

use application\app_demo\models\NewsManager as Manager;

class NewsController {

    public static function listadoNews($fecha) {
        Manager::SearchNews($fecha);
    }

}
