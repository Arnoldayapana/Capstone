<?php

$name="localhost";
$username="root";
$password="";
$database="sedp_hrms";

//create connection
$connection = new mysqli($name, $username, $password, $database);


$name ="";
$email ="";
$address ="";
$department ="";
$phone ="";
$hire_date ="";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] =='GET'){
    //

    if ( !isset($_GET["id"])){
        header("Location: /SEDP/employee/index.php");
        exit;
    }
    
    $id =$_GET["id"];

    //read the row of the selected data
    $sql = "SELECT * FROM employees WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if ( !$row ){
        header("Location: /SEDP/employee/index.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $address = $row["address"];
    $department = $row["department"];
    $phone = $row["phone"];
    $hire_date = $row["hire_date"];
}
else{
    //Update the data go the employee
    $id = $_POST["id"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $hire_date = $_POST['hire_date'];

    do {
        if ( empty($name) || empty($email) || empty($address) || empty($department) ||empty($phone) || empty($hire_date) ){
            $errorMessage = "all the field are required";
            break;    
        }
        $sql = "UPDATE employees SET name = '$name', email = '$email', address ='$address', department = '$department', phone='$phone', hire_date='$hire_date' " .
                "WHERE id = $id";

        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Employee Updated Succefuly!";

        header("Location: /SEDP/employee/index.php");
        exit;

    } while(false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Employee</h2>

        <?php 
        if ( !empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label  class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label  class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label  class="col-sm-2 col-form-label"">Department</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="department" value="<?php echo $department; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label  class="col-sm-2 col-form-label"">Phone Number</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label  class="col-sm-2 col-form-label"">Hire Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="hire_date" value="<?php echo $hire_date; ?>">
                </div>
            </div>
            <?php
            if ( !empty($successMessage) ){
                echo "
                 <div class='row mb-3'>
                    <div class='offset-sm-2 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                    </div>
                  </div>
                 </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-2 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary" href="index.php" role="button">Cancel</button>
                </div>
                
            </div>

        </form>
    </div>
    
</body>
</html>