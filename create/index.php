<?php
require_once("Database.class.php");
//Como parámetro va el nombre del proveedor que queréis cargar  
$db = DatabaseLayer::getConnection("MySqlProvider");  
//Imprimiría la estructura del array  
print_r($db->execute("SELECT id,email FROM users WHERE  name like ? LIMIT 20",array("ontuts%")));  
//Imprime un valor númerico  
echo($db->executeScalar("SELECT count(*) FROM users WHERE active=?",array(true)));  
