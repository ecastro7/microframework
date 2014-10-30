<?php

/* * *****************************************************************************
  /*********************Configuracion ************************
  /******************************************************************************* */


/** * Constantes para obtener las fecha actual y la siguiente. * */
$today = date('Y/m/d', strtotime("-4week"));
define('TODAY', $today);
$tomorrow = date('Y/m/d', strtotime("+1days"));
define('TOMORROW', $tomorrow);

const SUBJECT_ANIVERSARIO = "NOTIFICACION DE ANIVERSARIO";

const NOT_ANIVERSARIO = "NO HAY ANIVERSARIO";

const DESTINO_APLICACIONES = "ecastro@telesurtv.net";
/*const FROM_TELESUR = "distribucion-alltelesur-2014@telesurtv.net";*/

const DESTINO_TELESUR = "ecastro@telesurtv.net";

$imgPATH = array(
    "imgURL" => array(
        "individual" => "http://exwebserv.telesurtv.net/Tarjetas/reconocimiento-individual.jpg",
        "generalDoble" => "http://exwebserv.telesurtv.net/Tarjetas/reconocimiento-general2.jpg",
        "general" => "http://exwebserv.telesurtv.net/Tarjetas/reconocimiento-general1.jpg"
    )
);

define('URLIMG', serialize($imgPATH));