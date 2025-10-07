<?php
$servername = "localhost";
$username = "root";     // default XAMPP MySQL user
$password = "";         // default XAMPP has no password, unless you set one
$dbname = "bean_and_brew";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password']; // raw password (we’ll hash it below)

// OPTIONAL: hash password before storing (recommended!)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Use prepared statements for safety
$stmt = $conn->prepare("SELECT user_password FROM user WHERE user_email = ?; ");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $pass_check = password_verify($password, $row['user_password']);
        echo $pass_check;
        if ($pass_check == $password) {
            echo "Your in.";
        } else {
            echo "Your bad.";
        }
        //echo "Password hash: " . $row['user_password']; // ✅ print as string
    } else {
        echo "❌ No user found with that email.";
    }
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>