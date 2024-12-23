<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details with Status</title>
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

        .status-btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .status-btn:hover {
            background-color: #0056b3;
        }

        .responded {
            background-color: #28a745;
        }

        .responded:hover {
            background-color: #218838;
        }

        .delete-btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #dc3545;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Contact ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Status</th>
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

                // Fetch data from the `contact` table
                $query = "SELECT * FROM contact";
                $data = mysqli_query($con, $query);

                // Check if there are any records to display
                if (mysqli_num_rows($data) > 0) {
                    // Fetch and display each row of data
                    while ($result = mysqli_fetch_assoc($data)) {
                        $statusClass = $result['status'] === 'Responded' ? 'responded' : '';
                        echo "
                        <tr>
                            <td>" . htmlspecialchars($result['contact_id']) . "</td>
                            <td>" . htmlspecialchars($result['first_name']) . "</td>
                            <td>" . htmlspecialchars($result['last_name']) . "</td>
                            <td>" . htmlspecialchars($result['email']) . "</td>
                            <td>" . htmlspecialchars($result['message']) . "</td>
                            <td>" . htmlspecialchars($result['status']) . "</td>
                            <td>
                                <a href='update_status.php?contact_id=" . $result['contact_id'] . "&status=Responded' class='status-btn $statusClass'>" . ($result['status'] === 'Pending' ? 'Response' : 'Responded') . "</a>
                                <a href='update_status.php?contact_id=" . $result['contact_id'] . "&status=Pending' class='status-btn'>Not Response</a>
                                <a href='delete.php?contact_id=" . htmlspecialchars($result['contact_id']) . "' class='delete-btn'>Delete</a>
                            </td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found</td></tr>";
                }

                // Close the database connection
                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
