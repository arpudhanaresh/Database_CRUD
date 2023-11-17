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

// Get the roll_no from the query parameter
if(isset($_GET['id'])) {
    $editId = $_GET['id'];

    // Fetch data for the selected record
    $editSql = "SELECT * FROM student WHERE roll_no = '$editId'";
    $editResult = $conn->query($editSql);

    if ($editResult->num_rows > 0) {
        $editRow = $editResult->fetch_assoc();
    } else {
        // Handle record not found
        echo "Record not found";
        exit();
    }
} else {
    // Handle missing query parameter
    echo "Invalid request";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Student</h1>
        <form action="update.php" method="post">
            <input type="hidden" name="rollNo" value="<?php echo $editRow['roll_no']; ?>">

            <label for="studentName">Student Name:</label>
            <input type="text" id="studentName" name="studentName" value="<?php echo $editRow['student_name']; ?>" required>

            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" value="<?php echo $editRow['gender']; ?>" required>

            <label for="10thMark">10th Mark:</label>
            <input type="text" id="10thMark" name="tenthMark" value="<?php echo $editRow['10th_mark']; ?>" required>

            <label for="12thMark">12th Mark:</label>
            <input type="text" id="12thMark" name="twelfthMark" value="<?php echo $editRow['12th_mark']; ?>" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
