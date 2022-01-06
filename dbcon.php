<?php
class DBCon{
    //private $dbconn;
    public $host       = "localhost";
    public $database   = "Students2";
    public $user       = "test";
    public $password   = "test@123";
    private $dbconn;
    
    function __construct(){
        $this->dbconn = pg_connect("host=$this->host dbname=$this->database user=$this->user password=$this->password");
        // echo $this->dbconn;
    }   

    function get_data($table) {
        $query = "SELECT * FROM " . $table;
        $result = pg_query($this->dbconn,$query);
        return $result;
    }

    function insert_data($class, $data) {
        $query = "INSERT INTO " . $this->table_name();
        $q1 = "(";
        $q2 = "VALUES(";
        while(list($name,$value) = each($array)) {
            if(!is_null($value) and $value != "") {
                $q1 .= "$name,";
                $q2 .= "$value,";
            }
        }
        $q1[strlen($q1)-1] = ')';
        $q2[strlen($q2)-1] = ')';
        $query .= $q1 . $q2;

        $result = pg_query($this->dbconn,$query);
        return $result;
    }

    function save_data($data, $table) {
        $query = "INSERT INTO " . $table;
        $q1 = "(";
        $q2 = " VALUES(";

        foreach ($data as $key => $value) {
           $q1 .= "$key,";
           $q2 .= "'$value',";
        }
        
        $q1[strlen($q1)-1] = ')';
        $q2[strlen($q2)-1] = ')';
        $query .= $q1 . $q2;
        $result = pg_query($this->dbconn,$query);
        return $result;
    }

    function delete_data($pk, $table) {
        $query = "DELETE FROM " . $table . " WHERE id=" . $pk;
        $result = pg_query($this->dbconn,$query);
        return $result;
    }
 
}

// $db = new DBCon();