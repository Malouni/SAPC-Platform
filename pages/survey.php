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
            <script>
                updateProgressBar(0.5);
            </script>

        </div>


        <div class="questions section">

            <div class="question" id="question">
                <h3 id="strategic-goal">Strategic goal should be here</h3>
                <form action="">
                    <table id="question-table">

                        <!-------------- QUESTION FIELD, QUESTION SHALL BE PLACED HERE---->
                        <tr>
                            <th colspan="2" id="QuestionField">Question should go here</th>
                        </tr>


                        <!--------------SUB-QUESTIONS SPACE---->

                        <tr class="option-sq SQ">                           <!--------------example for a radio option Sub-Question---->
                            <td>Subquestion should go here</td>
                            <td class="radio-option">                       <!--------------for a radio option answer---->
                                <input type="radio" id="op1" name="roption" value="1">
                                <label for="op1">label 1</label><br>
                                <input type="radio" id="op2" name="roption" value="2">
                                <label for="op2">label 2</label><br>
                                <input type="radio" id="op3" name="roption" value="3">
                                <label for="op3">label 3</label>
                                <input type="radio" id="op1" name="roption" value="1">
                                <label for="op1">label 1</label><br>
                                <input type="radio" id="op2" name="roption" value="2">
                                <label for="op2">label 2</label><br>
                                <input type="radio" id="op3" name="roption" value="3">
                                <label for="op3">label 3</label>
                            </td>
                        </tr>



                        <tr class="input-sq SQ">                            <!--------------for a text input Sub-Question---->
                            <td>Subquestion should go here</td>
                            <td class="text-input"><input type="text" placeholder="Type your answer here"></td> <!--------------for an text input answer---->
                        </tr>



                        <!--------------IF QUESTION IS SINGLE TYPE---->
                        <tr>
                            <td  colspan="2" class="text-input"><input type="text"></td>
                        </tr>  
                        
                        

                    </table>

                    <!--------------SPACE FOR COMMENTS---->
                    <input type="text" id="userComments" placeholder="Additional Comments?">


                    <!--------------BACK & NEXT BUTTONS---->
                    <button class="floatleft">Back</button>
                    <button class="floatright">Next</button>
                </form>

            </div>

        </div>

    </div>




</body>

</html>