<?php

function get_survey_documents()
{
    global $conn;

    $sql = "select * from SurveyTable";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
            $data[] = $row;
        return $data;
    }
    else
        return $data[0] = "No Data";
}

function get_survey_activity($survId, $goal)
{
    global $conn;

    $sql = "SELECT
                SQ.Goal,
                SQ.SubGoal,
                SQ.Question,
                SQ.Type,
                SQS.Sub_Q,
                SR.Activity_Involvement,
                SR.Activity_Historical
            FROM SurveyReport SR
            JOIN SurveyQuestions SQ ON SR.QuestionID = SQ.QuestionID
            LEFT JOIN SubQuestions SQS ON SR.SubQuestionID = SQS.SubQuestionID AND SR.QuestionID = SQS.QuestionID
            WHERE SR.SurvID = '$survId' and SQ.Goal ='$goal'
            ORDER BY SR.SurvID, SR.QuestionID, SR.SubQuestionID;";

    $result = mysqli_query($conn, $sql);
    $data = [];

    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
            $data[] = $row;
        return $data;
    }
    else
        return $data[0] = "No Data";
}



?>