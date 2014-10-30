<?php

namespace application\app_aniversario\models {

    require ('application/database/manager/DBLayer.php');
    require ('application/app_aniversario/models/AppModel.php');

    use application\database\manager\DBLayer as DBLayer;
    use application\app_aniversario\models\AppModel as AppModel;

    class AppManager {

        public static function SearchNews($fecha) {
            list($year, $month, $day) = explode('/', $fecha);
            $conexion = new DBLayer("sigefirrhh");
            $conexion->getConnection();
            $result = $conexion->execute(AppModel::queryListAniversario(), array($day, $month, $year));
            print_r($result);
            return $result;
        }

        public static function renderView($result, $type) {
            $render_html = NULL;
            if (count($result) != 0) {
                $header = file_get_contents(dirname(__DIR__) . '/views/header.inc');
                $body = self::getBody($result, $type);
                $footer = file_get_contents(dirname(__DIR__) . '/views/footer.inc');
                $render_html = $header . $body . $footer;
            }
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
        
        public static function renderDinamicView($html, $data) {
            foreach ($data as $clave=>$valor) {
                $html = str_replace('{'.$clave.'}', $valor, $html);
            }
            return $html;
        }

    }

}
