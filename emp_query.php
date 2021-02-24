<?php
require_once("config.php");

// DB table to use
$table = 'employees';
 
// Table's primary key
$primaryKey = 'emp_no';
 
$columns = array(
    array('db' => 'emp_no', 'dt' => "emp_no"),
    array('db' =>  'first_name', 'dt' => "first_name"),
    array('db' =>  'last_name', 'dt' => "last_name"),
    array('db' =>  'gender', 'dt' => "gender"),
    array('db' =>  'birth_date', 'dt' => "birth_date"),
    array('db' =>  'title', 'dt' => "title"),
    array('db' =>  'hire_date', 'dt' => "hire_date"),
    array('db' =>  'salary', 'dt' => "salary")
);
 
$sql_details = array(
    'user' => $username,
    'pass' => $password,
    'db'   => $dbname,
    'host' => $servername
);
 
require('./ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
?>