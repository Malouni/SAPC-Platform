<?php

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

//This function will calculate and return the user progress
function get_user_progress($userid , $survID)
{
    global $conn;

    $sql = "SELECT ROUND(((COUNT(UA.QuestionID) +  COUNT(SUA.QuestionID) *100 )/ COUNT(SQ.QuestionID)),0) as Progress
                            FROM surveyquestions SQ
                            LEFT JOIN subquestions SQS 
                            ON SQ.QuestionID = SQS.QuestionID
                            LEFT JOIN useranswer UA  
                            ON UA.QuestionID = SQ.QuestionID AND UA.UserID = '".$userid."' AND UA.Answer IS NOT NULL  
                            LEFT JOIN subquestionanswer SUA 
                            ON SUA.SubQuestionID = SQS.SubQuestionID AND SUA.UserID = '".$userid."' AND SUA.Answer IS NOT NULL               
                            WHERE SQ.SurvID = '".$survID."' ";
    
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row;
}

?>