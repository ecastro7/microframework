<?php

/* * *****************************************************************************
  /*********************Configuracion ************************
  /******************************************************************************* */


/** * Constantes para obtener las fecha actual y la siguiente. * */
$today = date('Y/m/d', strtotime("2007/09/01"));
define('TODAY', $today);
$tomorrow = date('Y/m/d', strtotime("2008/01/01"));
define('TOMORROW', $tomorrow);

const SUBJECT_ANIVERSARIO = "FELIZ ANIVERSARIO";

const NOT_ANIVERSARIO = "NO HAY ANIVERSARIO";

const DESTINO_APLICACIONES = "ecastro@telesurtv.net";
/*const FROM_TELESUR = "distribucion-alltelesur-2014@telesurtv.net";*/

const DESTINO_TELESUR = "ecastro@telesurtv.net";


/**
 * Constante de la tarjeta individual
 */
$imgPATH = array(
    "imgURL" => array(
        "individual" => "http://exwebserv.telesurtv.net/Tarjetas/reconocimiento-individual.jpg"
    )
);

define('URLIMG', serialize($imgPATH));