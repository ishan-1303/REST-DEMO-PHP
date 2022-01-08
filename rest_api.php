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
        $result = $this->stud->retrieve($this->stud->table_name());
        $row = pg_fetch_all($result);
        echo json_encode($row, JSON_FORCE_OBJECT);
    }

    function post() {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $this->stud->add($input['id'],$input['first_name'],$input['last_name'],$input['age'],$input['gender']);
        $result = $this->stud->save($this->stud);
        echo $result;
    }

    function put() {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $this->stud->add($input['id'],$input['first_name'],$input['last_name'],$input['age'],$input['gender']);
        $result = $this->stud->update($this->stud);
        echo $result;
    }

    function delete() {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $pk = $input['id'];
        $result = $this->stud->delete($pk,$this->stud->table_name());   
        echo $result;     
    }
}


