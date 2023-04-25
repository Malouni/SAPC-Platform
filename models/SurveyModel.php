<?php

//========================== LOAD SESSION ===================================

// for load all the questions and goal
function LoadQuestions($survId)
{
    global $conn;

    //load the question from db and put it to array
    $sql = "SELECT
                SQ.Goal,
                SQ.Type,
                SQS.SubType,
                SQ.QuestionID,
                SQS.SubQuestionID,
                SQ.Question,
                SQS.Sub_Q

            FROM SurveyQuestions SQ
            LEFT JOIN SubQuestions SQS ON SQ.QuestionID = SQS.QuestionID
            WHERE SQ.SurvID = '$survId' 
            ORDER BY SQ.QuestionID, SQS.SubType;";

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

//load AnswerOption(label)
function LoadLabel($survId){
    global $conn;

    $sql = "SELECT  QuestionID , SubQuestionID , InputValue 
                FROM  answeroptions
                WHERE SurvID = '$survId' 
                ORDER BY QuestionID , SubQuestionID ,InputValue ";

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


//for load the last question the user stop working at 
function LoadLastProgress($survId , $userID)
{
    global $conn;

    $sql = "SELECT useranswer.QuestionID
                FROM useranswer 
                LEFT JOIN subquestionanswer ON subquestionanswer.QuestionID = useranswer.QuestionID
                WHERE (useranswer.Answer IS NOT NULL OR subquestionanswer.Answer IS NOT NULL)  
                AND (useranswer.SurvID = ".$survId."  AND useranswer.UserID = ".$userID.")
                ORDER BY useranswer.QuestionID DESC LIMIT 1";

    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0)
    {
        $data = mysqli_fetch_assoc($result);
        return $data['QuestionID'];
    }
    else
        return 0;

}

// for load the user answer 
function LoadAnswers($survId, $userID, $Q_ID, $Type)
{
    global $conn;

    if ($Type == 'single') {
        // load the answer for the only single questions    
        $stmt = mysqli_prepare($conn, "SELECT QuestionID, Answer AS MainAnswer
                                       FROM useranswer
                                       WHERE QuestionID = ? AND UserID = ".$userID."
                                       AND Answer IS NOT NULL");
        mysqli_stmt_bind_param($stmt, "i", $Q_ID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

    } else {
        // load the answer for the only composed questions    
        $stmt = mysqli_prepare($conn, "SELECT subquestionanswer.QuestionID, subquestionanswer.SubQuestionID, subquestionanswer.Answer AS SubAnswer
                                       FROM subquestionanswer
                                       LEFT JOIN subquestions ON subquestions.SubQuestionID = subquestionanswer.SubQuestionID
                                       WHERE subquestionanswer.QuestionID = ? AND UserID = ".$userID."
                                       AND Answer IS NOT NULL
                                       ORDER BY subquestions.SubType");
        mysqli_stmt_bind_param($stmt, "i", $Q_ID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }

    // put the data to array and return 
    $data = [];
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result))
            $data[] = $row;
        return $data;
    } else
        return $data[0] = "Failed";
}


//========================== UPDATE SESSION ===================================
// for update the user answer 
function UpdateAnswers($survId , $userID , $Q_ID , $SubQ_ID ,$IsUpdate, $Answer)
{   
    global $conn;

    if($IsUpdate == 'true'){    
        // update the ansewer for the question without the sub questions when SubQ_ID == 0(Note: the SubQuestionID = 0 in db is not exit )  
        if($SubQ_ID == 0)
        {
            $Update = "UPDATE UserAnswer SET Answer = ?   
                            WHERE SurvID = ".$survId." AND QuestionID = ? AND UserID = ".$userID."";
            $stmt = mysqli_prepare($conn, $Update);
            mysqli_stmt_bind_param($stmt, 'di', $Answer, $Q_ID);
            mysqli_stmt_execute($stmt);
        
        }else
        {
            $Update = "UPDATE SubQuestionAnswer SET Answer = ?   
                            WHERE  QuestionID = ? AND UserID = ".$userID." AND SubQuestionID = ?";
            $stmt = mysqli_prepare($conn, $Update);
            mysqli_stmt_bind_param($stmt, 'dii', $Answer, $Q_ID, $SubQ_ID);
            mysqli_stmt_execute($stmt);
        }
    }else{

        // INSERT the ansewer for the question
        if($SubQ_ID == 0)
        {
            $INSERT = "INSERT INTO useranswer (UserID, QuestionID, SurvID, Answer) 
                            VALUES (".$userID.", ?, ".$survId.", ?)";
            $stmt = mysqli_prepare($conn, $INSERT);
            mysqli_stmt_bind_param($stmt, 'id',  $Q_ID, $Answer);
            mysqli_stmt_execute($stmt);
        
        }else
        {
            $INSERT = "INSERT INTO subquestionanswer (UserID, QuestionID, SubQuestionID, Answer)
                            VALUES (".$userID.", ?, ?, ?)";  
            $stmt = mysqli_prepare($conn, $INSERT);
            mysqli_stmt_bind_param($stmt, 'iid', $Q_ID, $SubQ_ID, $Answer);
            mysqli_stmt_execute($stmt);
        }
    }
}


//Update comment 
function UpdateComment($userID , $Q_ID , $IsUpdateNote, $note)
{
    global $conn;

    if($IsUpdateNote == 'true'){

        $Update = "UPDATE answernotes SET NoteText = ?
        WHERE QuestionID = ? AND UserID = ".$userID."";
        $stmt = mysqli_prepare($conn, $Update);
        mysqli_stmt_bind_param($stmt, 'si', $note, $Q_ID);
        $result = mysqli_stmt_execute($stmt);

    }else{

        $INSERT = "INSERT INTO answernotes (UserID, QuestionID, NoteText)
                            VALUES (".$userID.", ?, ?)";  
        $stmt = mysqli_prepare($conn, $INSERT);
        mysqli_stmt_bind_param($stmt, 'is', $Q_ID , $note);
        $result = mysqli_stmt_execute($stmt);
    }
}


//Load comment 
function LoadComment($userID , $Q_ID)
{
    global $conn;
    
    $sql = "SELECT NoteText  
                FROM answernotes 
                WHERE UserID = ".$userID." AND QuestionID = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $Q_ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0)
    {
        $data = mysqli_fetch_assoc($result);
        return $data['NoteText'];
    }
    else
        return NULL;
}





?>