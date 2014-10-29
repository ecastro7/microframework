<?php

namespace application\database\manager {

    require (getcwd() . '/application/database/manager/PostgresProvider.php');

    class DBLayer {

        private $file = null;
        private $options = null;
        private $provider;
        private $params;

        public function __construct($file) {
            $this->file = $file;
        }

        public function setConfiguration() {
            $path = getcwd() . "/application/database/parameters/" . $this->file . ".json";
            if (is_readable($path) or die("Unable to open file!")) {
                $str_datos = file_get_contents($path);
                $datos = json_decode($str_datos, true);
                $datos["provider"] = $datos["provider"] . 'Provider';
                return $datos;
            }
        }

        public function getConnection() {
            $options = $this->setConfiguration();
            if (!class_exists(__NAMESPACE__ . '\\' . $options["provider"])) {
                throw new Exception("El proveedor indicado no existe");
            }
            $provider = __NAMESPACE__ . '\\' . $options["provider"];
            $this->provider = $provider::getConnection($options);
            print_r(!$this->provider->isConnected());
            if (!$this->provider->isConnected()) {
                /* Controlar error de conexion */
            } else {
                echo "Connection\n";
            }
        }

        private function replaceParams($coincidencias) {
            $b = current($this->params);
            next($this->params);
            return $b;
        }

        private function prepare($sql, $params) {
            for ($i = 0; $i < sizeof($params); $i++) {
                if (is_bool($params[$i]))
                    $params[$i] = $params[$i] ? 1 : 0;
                elseif (is_double($params[$i]))
                    $params[$i] = str_replace(',', '.', $params[$i]);
                elseif (is_numeric($params[$i]))
                    $params[$i] = $this->provider->escape($params[$i]);
                elseif (is_null($params[$i]))
                    $params[$i] = "NULL";
                else
                    $params[$i] = "'" . $this->provider->escape($params[$i]) . "'";
            }

            $this->params = $params;
            $q = preg_replace_callback("/(\?)/i", array($this, "replaceParams"), $sql);
            return $q;
        }

        private function sendQuery($q, $params) {
            $query = $this->prepare($q, $params);
            $result = $this->provider->query($query);
            /* Controlar errores */
            return $result;
        }

        public function executeScalar($q, $params = null) {
            $result = $this->sendQuery($q, $params);
            if (!is_null($result)) {
                if ($result) {
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
            if (!is_null($result)) {
                $arr = array();
                while ($row_result[] = $this->provider->fetchArray($result)) {
                    $arr = $row_result;
                }
                return $arr;
            }
            return null;
        }

    }

}