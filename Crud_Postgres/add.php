<!-- add.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <style>
        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            margin-bottom: 10px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <h2>Add Student</h2>

    <?php
    include('db.php');

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get data from the form
        $studentName = $_POST['student_name'];
        $gender = $_POST['gender'];
        $sslcMark = $_POST['sslc_mark'];
        $hscMark = $_POST['hsc_mark'];

        // Insert data into the database
        $query = $db->prepare("INSERT INTO student (student_name, gender, sslc_mark, hsc_mark) VALUES (?, ?, ?, ?)");
        $query->execute([$studentName, $gender, $sslcMark, $hscMark]);

        // Redirect back to the list page
        header('Location: index.php');
        exit();
    }
    ?>

    <!-- Form to add a new student -->
    <form method="post">
        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" required><br>

        <label for="gender">Gender:</label>
        <input type="text" name="gender" required><br>

        <label for="sslc_mark">SSLC Mark:</label>
        <input type="number" name="sslc_mark" required><br>

        <label for="hsc_mark">HSC Mark:</label>
        <input type="number" name="hsc_mark" required><br>

        <input type="submit" value="Add Student">
    </form>
</body>
</html>
    