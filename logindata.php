<?php
   
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'ahartori_database';

    
    $con = new mysqli($server, $username, $password, $database);

    
    if ($con->connect_error) {
        die('Connection failed: ' . $con->connect_error);
    }

 
    $test_password = 'userpassword';
    $hashed_password = password_hash($test_password, PASSWORD_BCRYPT);
    echo "Test hashed password (store this in the database for a test user): $hashed_password<br>";

  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));

        
        if (!empty($email) && !empty($password)) {
           
            $stmt = $con->prepare("SELECT `password` FROM `users` WHERE `email` = ?");
            $stmt->bind_param("s", $email); 
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($stored_hashed_password);
                $stmt->fetch();

                if (password_verify($password, $stored_hashed_password)) {
                    echo "Login successful! Welcome, $email.";
                } else {
                    echo "Invalid email or password.";
                }
            } else {
                echo "Invalid email or password.";
            }

          
            $stmt->close();
        } else {
            echo "Please provide both email and password.";
        }
    }

    
    $con->close();
?>
