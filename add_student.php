<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Database connection
$conn = new mysqli("localhost", "root", "", "bict");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];

    $sql = "INSERT INTO students (email, first_name, last_name, date_of_birth) VALUES ('$email', '$firstName', '$lastName', '$dateOfBirth')";

    if ($conn->query($sql) === TRUE) {
        $message = "Student added successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff; /* Light blue */
            text-align: center;
            padding-top: 20px;
        }
        a {
            background-color: #007bff; /* Blue */
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        a:hover {
            background-color: #0056b3; /* Darker blue */
        }

        h1 {
            color: #007bff; /* Blue */
        }

        #addStudentForm {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f0f8ff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #addStudentForm h2 {
            color: #007bff; /* Blue */
            margin-bottom: 20px;
        }

        #addStudentForm form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        #addStudentForm form input[type="email"],
        #addStudentForm form input[type="text"],
        #addStudentForm form input[type="date"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #addStudentForm form button[type="submit"] {
            background-color: #007bff; /* Blue */
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        #addStudentForm form button[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue */
        }

        #message {
            margin-top: 20px;
            color: green;
        }
    </style>
</head>
<body>
    <h1>Student Management System</h1>
    
    <div id="addStudentForm">
        <h2>Add New Student</h2>
        <a href="index.php">Back</a>
        <form method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="firstName">First Name:</label><br>
            <input type="text" id="firstName" name="firstName" required><br>
            <label for="lastName">Last Name:</label><br>
            <input type="text" id="lastName" name="lastName" required><br>
            <label for="dateOfBirth">Date of Birth:</label><br>
            <input type="date" id="dateOfBirth" name="dateOfBirth" required><br><br>
            <button type="submit" class="button">Submit</button>
        </form>
    </div>

    <div id="message"><?php if(isset($message)) { echo $message; } ?></div>
</body>
</html>
