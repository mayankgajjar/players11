<?php



class Database

{

	// specify your own database credentials

    private $host = "localhost";
    private $db_name = "nexusuvx_player11";
    private $username = "nexusuvx_nexus";
    private $password = 'VbYD%$Rhq&s5';
    public $conn;

    // get the database connection

    public function getConnection(){
        $this->conn = null;
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if($this->conn === false){
		    die("ERROR: Could not connect. " . $mysqli->connect_error);
		}
        return $this->conn;
    }



}





?>