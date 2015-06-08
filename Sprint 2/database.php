<?php
class Database {
	private static $dbName="bestnid";
	private static $dbHost="localhost";
	private static $dbUsername="root";
	private static $dbPassword="";
	
	private static $cont = null;
	
	public function __construct(){
		die('Init function is not allowed');
	}
	
	public static function connect(){
		
		//Una conexión para toda la aplicación
		if(null == self::$cont){
			try{
				self::$cont = new mysqli(self::$dbHost,self::$dbUsername,self::$dbPassword,self::$dbName);
			}catch (mysqli_sql_exception $e){
				die($e->getMessage());
			}
		}
		return self::$cont;
	}
	
	public static function disconnect(){
		self::$cont = null;
	}
}

?>