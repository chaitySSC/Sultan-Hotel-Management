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
$email = $_POST['loginEmail'];
$password = $_POST['loginPassword'];

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, verify password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Authentication successful
        // Redirect to index.html or any other page
        header("Location: home.html");
        exit(); // Add exit to stop further execution
    }
}

// If user not found or password incorrect, redirect back to login page with error message
echo "<script>alert('Invalid email or password. Please try again.');</script>";
echo "<script>window.location.href = 'index.html';</script>";

$conn->close();
?>
