<?php
header("Content-Type: application/json");

session_start();
if (isset($_SESSION["name"]))
{
    header("location:Index.html");
}

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
$keeplogged = $_POST['keeplogged'];

$stmt = $conn->prepare("SELECT user_password FROM user WHERE user_email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($pass, $row['user_password'])) {
        if ($keeplogged == 1) {
            setcookie("user_login", $email, time() +
                                    (10 * 365 * 24 * 60 * 60));
            setcookie("user_password", $row["user_password"], time() +
                                    (10 * 365 * 24 * 60 * 60));
            // After setting cookies the session variable will be set
            $_SESSION["name"] = $email;
        }
        echo json_encode(["status" => "success", "message" => "Login successful!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid password."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No user found."]);
}
