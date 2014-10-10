<?php

namespace database;

class DBLayer {
	private $provider;
	private $params;
	private static $_con;

	private function __construct($provider, $options) {
            echo "paso";
            if (file_exists("'".$options.".json'") or die("Unable to open file!") ) {
                $paramDB = $this->setOptions($options);
		if (!class_exists($provider)) {
			throw new Exception("El proveedor indicado no existe");
		}
		$this->provider = new $provider;
		$this->provider->connect("localhost", "usuarioBaseDatos", "tuPassword", "tuBaseDatos");
		if (!$this->provider->isConnected()) {
			/*Controlar error de conexion*/
		}
            } else {
                
            }
	}
        
        public function setOptions($options) {
            $str_datos = file_get_contents("'".$options.".json'");
            $datos = json_decode($str_datos,true);
            var_dump($datos);
            die;
            return $datos;
        }
        
	public static function getConnection($provider) {
		if (self::$_con) {
			return self::$_con;
		} else {
			$class = __CLASS__;
			self::$_con = new $class($provider);
			return self::$_con;
		}
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