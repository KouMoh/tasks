<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    
    $sql_check = "SELECT * FROM employee WHERE email = '$email'";
    $result = $connection->query($sql_check);

    if ($result->num_rows > 0) {
        echo "Error: Email already exists";
    } else {
        $sql = "INSERT INTO employee (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
        
        if ($connection->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }

    $connection->close();
}
?>
