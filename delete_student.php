<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "bict");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if student ID is provided
if(isset($_GET['id'])) {
    $student_id = $_GET['id'];
    
    // SQL to delete record
    $sql = "DELETE FROM students WHERE id=$student_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to index.php after successful deletion
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Student ID not provided.";
}

// Close connection
$conn->close();
?>
