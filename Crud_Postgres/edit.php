<!-- edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
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
    <h2>Edit Student</h2>

    <?php
    include('db.php');
   // var_dump($_GET);


    // edit.php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id_param = intval($id);

    // Debugging
    echo "Before query: id_param = $id_param<br>";

    // Retrieve the student record from the database
    $query = $db->prepare("SELECT * FROM student WHERE roll_no = ?");
    $query->execute([$id_param]);
    $student = $query->fetch(PDO::FETCH_ASSOC);

    // Debugging
    echo "After query: id_param = $id_param<br>";

    if (!$student) {
        echo "Student not found.";
        exit();
    }
} else {
    echo "Invalid request. Check 'id' parameter. Method: {$_SERVER['REQUEST_METHOD']}, id: {$_GET['id']}";
    exit();
}



    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        // Check if $student is set before using it
        if (!isset($student)) {
            echo "Student not found.";
            exit();
        }
    
        // Get data from the form
        $studentName = $_POST['student_name'];
        $gender = $_POST['gender'];
        $sslcMark = $_POST['sslc_mark'];
        $hscMark = $_POST['hsc_mark'];
    
        // Update data in the database
        $query = $db->prepare("UPDATE student SET student_name = ?, gender = ?, sslc_mark = ?, hsc_mark = ? WHERE roll_no = ?");
        $query->execute([$studentName, $gender, $sslcMark, $hscMark, $id_param]);
    
        // Redirect back to the list page
        header('Location: index.php');
        exit();
    }




    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get data from the form
        $studentName = $_POST['student_name'];
        $gender = $_POST['gender'];
        $sslcMark = $_POST['sslc_mark'];
        $hscMark = $_POST['hsc_mark'];

        // Update data in the database
        $query = $db->prepare("UPDATE student SET student_name = ?, gender = ?, sslc_mark = ?, hsc_mark = ? WHERE roll_no = ?");
        $query->execute([$studentName, $gender, $sslcMark, $hscMark, $id]);

        // Redirect back to the list page
        header('Location: index.php');
        exit();
    }
    ?>

    <!-- Form to edit the student -->
    <form method="post">
        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" value="<?php echo $student['student_name']; ?>" required><br>

        <label for="gender">Gender:</label>
        <input type="text" name="gender" value="<?php echo $student['gender']; ?>" required><br>

        <label for="sslc_mark">SSLC Mark:</label>
        <input type="number" name="sslc_mark" value="<?php echo $student['sslc_mark']; ?>" required><br>

        <label for="hsc_mark">HSC Mark:</label>
        <input type="number" name="hsc_mark" value="<?php echo $student['hsc_mark']; ?>" required><br>

        <input type="submit" name="update" value="Update Student">
    </form>
</body>
</html>
