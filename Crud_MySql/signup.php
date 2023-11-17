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
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO users (first_name, last_name, username, email, password)
            VALUES ('$firstName', '$lastName', '$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to Sign In Page after successful signup
        header("Location: signin.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
