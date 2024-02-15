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
    $id = $_POST['id'];
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];

    $sql = "UPDATE students SET email='$email', first_name='$firstName', last_name='$lastName', date_of_birth='$dateOfBirth' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $message = "Student updated successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Retrieve student details based on ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM students WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['email'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $dateOfBirth = $row['date_of_birth'];
        } else {
            $message = "Student not found";
        }
    } else {
        $message = "Student ID not provided";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Light blue */
            text-align: center;
            padding-top: 20px;
        }

        h1 {
            color: #007bff; /* Blue */
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

        #editStudentForm {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #editStudentForm h2 {
            color: #007bff; /* Blue */
            margin-bottom: 20px;
        }

        #editStudentForm form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        #editStudentForm form input[type="email"],
        #editStudentForm form input[type="text"],
        #editStudentForm form input[type="date"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #editStudentForm form button[type="submit"] {
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

        #editStudentForm form button[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue */
        }

        #message {
            margin-top: 20px;
            color: green;
        }
    </style>
</head>
<body>
    <h1>Edit Student</h1>
    
    <div id="editStudentForm">
        <h2>Edit Student Details</h2>
        <a href="index.php">Back</a>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>
            <label for="firstName">First Name:</label><br>
            <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required><br>
            <label for="lastName">Last Name:</label><br>
            <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required><br>
            <label for="dateOfBirth">Date of Birth:</label><br>
            <input type="date" id="dateOfBirth" name="dateOfBirth" value="<?php echo $dateOfBirth; ?>" required><br><br>
            <button type="submit" class="button">Update</button>
        </form>
    </div>

    <div id="message"><?php if(isset($message)) { echo $message; } ?></div>
</body>
</html>
