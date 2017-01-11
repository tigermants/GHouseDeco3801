<?PHP include "db_info.php";

	// Create connection to database described in db_info.php
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Query database
	$sql = "SELECT locationID, name FROM Locations";
	// Store the result from database
	$result = mysqli_query($conn, $sql);

	// Iterate through the results obtained
	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
    	while($row = mysqli_fetch_assoc($result)) {
        	$rows[] = array($row['locationID'], $row['name']);
    	}
	}

	// Encode result into JSON
	echo json_encode($rows);
	// Close connection to database
	mysqli_close($conn);

?>


