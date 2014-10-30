<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application\app_aniversario\models;

/**
 * Description of AppModel
 *
 * @author ecastro
 */
class AppModel {

    //put your code here

    static function queryListAniversario() {
        $query = "SELECT a.cedula, a.primer_nombre, a.primer_apellido, date_part('day',c.fecha_ingreso) as dia, 
            date_part('month',c.fecha_ingreso) as mes, date_part('year',c.fecha_ingreso) as anio, b.nombre as dependencia 
            from personal a, trabajador c, dependencia b 
            where b.id_dependencia = c.id_dependencia and a.id_personal = c.id_personal and c.estatus = 'A' 
            and date_part('day',c.fecha_ingreso) = ? and date_part('month',c.fecha_ingreso) = ? and date_part('year',c.fecha_ingreso) = ?";
        return $query;
    }

}
