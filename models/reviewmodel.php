<?php

function getUserReview($userId , $survYear){    

    global $conn;

    if(is_string($survYear) != 1){

        // Fetch the data by using SurvID
        $sql = "SELECT  ST.SurvYear , SQ.Type,  SQ.QuestionID , SQ.Question , UA.Answer as MainAnsewer , SQS.Sub_Q , UAS.Answer as SubAnsewer
                        FROM surveyquestions SQ 
                        LEFT JOIN surveytable ST ON SQ.SurvID =  ST.SurvID
                        LEFT JOIN subquestions SQS ON SQS.QuestionID =  SQ.QuestionID
                        LEFT JOIN useranswer UA ON UA.QuestionID = SQ.QuestionID AND UA.UserID = '".$userId."'
                        LEFT JOIN subquestionanswer UAS ON UAS.SubQuestionID = SQS.SubQuestionID AND UAS.UserID = '".$userId."' 
                        WHERE SQ.SurvID = '".$survYear."' 
                        ORDER BY SQ.QuestionID";
    }else{
        
        // Fetch the data for the selected year
        $sql = "SELECT  SQ.Type,  SQ.QuestionID , SQ.Question , UA.Answer as MainAnsewer , SQS.Sub_Q , UAS.Answer as SubAnsewer
                    FROM surveyquestions SQ 
                    LEFT JOIN subquestions SQS ON SQS.QuestionID =  SQ.QuestionID
                    LEFT JOIN useranswer UA ON UA.QuestionID = SQ.QuestionID AND UA.UserID = '".$userId."'
                    LEFT JOIN subquestionanswer UAS ON UAS.SubQuestionID = SQS.SubQuestionID AND UAS.UserID = '".$userId."' 
                    WHERE SQ.SurvID IN (SELECT SurvID FROM surveytable WHERE  SurvYear = '$survYear' )  
                    ORDER BY SQ.QuestionID";
    }

    $stmt = $conn->prepare($sql);
    //$stmt->bind_param('ii', $userId, $survYear);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [] ; 
    // Display table if data is found
    if ($result->num_rows > 0) {        
        while ($row = $result->fetch_assoc()) 
            $data[] = $row;
        return  $data;      

    } else 
        return $data[0] = 'Failed';
    
}

function getYearSurvey($position){
    global $conn;

    $sql = "SELECT SurvYear
                FROM surveytable
                WHERE Position = '$position'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = [] ; 
    // Display table if data is found
    if ($result->num_rows > 0) {        
        while ($row = $result->fetch_assoc()) 
            $data[] = $row;
        return  $data;      

    } else 
        return $data[0] = 'Failed';    
}


?>