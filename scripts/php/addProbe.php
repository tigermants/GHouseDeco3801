<?php include "db_info.php";

    //Create connection to DB
    $conn = new mysqli($servername, $username, $password, $dbname);

    //The data from form
    $probeID = $_POST['probeID'];
    $devID = $_POST['devID'];
    $accToken = $_POST['accToken'];
    $desc = $_POST['desc'];


    $sql = "INSERT INTO `Probes` (`probeID`, `devID`, `accToken`, `description`) VALUES ('$probeID', '$devID', '$accToken', '$desc');";

    mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
