<?php include "db_info.php";

    //Create connection to DB
    $conn = new mysqli($servername, $username, $password, $dbname);

    //The data from form
    $probeID = $_POST['probeID'];
    $eLocID = $_POST['eLocID'];
    $eRoom = $_POST['eRoom'];
    $nLocID = $_POST['nLocID'];
    $nName = $_POST['nName'];
    $nRoom = $_POST['nRoom'];
    $nType = $_POST['nType'];
    $nLat = $_POST['nLat'];
    $nLng = $_POST['nLng'];
    $nDesc = $_POST['nDesc'];


        $sql = "SELECT probeID from Probe_Locations where endingTime is null and locationID='" . $eLocID . "'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) { 
            $sql = "UPDATE Probe_Locations SET endingTime=CURRENT_TIMESTAMP WHERE probeID='" . $probeID."' and endingTime is null";
            mysqli_query($conn, $sql);
        }

    if ($nLocID == "") {

        if ($eRoom == "") {
            $sql="INSERT INTO `Probe_Locations` (`probeID`, `startingTime`, `endingTime`, `locationID`, `room`, `x`, `y`, `z`) VALUES ('".$probeID ."', CURRENT_TIMESTAMP, NULL, '".$eLocID."', NULL, NULL, NULL, NULL);";
        } else {
            $sql="INSERT INTO `Probe_Locations` (`probeID`, `startingTime`, `endingTime`, `locationID`, `room`, `x`, `y`, `z`) VALUES ('".$probeID ."', CURRENT_TIMESTAMP, NULL, '".$eLocID."','".$eRoom."', NULL, NULL, NULL);";
        }
        mysqli_query($conn, $sql);
    } else {  
      /*  
        $sql = "INSERT INTO `Locations` (`locationID`, `type`, `name`, `lat`, `lng`, `description`) VALUES ('".$nLocID."', '".$nType."', '".$nName."', '".$nLat."', '".$nLng."', '".$nDesc."'");
        mysqli_query($conn, $sql);
        if ($nRoom == "") {
            $sql="INSERT INTO `Probe_Locations` (`probeID`, `startingTime`, `endingTime`, `locationID`, `room`, `x`, `y`, `z`) VALUES ('".$probeID ."', CURRENT_TIMESTAMP, NULL, '".$nLocID."', NULL, NULL, NULL, NULL)";
            mysqli_query($conn, $sql);
            $sql = "INSERT INTO `Rooms` (`locationID`, `room`, `x`, `y`, `z`, `description`) VALUES ('".$nLocID"', '".$nRoom."', NULL, NULL, NULL, NULL)";
        } else {
            $sql="INSERT INTO `Probe_Locations` (`probeID`, `startingTime`, `endingTime`, `locationID`, `room`, `x`, `y`, `z`) VALUES ('".$probeID ."', CURRENT_TIMESTAMP, NULL, '".$nLocID."','".$nRoom."', NULL, NULL, NULL);";
        }
        mysqli_query($conn, $sql);
       */
    }
         
    mysqli_close($conn);
?>
