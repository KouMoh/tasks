<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "php_employee_management";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employee WHERE id = $id AND is_deleted = FALSE";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    }
} else {
    $sql = "SELECT * FROM employee WHERE is_deleted = FALSE";
    $result = $connection->query($sql);
    $rows = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'address' => $row['address'],
                'created_at' => $row['created_at']
            ];
        }
    }
    echo json_encode($rows);
}

$connection->close();
?>
