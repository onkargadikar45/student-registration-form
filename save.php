<?php

$servername = "localhost";
$username = "root";
$password = "Onkar@123";
$dbname = "studentdb";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

// Get form data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');

// Validate fields
if (empty($name) || empty($email) || empty($phone)) {
    die("Please fill all fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Please enter a valid email address.");
}

if (!preg_match("/^[0-9]{10}$/", $phone)) {
    die("Phone number must contain exactly 10 digits.");
}

// Prepared statement
$stmt = $conn->prepare(
    "INSERT INTO students (name, email, phone) VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $name, $email, $phone);

// Save data
if ($stmt->execute()) {

    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
    echo "<title>Registration Successful</title>";
    echo "<style>";
    echo "body{font-family:Arial;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;justify-content:center;align-items:center;height:100vh;}";
    echo ".box{background:white;padding:35px;border-radius:15px;text-align:center;box-shadow:0 5px 20px rgba(0,0,0,.2);}";
    echo "h2{color:green;}";
    echo "a{display:inline-block;margin-top:15px;padding:10px 20px;background:#667eea;color:white;text-decoration:none;border-radius:8px;}";
    echo "</style>";
    echo "</head>";

    echo "<body>";
    echo "<div class='box'>";
    echo "<h2>✅ Registration Successful!</h2>";
    echo "<p>Student data saved successfully.</p>";
    echo "<a href='index.html'>Register Another Student</a>";
    echo "</div>";
    echo "</body>";

    echo "</html>";

} else {

    echo "Database error: " . $stmt->error;

}

// Close connection
$stmt->close();
$conn->close();

?>