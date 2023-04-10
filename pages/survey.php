
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

    <script>
        function updateProgressBar(progress) {
            const fill = document.querySelector(".fill");
            const percentage = Math.max(0, Math.min(100, progress * 100));
            fill.style.width = `${percentage}%`;
        }
    </script>
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
            <p>Progress</p>
            <div class="progress-bar">
                <div class="circle start"></div>
                <div class="bar">
                    <div class="fill"></div>
                </div>
                <div class="circle end"></div>
            </div>    
        </div>


        <div class="questions section">

            <div class="question" id="question">
                

            </div>

        </div>

    </div>

<form method='post' action='Controller.php' id='SurveyFinSubmit' style='display:none'>
    <input type='hidden' name='page' value='Suvery'>
    <input type='hidden' name='command' value='SurveyFin'>
</form>

</body>

</html>