<?php

namespace application\database\manager;

require (getcwd().'/application/database/manager/PostgreProvider.php');

//require (getcwd().'/application/database/manager/loading.php');

class DBLayer {
	private $provider;
	private $params;
	private static $_con;

	private function __construct($provider, $options) {
            echo '--'.\PostgreProvider::$vars.'--';
//            echo getcwd().'/application/database/manager/PostgreProvider.php';
//            print_r(get_declared_classes());
            $path = getcwd()."/application/database/manager/".$options.".json";
            if (is_readable($path) or die("Unable to open file!") ) {
                $paramDB = $this->setOptions($path);
                print_r(__NAMESPACE__.'\\'.$provider."\n");
		if (!class_exists(__NAMESPACE__.'\\'.$provider)) {
                    trigger_error("No es posible cargar la clase: $provider", E_USER_WARNING);
                    throw new Exception("El proveedor indicado no existe");
		}
		$this->provider = new $provider;
		$this->provider->connect($paramDB);
                print_r(!$this->provider->isConnected());
		if (!$this->provider->isConnected()) {
			/*Controlar error de conexion*/
		}
            } else {
                /*Gestionar error de lectura de archivo*/
            }
	}
        
        public function setOptions($path) {
            $str_datos = file_get_contents($path);
            $datos = json_decode($str_datos,true);
            return $datos;
        }
        
	public static function getConnection($provider, $options) {
		if (self::$_con) {
			return self::$_con;
		} else {
			$class = __CLASS__;
                        echo $class."\n";
                        die;
			self::$_con = new self($provider, $options);
			return self::$_con;
		}
	}
        
        /*Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos*/
        public static function getInstance(){
           if (!(self::$_instance instanceof self)){
              self::$_instance=new self();
           }
           return self::$_instance;
        }
        
	private function replaceParams($coincidencias) {
		$b = current($this->params);
		next($this->params);
		return $b;
	}

	private function prepare($sql, $params) {
		for ($i = 0; $i < sizeof($params);
			$i++) {
			if (is_bool($params[$i])) {
				$params[$i] = $params[$i] ? 1 : 0;
			} elseif (is_double($params[$i])) {
				$params[$i] = str_replace(',', '.', $params[$i]);
			} elseif (is_numeric($params[$i])) {
				$params[$i] = $this->provider->escape($params[$i]);
			} elseif (is_null($params[$i])) {
				$params[$i] = "NULL";
			} else {

				$params[$i] = "'" . $this->provider->escape($params[$i]) . "'";
			}
		}

		$this->params = $params;
		$q = preg_replace_callback("/(\?)/i", array($this, "replaceParams"), $sql);

		return $q;
	}

	private function sendQuery($q, $params) {
		$query = $this->prepare($q, $params);
		$result = $this->provider->query($query);
		if ($this->provider->getErrorNo()) {
			/*Controlar errores*/
		}
		return $result;
	}

	public function executeScalar($q, $params = null) {
		$result = $this->sendQuery($q, $params);
		if (!is_null($result)) {
			if (!is_object($result)) {
				return $result;
			} else {
				$row = $this->provider->fetchArray($result);
				return $row[0];
			}
		}
		return null;
	}

	public function execute($q, $params = null) {
		$result = $this->sendQuery($q, $params);
		if (is_object($result)) {
			$arr = array();
			while ($row = $this->provider->fetchArray($result)) {
				$arr[] = $row;
			}
			return $arr;
		}
		return null;

	}

}