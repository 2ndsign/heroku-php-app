<style>
  #container {
    margin-top: 60px;
  }

  .btn--radius {
    border-radius: 20px;
  }

  

  
</style>

<?php
require_once("config.php");

$uri = $_SERVER['REQUEST_URI'];
$uriSplit = explode('/', $uri);
$emp_no = end($uriSplit);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM employees WHERE emp_no = {$emp_no} LIMIT 1";
$result = mysqli_query($conn, $sql);
if ($result){
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        $data = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
}

if (isset($_POST['cmd'])) {
    // edit employee
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];

    $birth_date = $_POST['birth_date'];
    $hire_date = $_POST['hire_date'];


    $salary = $_POST['salary'];
    $title = $_POST['title'];

    if (!is_numeric($salary)) {
        echo "Error : Salary is not a number<br/>";
    } else {
        $sql_update = "UPDATE employees
                       SET birth_date = '$birth_date', first_name = '$first_name', last_name = '$last_name',
                           gender = '$gender', hire_date = '$hire_date', salary = '$salary', title = '$title'
                       WHERE emp_no = '$emp_no'";

        if ($conn->query($sql_update) === TRUE) {
            echo "<script> location.href='../emp.php'; </script>";
        } else {
            echo "Error: " . $sql_update . "<br>" . $conn->error;
        }
        // exit();
    }
}

?>

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>

    <body>
    <div class="bottomAnim"></div>
        <div class="container" id="container">
            <div class="row justify-content-center">
                <h3>Edit Employee</h3>
            </div>

            <br>
            <br>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" name="cmd" value="save" />

                <div class="form-group row justify-content-center">
                    <label class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="title" value="<?php echo $data[0]['title']; ?>">
                    </div>
                </div>
                
                <div class="form-group row justify-content-center">
                    <label class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="first_name" value="<?php echo $data[0]['first_name']; ?>">
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="last_name" value="<?php echo $data[0]['last_name']; ?>">
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label class="col-sm-2 col-form-label">Birth Date</label>
                    <div class="col-sm-3">
                        <input type="date" name="birth_date" class="form-control" value="<?php echo $data[0]['birth_date']; ?>"></td>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label class="col-sm-2 col-form-label">Hire Date</label>
                    <div class="col-sm-3">
                        <input type="date" name="hire_date" class="form-control" value="<?php echo $data[0]['hire_date']; ?>">
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-1">
                        <input type="radio" name="gender" value="M" <?php echo ($data[0]['gender'] == 'M' ? 'checked' : ''); ?>>    Male
                    </div>
                    <div class="col-sm-2">
                        <input type="radio" name="gender" value="F" <?php echo ($data[0]['gender'] == 'F' ? 'checked' : ''); ?>>    Female
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <label class="col-sm-2 col-form-label">Salary</label>
                    <div class="col-sm-3">
                        <input type="number" name="salary" class="form-control" value="<?php echo $data[0]['salary']; ?>">
                    </div>
                </div>

                <br>
                
                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-outline-primary">
                </div>
            </form>

        </div>


            <!-- <table>
                <tr>
                    <th>Title</th>
                    <td><input type="text" name="title" value="<?php echo $data[0]['title']; ?>"></td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td><input type="text" name="first_name" value="<?php echo $data[0]['first_name']; ?>"></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input type="text" name="last_name" value="<?php echo $data[0]['last_name']; ?>"></td>
                </tr>
                <tr>
                    <th>Birth Date</th>
                    <td><input type="date" name="birth_date" value="<?php echo $data[0]['birth_date']; ?>"></td>
                </tr>
                <tr>
                    <th>Hire Date</th>
                    <td><input type="date" name="hire_date" value="<?php echo $data[0]['hire_date']; ?>"></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>
                        <input type="radio" name="gender" value="M" <?php echo ($data[0]['gender'] == 'M' ? 'checked' : ''); ?>>Male<br />
                        <input type="radio" name="gender" value="F" <?php echo ($data[0]['gender'] == 'F' ? 'checked' : ''); ?>>Female
                    </td>
                </tr>
                <tr>
                    <th>Salary</th>
                    <td><input type="text" name="salary" value="<?php echo $data[0]['salary']; ?>"></td>
                </tr>
            </table> -->
            <!-- <input type="submit"> -->
        <!-- </form> -->
    </body>
</html>

