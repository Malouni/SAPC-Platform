<?php
if (empty($_POST['page'])) {

    $display_type = 'none';

    $error_message_username = "";
    $error_message_password = "";
    include ('LogInPage.php');
    exit();
}

require('LogInModel.php');
require('model2.php');


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
                require('Index.php');
            }
            exit();
    }
}

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
        include('PastSurveyReport.php');
        break;

    case 'SignOut':
        session_unset();
        session_destroy();
        $display_type = 'none';
        include ('LogInPage.php');
        break;
    }
}

else if ($_POST['page'] == 'MainPage')
{
    if (!isset($_SESSION['LogIn'])) {
        $display_type = 'none';
        include('LogInPage.php');
        exit();
    }

    $command = $_POST['command'];
    switch($command) {
        case '':

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
else {
}
?>
