<?php include "connect_db.php";

	date_default_timezone_set('Australia/Brisbane');

    // Get temperature from the photon
	$dataString = $_POST["dataString"];

	// $test = "1475498689 4.000000 43.000000 23.100000";
	$light = explode(' ', $dataString)[1];
	$humidity = explode(' ', $dataString)[2];
	$temp = explode(' ', $dataString)[3];

	$timeV = date("Y-m-d h:i:s");
	echo $timeV;
	//echo $array;
    // Insert new Temperature into Database
    $query = "INSERT INTO Data (probeID, time, temperature, light, humidity, comment) VALUES ('probe9969','$timeV', '$temp', '$light', '$humidity', NULL)";


	//echo $_POST["data"];
    // Check if query was successful

    if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Close connection to database
    $conn->close();

?>
