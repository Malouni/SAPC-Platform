<?php

//Check the Open Date of the Survey
//Return the boolean by compare current date with it 
//True -> open for access 
//False -> close for access
function isSurveyOpen($SurvID)
{
    global $conn;

    $date = date('Y-m-d');
    $sql = "SELECT IF (SurvDateStart <= '$date' , 0 , 1) as SBoolean ,
                   DATE_FORMAT(SurvDateStart, '%W %M %e %Y') as StartDate , 
                   DATE_FORMAT(SurvDateEnd, '%W %M %e %Y') as EndDate     
                FROM surveytable 
                WHERE SurvID = '$SurvID'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row;
}

?>