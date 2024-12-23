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

// Get the 'id' parameter from the URL
$id = $_GET['id'];

// Fetch the existing record
$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));
    $mobile = htmlspecialchars(trim($_POST['mobile']));

    // Update the record
    $update_query = "UPDATE users SET name='$name', email='$email', address='$address', mobile='$mobile' WHERE id='$id'";
    if (mysqli_query($con, $update_query)) {
        echo "Record updated successfully!";
        header("Location: index.php"); // Redirect back to the list page
        exit;
    } else {
        echo "Failed to update record: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $row['address']; ?>" required><br>
        <label>Mobile:</label>
        <input type="text" name="mobile" value="<?php echo $row['mobile']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>
