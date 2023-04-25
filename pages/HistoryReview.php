<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Review</title>

    <!-- links to stylesheets -->
    <link rel="stylesheet" href="../fonts/arial-nova/stylesheet.css">
    <link rel="stylesheet" href="../styles/generalStyles.css">
    <link rel="stylesheet" href="../styles/review.css">

    <script src="../scripts/userReview.js"></script>


</head>

<body>

    <!-------------------------- Navigation section------------------------- -->
    <?php
    require('Navigation.php');
    ?>
    <!----------------------------- Main section -------------------------------->

    <div class="container">
        <script> SurveyHistory(); </script>

        <div class="report" id="selectBTN">            
        </div>

        <div class="report" id="report">            
        </div>

    </div>


</body>

</html>