<?php
// Connection details
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'ahartori_database';

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['contact_id']) && isset($_GET['status'])) {
    $contact_id = intval($_GET['contact_id']);
    $status = mysqli_real_escape_string($con, $_GET['status']);

    // Update the status
    $query = "UPDATE contact SET status = '$status' WHERE contact_id = $contact_id";

    if (mysqli_query($con, $query)) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . mysqli_error($con);
    }
}

// Redirect back to the main page
header("Location: index.php");
exit;

// Close the connection
mysqli_close($con);
?>
