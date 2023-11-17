

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


// ... (previous code)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollNo = $_POST["rollNo"];
    $studentName = $_POST["studentName"];
    $gender = $_POST["gender"];
    $tenthMark = isset($_POST["tenthMark"]) ? $_POST["tenthMark"] : null;
    $twelfthMark = isset($_POST["twelfthMark"]) ? $_POST["twelfthMark"] : null;

    // Handle empty values
    $tenthMark = ($tenthMark !== null && $tenthMark !== '') ? "'$tenthMark'" : 'NULL';
    $twelfthMark = ($twelfthMark !== null && $twelfthMark !== '') ? "'$twelfthMark'" : 'NULL';

    $sql = "INSERT INTO student (roll_no, student_name, gender, 10th_mark, 12th_mark)
            VALUES ('$rollNo', '$studentName', '$gender', $tenthMark, $twelfthMark)";

    if ($conn->query($sql) === TRUE) {
        header("Location: list.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

?>
