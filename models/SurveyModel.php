<?php


// for update the user answer 
function UpdateAnswers($survId , $userID , $Q_ID , $SubQ_ID , $Answer)
{   
    global $conn;

    // update the ansewer for the question without the sub questions when SubQ_ID == 0(Note: the SubQuestionID = 0 in db is not exit )  
    if($SubQ_ID == 0)
    {
        $Update = "UPDATE UserAnswer SET Answer = ".$Answer."   
                        WHERE SurvID = ".$survId." AND QuestionID = ".$Q_ID." AND UserID = ".$userID."";

        $result = mysqli_query($conn, $Update);
    
    }else
    {
        $Update = "UPDATE SubQuestionAnswer SET Answer = ".$Answer."   
                        WHERE  QuestionID = ".$Q_ID." AND UserID = ".$userID." AND SubQuestionID = ".$SubQ_ID."";
        
        $result = mysqli_query($conn, $Update);
    }

}

// for load the user answer 
function LoadAnswers($survId , $userID , $Q_ID , $Type)
{
    global $conn;

    if($Type == 'single'){
        
        // load the ansewer for the only single questions    
        $sql = " SELECT QuestionID, Answer As MainAnswer
                    FROM useranswer
                    WHERE QuestionID = ".$Q_ID." AND UserID = ".$userID." 
                    AND Answer IS NOT NULL";
    }else{

        // load the ansewer for the only composed questions    
        $sql = " SELECT subquestionanswer.QuestionID, subquestionanswer.SubQuestionID, subquestionanswer.Answer As SubAnswer
                    FROM subquestionanswer
                    LEFT JOIN subquestions ON subquestions.SubQuestionID = subquestionanswer.SubQuestionID
                    WHERE subquestionanswer.QuestionID =  ".$Q_ID." AND UserID = ".$userID."
                    AND Answer IS NOT NULL
                    ORDER BY subquestions.SubType ";                   
    }

    $result = mysqli_query($conn, $sql);
   
    //put the data to array and return 
    $data = [];
    if (mysqli_num_rows($result)) 
    {
        while($row = mysqli_fetch_assoc($result))
            $data[] = $row;
        return $data;

    }else
        return $data[0] = "Failed";

}

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

//Update comment 
function UpdateComment($userID , $Q_ID , $note)
{
    global $conn;

    $Update = "UPDATE answernotes SET NoteText = '$note' 
                    WHERE QuestionID = ".$Q_ID." AND UserID = ".$userID."";

    $result = mysqli_query($conn, $Update);  
}

//Load comment 
function LoadComment($userID , $Q_ID)
{
    global $conn;
    
    $sql = "SELECT NoteText  
                FROM answernotes 
                WHERE UserID = ".$userID." AND QuestionID = ".$Q_ID."";

    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0)
    {
        $data = mysqli_fetch_assoc($result);
        return $data['NoteText'];
    }
    else
        return NULL;
}




?>