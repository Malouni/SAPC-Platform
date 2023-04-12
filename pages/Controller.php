<?php
if (empty($_POST['page'])) {

    $display_type = 'none';

    $error_message_username = "";
    $error_message_password = "";
    include ('LogInPage.php');
    exit();
}

require('../models/LogInModel.php');
require('../models/PastSurveyReportModel.php');
require('../models/MainPageModel.php');
require('../models/SurveyModel.php');
require('../models/surveyStartModel.php');
require('../models/reviewmodel.php');
require('../models/AdminPageModel.php');
require('../models/chartPDFModel.php');
require('../models/PresentSurveyReportModel.php');




session_start();

if ($_POST['page'] == 'LogInPage')
{
    $command = $_POST['command'];
    switch($command) {
        case 'LogIn':

            if (!check_validity($_POST['userName'], $_POST['password'])) {
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password';

                $display_type = 'LogIn';

                include('LogInPage.php');
            }
            else {
                $_SESSION['LogIn'] = 'Yes';
                $_SESSION['userFirstName'] = get_user_first_name ($_POST['userName']);
                $_SESSION['userLastName'] = get_user_last_name ($_POST['userName']);
                $_SESSION['userPosition'] = get_user_position ($_POST['userName']);
                $_SESSION['userId'] = get_user_id($_POST['userName']);
                require('Index.php');
            }
            exit();
    }
}

//navigation funcitonality
else if($_POST['page'] == 'Navigation')
{
    if (!isset($_SESSION['LogIn'])) {
        $display_type = 'none';
        include('LogInPage.php');
        exit();
    }

    $command = $_POST['command'];
    switch($command) {

    case 'MainPage':
        include('Index.php');
        break;

    case 'SurveyStart':
        include('surveyStart.php');
        break;

    case 'PresentReport':
        if($_SESSION['userPosition']=="admin"){
            include('PastSurveyReport.php');
            break;
        }
        else{
            include('userReview.php');
            break;
        }

    case 'UploadCsv':
        include('AdminPage.php');
        break;

    case 'SignOut':
        session_unset();
        session_destroy();
        $display_type = 'none';
        include ('LogInPage.php');
        break;
    }
}


else if($_POST['page'] == 'MainPage')
{
    if (!isset($_SESSION['LogIn'])) {
        $display_type = 'none';
        include('LogInPage.php');
        exit();
    }

    $command = $_POST['command'];
    switch($command) {

    case 'UpcomingSurveys':
        $result = get_upcoming_surveys($_SESSION['userId'], $_SESSION['userPosition']);
        echo json_encode($result);
        break;

    case 'HistoryOfSurveys':
        $result = get_surveys_completed_by_user($_SESSION['userId']);
        echo json_encode($result);
        break;
    
    case 'upcomingSurveysID':
        $_SESSION['NewSurveysID'] = (int) $_POST['ID'] ;
        include('surveyStart.php');
        break;

    case 'HistorySurveysID':
        $_SESSION['PastSurveysID'] = (int) $_POST['P_ID'] ;
        include('userReview.php');
        break;

    }
}



else if ($_POST['page'] == 'SuveryStart')
{
    if (!isset($_SESSION['LogIn'])) {
        $display_type = 'none';
        include('LogInPage.php');
        exit();
    }

    $command = $_POST['command'];
    switch($command) {
        case 'IsSurveyOpen':
            $result = isSurveyOpen($_SESSION['NewSurveysID']);
            echo json_encode($result);
            break;

        case 'GetProgress':
            $result = get_user_progress($_SESSION['userId'],$_SESSION['NewSurveysID']);
            echo json_encode($result);
            break;

        case 'StartSurvey':
            include('survey.php');  
            break;
    }
}


else if($_POST['page'] == 'Suvery'){
    if (!isset($_SESSION['LogIn'])) {
        $display_type = 'none';
        include('LogInPage.php');
        exit();
    }
    
    $command = $_POST['command'];
    switch($command) {

        case 'AnswerUpdate':
            UpdateAnswers($_SESSION['NewSurveysID'],$_SESSION['userId'],$_POST['Q_ID'],$_POST['SubQID'],$_POST['IsUpdate'],$_POST['Answer']);
            break;
        
        case 'NoteUpdate':
            UpdateComment($_SESSION['userId'],$_POST['Q_ID'],$_POST['note']);
            break;
    
        case 'LoadQuestionList':
            $result = LoadQuestions($_SESSION['NewSurveysID']);
            echo json_encode($result);
            break;
        
        case 'LoadLabelList':
            $result = LoadLabel($_SESSION['NewSurveysID']);
            echo json_encode($result);
            break;

        case 'LoadAnswers':
            $result = LoadAnswers($_SESSION['NewSurveysID'],$_SESSION['userId'],$_POST['Q_ID'],$_POST['Q_Type']);
            echo json_encode($result);
            break;
        
        case 'LoadNote':
            $result = LoadComment($_SESSION['NewSurveysID'],$_POST['Q_ID']);
            echo json_encode($result);
            break;

        case 'LastProgress':
            $result = LoadLastProgress($_SESSION['NewSurveysID'],$_SESSION['userId']);
            echo json_encode($result);
            break;       
            
        case 'SurveyFin':
            include('SurveySubmit.php');
            break;       
    }
}

else if ($_POST['page'] == 'PastReport')
{
    if (!isset($_SESSION['LogIn'])) {
        $display_type = 'none';
        include('LogInPage.php');
        exit();
    }
   
    $command = $_POST['command'];
    switch($command) {
        case 'SurveyDocuments':
            $result = get_survey_documents();
            echo json_encode($result);
            break;

        case 'SurveyActivityGoal':
            $result = get_survey_activity($_SESSION['documentId'], $_POST['goal']);
            echo json_encode($result);
            break;

        case 'AnswerPercentage':    
            $result = get_survey_answer_percentage($_SESSION['documentId'], $_POST['goal']);
            echo json_encode($result);
            break;

        case 'GetPDFReport':
            $_SESSION['ID_PDF'] = (int) $_POST['PDF_ID'];
            include('chartPDF.php');
            break;

        case 'CurrentSurveyDocumentID':
            $_SESSION['documentId'] = $_POST['CurrentDocumentID'];
            CheckUpdate($_SESSION['documentId']);
            break;
    }
}
else if ($_POST['page'] == 'userReview')
{
    if (!isset($_SESSION['LogIn'])) {
        $display_type = 'none';
        include('LogInPage.php');
        exit();
    }

    $command = $_POST['command'];
    switch($command) {
       
        case 'getUserAnswerReview':
            $result = getUserReview($_SESSION['userId'] , $_POST['SurveyYear']);
            echo json_encode($result);
            break;
        
        case 'getYearSurvey':
            $result = getYearSurvey($_SESSION['userPosition']);
            echo json_encode($result);
            break;

        case 'SurveySubmitAnswer':
            $result = getUserReview($_SESSION['userId'] , $_SESSION['NewSurveysID'] );
            echo json_encode($result);
            break;
    
        case 'HistorySurveyReview':
            $result = getUserReview($_SESSION['userId'] , $_SESSION['PastSurveysID'] );
            echo json_encode($result);
            break;
    }
}

else if ($_POST['page'] == 'AdminPage')
{
    if (!isset($_SESSION['LogIn'])) {
        $display_type = 'none';
        include('LogInPage.php');
        exit();
    }

    $command = $_POST['command'];
    switch($command) {
        case 'UserTable':
            $result = get_users_info();
            echo json_encode($result);
            break;

        case 'SurveyTable':
            $result = get_surveys_info();
            echo json_encode($result);
            break;

        case 'ChangeUser':
            if($fieldToChange = get_the_column_name_user($_POST["choice"]))
            {
                if($result = update_user($_POST["rowId"], $fieldToChange, $_POST["value"]))
                    $result = "The user's ".$_POST["choice"]." was updated successfully";
                else
                    $result = "Error occupied while updating the user, try again";
            }
            else
                $result ="No such attribute for user";
            echo json_encode($result);
            break;

        case 'ResetPassword':
            if($result = rest_user_password($_POST['ResetPwdUserId']))
                $result = "The password was set to DEFAULT for user: ";
            else
                $result = "Error occupied while updating the user, try again";
            echo json_encode($result);
            break;

        case 'ChangeSurv':
            if($fieldToChange = get_the_column_name_survey($_POST["choice"]))
            {
                if($result = update_survey($_POST["rowId"], $fieldToChange, $_POST["value"]))
                    $result = "The survey field ".$_POST["choice"]." was updated successfully";
                else
                    $result = "Error occupied while updating the survey, try again";
            }
            else
                $result ="No such attribute for survey";
            echo json_encode($result);
            break;

        case 'AddNewUser':
            if(!check_if_user_exists($_POST["Email"]))
            {
                if($_POST["Email"] == $_POST["EmailCon"])
                {
                    $result = add_new_user($_POST["Email"], $_POST["Fname"], $_POST["Lname"], $_POST["userType"], $_POST["department"]);
                    if($result){
                        $result = "New user ".$_POST["Email"]." was added successfully!";
                    }else{
                        $result = "The error occupied, try again later.";
                    }
                }
                else
                {
                    $result = "Emails for user: ".$_POST["Email"]." are not matching, please try again";
                }
            }
            else
            {
                $result = "User: ".$_POST["Email"]." already exists";
            }
            echo json_encode($result);
            break;

        case 'RemoveUser':
            if($userName = remove_user($_POST["RemoveUserId"]))
                $result = "The user: ".$userName." was deleted successfully!";
            else
                $result = "The error occupied, try again later.";
            echo json_encode($result);
            break;

        case 'csvAddUsers':
            $data = $_POST["csvFileDataUsers"];
            $result = "";
            for($line = 0; $line < count($data); $line++)
            {
                if(!check_if_user_exists($data[$line]["Username"]))
                {
                    if(add_new_user($data[$line]["Username"],$data[$line]["FirstName"], $data[$line]["LastName"], $data[$line]["UserType"], $data[$line]["Department"])){
                        $result .= "The user ".$data[$line]["Username"]." was added successfully!\n";
                    }else{
                        $result .= "The user ".$data[$line]["Username"]." was not added due to the error!, try again\n";
                    }
                }
                else
                {
                    $result .= "User already exists: ".$data[$line]["Username"]."\n";
                }
            }
            echo json_encode($result);
            break;

        case 'csvAddSurvey':
            $data = $_POST["csvFileDataSurveys"];
            $result;
            if(!check_if_survey_exists($data[0][0]["SurvYear"], $data[0][0]["SurvName"]))
            {
                $newSurvId = add_new_survey($data[0][0]["SurvYear"], $data[0][0]["SurvName"], $data[0][0]["SurvDateStart"], $data[0][0]["SurvDateEnd"], $data[0][0]["Position"]);
                if($newSurvId)
                {
                    if($result = add_questions_to_new_survey($data[1], $data[2], $newSurvId))
                    {
                        $result = "The survey: ".$data[0][0]["SurvName"]." was added successfully!";
                    }
                    else
                    {
                        $result = "The survey: ".$data[0][0]["SurvName"]." addition failed, check the csv file (Questions Part)";
                    }
                }
                else
                {
                    $result = "The survey: ".$data[0][0]["SurvName"]." addition failed, check the csv file (Survey Details)";
                }
            }
            else
            {
                $result ="The survey: ".$data[0][0]["SurvName"]." already exists";
            }
            echo json_encode($result);
            break;
    }
}

else if ($_POST['page'] == 'ReportPDF')
{
    if (!isset($_SESSION['LogIn'])) {
        $display_type = 'none';
        include('LogInPage.php');
        exit();
    }

    $command = $_POST['command'];
    switch($command) {
       
        case 'getPDFRport':
           $_SESSION['lineChart'] = $_POST['lineChart'] ;
           $_SESSION['circleChart'] = $_POST['circleChart'] ;
           CheckUpdate($_SESSION['documentId']);
           include('reportPDF.php');
           break;        

        case 'LoadCharts':
            $result = getChartData($_SESSION['ID_PDF']);
            echo json_encode($result);
            break;
      
    }
}