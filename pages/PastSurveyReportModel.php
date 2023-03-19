<?php

function get_survey_documents()
{
    global $conn;

    $sql = "SELECT * FROM SurveyTable";
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

    $sql = "SELECT SurveyQuestions.Goal , SurveyQuestions.SubGoal, SurveyReport.Activity, SurveyReport.Activity_Involvement, SurveyReport.Activity_Historical
            FROM SurveyQuestions
            INNER JOIN SurveyReport
            ON SurveyQuestions.QuestionID = SurveyReport.QuestionID and SurveyQuestions.SurvID = SurveyReport.SurvID
            WHERE SurveyQuestions.SurvID = '$survId' and SurveyQuestions.Goal = '$goal'";
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



?>