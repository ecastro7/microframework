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
            <title>Aniversario</title>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
            <style type="text/css">
                body{
                    width: 800px;
                    height: 630px;
                }

                div{
                    width: 792px;
                    height: 612px;
                    top:0px;
                    left:0px;
                    position:relative;
                    z-index:1;
                }

                .table_conmemoracion{
                    border-collapse:collapse;
                    position: absolute;
                    left: 270px;
                    top: 200px;
                    text-align: center;
                    z-index: 2;
                    width:380px; 
                    height:260px;
                }

                .table_otros{
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

                .table_profesionales{
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

                tr, td, span, strong{
                    padding: 0;
                    text-decoration: none !important;
                    font-family: helvetica,sans-serif;
                    color: black !important;
                }
                
                img{
                    width: 792px;
                    height: 612px;
                }
            /*****************************************************************/                
            /*****************************************************************/                
            /*****************************************************************/                
                .fecha_conmemoracion{
                    font-size: 1em !important;
                    color: black !important;
                    font-weight: bold !important;
                }

                .descripcion_conmemoracion{
                    font-size: 0.6em !important;
                    color: black !important;
                }
            /*****************************************************************/                
            /*****************************************************************/                
            /*****************************************************************/                
                .descripcion_otros{
                    font-size: 1em !important;
                    color: white !important;
                    font-weight: bold !important;
                }
            /*****************************************************************/                
            /*****************************************************************/                
            /*****************************************************************/                
                .descripcion_profesionales{
                    font-size: 1em !important;
                    color: white !important;
                    font-weight: bold !important;
                }
            /*****************************************************************/                
            /*****************************************************************/                
            /*****************************************************************/            
                .ocultar{
                    display: none;
                } 

            </style>
	</head>
	<body>
		<div>
                    <img src="{img_path}" alt="Tarjeta de Efemerides"/>
		</div>
                    <table class="{type_table}">
                        <thead></thead>
                        <tbody>
                            
