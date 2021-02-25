<html>
<head>
<h1 style="text-align: center">List of employees</h1>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script defar src="all.js"></script>
</head>

<body>
<img src="https://blog.bonus.ly/hubfs/employee-experience-featured-image.png"  style="width:100%" height="500" style="text-align:center">
<table class="table" id="tableEmployee" style="width:100%">
  <br><br>
  <br>
  <thead class="thead-dark">
    <tr>
      <th >Employee Number</th>
      <th scope="col">Title</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Gender</th>
      <th scope="col">Salary</th>
      <th scope="col">Birth Date</th>
      <th scope="col">Hire Date</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
</table>
<script type="text/Javascript">
    $(document).ready(function() {
        const url = 'edit.php';
        $('#tableEmployee').DataTable({
            "stripeClasses": [],
            "processing": true,
            "serverSide": true,
            "ajax": "./query.php",
            "columns": [
                { "data": "emp_no" },
                { "data": "title" },
                { "data": "first_name" },
                { "data": "last_name" },
                { "data": "gender" },
                { "data": "salary" },
                { "data": "birth_date" },
                { "data": "hire_date" },
                
                {
                    "orderable": false,
                    "data": "emp_no",
                    "createdCell": function (td, cellData, rowData, row, col) {
                        $(td).text('');
                        var button = $(`<a href=${url}/${cellData}><i class='fas fa-user-edit' id='${cellData}'></i>`);
                        $(td).append(button);
                    },
                    "defaultContent": ""
                },
            ],
            "order": [[1, 'asc']]
        });
    });

</script>
    

</body>

</html>
