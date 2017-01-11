<?PHP include 'db_info.php';
 
$conn = new mysqli($servername, $username, $password, $dbname);


$location = $_POST['location'];

$sql = "SELECT Probe_Locations.probeID, Probe_Locations.room, b.temperature, b.light, b.humidity
	from Probe_Locations
	left JOIN (SELECT probeID, temperature, light, humidity, MAX(time) FROM Data GROUP BY probeID) b
	ON Probe_Locations.probeID = b.probeID 
	where Probe_Locations.endingTime is null and Probe_Locations.locationID='" . $location . "'
	order by Probe_Locations.room";

	// Get the result from Database
	$result = mysqli_query($conn, $sql);

	// Iterate through the results obtained
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$rows[] = array($row['probeID'], $row['room'], $row['temperature'], $row['light'] ,$row['humidity']);
		}
	}
	
	// Encode result into JSON
	echo json_encode($rows);
	// Close connection to Database
	mysqli_close($conn);
	
?>
