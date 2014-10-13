<?php

namespace application\database\manager;

require (getcwd().'/application/database/manager/DBAbstractModel.php');

//require '/home/ecastro/TELESUR/composer/microframework/application/database/manager/DBAbstractModel.php';


class PostgreProvider extends DBAbstractModel {
    public static $vars = "hola";
    
	public function connect($param) {
            $parameter = "host=".$param[0]." port=".$param[1]." dbname=".$param[2]." user=".$param[3]." password=".$param[4];
            $this->resource = pg_connect($parameter);
            return $this->resource;
	}
	public function getErrorNo() {
		return mysqli_errno($this->resource);
	}
	public function getError() {
		return mysqli_error($this->resource);
	}
	public function query($q) {
		return mysqli_query($this->resource, $q);
	}
	public function fetchArray($result) {
		return mysqli_fetch_array($result);
	}
	public function isConnected() {
		return !is_null($this->resource);
	}
	public function escape($var) {
		return mysqli_real_escape_string($this->resource, $var);
	}

}