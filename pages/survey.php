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
    <link rel="stylesheet" href="../fonts/arial-nova/stylesheet.css">
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/survey.css">

    <script src="../scripts/Survey.js"></script>


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
            <div class="question" id="question">      

               
            </div>
        </div>

    </div>




</body>

</html>