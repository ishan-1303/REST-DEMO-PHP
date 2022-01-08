<?php
include('dbcon.php');
class Model {
    protected $db;
    function __construct(){
        $this->db = new DBCon();
    }

    function get_db() {
        return $this->db;
    }

    function retrieve($table) {
        return $this->db->get_data($table);
    }

    function save($data_items) {
        $feedback = array();
        $data = $data_items->get_objects();
        $table = $data_items->table_name();
        foreach ($data as $key => $value) {
            $result = $this->db->insert_data($value, $table);
            if($result == false) {
                $feedback[] = "Failed";
            } else {
                $feedback[] = "Inserted into Database";
            }
        }
        echo json_encode($feedback);
        return json_encode($feedback);
    }

    function update($data_items) {
        $feedback = array();
        $data = $data_items->get_objects();
        $table = $data_items->table_name();
        foreach ($data as $key => $value) {
            $result = $this->db->update_data($value, $table);
            if($result == false) {
                $feedback[] = "Failed";
            } else {
                $feedback[] = "Updated in Database";
            }
        }
        echo json_encode($feedback);
        return json_encode($feedback);
    }

    function delete($pk, $table) {
        $feedback = "";
        $result = $this->db->delete_data($pk, $table);
        if($result == false) {
            $feedback = "Failed";
        } else {
            $feedback = "Deleted from Database";
        }
        echo $feedback;
        return $feedback;
    }
}