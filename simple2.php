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

// Retrieve email ID from the request
$email = $_GET['email'];

// Prepare the SQL statement
$sql = "SELECT pdf_file FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);

// Execute the statement
$stmt->execute();
$stmt->store_result();

// Check if a result is found
if ($stmt->num_rows > 0) {
    $stmt->bind_result($pdf_file);
    $stmt->fetch();
    
    // Send the PDF file to the user
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($pdf_file) . '"');
    readfile($pdf_file);
} else {
    echo "No health report found for the given email ID.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
