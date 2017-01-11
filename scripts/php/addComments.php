<?php include "db_info.php";

    //Create connection to DB
    $conn = new mysqli($servername, $username, $password, $dbname);

    //The data from form
    $probeID = $_POST['probeID'];
    $maxDate = $_POST['max'];
    $minDate = $_POST['min'];
    $comment = $_POST['comment'];


    //Convert the accepted date data into PHP datetime form
    $dmaxDate = date('Y-m-d H:i:s', strtotime($maxDate));
    $dminDate = date('Y-m-d H:i:s', strtotime($minDate));

    //Check on all possible form conditions, then create the query string accordingly
    if(($probeID == "") && ($maxDate == "") && ($minDate == "")){
        $sql = "UPDATE Data SET comment ='$comment'";
    } else if(($probeID != "") && ( $maxDate == "") && ( $minDate == "")){
        $sql = "UPDATE Data SET comment ='$comment' WHERE probeID='$probeID'";
    } else if(($probeID == "") && ($maxDate == "") && ( $minDate != "")){
        $sql = "UPDATE Data SET comment ='$comment' WHERE time >= '$dminDate'";
    } else if(($probeID == "") && ($maxDate != "") && ($minDate == "")){
        $sql = "UPDATE Data SET comment ='$comment' WHERE time <= '$dmaxDate'";
    } else if(($probeID != "") && ($maxDate == "") && ( $minDate != "")){
        $sql = "UPDATE Data SET comment ='$comment' WHERE time >= '$dminDate' AND probeID='$probeID'";
    } else if(($probeID != "") && ($maxDate != "") && ( $minDate == "")){
        $sql = "UPDATE Data SET comment ='$comment' WHERE time <= '$dmaxDate' AND probeID='$probeID'";
    } else if(($probeID == "") && ($maxDate != "") && ( $minDate != "")){
        $sql = "UPDATE Data SET comment ='$comment' WHERE time <= '$dmaxDate' AND time > '$dminDate'";
    } else{
        $sql = "UPDATE Data SET comment ='$comment' WHERE time >= '$dminDate' AND time < '$dmaxDate' AND probeID='$probeID'";
    }

    mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
