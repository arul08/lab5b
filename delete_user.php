<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab_5b";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Delete the user from the database
    $sql = "DELETE FROM users WHERE matric = '$matric'";
    if ($conn->query($sql) === TRUE) {
        header("Location: display_users.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

$conn->close();
?>
