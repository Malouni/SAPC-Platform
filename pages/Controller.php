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




session_start();

if ($_POST['page'] == 'LogInPage')
{
    $command = $_POST['command'];
    switch($command) {
        case 'LogIn':

            if (!check_validity($_POST['truid'], $_POST['password'])) {
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password';

                $display_type = 'LogIn';

                include('LogInPage.php');
            }
            else {
                $_SESSION['LogIn'] = 'Yes';
                $_SESSION['userFirstName'] = get_user_first_name ($_POST['truid']);
                $_SESSION['userLastName'] = get_user_last_name ($_POST['truid']);
                $_SESSION['userPosition'] = get_user_position ($_POST['truid']);
                $_SESSION['userId'] = get_user_id($_POST['truid']);
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
        include('upload_csv.php');
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
        $result = get_upcoming_surveys($_SESSION['userId']);
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
            header('location: survey.php');
            exit();
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
            UpdateAnswers($_SESSION['NewSurveysID'],$_SESSION['userId'],$_POST['Q_ID'],$_POST['SubQID'],$_POST['Answer']);
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

        case 'CurrentSurveyDocumentID':
            $_SESSION['documentId'] = $_POST['CurrentDocumentID'];
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
    }
}
else{

}