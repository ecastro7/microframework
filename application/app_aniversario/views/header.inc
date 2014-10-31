<!--
    name: header.html
    creationDate: 24 Febrero 2014
    author: Eduard Castro
    authorEmail: ecastro@telesurtv.net
    authorUrl: http://www.
    version: 1.0
    description: Template de envio de postales
    copyright: Copyright (C) 2014 - Open Source EdHack, Inc. All rights reserved.
    license: GNU General Public License version 2 or later; see LICENSE.txt
-->

<html>
    <head>
        <title>{type_title}</title>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
        <style type="text/css">
            body{
                width: 800px;
                height: 630px;
                font-size: 12px !important;
            }

            div{
                width: 792px;
                height: 612px;
                top:0px;
                left:0px;
                position:relative;
                z-index:1;
            }

            .table_generalDoble{
                border-collapse:collapse;
                position: absolute;
                left: 110px;
                top: 130px;
                text-align: center;
                z-index: 2;
                width:700px; 
                height:350px;
            }

            .table_general{
                border-collapse:collapse;
                position: absolute;
                left: 192px;
                top: 200px;
                text-align: center;
                font-family: Arial;
                z-index: 2;
                width:380px; 
                height:260px;
            }

            .table_individual{
                border-collapse:collapse;
                position: absolute;
                left: 192px;
                top: 200px;
                text-align: center;
                font-family: Arial;
                z-index: 2;
                width:380px; 
                height:260px;
            }

            tr, td, span, strong {
                padding: 0;
                text-decoration: none !important;
                font-family: helvetica,sans-serif;
                color: #f2e3e3 !important;
            }

            .img_general, .img_generalDoble {
                width: 900px !important;
                height: 600px !important;
            }
            .img_individual {
                height: 295px !important;
                width: 442px !important;
            } 
            
            .dependencia, .anios, .nombre {
                font-size: 12px !important;
            }
            
            table, td, tr {
                border: 1px solid transparent;
            }
        </style>
    </head>
    <body>
        <div>
            <img class="img_{type_table}" src="{img_path}" alt="Tarjeta de Efemerides"/>
        </div>
        <table class="table_{type_table}">
            <thead></thead>
            <tbody>

