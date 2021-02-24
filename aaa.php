<?php
require_once("config.php");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<?php
// Employee
$sql = "SELECT * FROM employees LIMIT 10000";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $counter = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        // echo "id: " . $row["emp_no"] . " - Name: " . $row["first_name"] . " " . $row["last_name"] . " - " . $row["gender"] . "<br>";
        // $counter++;

        $columns = array(
            array('db' => 'emp_no', 'dt' => 0),
            array('db' => 'first_name', 'dt' => 1),
            array('db' => 'last_name', 'dt' => 2),
            array('db' => 'gender', 'dt' => 3),
            array('db' => 'birth_date', 'dt' => 4),
            array('db' => 'title', 'dt' => 5),
            array('db' => 'hire_date', 'dt' => 6),
            array('db' => 'salary', 'dt' => 7)
        );
    }
}


mysqli_close($conn);

// TODO Show list of departments
?>