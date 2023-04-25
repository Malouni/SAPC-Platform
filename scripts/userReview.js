
function getUserAnswer(surveyYear){

    //call to Controller to get the data 
    var url = 'Controller.php';

   
    //called from surveysubmit.php will set the surveyYear == 0 
    //called from history(main) will set the surveyYear == 1
    if(surveyYear == 0){
        var query = {page: 'userReview', command: 'SurveySubmitAnswer'};
    }else if(surveyYear == 1){
        var query = {page: 'userReview', command: 'HistorySurveyReview'};
    }else{
        //get the postion in Select Value
        var postion = surveyYear.split('_');
        var query = {page: 'userReview', command: 'getUserAnswerReview' , SurveyYear: ''+postion[0]+'' , Position: ''+postion[1]+'' };                
    }

    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        var table;

        if(result != 'Failed'){
            
            var IDcheck = 0 ; 

            table = "<h1 class='sectionheader'>User Answers</h1>";
            table += "<table border='1'>";
            table +=  "<tr><th>Questions</th><th>Answer</th></tr>";

            for(let row = 0 ; row < result.length ; row++)
            {   
                var QuesetionType = (result[row]['Type']).split("_");


                if (QuesetionType[0] == 'composed') {
                    if(IDcheck != result[row]['QuestionID'])
                        table += "<tr><td colspan='2' style='font-weight: bold;'>"+result[row]['Question']+"</td></tr>";
                        IDcheck = result[row]['QuestionID'];

                    if(result[row]['SubAnsewer'] !== null)
                        table += "<tr><td style='text-indent: 30px;'>"+result[row]['Sub_Q']+"</td><td>"+result[row]['SubAnsewer']+"</td></tr>";
                    else    
                        table += "<tr><td style='text-indent: 30px;'>"+result[row]['Sub_Q']+"</td><td id='no_answer'>"+"No Answer"+"</td>";
                   
                }
                else{
                    if(result[row]['MainAnsewer'] !== null)
                        table += "<tr><td style='font-weight: bold;'>"+result[row]['Question']+"</td><td>"+result[row]['MainAnsewer']+"</td></tr>";
                    else 
                        table += "<tr><td style='font-weight: bold;'>"+result[row]['Question']+"</td><td id='no_answer'>"+"No Answer"+"</td>";
                }
            }

            table += "</table>";    

        }else{
            table = "<p>No data found for the selected year.</p>";
        }       
          

    //print the table
    $('#report').html(table);
    if(surveyYear == 1){
        setDefaultSelect(result[1]['SurvYear']+ "_" +result[1]['Position']);
    }
    });
}



function getSelectMenu(value){

    //call to Controller to get the data 
    var url = 'Controller.php';
    var query = {page: 'userReview', command: 'getYearSurvey'};        

    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        if(result[0] != 'Failed'){
            var select = "<label for='year'>Select a year: </label>";     
            select +="<select name='year' id='year' onchange='yearSelect()'>";      
                        
            for(let row = 0 ; row < result.length ; row++)
            {
                select +="<option value="+result[row]['SurvYear']+"_"+result[row]['Position'] +"> "+result[row]['SurvYear']+"_"+result[row]['Position'] +" </option>";
            }   

            select +="</select>";    
        }

        //print the selectButton 
        $('#selectBTN').html(select);
        
        //this is call from the navigation 
        if(value === 1){
          yearSelect(); 
        }

    });     
 
}

function yearSelect(){
    var year = document.getElementById("year").value;
    getUserAnswer(year);
}

// this function will only be called in the surveySubmit page 
// This will use the 
function SurveySumbit(){
    getUserAnswer(0);
}

//this come from the History in main page
function SurveyHistory(){
    getSelectMenu(0);
    getUserAnswer(1);
}

//this come from the navigation
function CurrentReport(){
    getSelectMenu(1);
}

function setDefaultSelect(year){

    var valueSelect = year;
    var mySelect = document.getElementById('year');

    for(var i, j = 0; i = mySelect.options[j]; j++) {
        
        if(i.value == valueSelect) {
            mySelect.selectedIndex = j;
            break;
        }
    }   
}