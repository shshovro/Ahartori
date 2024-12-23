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

// Fetch records from the database
$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
</head>
<body>
    <h1>Manage Users</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display each record in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['address']}</td>";
                echo "<td>{$row['mobile']}</td>";
                echo "<td>
                    <a href='edit.php?id={$row['id']}'>Edit</a> |
                    <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>
