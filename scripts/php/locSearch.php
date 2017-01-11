<?PHP include "db_info.php";

	// Create connection to database described in db_info.php
	$conn = new mysqli($servername, $username, $password, $dbname);

	$location = $_POST['location'];

	// Get all data from Data table
	$sql = "SELECT Probe_Locations.probeID, b.time, b.temperature, b.light, b.humidity, b.comment
        from Probe_Locations
        left JOIN (SELECT probeID, time, temperature, light, humidity, comment FROM Data) b
        ON Probe_Locations.probeID = b.probeID 
        where Probe_Locations.startingTime < b.time and (Probe_Locations.endingTime is null or Probe_Locations.endingTime > b.time) and Probe_Locations.locationID='" . $location . "'
        order by b.time DESC";

	// Store the result from query
	$result = mysqli_query($conn, $sql);

	// Iterate through the results obtained
	if (mysqli_num_rows($result) > 0) {
    	// output data of each row
    	while($row = mysqli_fetch_assoc($result)) {
        $rows[] = array($row['probeID'], $row['time'], $row['temperature'], $row['light'],
                       $row['humidity'], $row['comment']);
    	}
	}

	// Encode result into JSON
	echo json_encode($rows);

	// Close connection to database
	mysqli_close($conn);

?>


