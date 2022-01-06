<?php
include('students.php');

$stud = new Students();
$stud->add(101, 'Alice', 'Schmidt', '19', 'F');
$stud->add(111, 'Bob', 'Schmidt', '21', 'M');

$stud->save($stud);