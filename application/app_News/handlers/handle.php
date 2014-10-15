<?php

namespace application\app_News\handlers {

    require (getcwd() . '/application/app_News/controllers/NewsController.php');
    require (getcwd() . '/application/app_News/config/paramMail.php');

    use application\app_News\controllers\NewsController as News;

    $today = date('d/m/y');
    $content = News::getNews($today);
    News::EnviarMail($content, LISTA_EMAIL);
}
