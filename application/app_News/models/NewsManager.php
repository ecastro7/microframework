<?php

namespace application\app_News\models {

    require (getcwd() . '/application/database/manager/DBLayer.php');
    require (getcwd() . '/application/app_News/models/NewsModel.php');

    use application\database\manager\DBLayer as DBLayer;

    class NewsManager {

        static function SearchNews($fecha) {
            $conexion = new DBLayer("prueba");
            $conexion->getConnection();
            $result = $conexion->execute("SELECT id,descripcion,fecha FROM news WHERE fecha = ?", array($fecha));
            echo "rows: " . count($result) . "\n";
            return $result;
        }

        static function renderView($result) {
            $header = file_get_contents(getcwd() . '/application/app_News/views/header.inc');
            $body = self::getBody($result);
            $footer = file_get_contents(getcwd() . '/application/app_News/views/footer.inc');
            $render_html = $header . $body . $footer;
            return $render_html;
        }

        static function getBody($result) {
            $body = "";
            foreach ($result as $value) {
                $body .= "<tr>
                            <td>
                                <span class='fecha'><strong>" . $value->fecha . "</strong></span><br/>
                                <span class='descripcion'>" . $value->descripcion . "</span>
                            </td>
                         </tr>";
            }
            return $body;
        }

    }

}
