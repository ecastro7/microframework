<?php

namespace application\app_aniversario\models {

    require (getcwd() . '/application/database/manager/DBLayer.php');
    require (getcwd() . '/application/app_aniversario/models/AppModel.php');

    use application\database\manager\DBLayer as DBLayer;

    class AppManager {

        public static function SearchNews($fecha) {
            list($year, $month, $day) = explode('/', $fecha);
            $conexion = new DBLayer("sigefirrhh");
            $conexion->getConnection();
            $result = $conexion->execute(" SELECT a.cedula, a.primer_nombre, a.primer_apellido, date_part('day',c.fecha_ingreso) as dia, 
date_part('month',c.fecha_ingreso) as mes, b.nombre as dependencia 
from personal a, trabajador c, dependencia b 
where b.id_dependencia = c.id_dependencia and a.id_personal = c.id_personal and c.estatus = 'A' 
and date_part('day',c.fecha_ingreso) = ? and date_part('month',c.fecha_ingreso) = ?", array($day, $month));
            return $result;
        }
        
        public static function renderView($result) {
            $header = file_get_contents(getcwd() . '/application/app_aniversario/views/header.inc');
            $body = self::getBody($result);
            $footer = file_get_contents(getcwd() . '/application/app_aniversario/views/footer.inc');
            $render_html = $header . $body . $footer;
            return $render_html;
        }

        public static function getBody($result) {
            $body = "";
            foreach ($result as $value) {
                $body .= "<tr>
                            <td>
                                <span class='fecha'><strong>" . $value->primer_nombre . " " . $value->primer_apellido . "</strong></span><br/>
                                <span class='descripcion'>" . $value->dependencia . "</span>
                            </td>
                         </tr>";
            }
            return $body;
        }

    }

}
