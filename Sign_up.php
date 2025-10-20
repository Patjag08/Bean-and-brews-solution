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


//Check if the email exists
$stmt = $conn->prepare("SELECT 1 FROM user WHERE user_email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Email exists."]);
} else {
    // Use prepared statements for safety
    $stmt = $conn->prepare("INSERT INTO user (user_name, user_email, user_password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        //echo "✅ New record created successfully!";
        echo json_encode(["status" => "success", "message" => "Sign up successful!"]);
    } else {
        //echo "❌ Error: " . $stmt->error;
        echo json_encode(["status" => "error", "message" => "An error occured."]);
    }
}

$stmt->close();
$conn->close();
?>