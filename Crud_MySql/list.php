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

// Handle deletion if delete button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $deleteId = $_POST["delete"];
    $deleteSql = "DELETE FROM student WHERE roll_no = '$deleteId'";
    $conn->query($deleteSql);
}

// Fetch data from the 'student' table
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Student List</h1>

        <table>
            <tr>
                <th>Roll No</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>10th Mark</th>
                <th>12th Mark</th>
                <th>Action</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['roll_no']}</td>
                            <td>{$row['student_name']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['10th_mark']}</td>
                            <td>{$row['12th_mark']}</td>
                            <td>
                                <form method='post' style='display: inline;'>
                                    <input type='hidden' name='delete' value='{$row['roll_no']}'>
                                    <button type='submit'>Delete</button>
                                </form>
                                <a href='edit.php?id={$row['roll_no']}'><button>Edit</button></a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            ?>
        </table>

        <button onclick="location.href='add.html'">Add</button>
    </div>
</body>
</html>
