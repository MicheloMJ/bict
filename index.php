<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <h1>Student Management System</h1>
    <a href="add_student.php" class="button">Add New Student</a>
    <?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "bict");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetching students from the database
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display table if students are found
        echo "<table>";
        echo "<tr><th>ID</th><th>Email</th><th>Student Number</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Date of Registration</th><th>Date of Modification</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['student_number'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['date_of_birth'] . "</td>";
            echo "<td>" . $row['date_of_registration'] . "</td>";
            echo "<td>" . $row['date_of_modification'] . "</td>";
            echo "<td><a href='edit_student.php?id=" . $row['id'] . "' class='button'>Edit</a> <a href='delete_student.php?id=" . $row['id'] . "' class='button' onclick='return confirm(\"Are you sure you want to delete this student?\")'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // Display message if no students found
        echo "<p>No students found.</p>";
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
