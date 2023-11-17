<?php
$hostname = "localhost";
$username = "datab";
$password = "datab";
$database = "naresh";


// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Redirect to List Page Screen
        header("Location: list.php");
        exit();
    } else {
        echo "Username or password is incorrect.";
    }
}

$conn->close();
?>
