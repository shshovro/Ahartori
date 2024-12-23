<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'ahartori_database';

// Establish database connection
$con = mysqli_connect($server, $username, $password, $database);

// Check if the connection was successful
if ($con->connect_error) {
    die("Database connection failed: " . $con->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize user inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $mobile = htmlspecialchars(trim($_POST['mobile']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validate required fields are not empty
    if (empty($name) || empty($email) || empty($address) || empty($mobile) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO `users` (`name`, `email`, `address`, `mobile`, `password`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $address, $mobile, $password);

    // Execute the statement and check the result
    if ($stmt->execute()) {
        echo "Data submitted successfully!";
    } else {
        echo "Query failed: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close the database connection
$con->close();
?>
