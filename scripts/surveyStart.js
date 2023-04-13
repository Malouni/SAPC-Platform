

document.addEventListener("DOMContentLoaded", function(){
    StartPageRender();
});

function StartPageRender(){

    var status = document.getElementById("status");
    var progress = document.getElementById("progress") ;

    var Date = document.getElementById("date"); 
    var StartBtn = document.getElementById("beginQbutton");
   
    //call to Controller to check and return the StartDate   
    var url = 'Controller.php';
    var query = {page: 'SuveryStart', command: 'IsSurveyOpen'};        
    
    $.post(url, query, function(data) {
        var result = JSON.parse(data);

        //1 is not open yet 
        if(result['SBoolean'] == 1){

            //set the due date to start date
            Date.innerHTML = "Start date: " + result['StartDate'] ;
            //hide the begin button 
            StartBtn.style.display = "none";

        }else
            Date.innerHTML = "Due date: " + result['EndDate'];               
    });

    // get and set the progress
    url = 'Controller.php';
    query = {page: 'SuveryStart', command: 'GetProgress'};
    $.post(url, query, function(data) {
        var result = JSON.parse(data);
        //1 is not open yet 
        if(result['Progress'] != null){

            //set the due date to start date
            status.innerHTML = "Continuing";
            progress.innerHTML =  result['Progress'] +"%";
           
        }      
    });          
}

function BeginSurvey(){
    $('#BeginSurvey').submit();}


