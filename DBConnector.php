<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','btc3205');

class DBConnector{
public $conn;

function ___construct(){
$this->conn=msqli_connect(DB_SERVER, DB_USER, DB_PASS) or die("Error: ".mysqli_error());
mysqli_select_db(DB_NAME, $this->conn);
}

public function closeDatabase() {
mysqli_close($this->conn);
}
}
?>