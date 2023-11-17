<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

       
        /* Style for the delete link button */
        .delete-link {
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
            border: none;
            background-color: transparent;
            padding: 0;
            margin: 0;
        }
   
    </style>
</head>
<body>
    <h2>Student List</h2>
    <?php
    include('db.php');

//     $query = $db->query("SELECT * FROM student");
//     $students = $query->fetchAll(PDO::FETCH_ASSOC);

//  // Check if delete button is clicked
//  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
//     $deleteId = $_POST['deleteId'];

//     // Delete record from the database
//     $query = $db->prepare("DELETE FROM student WHERE roll_no = ?");
//     $query->execute([$deleteId]);
// }


// Check if delete button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $deleteId = $_POST['deleteId'];

    // Delete record from the database
    $queryDelete = $db->prepare("DELETE FROM student WHERE roll_no = ?");
    $queryDelete->execute([$deleteId]);

    // Fetch updated student records
    $queryFetch = $db->query("SELECT * FROM student");
    $students = $queryFetch->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Fetch initial student records
    $query = $db->query("SELECT * FROM student");
    $students = $query->fetchAll(PDO::FETCH_ASSOC);
}

    ?>

    <table>
        <thead>
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Gender</t/h>
                <th>SSLC Mark</th>
                <th>HSC Mark</th>
                <th>Action</th> <!-- Add a new column for the "Edit" button -->

            </tr>
        </thead>
        <tbody>
        <a href="add.php">Add Student</a>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['roll_no']; ?></td>
                    <td><?php echo $student['student_name']; ?></td>
                    <td><?php echo $student['gender']; ?></td>
                    <td><?php echo $student['sslc_mark']; ?></td>
                    <td><?php echo $student['hsc_mark']; ?></td>
                    <td><a href="edit.php?id=<?php echo $student['roll_no']; ?>">Edit</a>
                    <form method="post">
                            <input type="hidden" name="deleteId" value="<?php echo $student['roll_no']; ?>">
                            <button type="submit" name="delete" class="delete-link">Delete</button>
                        </form></td>


                </tr>
            <?php endforeach; ?>
           
        </tbody>
    </table>
</body>
</html>
