<?php

namespace application\database\manager {

    abstract class DBAbstractModel {

        protected $host;
        protected $port;
        protected $user;
        protected $pass;
        protected $dbname;
        protected $resource;     //Guarda internamente el objeto de conexión
        protected static $_instance;

        protected function __construct(array $param) {
            $this->host = $param["host"];
            $this->port = $param["port"];
            $this->user = $param["user"];
            $this->pass = $param["pass"];
            $this->dbname = $param["dbname"];
            $this->connect();
        }

        public abstract function connect();

        public abstract function getError();

        public abstract function query($q);

        public abstract function fetchArray($resource);

        public abstract function isConnected();

        public abstract function escape($var);
    }

}