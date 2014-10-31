<?php

namespace application\database\manager {

    require ('application/database/manager/DBAbstractModel.php');

    class PostgresProvider extends DBAbstractModel {

        public function connect() {
            $parameter = "host=" . $this->host
                    . " port=" . $this->port
                    . " dbname=" . $this->dbname
                    . " user=" . $this->user
                    . " password=" . $this->pass;

            $this->resource = pg_connect($parameter);
            return $this->resource;
        }

        public static function getConnection($options, $flag) {

            if (!$flag) {
                self::$_instance = NULL;
            }
            if (!isset(self::$_instance)) {
                self::$_instance = new self($options);
            }
            return self::$_instance;
        }

        public function getError() {
            return pg_result_error($this->resource);
        }

        public function query($q) {
            return pg_query($this->resource, $q);
        }

        public function fetchArray($result) {
            return pg_fetch_object($result);
        }

        public function isConnected() {
            $status = FALSE;
            $stat = pg_connection_status($this->resource);
            if ($stat === PGSQL_CONNECTION_OK) {
                $status = TRUE;
//                echo "\nstatus: " . $stat ."\n";
            }
            return $status;
        }

        public function escape($var) {
            return pg_escape_string($var);
        }

        public function disconnect() {
            pg_close($this->resource);
        }

    }

}