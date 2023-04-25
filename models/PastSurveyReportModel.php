<?php

//This function return all of the surveys from survey table
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

//This function return the report with question,subquestion and the answers to that questions
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
            WHERE SR.SurvID = ? and SQ.Goal = ?
            ORDER BY SR.SurvID, SR.QuestionID, SR.SubQuestionID;";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'is', $survId, $goal);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

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

//This function return the report with user first name, last name, question,subquestion and the answers to that questions by specific user
function get_survey_activity_detailed($survId, $goal, $userNumber)
{
    global $conn;

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
                    WHERE SurveyQuestions.SurvID = ? AND SQ.Type ='composed' AND SQ.QuestionID = SubQuestions.QuestionID) AS ComposedCount
            FROM surveytable ST
                JOIN SurveyQuestions SQ ON ST.SurvID = SQ.SurvID
                LEFT JOIN answernotes AN ON SQ.QuestionID = AN.QuestionID
                LEFT JOIN useranswer UA ON SQ.QuestionID = UA.QuestionID
                LEFT JOIN SubQuestions SQS ON SQ.QuestionID = SQS.QuestionID
                LEFT JOIN subquestionanswer SA ON SQS.SubQuestionID = SA.SubQuestionID
                LEFT JOIN usertable UT ON UT.UserID = UA.UserID OR UT.UserID= SA.UserID
            WHERE ST.SurvID = ? and SQ.Goal =? AND UT.UserID = ?
            ORDER BY SQ.QuestionID, SQ.SubGoal, UT.UserID";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "iisi", $survId, $survId, $goal, $userNumber);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $data = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    } else {
        return $data[0] = "No Data";
    }
}


//This function searches for the user from user table using specific filter
function searchUser($searchString)
{
    global $conn;

    if($searchString == null)
    {
        $sql = "SELECT UserID AS UserNumber, Fname AS FirstName, Lname AS LastName, Department
                FROM UserTable
                WHERE Position != 'admin';";
        $stmt = mysqli_prepare($conn, $sql);
    }
    else
    {
        $userInfo = explode(',', $searchString);
        $sql = "SELECT UserID AS UserNumber, Fname AS FirstName, Lname AS LastName, Department
                FROM UserTable
                WHERE Position != 'admin' AND Fname LIKE ? AND Lname LIKE ? ;";
        $stmt = mysqli_prepare($conn, $sql);
        $fname = $userInfo[0] . '%';
        $lname = $userInfo[1] . '%';
        mysqli_stmt_bind_param($stmt, "ss", $fname, $lname);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
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

//This function return the percentage of answers from a specific survey
function get_survey_answer_percentage($survId, $goal)
{
    global $conn;

    $sql = "SELECT  ST.SurvYear  as CurrentYear , SR.Answer_Percentage as Value,
                    ST1.SurvYear as Year1,  SR1.Answer_Percentage as Value1 ,
                    ST2.SurvYear as Year2 , SR2.Answer_Percentage as Value2

                    FROM SurveyQuestions SQ
                    JOIN SurveyReport SR  ON SR.QuestionID = SQ.QuestionID
                    JOIN SurveyTable ST ON ST.SurvID = SR.SurvID

                    LEFT JOIN SurveyTable ST1 ON  ST1.SurvYear = ST.SurvYear - 1 AND ST1.Position = ST.Position
                    LEFT JOIN SurveyQuestions SQ1 ON  SQ1.Goal =  SQ.Goal AND ST1.SurvID = SQ1.SurvID
                    LEFT JOIN SurveyReport SR1 ON SR1.SurvID = ST1.SurvID 

                    LEFT JOIN SurveyTable ST2 ON ST2.SurvYear = ST.SurvYear - 2 AND ST2.Position = ST.Position
                    LEFT JOIN  SurveyQuestions SQ2 ON  SQ2.Goal =  SQ.Goal AND ST2.SurvID = SQ2.SurvID
                    LEFT JOIN  SurveyReport SR2 ON SR2.SurvID = ST2.SurvID

                    WHERE SR.SurvID = ? AND SQ.Goal = ?
                    GROUP BY SQ.Goal";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "is", $survId, $goal);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
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