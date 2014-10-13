<?php

/*******************************************************************************
/*********************Configuracion para envio de correo************************
/*******************************************************************************
    /**
     * Lista de destinatarios
     */
    $listEmail = array(
        "lyzmar" => "ecastro@telesurtv.net",
        "jhoan" => "ecastro@telesurtv.net",
        "jennifer" => "ecastro@telesurtv.net",
        "johann" => "ecastro@telesurtv.net",
        "eduard" => "ecastro@telesurtv.net"
    );
            
    /**
     * Definicion de constantes
     *
     */
    const SUBJECT = "Newsletters";
    const TO = "ecastro@telesurtv.net";
    define('LISTA_EMAIL', serialize($listEmail));
