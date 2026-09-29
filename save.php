<?php

$servername = "localhost";
$username = "root";
$password = "YOUR_DB_PASSWORD";
$dbname = "studentdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sql = "INSERT INTO students (name, email, phone)
        VALUES ('$name', '$email', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Registration Successful!</h2>";
    echo "<p>Student data saved successfully.</p>";
    echo "<a href='index.html'>Go Back</a>";
} else {
    echo "Database error: " . $conn->error;
}

$conn->close();

?>