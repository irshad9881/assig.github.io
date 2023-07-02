<?php
// Configuration variables
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user details from the form
$name = $_POST['fname'];
$name = $_POST['lname'];
$email = $_POST['email'];
$email = $_POST['pass'];
$email = $_POST['age'];
$email = $_POST['weight'];
$filename = $_FILES['pdf']['name'];
$filetmp = $_FILES['pdf']['tmp_name'];

// Move uploaded PDF file to a desired location
$destination = "uploads/" . $filename;
move_uploaded_file($filetmp, $destination);

// Prepare the SQL statement
$sql = "INSERT INTO users (fname,lname, email,pass,age,weight, pdf_file) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $fname,$fname,$lname, $email,$pass,$weight, $destination);

// Execute the statement
if ($stmt->execute()) {
    echo "User details and PDF file inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
