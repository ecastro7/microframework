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
            $arrayDep = self::getDependencia($result);
            if ($type == "GENERAL" and count($arrayDep) > 8 and count($result) < 24 ) {
                $nCols = 2;
                $body = self::getBodyGeneral($result, $nCols, $arrayDep);
            } elseif ($type == "GENERAL" and count($arrayDep) > 8) {
                $nCols = 3;
                $body = self::getBodyGeneral($result, $nCols, $arrayDep);
            } elseif ($type == "GENERAL" && count($arrayDep) <= 8) {
                $nCols = 2;
                $body = self::getBodyGeneral($result, $nCols, $arrayDep);
            } else {
                $nCols = 1;
                $body = self::getBody($result, $nCols);
            }
            $footer = file_get_contents(dirname(__DIR__) . '/views/footer.inc');
            $render_html = $header . $body . $footer;
            return $render_html;
        }

        public static function getBodyGeneral($result, $nCols, $arrayDep) {
            $nroRows = count($arrayDep);
            if ($nroRows % 2 != 0) {
                $nroRows += 1;
            }
            $body = "";
            $pointerDep = 0;
            /**
             * Numero de filas
             */
            for ($row = 1; $row < $nroRows; $row++) {
                /**
                 * Numero de columnas
                 */
                $content = "<tr>";
                for ($col = 1; $col <= $nCols; $col++) {
                    $td = "<td><span class='titulo'><strong>$arrayDep[$pointerDep]</strong></span></br>";
                    $span = "";
                    $span .= self::getDatos($pointerDep, $arrayDep, $result);
                    $pointerDep++;
                    $content .= $td . $span . "</td>";
                }
                $body .= $content . "</tr></br>";
            }
            return $body;
        }

        public static function getDatos($pointerDep, $arrayDep, $result) {
            $span = "";
            if ($pointerDep < count($arrayDep)) {
                $span = self::getListAniDep($result, $arrayDep[$pointerDep]);
            }
            return $span;
        }

        public static function getListAniDep($list, $dependencia) {
            $result = "";
            for ($i = 0; $i < count($list); $i++) {
                if ($list[$i]->dependencia == $dependencia) {
                    $result .= "<span class='nombre'><strong>" . $list[$i]->primer_nombre . ' ' . $list[$i]->primer_apellido . "</strong></span></br>";
                }
            }
            return $result;
        }

        public static function getBody($result, $nCols) {
            $nroRows = count($result);
            if (count($result) % 2 != 0) {
                $nroRows += 1;
            }
            $body = "";
            for ($index = 0; $index < $nroRows; $index+=$nCols) {
                $td = "<td>
                        <span class='titulo'>" . $result[$index]->dependencia . "</strong></span></br>";
                for ($i = $index; $i < $index + $nCols; $i++) {
                    $td .= "<span class='nombre'>
                                <strong>" . $result[$i]->primer_nombre . " " . $result[$i]->primer_apellido . " " . $result[$i]->dif_anios . " " . utf8_decode("AÑOS") .
                            "</strong>
                            </span><br/>";
                }
                $body .= "<tr>" . $td . "</td></tr></br>";
            }

            return $body;
        }

        public static function renderDinamicView($html, $data) {
            foreach ($data as $clave => $valor) {
                $html = str_replace('{' . $clave . '}', $valor, $html);
            }
            return $html;
        }

        public static function getDependencia($result) {
            $buffer = array();
            $i = 0;
            foreach ($result as $value) {
                $buffer[$i] = $value->dependencia;
                $i++;
            }
            return array_values(array_unique($buffer));
        }

    }

}
