<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bean_and_brew";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "❌ Connection failed."]);
    exit;
}

$email = $_POST['email'];
$pass = $_POST['password'];

$stmt = $conn->prepare("SELECT user_password FROM user WHERE user_email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($pass, $row['user_password'])) {
        echo json_encode(["status" => "success", "message" => "✅ Login successful!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Invalid password."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "❌ No user found."]);
}
