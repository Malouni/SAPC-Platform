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
                SQ.QuestionID,
                SQ.Question,
                SQ.Type,
                SQS.Sub_Q,
                SR.Answer_Percentage,
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

function get_survey_activity_detailed($survId, $goal, $userNumber)
{
    global $conn;

    if($userNumber == null)
        $sql = "SELECT
                    UT.UserID AS UserNumber,
                    UT.Fname,
                    UT.Lname,
                    SQ.Goal,
                    SQ.SubGoal,
                    SQ.QuestionID,
                    SQ.Question,
                    UA.Answer AS QuestionAnswer,
                    SQ.Type,
                    SQS.Sub_Q,
                    SA.Answer AS SubQuestionAnswer,
                    AN.NoteText,
                        (SELECT COUNT(SubQuestions.Sub_Q)
                        FROM SurveyQuestions
                        LEFT JOIN SubQuestions
                        ON surveyquestions.QuestionID = subquestions.QuestionID
                        WHERE SurveyQuestions.SurvID = ST.SurvID AND SQ.Type ='composed' AND SQ.QuestionID = SubQuestions.QuestionID) AS ComposedCount
                FROM surveytable ST
                    JOIN SurveyQuestions SQ ON ST.SurvID = SQ.SurvID
                    LEFT JOIN answernotes AN ON SQ.QuestionID = AN.QuestionID
                    LEFT JOIN useranswer UA ON SQ.QuestionID = UA.QuestionID
                    LEFT JOIN SubQuestions SQS ON SQ.QuestionID = SQS.QuestionID
                    LEFT JOIN subquestionanswer SA ON SQS.SubQuestionID = SA.SubQuestionID
                    LEFT JOIN usertable UT ON UT.UserID = UA.UserID OR UT.UserID= SA.UserID
                WHERE ST.SurvID = '$survId' AND SQ.Goal ='$goal'
                ORDER BY SQ.QuestionID, SQ.SubGoal, UT.UserID;";
    else
        $sql = "SELECT
                    UT.UserID AS UserNumber,
                    UT.Fname,
                    UT.Lname,
                    SQ.Goal,
                    SQ.SubGoal,
                    SQ.QuestionID,
                    SQ.Question,
                    UA.Answer AS QuestionAnswer,
                    SQ.Type,
                    SQS.Sub_Q,
                    SA.Answer AS SubQuestionAnswer,
                    AN.NoteText,
                        (SELECT COUNT(SubQuestions.Sub_Q)
                        FROM SurveyQuestions
                        LEFT JOIN SubQuestions
                        ON surveyquestions.QuestionID = subquestions.QuestionID
                        WHERE SurveyQuestions.SurvID = ST.SurvID AND SQ.Type ='composed' AND SQ.QuestionID = SubQuestions.QuestionID) AS ComposedCount
                FROM surveytable ST
                    JOIN SurveyQuestions SQ ON ST.SurvID = SQ.SurvID
                    LEFT JOIN answernotes AN ON SQ.QuestionID = AN.QuestionID
                    LEFT JOIN useranswer UA ON SQ.QuestionID = UA.QuestionID
                    LEFT JOIN SubQuestions SQS ON SQ.QuestionID = SQS.QuestionID
                    LEFT JOIN subquestionanswer SA ON SQS.SubQuestionID = SA.SubQuestionID
                    LEFT JOIN usertable UT ON UT.UserID = UA.UserID OR UT.UserID= SA.UserID
                WHERE ST.SurvID = '$survId' and SQ.Goal ='$goal' AND UT.UserID ='$userNumber'
                ORDER BY SQ.QuestionID, SQ.SubGoal, UT.UserID;";

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

function searchUser($searchString)
{
    global $conn;
    if($searchString == null)
        $sql = "SELECT UserID AS UserNumber, Fname AS FirstName, Lname AS LastName, Department
                FROM UserTable
                WHERE Position != 'admin';";
    else
        $sql = "SELECT UserID AS UserNumber, Fname AS FirstName, Lname AS LastName, Department
                FROM UserTable
                WHERE UserID = '$searchString' AND Position != 'admin';";

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


function get_survey_answer_percentage($survId, $goal)
{
    global $conn;

    $Year1_ID = $survId - 1;
    $Year2_ID = $survId - 2;

    $sql = "SELECT  ST.SurvYear  as CurrentYear , SR.Answer_Percentage as Value,
                    ST1.SurvYear as Year1,  SR1.Answer_Percentage as Value1 ,
                    ST2.SurvYear as Year2 , SR2.Answer_Percentage as Value2

            FROM SurveyQuestions SQ
            JOIN SurveyReport SR  ON SR.QuestionID = SQ.QuestionID
            JOIN SurveyTable ST ON ST.SurvID = SR.SurvID

            JOIN SurveyReport SR1 ON SR1.SurvID = '$Year1_ID'
            JOIN SurveyQuestions SQ1 ON  SQ1.Goal =  SQ.Goal AND SR1.SurvID = SQ1.SurvID
            JOIN SurveyTable ST1 ON ST1.SurvID = SR1.SurvID

            LEFT JOIN  SurveyReport SR2 ON SR2.SurvID = '$Year2_ID'
            LEFT JOIN  SurveyQuestions SQ2 ON  SQ2.Goal =  SQ.Goal AND SR2.SurvID = SQ2.SurvID
            LEFT JOIN SurveyTable ST2 ON ST2.SurvID = SR2.SurvID

            WHERE SR.SurvID = '$survId' AND SQ.Goal = '$goal'
            GROUP BY SQ.Goal";

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