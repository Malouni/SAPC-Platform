<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Review</title>

    <!-- links to stylesheets -->
    <link rel="stylesheet" href="/fonts/arial-nova/stylesheet.css">
    <link rel="stylesheet" href="/styles/generalStyles.css">
    <link rel="stylesheet" href="/styles/review.css">

</head>

<body>

    <!-------------------------- Navigation section------------------------- -->
    <?php
    require('Navigation.php');
    ?>
    <!----------------------------- Main section -------------------------------->

    <div class="container">

        <div class="report">
            <h1 class="sectionheader">User Answers</h1>

            <!-- Dropdown list for year selection-->
            <form method="POST" action="controller.php" id="yearSelectForm">
                <input type='hidden' name='page' value='userReview'>
                <input type='hidden' name='command' value='selectYear'>
                <label for="year">Select a year:</label>
                <select name="year" id="year">
                    <?php
                    $currentYear = date('Y');
                    for ($i = $currentYear; $i >= $currentYear - 4; $i--) {
                        $selected = isset($_POST['year']) && $_POST['year'] == $i ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
                <button type="submit" id="submit-btn">Submit</button>
            </form>


            <?php
            require('../models/reviewmodel.php');
            ?>
        </div>

    </div>


</body>

</html>