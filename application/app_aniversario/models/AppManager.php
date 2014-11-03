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
            $result = $conexion->execute(AppModel::queryListAniversario(), array($day, $month));
//            print_r($result);
            return $result;
        }

        public static function SearchListEmail() {
            $conexion = new DBLayer("sait");
            $conexion->getConnection();
            $result = $conexion->execute(AppModel::queryListEmail());
            return $result;
        }

        public static function renderView($result, $type) {
            $header = file_get_contents(dirname(__DIR__) . '/views/header.inc');
            /**
             * Si el tipo de tarjeta es general y hay mas de 8 aniversario
             * se cambia la tarjeta (tarjeta doble)
             */
            if ($type == "GENERAL" && (count($result) > 8 && count($result) < 14)) {
                $nCols = 3;
                $body = self::getBody($result, $type);
            } elseif ($type == "GENERAL" && count($result) > 14) {
                $nCols = 2;
                $body = self::getBody($result);
            } else {
                $nCols = 1;
                $body = self::getBody($result);
            }
            $footer = file_get_contents(dirname(__DIR__) . '/views/footer.inc');
            $render_html = $header . $body . $footer;
            return $render_html;
        }

        public static function getBody($result, $nCols) {
            $nroRows = count($result);
            if (count($result) % 2 != 0) {
                $nroRows += 1;
            }
            $body = "";
            for ($index = 0; $index < $nroRows; $index+=$nCols) {
                $td = "";
                for ($i = $index; $i < $index + $nCols; $i++) {
                    $td .= "<td>
                                <span class='nombre'><strong>" . $result[$i]->primer_nombre . " " . $result[$i]->primer_apellido . "</strong></span><br/>
                                <span class='dependencia'>" . $result[$i]->dependencia . "</span><br/>
                                <span class='anios'><strong>" . $result[$i]->dif_anios ." " . utf8_decode("AÑOS") ."</strong></span>
                            </td>";
                }
                $body .= "<tr>" . $td . "</tr>";
            }

            return $body;
        }

        public static function renderDinamicView($html, $data) {
            foreach ($data as $clave => $valor) {
                $html = str_replace('{' . $clave . '}', $valor, $html);
            }
            return $html;
        }

    }

}
