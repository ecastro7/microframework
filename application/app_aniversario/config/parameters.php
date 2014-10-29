<?php

/* * *****************************************************************************
  /*********************Configuracion ************************
  /******************************************************************************* */
/** * Constantes para obtener las fecha actual y la siguiente. * */
$today = date('Y/m/d');
define('TODAY', $today);
$tomorrow = date('Y/m/d', strtotime("+1days"));
define('TOMORROW', $tomorrow);

        const SUBJECT_ANIVERSARIO = "NOTIFICACION DE ANIVERSARIO";

        const NOT_ANIVERSARIO = "NO HAY ANIVERSARIO";

        const DESTINO_APLICACIONES = "aplicaciones@telesurtv.net";
        /*const FROM_TELESUR = "distribucion-alltelesur-2014@telesurtv.net";*/
        
        const DESTINO_TELESUR = "aplicaciones@telesurtv.net";

        const PATH_INDIVIDUAL = " http://exwebserv.telesurtv.net/Tarjetas/reconocimiento-individual.jpg";
        const PATH_GENERAL_DOBLE = "http://exwebserv.telesurtv.net/Tarjetas/reconocimiento-general2.jpg";
        const PATH_GENERAL = "http://exwebserv.telesurtv.net/Tarjetas/reconocimiento-general1.jpg";
