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
        return $data[0] = "Failed";
}

function get_survey_activity($survId, $goal)
{
    global $conn;

    $sql = "SELECT SurveyQuestions.Goal, SurveyQuestions.SubGoal, SurveyQuestions.Question, SubQuestions.Sub_Q, SurveyReport.Activity_Involvement, SurveyReport.Activity_Historical
            FROM SurveyReport
            INNER JOIN SurveyQuestions
            ON SurveyQuestions.QuestionID = SurveyReport.QuestionID and SurveyQuestions.SurvID = SurveyReport.SurvID
            INNER JOIN SubQuestions
            ON SubQuestions.QuestionID = SurveyReport.QuestionID and SubQuestions.SurvID = SurveyReport.SurvID
            WHERE SurveyQuestions.SurvID = '$survId' and SurveyQuestions.Goal = '$goal'";

    $result = mysqli_query($conn, $sql);
    echo '<pre>'; print_r($result); echo '</pre>';
    $data = [];

    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        $data[] = $row;
        return $data;
    }
    else
        return $data[0] = "Failed";
}



?>