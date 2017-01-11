<?PHP include "db_info.php";

	// Create connection to database described in db_info.php
	$conn = new mysqli($servername, $username, $password, $dbname);

	$location = $_POST['location'];
	
	$sql = "SELECT * from Locations where locationID='" . $location . "'";

	// Store the result from query
	$result = mysqli_query($conn, $sql);

	// Iterate through the results obtained
	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
    	while($row = mysqli_fetch_assoc($result)) {
        	$rows[] = array($row['locationID'], $row['type'], $row['name'], $row['lat'], $row['lng'], $row['description']);
    		}
	}

	// Encode result into JSON
	echo json_encode($rows);

	// Close connection to database
	mysqli_close($conn);

?>
