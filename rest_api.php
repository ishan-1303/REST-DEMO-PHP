<?php
include('students.php');

class REST_API {
    private $method;
    private $stud;
    private $db;
    function __construct(){
        $method = $_SERVER['REQUEST_METHOD'];
        $this->stud = new Students();
        $this->db =  $this->stud->get_db();
        // echo($this->db);

        if($method == 'GET') {
            $this->get();
        }
        if($method == 'POST') {
            $this->post();
        }
        if($method == 'PUT') {
            $this->put();
        }
        if($method == 'DELETE') {
            $this->delete();
        }
    }

    function get() {
        // echo "GET method";  
        $result = $this->stud->retrieve($this->stud->table_name());
        $row = pg_fetch_all($result);
        echo json_encode($row, JSON_FORCE_OBJECT);
        
    }

    function post() {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $this->stud->add($input['id'],$input['first_name'],$input['last_name'],$input['age'],$input['gender']);
        $result = $this->stud->save($this->stud);
    }

    function put() {
        echo "PUT method";  
    }

    function delete() {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $pk = $input['id'];
        $result = $this->stud->delete($pk,$this->stud->table_name());        
    }
}


