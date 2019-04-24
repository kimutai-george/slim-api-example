<?php

class dbconfig
{

	//database
	//use the following sql command to create your table
		/*CREATE TABLE `customers` (
	  `id` int(12) NOT NULL AUTO_INCREMENT,
	  `first_name` varchar(20) DEFAULT NULL,
	  `last_name` varchar(20) DEFAULT NULL,
	  `phone_number` varchar(30) DEFAULT NULL,
	  `email` varchar(30) DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;*/


	//db properties

	private $db_host = 'localhost';
	private $db_user =  'root';
	private $db_pass = '';
	private $db_name = 'testtest';

	public function connect()
	{
		$mysql_connect = "mysql:host = $this->db_host;dbname=$this->db_name";
		$dbConnection = new PDO($mysql_connect, $this->db_user, $this->db_pass);
		$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $dbConnection;
	}
}
