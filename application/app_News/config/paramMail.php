<?php

/* * *****************************************************************************
  /*********************Configuracion para envio de correo************************
  /******************************************************************************* */

$parametros = array(
    "lista" => array(
        "lyzmar" => "ecastro@telesurtv.net",
        "jhoan" => "ecastro@telesurtv.net",
        "jennifer" => "ecastro@telesurtv.net",
        "johann" => "ecastro@telesurtv.net",
        "eduard" => "ecastro@telesurtv.net"
    ),
    "subject" => "Newsletters",
    "from" => "ecastro@telesurtv.net"
);

define('LISTA_EMAIL', serialize($parametros));
