<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script script="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container" my-5>
        <br>
        <h3>List Of Employees</h3>
        <hr>
        <div class="d-grid gap-1 d-md-flex justify-content-md-end">
            <a class="btn btn-primary" href="/SEDP/employee/create.php">Add Employee</a>
        </div>
        
        <br>
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ADDRESS</th>
                    <th>DEPARTMENT</th>
                    <th>PHONE</th>
                    <th>HIRE DATE</th>
                    <th>OPERATIONS</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $name="localhost";
            $username="root";
            $password="";
            $database="sedp_hrms";

            //create connection
            $connection = new mysqli($name, $username, $password, $database);

            //check connection
            if ($connection->connect_error) {
                die("connection faild!". $connection->connect_error);
            }
            //read all row from database table
            $sql= "SELECT * FROM employees";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid Query". $connection->error);
            }
            //read data of each row
            while ($row = $result->fetch_assoc()) {
                echo"
                <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[address]</td>
                    <td>$row[department]</td>
                    <td>$row[phone]</td>
                    <td>$row[hire_date]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/SEDP/employee/edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/SEDP/employee/delete.php?id=$row[id]'>delete</a>
                    </td>
                </tr>
                    ";
            }

            ?>
            </tbody>
            
        </table>
    </div>
    
</body>
</html>