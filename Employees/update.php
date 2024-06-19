<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "php_employee_management";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    
    $sql_check = "SELECT * FROM employee WHERE email = '$email' AND id != $id";
    $result = $connection->query($sql_check);

    if ($result->num_rows > 0) {
        echo "Error: Email already exists";
    } else {
        $sql = "UPDATE employee SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id";
        
        if ($connection->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }

    $connection->close();
}
?>
