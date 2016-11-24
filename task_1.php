<?php

final class Init {
	private $dbConnection = false;
	private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbName = "";
	
    function __construct() {
        $this->dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
		
		if(mysqli_connect_error()) {
			trigger_error("Failed to conenc to to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}else {
			if($this->create()){
				$this->fill();
			}
		}
    }
	
	/**
	 * This method create MySQL table
	 * @return booling
	 */
	private function create(){
		$sql_query = "CREATE TABLE IF NOT EXISTS test (
        id int(11) NOT NULL auto_increment,
        script_name varchar(25) default NULL,
        strart_time DATETIME default NULL,
        end_time DATETIME default NULL,
        result ENUM('normal','illegal','failed','success') NOT NULL DEFAULT 'normal',
        PRIMARY KEY (id)) ENGINE=MyISAM DEFAULT CHARSET=utf8";
		
		return $this->dbConnection->query($sql_query);
	}
	
	/**
	 * This method fill the table by random data
	 * @return void
	 */
	private function fill() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$result_arr = array('normal','illegal','failed','success');
		
		for($i = 0; $i < 10; $i++){
			$strart_time =date("Y-m-d H:i:s");
			$end_time =date("Y-m-d H:i:s", strtotime("+4 hour"));
			$script_name = '';
			for ($a = 0; $a < 10; $a++) {
				$script_name .= $characters[rand(0, strlen($characters))];
			}
			$result = $result_arr[mt_rand(0, count($result_arr) - 1)];
			
			$this->dbConnection->query("INSERT INTO test(script_name, strart_time, end_time, result) VALUES ('".$script_name."', '".$strart_time."', '".$end_time."', '".$result."')");
		}
	}

	/**
	 * This method get data from tabls by filter
	 * @return array of data of false
	 */	
	function get() {
		$result_arr = array();
	
		$respons = $this->dbConnection->query("SELECT * FROM test WHERE result = 'normal' OR result = 'success'");
		if($respons){
			while($row = mysqli_fetch_array($respons))
				array_push( $result_arr, $row);
		}

		if(empty($result_arr))
			return false;
		else
			return $result_arr;
	}
}

$init = new Init();
$init->get();
?>
