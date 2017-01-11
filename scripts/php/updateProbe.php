<?php include "db_info.php";

    //Create connection to DB
    $conn = new mysqli($servername, $username, $password, $dbname);

    //The data from form
    $probeID = $_POST['probeID'];
    $devID = $_POST['devID'];
    $accToken = $_POST['accToken'];
    $desc = $_POST['desc'];

    $sql = "UPDATE Probe_Locations SET devID='$devID', accToken='$accToken', description='$desc' WHERE probeID='$probeID'";

    mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
