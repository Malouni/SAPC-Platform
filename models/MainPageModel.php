<?php

// If Exit return SurveyName , ExpiryDate , ProgressPrecent  
function GetPresentSurveyInfo($position)
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

    $data = [];

    //if exit return the data in form of Array.
    if (mysqli_num_rows($survey_result) > 0) {
        while ($survey_row = mysqli_fetch_assoc($survey_result))
            $data[] = $survey_row;
        return $data;
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

    $data = [];

    //if exit return the data in form of Array.
    if (mysqli_num_rows($survey_result) > 0)
    {
        while ($survey_row = mysqli_fetch_assoc($survey_result))
            $data[] = $survey_row;
        return $data;
    }
    else
        return -1;
}

function get_upcoming_surveys($userid)
{
    global $conn;

    $date = date('Y-m-d');
    $sql = "SELECT SurveyTable.SurvID, SurveyTable.SurvName
            FROM SurveyTable
            INNER JOIN UserTable
            ON SurveyTable.Position = UserTable.Position
            WHERE SurveyTable.SurvDateEnd >= '$date' and UserTable.UserID = '$userid'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
            $data[] = $row;
        return $data;
    }
    else
        return $data[0] = "NoResults";
}

function get_surveys_completed_by_user($userid)
{
    global $conn;

    $sql = "SELECT DISTINCT rt.SurvID, rt.SurvName
            FROM
            (SELECT SurveyTable.SurvID, SurveyTable.SurvName
            FROM SurveyTable
            INNER JOIN UserTable
            ON SurveyTable.Position = UserTable.Position
            INNER JOIN useranswer
            ON UserTable.UserID = useranswer.UserID
            WHERE UserTable.UserID = '$userid')rt";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
            $data[] = $row;
        return $data;
    }
    else
        return $data[0] = "NoResults";
}

?>