<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'Oleg');
define('DB_PASS', 'asd123@#4');
define('DB_NAME', 'sciencestrategicplan');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// If Exit return SurveyName , ExpiryDate , ProgressPrecent  
function GetPresentSurveyInfo($userid , $position )
{
    // Get the Current Date
    $date = date('Y-m-d');

    global $conn;

    //Get the SurveyName , Progress and DateEnd.
    $survey_sql = "SELECT SurveyTable.SurvName ,
                       SurveyTable.SurvDateEnd , 
                       UserAnswer.Progress 
                       FROM UserAnswer 
                       RIGHT JOIN SurveyTable ON SurveyTable.SurvID = UserAnswer.SurvID
                       AND SurveyTable.SurvDateEnd >= '$date' AND SurveyTable.Position = '$position' OR SurveyTable.Position = 'everyone' ";

    $survey_result = mysqli_query($conn, $survey_sql);

    //if exit return the data in form of Array.
    if (mysqli_num_rows($survey_result) > 0) {
        $survey_row = mysqli_fetch_assoc($survey_result);
        return array($survey_row['SurvName'] , $survey_row['SurvDateEnd'] , $survey_row['Progress']); 
    } else
        return -1;
}


// If Exit return SurveyName 
function GetPastSurveyInfo($userid)
{
    // Get the Current Date
    $date = date('Y-m-d');

    //Check if exit any old survey by check the ExpiryDate vs CurrentDate 
    global $conn;


    //Get the SurvName that user did before 
    $survey_sql = "SELECT SurveyTable.SurvName 
                    FROM  UserAnswer
                    JOIN  SurveyTable ON SurveyTable.SurvID = UserAnswer.SurvID
                    AND UserAnswer.UserID = '$userid' AND SurveyTable.SurvDateEnd < '$date'";

    $survey_result = mysqli_query($conn, $survey_sql);


    //if exit return the data in form of Array.
    if (mysqli_num_rows($survey_result) > 0) {

        $PastSurveyArray = array();        
        while ($survey_row = mysqli_fetch_assoc($survey_result)){
           array_push($PastSurveyArray, $survey_row['SurvName']); 
        }
        return $PastSurveyArray ;
    } else
        return -1;
}

?>