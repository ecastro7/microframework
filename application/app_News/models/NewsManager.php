<?php

namespace application\app_demo\models;

require (getcwd().'/application/database/manager/DBLayer.php');

use application\database\manager\DBLayer as Layer;

/**
 * Description of NewsManager
 *
 * @author ecastro
 */
class NewsManager {
    
    static function SearchNews($fecha) {
        //Como parámetro va el nombre del proveedor que queréis cargar  
        $db = Layer::getConnection("PostgreProvider", "prueba");  
        //Imprimiría la estructura del array  
        print_r($db->execute("SELECT id,descripcion,fecha FROM news WHERE  fecha = ? LIMIT 2",array($fecha)));
        die;
    }
    
}
