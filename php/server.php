<?php
$servername = "localhost";
$username = "root";     // default XAMPP MySQL user
$password = "";         // default XAMPP has no password, unless you set one
$dbname = "bean_and_brew";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password']; // raw password (we’ll hash it below)

// OPTIONAL: hash password before storing (recommended!)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Use prepared statements for safety
$stmt = $conn->prepare("INSERT INTO user (user_name, user_email, user_password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed_password);

if ($stmt->execute()) {
    echo "✅ New record created successfully!";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>