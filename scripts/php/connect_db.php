<?php include 'db_info.php'; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Tell programmer that connection is successful
    echo "Connected successfully";
    echo "Hello";


?>
