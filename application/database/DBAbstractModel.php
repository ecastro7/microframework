<?php 

namespace database;


abstract class DBAbstractModel {
	#Guarda internamente el objeto de conexión
	protected $resource;
	#Se conecta según los datos especificados
	public abstract function connect($host, $user, $pass, $dbname);
	#Obtiene el número del error
	public abstract function getErrorNo();
	#Obtiene el texto del error
	public abstract function getError();
	#Envía una consulta
	public abstract function query($q);
	#Convierte en array la fila actual y mueve el cursor
	public abstract function fetchArray($resource);
	#Comprueba si está conectado
	public abstract function isConnected();
	#Escapa los parámetros para prevenir sql inyección
	public abstract function escape($var);
}