<?php include "db_info.php";

    //Create connection to DB
    $conn = new mysqli($servername, $username, $password, $dbname);

    //The data from form
    $probeID = $_POST['probeID'];
    $maxDate = $_POST['max'];
    $minDate = $_POST['min'];

    //Convert the accepted date data into PHP datetime form
    $dmaxDate = date('Y-m-d H:i:s', strtotime($maxDate));
    $dminDate = date('Y-m-d H:i:s', strtotime($minDate));

    //Check on all possible form conditions, then create the query string accordingly
    if(($probeID == "") && ($maxDate == "") && ($minDate == "")){
        $sql = "SELECT * FROM Data";
    } else if(($probeID != "") && ( $maxDate == "") && ( $minDate == "")){
        $sql = "SELECT * FROM Data WHERE probeID='$probeID'";
    } else if(($probeID == "") && ($maxDate == "") && ( $minDate != "")){
        $sql = "SELECT * FROM Data WHERE time >= '$dminDate'";
    } else if(($probeID == "") && ($maxDate != "") && ($minDate == "")){
        $sql = "SELECT * FROM Data WHERE time <= '$dmaxDate'";
    } else if(($probeID != "") && ($maxDate == "") && ( $minDate != "")){
        $sql = "SELECT * FROM Data WHERE time >= '$dminDate' AND probeID='$probeID'";
    } else if(($probeID != "") && ($maxDate != "") && ( $minDate == "")){
        $sql = "SELECT * FROM Data WHERE time <= '$dmaxDate' AND probeID='$probeID'";
    } else if(($probeID == "") && ($maxDate != "") && ( $minDate != "")){
        $sql = "SELECT * FROM Data WHERE time <= '$dmaxDate' AND time > '$dminDate'";
    } else{
        $sql = "SELECT * FROM Data WHERE time >= '$dminDate' AND time < '$dmaxDate' AND probeID='$probeID'";
    }

    //Get the result of the query
    $result = mysqli_query($conn, $sql);

    //Iterate through the result
    if (mysqli_num_rows($result) > 0) {
    	while($row = mysqli_fetch_assoc($result)) {
        $rows[] = array($row['probeID'], $row['time'], $row['temperature'], $row['light'],
                       $row['humidity'], $row['comment'],);
    	}

	}

    // Encode result into JSON
	echo json_encode($rows);

    mysqli_close($conn);
?>
