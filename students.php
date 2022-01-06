<?php
include('Model.php');

class Students extends Model{
    private $table = 'students';
    
    private $student_data = array();

    function add($id, $first_name, $last_name, $age, $gender) {
        $this->student_data[$id] = array();
        $this->student_data[$id]['id'] = $id;
        $this->student_data[$id]['first_name'] = $first_name;
        $this->student_data[$id]['last_name'] = $last_name;
        $this->student_data[$id]['age'] = $age;
        $this->student_data[$id]['gender'] = $gender;

        echo json_encode($this->student_data[$id]);
        return $this->student_data[$id];
    }

    function get_objects() {
        return $this->student_data;
    }

    function table_name() {
        return $this->table;
    }
}