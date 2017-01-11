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
    if((!isset($probeID) || $probeID == "") && (!isset($maxDate) || $maxDate == "") && (!isset($minDate) || $minDate == "")){
        $sql = "SELECT * FROM Data";
    } else if((isset($probeID) || $probeID != "") && (!isset($maxDate) || $maxDate == "") && (!isset($minDate) || $minDate == "")){
        $sql = "SELECT * FROM Data WHERE probeID='$probeID'";
    } else if((!isset($probeID) || $probeID == "") && (!isset($maxDate) || $maxDate == "") && (isset($minDate) || $minDate != "")){
        $sql = "SELECT * FROM Data WHERE time >= '$dminDate'";
    } else if((!isset($probeID) || $probeID == "") && (isset($maxDate) || $maxDate != "") && (!isset($minDate) || $minDate == "")){
        $sql = "SELECT * FROM Data WHERE time <= '$dmaxDate'";
    } else if((isset($probeID) || $probeID != "") && (!isset($maxDate) || $maxDate == "") && (isset($minDate) || $minDate != "")){
        $sql = "SELECT * FROM Data WHERE time >= '$dminDate' AND probeID='$probeID'";
    } else if((isset($probeID) || $probeID != "") && (isset($maxDate) || $maxDate != "") && (!isset($minDate) || $minDate == "")){
        $sql = "SELECT * FROM Data WHERE time <= '$dmaxDate' AND probeID='$probeID'";
    } else if((!isset($probeID) || $probeID == "") && (isset($maxDate) || $maxDate != "") && (isset($minDate) || $minDate != "")){
        $sql = "SELECT * FROM Data WHERE time <= '$dmaxDate' AND time > '$dminDate'";
    } else{
        $sql = "SELECT * FROM Data WHERE time >= '$dminDate' AND time < '$dmaxDate' AND probeID='$probeID'";
    }
         
    //Get the result of the query
    $result = mysqli_query($conn, $sql);

    //Defining the first row (header) of the csv file
    $firstrow = array('probeID', 'time', 'temperature', 'light',
                      'humidity', 'comment');

    //Create new file, write to it
    $file = fopen('php://output', 'w');

    //Put the first row (header) into csv format
    fputcsv($file, $firstrow);
    

    //Iterate through the result. Put each of the results into csv format
    if (mysqli_num_rows($result) > 0) {
    	while($row = mysqli_fetch_assoc($result)) {
            fputcsv($file, $row);
    	}
	}
    

    fclose($file);

    //Make it so that the user can download the file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=probedata.csv');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    readfile($file);

    mysqli_close($conn);
?>
