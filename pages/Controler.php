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

            if (!check_validity($_POST['truid'], $_POST['password'], $_POST['position'])) {
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password';

                $display_type = 'LogIn';

                include('LogInPage.php');
            }
            else {
                $_SESSION['LogIn'] = 'Yes';
                $_SESSION['userFirstName'] = get_user_first_name($_SESSION['truid']);
                $_SESSION['userLastName'] = get_user_last_name($_SESSION['truid']);
                include('Index.php');
            }
            exit();
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

        case 'SignOut':
            session_unset();
            session_destroy();
            $display_type = 'none';
            include ('LogInPage.php');
            break;
    }
}

else {
}
?>
