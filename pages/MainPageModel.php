<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'Oleg');
define('DB_PASS', 'asd123@#4');
define('DB_NAME', 'sciencestrategicplan');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// If Exit return SurveyName , ExpiryDate , ProgressPrecent  
//This code is apply for each user will only has one survey for each time 
function GetPresentSurveyInfo($truid)
{
    // Get the Current Date
    $date = date('Y-m-d');

    //Check if exit any new survey by check the ExpiryDate vs CurrentDate 
    global $conn;

    $sql = "select SurveyName , DateEnd , Progress from SurveyUserTable where TruID = '$truid' and DateEnd >= '$date'";
    $result = mysqli_query($conn, $sql);

    //if exit return the data(Array)
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return array($row['SurveyName'] ,$row['Progress'] , $row['DateEnd']);
    } else
        return -1;
}

// If Exit return SurveyName 
function GetPastSurveyInfo()
{
    // Get the Current Date
    $date = date('Y-m-d');

    //Check if exit any old survey by check the ExpiryDate vs CurrentDate 
    global $conn;

    $sql = "select SurveyName from SurveyUserTable where TruID = '$truid' and DateEnd < '$date'";
    $result = mysqli_query($conn, $sql);

    //if exit return the data(Array)
    if (mysqli_num_rows($result) > 0) {
        dataArray = array();        
        while ($row = mysqli_fetch_assoc($result)){
           
            array_push($dataArray, $row['SurveyName']); 
        }
        return dataArray;
    } else
        return -1;
}

?>

