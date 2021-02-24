<?php
require_once("config.php");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<!-- <h1>Employees</h1>

<table id="employee-table" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Employee Number</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Gender</th>
            <th>Birth Date</th>
            <th>Title</th>
            <th>Hire Date</th>
            <th>Salary</th>
        </tr>
    </thead>
</table> -->

<?php
// Employee
$sql = "SELECT * FROM employees LIMIT 10000";
$result = mysqli_query($conn, $sql);

$columns = array(
    array(0 => 'emp_no'),
    array(1 => 'first_name'),
    array(2 => 'last_name'),
    array(3 => 'gender'),
    array(4 => 'birth_date'),
    array(5 => 'title'),
    array(6 => 'hire_date'),
    array(7 => 'salary')
);

if (mysqli_num_rows($result) > 0) {
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) { 
        $data[] = $row; 
    } 
}

$json_data = array(
    "draw" => 0,
    "recordsTotal" => 0,
    "recordsFiltered" => 0,
    "data" => $data   // total data array
);


echo json_encode($json_data);

mysqli_close($conn);

?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.min.js"></script>


<script type="text/Javascript">
    $(document).ready(function() {
        $('#employee-table').DataTable( {
            "processing": true,
            "serverSide": true,
            // "ajax": "./emp.php"
            "ajax" : {
                "url" : "./emp.php",
                "dataSrc" : ""
            }
        });
});
</script>