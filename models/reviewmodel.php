<?php

function getUserReview($userId , $survYear , $position){    

    global $conn;

    if(is_string($survYear) != 1){

        // Fetch the data by using SurvID
        $sql = "SELECT  ST.SurvYear , ST.Position , SQ.Type,  SQ.QuestionID , SQ.Question , UA.Answer as MainAnsewer , SQS.Sub_Q , UAS.Answer as SubAnsewer 
                        FROM surveyquestions SQ 
                        LEFT JOIN surveytable ST ON SQ.SurvID =  ST.SurvID
                        LEFT JOIN subquestions SQS ON SQS.QuestionID =  SQ.QuestionID
                        LEFT JOIN useranswer UA ON UA.QuestionID = SQ.QuestionID AND UA.UserID = '".$userId."'
                        LEFT JOIN subquestionanswer UAS ON UAS.SubQuestionID = SQS.SubQuestionID AND UAS.UserID = '".$userId."' 
                        WHERE SQ.SurvID = ?
                        ORDER BY SQ.QuestionID";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $survYear);

    }else{
        
        // Fetch the data for the selected year
        $sql = "SELECT  SQ.Type,  SQ.QuestionID , SQ.Question , UA.Answer as MainAnsewer , SQS.Sub_Q , UAS.Answer as SubAnsewer
                    FROM surveyquestions SQ 
                    LEFT JOIN subquestions SQS ON SQS.QuestionID =  SQ.QuestionID
                    LEFT JOIN useranswer UA ON UA.QuestionID = SQ.QuestionID AND UA.UserID = '".$userId."'
                    LEFT JOIN subquestionanswer UAS ON UAS.SubQuestionID = SQS.SubQuestionID AND UAS.UserID = '".$userId."' 
                    WHERE SQ.SurvID IN (SELECT SurvID FROM surveytable WHERE  SurvYear = ? AND Position = ?)  
                    ORDER BY SQ.QuestionID";
     
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $survYear, $position);
    }
    
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

    $sql = "SELECT SurvYear , Position
                FROM surveytable
                WHERE Position = '$position' OR Position ='user'";

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