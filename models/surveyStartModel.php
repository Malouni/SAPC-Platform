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


//This function will calculate and return the user progress
function get_user_progress($userid , $survID)
{
    global $conn;

    $sql = "SELECT ROUND(((COUNT(UA.QuestionID) +  COUNT(SUA.QuestionID)) *100 ) /  (COUNT(SQ.QuestionID)),0) as Progress
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

    $data = [];
    if (mysqli_num_rows($result) > 0)
    {
        return $row;
    }
}
?>