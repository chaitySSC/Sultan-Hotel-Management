<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['signupName'];
$email = $_POST['signupEmail'];
$password = $_POST['signupPassword'];

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user data into the database
$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    // Registration successful
    // Redirect to login page or any other page
    header("Location: index.html");
} else {
    // Registration failed
    // Redirect back to signup page with error message
    echo "Error: " . $sql . "<br>" . $conn->error; // Print error message
}

$conn->close();
?>
