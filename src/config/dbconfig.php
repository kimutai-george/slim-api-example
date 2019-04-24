<?php

class dbconfig
{
	//db properties

	private $db_host = 'localhost';
	private $db_user =  'root';
	private $db_pass = '12??_??12kim';
	private $db_name = 'testtest';

	public function connect()
	{
		$mysql_connect = "mysql:host = $this->db_host;dbname=$this->db_name";
		$dbConnection = new PDO($mysql_connect, $this->db_user, $this->db_pass);
		$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $dbConnection;
	}
}
