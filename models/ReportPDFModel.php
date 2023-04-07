<?php


//This in here just for edit and change the css
//Will be remove after make the link to Controller.php
$servername = "localhost";
$username = "Oleg";
$password = "asd123@#4";
$dbname = "sciencestrategicplan";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Survid = 1 Just for test and css change 
echo get_survey_activity(1, 'DIEL'); 
echo get_survey_activity(1, 'SPP'); 
echo get_survey_activity(1, 'TTL'); 
echo get_survey_activity(1, 'TC'); 
echo get_survey_activity(1, 'GSD'); 



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

        $dataLength = COUNT($data);    

        if($data[0]['Goal'] == "DIEL")
            $tables = "<p class='headers'>Diverse, Inclusive & Equitable Learning</p>";
        elseif($data[0]['Goal'] == "SPP")
            $tables = "<p class='headers'>Sustainable practice to promote well being</p>";
        elseif($data[0]['Goal'] == "TTL")
            $tables = "<p class='headers'>Transformational Teaching & Learning</p>";
        elseif($data[0]['Goal'] == "TC")
            $tables = "<p class='headers'>Transformation Communities</p>";
        elseif($data[0]['Goal'] == "GSD")
            $tables = "<p class='headers'>Guided skill development</p>";

        for($row = 0; $row < $dataLength; $row++) {

            if($row == 0)
            {
                if($data[$row]['SubGoal'] == "I&D")
                    $tables .= "<p class='headers'>Inclusive & Diversity</p>";
                elseif($data[$row]['SubGoal'] == "CM")
                    $tables .= "<p class='headers'>Community mindedness</p>";
                elseif($data[$row]['SubGoal'] == "C")
                    $tables .= "<p class='headers'>Curiosity</p>";
                elseif($data[$row]['SubGoal'] == "S")
                    $tables .= "<p class='headers'>Sustainability</p>";
                $tables .= "<table class='tablePastReport'>";
                $tables .= "<tr class='rowPastReport'>";
                $tables .= "<th class='headerActivity'>Activity</th>";
                $tables .= "<th class='headerRest'>Involvement</th>";
                $tables .= "<th class='headerRest'>Historical</th>";
                $tables .= "</tr>";
            }
            elseif($data[$row-1]['SubGoal'] != $data[$row]['SubGoal'])
            {
                if($data[$row]['SubGoal'] == "I&D")
                    $tables .= "<p class='headers'>Inclusive & Diversity</p>";
                elseif($data[$row]['SubGoal'] == "CM")
                    $tables .= "<p class='headers'>Community mindedness</p>";
                elseif($data[$row]['SubGoal'] == "C")
                    $tables .= "<p class='headers'>Curiosity</p>";
                elseif($data[$row]['SubGoal'] == "S")
                    $tables .= "<p class='headers'>Sustainability</p>";
                $tables .= "<table class='tablePastReport'>";
                $tables .= "<tr class='rowPastReport'>";
                $tables .= "<th class='headerActivity'>Activity</th>";
                $tables .= "<th class='headerRest'>Involvement</th>";
                $tables .= "<th class='headerRest'>Historical</th>";
                $tables .= "</tr>";
            }

            if($data[$row]['Type'] == 'composed')
            {
                $composedMainQuestion = true;
                for($composedQuestion = $row; ;$composedQuestion++)
                {
                    if($composedMainQuestion)
                    {
                        $tables .= "<tr class='rowPastReportSingle'>";
                        //TODO: We need to change the attribute for column span for the grid below and move it to css file for the corresponding style
                        $tables .= "<td class='gridComposedActivity' colspan='3'>" . $data[$composedQuestion]['Question'] . "</td>";
                        $tables .= "</tr>";
                        $tables .= "<tr class='rowPastReportComposed'>";
                        $tables .= "<td class='gridActivity'>" . $data[$composedQuestion]['Sub_Q'] . "</td>";
                        $tables .= "<td class='gridRest'>" . ($data[$composedQuestion]['Activity_Involvement']) . "</td>";
                        $tables .= "<td class='gridRest'>". ($data[$composedQuestion]['Activity_Historical']) ."</td>";
                        $tables .= "</tr>";
                        $composedMainQuestion = false;
                    }
                    else
                    {
                        $tables .= "<tr class='rowPastReportComposed'>";
                        $tables .= "<td class='gridActivity'>" . ($data[$composedQuestion]['Sub_Q']) . "</td>";
                        $tables .= "<td class='gridRest'>" . ($data[$composedQuestion]['Activity_Involvement']) . "</td>";
                        $tables .= "<td class='gridRest'>". ($data[$composedQuestion]['Activity_Historical']) ."</td>";
                        $tables .= "</tr>";
                    }

                    //alert($composedQuestion);
                    if($composedQuestion == $dataLength -1)
                    {
                        $row = $composedQuestion;
                        break;
                    }
                    elseif($data[$composedQuestion]['Type'] != $data[$composedQuestion+1]['Type'])
                    {
                        $row = $composedQuestion;
                        break;
                    }elseif($data[$composedQuestion]['SubGoal'] != $data [$composedQuestion+1]['SubGoal'])
                    {
                        $row = $composedQuestion;
                        break;
                    }
                }
                $composedMainQuestion = true;
            }
            else
            {
                $tables .= "<tr class='rowPastReportSingle'>";
                $tables .= "<td class='gridActivity'>" . ($data[$row]['Question']) . "</td>";
                $tables .= "<td class='gridRest'>" . ($data[$row]['Activity_Involvement']) . "</td>";
                $tables .= "<td class='gridRest'>". ($data[$row]['Activity_Historical']) ."</td>";
                $tables .= "</tr>";
            }

            if($row == $dataLength - 1)
            {
                $tables .= "</table>";
            }
            elseif($data[$row]['SubGoal'] != $data[$row+1]['SubGoal'])
            {
                $tables .= "</table>";
            }
        }
        return $tables;        

    }  
    else
        return $tables = "<p class='headers'>No data found</p>";    
        
}

?>