$servername = "localhost";
$username = "root";     // default XAMPP MySQL user
$password = "";         // default XAMPP has no password, unless you set one
$dbname = "bean and brew";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['passw'];


// Insert into database
$sql = "INSERT INTO user (user_name, user_email, user_password) VALUES ('$name', '$email', $password)";

if ($conn->query($sql) === TRUE) {
    echo "✅ New record created successfully!";
} else {
    echo "❌ Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();