<?php
//This is the moodel for update the newest data to the SurveyReport based on the LastUpdateDate
//It's will calculate and Update 3 main columns: Answer_Percentage, Activity_Involvement ,Activity_Historical
//This will be called before go to the surveyView(Pastsurveyreport.php) or when download pdf is called 

//This will check the last update of the survey report by compare the last update vs the Date_end of the survey
function CheckUpdate($survID)
{
    global $conn;

    $UpdateCheck = "SELECT IF(`LastUpdatedDate` <= `SurvDateEnd` , 0 , 1) as result  
                           FROM surveytable 
                           WHERE SurvID = ".$survID."";
    
    $UpdateCheck_Result = mysqli_query($conn, $UpdateCheck);
    $UpdateCheck_row = mysqli_fetch_assoc($UpdateCheck_Result);

    // 0 mean need update and return true after done 
    if($UpdateCheck_row["result"] == 0)
    {
       
        ReportUpdate($survID);
        
        //Update the last update date
        $CurrentDate = date("Y/m/d");
   
        $Update = "UPDATE surveytable SET LastUpdatedDate = '$CurrentDate'   
                        WHERE SurvID = ".$survID."";
        mysqli_query($conn, $Update);

        return true; 
    }else 
    {
        return true; 
    }
}

//Update the newest data to SurveyReportTable 
function ReportUpdate($survID)
{
    //Update ProgressPrecent
    ProgressPrecentUpdate($survID);

    //Update Involvement
    InvolvementUpdate($survID);

    //Update Historical
    HistoricalUpdate($survID);
}


//Calculate and Update Involvement For each Activity 
function InvolvementUpdate($survID) 
{
    global $conn;

    // Calculate Involvement of each answers for the questions don't contain sub-question
    $AnswerInvolvement = "SELECT QuestionID, SUM(Answer) AS Involvement 
                                FROM UserAnswer 
                                WHERE SurvID = '$survID' AND Answer IS NOT NULL
                                GROUP BY QuestionID" ;

    $SubAnswerInvolvement = "SELECT QuestionID, SubQuestionID , SUM(Answer) AS Involvement
                                FROM SubQuestionAnswer 
                                WHERE Answer IS NOT NULL
                                GROUP BY SubQuestionID
                                ORDER BY QuestionID" ;
    

    $Answer = mysqli_query($conn, $AnswerInvolvement);
    $SubAnswer = mysqli_query($conn, $SubAnswerInvolvement);

    //Upated the Involvement data to db 
    //for the question not contain SubAnswer
    if (mysqli_num_rows($Answer) > 0) 
    {
        while ($Answer_row = mysqli_fetch_assoc($Answer))
        {
            //non sub-answer update query 
            $Update = " UPDATE surveyreport SET Activity_Involvement = ".$Answer_row['Involvement']."
                            WHERE  SurvID = ".$survID."
                            AND QuestionID = ".$Answer_row['QuestionID']." ";
            
            mysqli_query($conn, $Update);
        }            
    }
    
    //for the question contain SubAnswer
    if (mysqli_num_rows($SubAnswer) > 0) 
    {
        while ($SubAnswer_row = mysqli_fetch_assoc($SubAnswer))
        {
              //non sub-answer update query 
            $Update = "UPDATE surveyreport SET Activity_Involvement = ".$SubAnswer_row["Involvement"]."
                            WHERE SurvID = ".$survID."
                            AND QuestionID = ".$SubAnswer_row["QuestionID"]." 
                            AND SubQuestionID = ".$SubAnswer_row["SubQuestionID"]." ";

            mysqli_query($conn, $Update);
        }            
    }    
}

//Get the Involvement data from last year report and compare to present Involvement For each Activity and Update Historical
function HistoricalUpdate($survID)
{
    global $conn;
    //Check if any last year report exist or not 
    $LastYearReport = "SELECT PastSurvey.SurvID
                            FROM surveytable CurrentSurvey
                            JOIN  surveytable PastSurvey
                            ON CurrentSurvey.SurvID  = ".$survID."
                            AND PastSurvey.SurvYear = CurrentSurvey.SurvYear - 1" ;

    $LastYearReportID = mysqli_query($conn, $LastYearReport);
    
    //if the past report exits then we calcuate the Historical and Update to db
    if (mysqli_num_rows($LastYearReportID) > 0) 
    {
        $LastReport_row  =  mysqli_fetch_assoc($LastYearReportID);

        //Check, select, and calculate the Historical for only the SAME Acitvity from both report.
        //1st join: Return QuestionID have same Acitvity(same Question)
        //2st join: Return SubQuestionID based on the QuestionID in 1st
        //3st join: Return the Involvement based on 1st and 2st
        $AcitivityList = "SELECT CurrentSurvey.QuestionID, CurrentSurveySub.SubQuestionID, 
                                CurrentSurveyReport.Activity_Involvement - PastSurveyReport.Activity_Involvement As Activity_Historical
                                
                                FROM  SurveyQuestions CurrentSurvey
                                JOIN  SurveyQuestions PastSurvey 
                                    ON CurrentSurvey.SurvID = ".$survID."
                                    AND PastSurvey.SurvID =  ".$LastReport_row["SurvID"]."   
                                    AND CurrentSurvey.Question  = PastSurvey.Question 
                            
                                Left JOIN SubQuestions CurrentSurveySub 
                                    ON CurrentSurveySub.QuestionID = CurrentSurvey.QuestionID 
                                Left JOIN SubQuestions PastSurveySub 
                                    ON PastSurveySub.QuestionID = PastSurvey.QuestionID 
                                    AND CurrentSurveySub.Sub_Q = PastSurveySub.Sub_Q 

                                JOIN SurveyReport CurrentSurveyReport 
                                    ON CurrentSurveyReport.QuestionID = CurrentSurvey.QuestionID  
                                JOIN SurveyReport PastSurveyReport 
                                    ON PastSurveyReport.QuestionID =PastSurvey.QuestionID             
                                
                                WHERE CurrentSurveySub.SubQuestionID IS NULL AND PastSurveySub.SubQuestionID IS NULL 
                                OR CurrentSurveySub.SubQuestionID IS NOT NULL AND PastSurveySub.SubQuestionID IS NOT NULL 

                                GROUP BY CurrentSurvey.QuestionID, CurrentSurveySub.SubQuestionID" ;
        
        $HistoricalList = mysqli_query($conn, $AcitivityList);
        //Check if Involvement exit or not => If exit = update 
        if (mysqli_num_rows($HistoricalList) > 0) 
        {
            //update
            while ($Historical_row = mysqli_fetch_assoc($HistoricalList))
            {
                //If SubQuestionID IS NOT NULL 
                if($Historical_row["SubQuestionID"] != null )
                {
                    $Update = "UPDATE surveyreport SET Activity_Historical = ".$Historical_row["Activity_Historical"]."
                    WHERE SurvID = ".$survID."
                    AND QuestionID = ".$Historical_row["QuestionID"]." 
                    AND SubQuestionID = ".$Historical_row["SubQuestionID"]."";
    
                    mysqli_query($conn, $Update);

                }else{

                    $Update = "UPDATE surveyreport SET Activity_Historical = ".$Historical_row["Activity_Historical"]."
                    WHERE SurvID = ".$survID."
                    AND QuestionID = ".$Historical_row["QuestionID"]."";
    
                    mysqli_query($conn, $Update);
                }               
            }
        }          
    }
}


//Caculate and Update ProgressPrecent
function ProgressPrecentUpdate($survID)
{
    global $conn;

    //Note:TotalParticipants and TotalQueastion is 100% have the return so no need for check 
    //Get total number of Participants 
    $TotalParticipants = "SELECT  COUNT( DISTINCT UserID) as num 
                            FROM useranswer 
                            WHERE SurvID = ".$survID." ";

    $ParticipantsNumber = mysqli_query($conn, $TotalParticipants);
    $Participants_row = mysqli_fetch_assoc($ParticipantsNumber);

    //Get Total answer goal based on the number of Participants (number in each goal * number of Participants)
    $TotalQueastion = "SELECT surveyquestions.Goal, 
                            COUNT(surveyquestions.Goal) * ".$Participants_row["num"]." AS answer_goal
                            FROM surveyquestions  
                            LEFT JOIN subquestions ON subquestions.QuestionID = surveyquestions.QuestionID
                            WHERE surveyquestions.SurvID = ".$survID." 
                            GROUP BY surveyquestions.Goal
                            ORDER BY surveyquestions.QuestionID";

    $answer_goal = mysqli_query($conn, $TotalQueastion);
    

    //Get the total already answer from user in each goal 
    $TotalAnswer = "SELECT  surveyquestions .Goal , COUNT(surveyquestions.Goal) AS TotalAnswer
                            FROM surveyquestions 
                            LEFT JOIN subquestions ON subquestions.QuestionID = surveyquestions.QuestionID
                            LEFT JOIN useranswer ON useranswer.QuestionID = surveyquestions.QuestionID 
                            LEFT JOIN subquestionanswer ON subquestions.SubQuestionID = subquestionanswer.SubQuestionID  
                            WHERE surveyquestions.SurvID = ".$survID."   AND  subquestionanswer.Answer IS NOT NULL 
                            OR surveyquestions.SurvID = ".$survID."  AND  useranswer.Answer IS NOT NULL
                            GROUP BY surveyquestions.Goal" ;

    $TotalAnswerResult = mysqli_query($conn, $TotalAnswer);

    if (mysqli_num_rows($TotalAnswerResult) > 0) 
    {   
        //Check if there is any TotalAnswerResult is missing for any goal 
        if (mysqli_num_rows($TotalAnswerResult) < mysqli_num_rows($answer_goal))
        {
            $count = 0;
            $total_row = mysqli_num_rows($TotalAnswerResult); 
           
            while ($answer_goal_row = mysqli_fetch_assoc($answer_goal))
            {  
                $TotalAnswer_row = mysqli_fetch_assoc($TotalAnswerResult);  
                            
                 
                //This will set the Answer_Percentage = 0 whenever TotalAnswerResult for that goal is null or non exits
                if($count <= $total_row){
                    //Calculate the Answer_Percentage
                    $Answer_Percentage_Result = $TotalAnswer_row["TotalAnswer"] / $answer_goal_row["answer_goal"]; 

                    //Update
                    $Update = "UPDATE surveyreport
                                    SET Answer_Percentage = ".$Answer_Percentage_Result."
                                    WHERE  surveyreport.QuestionID  
                                    IN (SELECT QuestionID FROM surveyquestions WHERE Goal = '".$answer_goal_row['Goal']."' AND SurvID = '".$survID."' )";
    
                    mysqli_query($conn, $Update);
                    $count += 1;
                }else{

                    //Update 
                    $Update = "UPDATE surveyreport
                                    SET Answer_Percentage = 0
                                    WHERE  surveyreport.QuestionID  
                                    IN (SELECT QuestionID FROM surveyquestions WHERE Goal = '".$answer_goal_row['Goal']."' AND SurvID = '".$survID."'  )";
    
                    mysqli_query($conn, $Update);
                }     
                
            }

        }
        else{

            while ($answer_goal_row = mysqli_fetch_assoc($answer_goal))
            {  
                $TotalAnswer_row = mysqli_fetch_assoc($TotalAnswerResult);                
               
                //Calculate the Answer_Percentage
                $Answer_Percentage_Result = $TotalAnswer_row["TotalAnswer"] / $answer_goal_row["answer_goal"]; 

                //Update
                $Update = "UPDATE surveyreport
                                SET Answer_Percentage = ".$Answer_Percentage_Result."
                                WHERE  surveyreport.QuestionID  
                                IN (SELECT QuestionID FROM surveyquestions WHERE Goal = '".$answer_goal_row['Goal']."' AND SurvID = '".$survID."'  )";

                mysqli_query($conn, $Update);   
            }
        }   
    }
}

?>

