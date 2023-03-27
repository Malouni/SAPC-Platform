<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>

    <!--Links to stylesheets-->
    <link rel="stylesheet" href="/fonts/arial-nova/stylesheet.css">
    <link rel="stylesheet" href="/styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/survey.css">

</head>

<body>

    <!-------------------------- Navigation section------------------------- -->
    <?php
        include('Navigation.php');
    ?>
    <!----------------------------- Main section -------------------------------->

    <!------------------ Container div----------------- -->
    <div class="container">

        <div class="progressbar section">
            <p> progress bar code here </p>
        </div>
        <div class="questions section">
            <div class="question">
                <h3 id="S_tochange">Strategy goal #:?</h3>   <!------------------Here is the field for the strategy goal to be changed-->
                <p id="Q_tochange">Q#. Question to be asked</p>
                <form>
                    <input type="radio" id="option1" name="options" value="1">
                    <label for="option1">Answer1</label><br>
                    <input type="radio" id="option2" name="options" value="1">
                    <label for="option2">Answer2</label><br>
                    <input type="radio" id="option3" name="options" value="1">
                    <label for="option3">Answer3</label><br>
                    <input type="radio" id="option4" name="options" value="1">
                    <label for="option4">Answer4</label><br>
                    <input type="radio" id="option5" name="options" value="1">
                    <label for="option5">Answer5</label><br>
                    <input type="text" id="userComments" placeholder="Additional comments">
                    <button class="floatleft">Back</button>
                    <button type="submit" class="floatright">Next</button>
                </form>
            </div>
        </div>

    </div>




</body>

</html>