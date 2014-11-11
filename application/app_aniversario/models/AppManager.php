<?php

namespace application\app_aniversario\models {

    require ('application/database/manager/DBLayer.php');
    require ('application/app_aniversario/models/AppModel.php');

    use application\database\manager\DBLayer as DBLayer;
    use application\app_aniversario\models\AppModel as AppModel;

    class AppManager {

        /**
         * Buscar noticias segun una fecha
         * @param date $fecha
         * @return array
         */
        public static function SearchNews($fecha) {
            list($year, $month, $day) = explode('/', $fecha);
            $conexion = new DBLayer("sigefirrhh");
            $conexion->getConnection();
            $result = $conexion->execute(AppModel::queryListAniversario(), array($day, $month));
            return $result;
        }

        /**
         * Buscar el listado de email
         * @return array
         */
        public static function SearchListEmail() {
            $conexion = new DBLayer("sait");
            $conexion->getConnection();
            $result = $conexion->execute(AppModel::queryListEmail());
            return $result;
        }

        /**
         * renderizar la vista segun el tipo
         * @param array $result
         * @param string $type
         * @return array
         */
        public static function renderView($result, $type) {
            if ($type == "GENERAL") {
                /**
                 * Contenido de la notificacion general
                 */
                $header = file_get_contents(dirname(__DIR__) . '/views/general/header.inc');
                $body = self::getBodyGeneral($result);
                $footer = file_get_contents(dirname(__DIR__) . '/views/general/footer.inc');
            } else {
                /**
                 * Contenido de la notificacion individual
                 */
                $header = file_get_contents(dirname(__DIR__) . '/views/individual/header.inc');
                $body = self::getBody($result);
                $footer = file_get_contents(dirname(__DIR__) . '/views/individual/footer.inc');
            }
            $render_html = $header . $body . $footer;
            return $render_html;
        }

        /**
         * Renderizar el cuerpo de la notificacion generals
         * @param array $result
         * @return string
         */
        public static function getBodyGeneral($result) {
            $arrayDep = self::getDependencia($result);
            $nroDep = count($arrayDep);
            $body = "";
            for ($row = 1; $row < $nroDep; $row++) {
                $tr = "";
                $tr = "<tr style=' border: 1px solid #890300 !important; color: white; background-color: #890300; padding: 5px !important;'>
                            <td style='max-width:100%; min-width:320px; border: 1px solid #E1E1E1 !important; padding: 3px !important;'>
                                <p style='width:100%; margin: 5px 0px !important; font-size:0.9em; font-family: 'Droid Serif', serif; color: #FFF;'>
                                " . $arrayDep[$row] . "</p>
                            </td>
                        </tr>
                        <tr style=' border: 1px solid #EAEAEA !important; font-size:0.875em;'>
                            <td>
                                <ul style='margin: 0px; padding: 5px;'>";
                /**
                 * Buscar las personas segun la dependencia
                 */
                $li = "" . self::getListAniDep($result, $arrayDep[$row]);

                $body .= $tr . $li . "</ul></td></tr><tr style='width:100%; background-color: #DDDDDD'><td style='max-width:100%; min-width:320px; padding:2px 2px 5px 2px;'></td></tr>";
            }
            return $body;
        }

        /**
         * Obtener una aniversario segun la dependencia
         * @param array $list
         * @param string $dependencia
         * @return string
         */
        public static function getListAniDep($list, $dependencia) {
            $result = "";
            for ($i = 0; $i < count($list); $i++) {
                if ($list[$i]->dependencia == $dependencia) {
                    $result .= "<li style='position: relative; display: block; padding: 10px 15px; margin-bottom: -2px; background-color: #FFF; border: 1px solid #DDD;'>"
                            . $list[$i]->primer_nombre . ' ' . $list[$i]->primer_apellido . " -  " . $list[$i]->dif_anios . " A&Ntilde;O(S)</li>";
                }
            }
            return $result;
        }

        /**
         *  Renderizar el cuerpo de la notificacion individual
         * @param array $result
         * @return string
         */
        public static function getBody($result) {
            $nroRows = count($result);
            $body = "";
            for ($index = 0; $index < $nroRows; $index++) {
                $td = "<td>";
                $td .= "<p style='margin: 0px 0px 4px 0px; font-size:14px'><span><strong>" 
                        . $result[$index]->primer_nombre . " " . $result[$index]->primer_apellido . " - " . $result[$index]->dif_anios . " " . utf8_decode("AÑO") . "(S)" .
                        "</strong></span><p style='margin: 0;font-size:12px'>
                        <span>" . $result[$index]->dependencia .
                        "</span></td>";
                $body .= "<tr>" . $td . "</tr></br>";
            }

            return $body;
        }

        /**
         * Renderizar dinamicamente la notificacion individual
         * @param array $html
         * @param array $data
         * @return mixed
         */
        public static function renderDinamicView($html, $data) {
            foreach ($data as $clave => $valor) {
                $html = str_replace('{' . $clave . '}', $valor, $html);
            }
            return $html;
        }

        /**
         * Obtener una lista de dependencias unicas 
         * @param array $result
         * @return array
         */
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
