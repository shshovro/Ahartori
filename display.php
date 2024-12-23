<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f3f3f3;
        }
        
        .table-container {
            margin-top: 30px;
            width: 100%;
            max-width: 1300px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
    
            background-color: #10997f;
            color: #ffffff;
        }

        th, td {
            padding: 12px 16px;
        }

        th {
            font-weight: bold;
        }

        tbody tr:nth-child(odd) {
            background-color: #f7f4ff;
        }

        tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

       
        thead th:first-child {
            border-top-left-radius: 8px;
        }

        thead th:last-child {
            border-top-right-radius: 8px;
        }

    
        .delete-btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #10997f;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: orange;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
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

                $query = "SELECT * FROM users";
                $data = mysqli_query($con, $query);

                // Check if there are any records to display
                if (mysqli_num_rows($data) > 0) {
                    // Fetch and display each row of data
                    while ($result = mysqli_fetch_assoc($data)) {
                        echo "
                        <tr>
                            <td>" . htmlspecialchars($result['id']) . "</td>
                            <td>" . htmlspecialchars($result['name']) . "</td>
                            <td>" . htmlspecialchars($result['email']) . "</td>
                            <td>" . htmlspecialchars($result['address']) . "</td>
                            <td>" . htmlspecialchars($result['mobile']) . "</td>
                            <td> <a href='delete.php?id=" . htmlspecialchars($result['id']) . "' class='delete-btn'>Delete</a> </td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }

                // Close the database connection
                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
