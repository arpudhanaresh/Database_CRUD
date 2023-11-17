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
    $rollNo = $_POST["rollNo"];
    $studentName = $_POST["studentName"];
    $gender = $_POST["gender"];
    $tenthMark = $_POST["tenthMark"];
    $twelfthMark = $_POST["twelfthMark"];

    // Update the record in the 'student' table
    $updateSql = "UPDATE student SET 
                    student_name = '$studentName', 
                    gender = '$gender', 
                    10th_mark = '$tenthMark', 
                    12th_mark = '$twelfthMark' 
                  WHERE roll_no = '$rollNo'";

    if ($conn->query($updateSql) === TRUE) {
        // Redirect to list.php after successful update
        header("Location: list.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
