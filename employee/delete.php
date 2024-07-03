<?php
if( isset($_GET["id"])){
    $id = $_GET["id"];

    $name="localhost";
    $username="root";
    $password="";
    $database="sedp_hrms";

    //create connection
    $connection = new mysqli($name, $username, $password, $database);

    $sql = "DELETE FROM employees WHERE id=$id";
    $connection->query($sql);

}

header("location: /SEDP/employee/index.php");
exit;
?>