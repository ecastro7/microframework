<?php

namespace application\app_demo\handlers;

require (getcwd().'/application/app_demo/controllers/NewsController.php');

use application\app_demo\controllers\NewsController as News;

$today = date('d/m/y');
News::listadoNews($today);
