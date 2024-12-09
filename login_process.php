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

// Get form data
$matric = $_POST['matric'];
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT * FROM users WHERE matric = '$matric'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch user data
    $row = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $row['password'])) {
        // Login successful
        header("Location: display_users.php");
        exit();
    } else {
        // Incorrect password
        $error = "Invalid matric or password.";
    }
} else {
    // User not found
    $error = "Invalid matric or password.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Failed</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8d7da;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Container styling */
        .container {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            width: 300px;
        }

        /* Headings */
        h1 {
            color: #721c24;
            font-size: 24px;
            margin-bottom: 10px;
        }

        /* Error message */
        p {
            color: #721c24;
            margin-bottom: 20px;
            font-size: 16px;
        }

        /* Link styling */
        a {
            color: #0056b3;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border: 1px solid #0056b3;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #ffffff;
            cursor: pointer;
        }

        a:hover {
            background-color: #0056b3;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login Failed</h1>
        <p><?php echo $error; ?></p>
        <a href="login.php">Go back to login</a>
    </div>
</body>
</html>

