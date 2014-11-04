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
                width: 900px;
                height: 600px;
                font-size: 12px !important;
            }

            div.imagen {
                width: 900px;
                height: 600px;
                top:0px;
                left:0px;
                position:relative;
                z-index:1;
            }

            .table_generalDoble{
                border-collapse:collapse;
                position: absolute;
                left: 30px;
                top: 130px;
                text-align: center;
                z-index: 2;
                width:864px; 
                height:350px;
            }

            strong {
                font-family: helvetica,sans-serif;
                color: #f2e3e3 !important;
            }

            td {
                /*padding: 2px 0px !important;*/
                width: 280px !important;
            }

            .img_general, .img_generalDoble {
                width: 900px !important;
                height: 600px !important;
            }
            .img_individual {
                height: 295px !important;
                width: 442px !important;
            } 

            .nombre {
                font-size: 10px !important;
            }

            .titulo {
                font-size: 12px;
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

