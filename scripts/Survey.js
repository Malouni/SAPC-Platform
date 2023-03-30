var CurrentQuestionID;
var QuestionList;
//setup the QuestionList and CurrentQuestion
QuestionList = JSON.parse(sessionStorage.getItem("QuestionList"));
CurrentQuestionID = JSON.parse(sessionStorage.getItem("CurrentQuestion"));

// 0 is mean this is the first time user open the survey
if(CurrentQuestionID == 0){
    CurrentQuestionID = QuestionList[0]["QuestionID"];
}

document.addEventListener("DOMContentLoaded", function(){
    QuestionLoad();    
    LastProgressCheck();
    QuestionGender(findIndex(CurrentQuestionID));
});
  

//This function will get and display the next questions 
function NextQuestions(){
 
    var NextQuestionID = parseInt(CurrentQuestionID) + 1;
    var NextQuestionIndex = findIndex(NextQuestionID);    
 
    //if index found 
    if(NextQuestionIndex != -1){
        //update the CurrentQuestion
        CurrentQuestionID = NextQuestionID;
        // render the UI
        QuestionGender(NextQuestionIndex);

    }else{
        //back to the frist question
        CurrentQuestionID = QuestionList[0]['QuestionID'];
        QuestionGender(findIndex(CurrentQuestionID));
    }    
}

//This function will get the question before with the answer(if exit).
function BackQuestions(){

    var BackQuestionID = parseInt(CurrentQuestionID) - 1;
    var BackQuestionIndex = findIndex(BackQuestionID);
    
    //if index found 
    if(BackQuestionIndex != -1){
        //update the CurrentQuestion
        CurrentQuestionID = BackQuestionID;
        // render the UI
        QuestionGender(BackQuestionIndex);
    }else{
        //go to the last question
        length = QuestionList.length - 1;
        CurrentQuestionID = QuestionList[length]['QuestionID'];
        QuestionGender(findIndex(CurrentQuestionID));
    }    
}

// this will gender the question html based on data got from db
function QuestionGender(QuestionIndex){
    
    
    if(sessionStorage.getItem("QuestionList") == "Failed"){
        var document ="<p class='headers'>No connection to the DataBase, Please try again latter</p>";
        $('#question').html(document);
    }
    else{
        var IsSubQ;
        var document;

        //Set goal for the question
        if(QuestionList[QuestionIndex]['Goal'] == "DIEL")
            document = "<h3 id='S_tochange'>Diverse, Inclusive & Equitable Learning</h3>";
            else if(QuestionList[QuestionIndex]['Goal']  == "SPP")
            document = "<h3 id='S_tochange'>Sustainable practice to promote well being</h3>";
            else if(QuestionList[QuestionIndex]['Goal'] == "TTL")
            document = "<h3 id='S_tochange'>Transformational Teaching & Learning</h3>";
            else if(QuestionList[QuestionIndex]['Goal']  == "TC")
            document = "<h3 id='S_tochange'>Transformation Communities</h3>";
            else if(QuestionList[QuestionIndex]['Goal']  == "GSD")
            document = "<h3 id='S_tochange'>Guided skill development</h3>";

        //Set Question
        document += "<p id='Q_tochange'>"+QuestionList[QuestionIndex]['Question'] +"</p>";

        //Set the question form based on the question type
        //Check the question type 
        //this for the multi choice questions

        if(QuestionList[QuestionIndex]['Type'] == 'multi')
        {   
            //check if it's is contain subquestion or not 
            if(QuestionList[QuestionIndex]['SubQuestionID'] != null){
                //this use to know the Q_ID and SQ_ID when the answer is return 
                //this will be put in name of the radio button
                var Update_ID = QuestionList[QuestionIndex]['QuestionID']+"_"+QuestionList[QuestionIndex]['SubQuestionID'];     
                IsSubQ = 'yes';

                document +="<form class='MultiQForm'>";
                document +="<table class='MultiQTable>";
                document +="<tr class='RowMultiQ>";
                document +="<th></th>";
                document +="<th class='ColMultiQ'>None</th>";
                document +="<th class='ColMultiQ'>1</th>";
                document +="<th class='ColMultiQ'>2</th>";
                document +="<th class='ColMultiQ'>3</th>";
                document +="<th class='ColMultiQ'>4</th>";
                document +="<th class='ColMultiQ'>5</th>";
                document +="<th class='ColMultiQ'>6</th>";
                document +="</tr>";


                document += "<tr class='RowMultiQ'>";
                document += "<td class='gridMultiQ'>"+QuestionList[QuestionIndex]['Sub_Q']+"</td>";
                document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='0'></td>";
                document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='1'></td>";
                document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='2'></td>";
                document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='3'></td>";
                document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='4'></td>";
                document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='5'></td>";
                document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='6'></td>";
                document += "</tr>";
                
                //Gender all the subquestion by using while loops
                //if the next CurrentQuestionIndex has same QuestionID => still have more subquestions
                while(QuestionList[QuestionIndex]['QuestionID'] == QuestionList[QuestionIndex + 1]['QuestionID'] ){
                    Update_ID = QuestionList[QuestionIndex+1]['QuestionID']+"_"+QuestionList[QuestionIndex+1]['SubQuestionID'];

                    document += "<tr class='RowMultiQ'>";
                    document += "<td class='gridMultiQ'>"+QuestionList[QuestionIndex+1]['Sub_Q']+"</td>";
                    document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='0'></td>";
                    document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='1'></td>";
                    document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='2'></td>";
                    document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='3'></td>";
                    document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='4'></td>";
                    document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='5'></td>";
                    document += "<td class='gridMultiQ'><input type='radio' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='6'></td>";
                    document += "</tr>";


                    //update the CurrentQuestionIndex to check the next one
                    QuestionIndex += 1; 
                }
                document += "</table>";
                document += "<input type='text' id='userComments' placeholder='Additional comments'>";
                document += " <button class='floatleft' onclick='BackQuestions()'>Back</button>";
                document += "<button class='floatright' onclick='multiNextButton()'>Next</button>";
                document += "</form>";               
           

            }else{
                //For only one question => non sub-Question 
                var Update_ID = QuestionList[QuestionIndex]['QuestionID'];
                IsSubQ = 'no';

                document += "<form>";
                document += "<input type='radio' id='option1' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='0'>";
                document += " <label for='option1'>None</label><br>";
                document += "<input type='radio' id='option2' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='1'>";
                document += "<label for='option2'>1</label><br>"; 
                document += "<input type='radio' id='option3' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='2'>";
                document += "<label for='option3'>2</label><br>"; 
                document += "<input type='radio' id='option4' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='3'>";
                document += "<label for='option4'>3</label><br>"; 
                document += "<input type='radio' id='option5' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='4'>";
                document += "<label for='option5'>4</label><br>"; 
                document += "<input type='radio' id='option6' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='5'>";
                document += "<label for='option5'>5</label><br>"; 
                document += "<input type='radio' id='option7' name='"+Update_ID+"' onchange='multiAnswerUpdate(this);' value='6'>";
                document += "<label for='option5'>6</label><br>"; 
                document += "<input type='text' id='userComments' placeholder='Additional comments'>";
                document += " <button class='floatleft' onclick='BackQuestions()'>Back</button>";
                document += "<button class='floatright' onclick='multiNextButton()'>Next</button>";
                document += "</form>"; 
    

            }
            $('#question').html(document);
            NoteLoad();
            AnswerLoad(QuestionList[QuestionIndex]['QuestionID'],'multi',IsSubQ);


        }else{

            // for the short questions 
            //check if it's is contain subquestion or not 
            if(QuestionList[QuestionIndex]['SubQuestionID'] != null){
                var Update_ID = QuestionList[QuestionIndex]['QuestionID']+"_"+QuestionList[QuestionIndex]['SubQuestionID'];
                IsSubQ='yes';  

                document += "<form class='ShortQForm'>";
                document += "<table class='ShortQTable'>";
                document +="<tr class='RowShortQ'>";
                document +="<th class='ColShortQ'>"+ QuestionList[QuestionIndex]['Sub_Q'] +"</th>";
                document +="<td class='gridShortQ'><input type='number' id='text_answer' name='"+Update_ID+"'></td>";
                document +="</tr>";        


                //Gender all the subquestion by using while loops
                //if the next CurrentQuestionIndex has same QuestionID => still have more subquestions
                while(QuestionList[QuestionIndex]['QuestionID'] == QuestionList[QuestionIndex + 1]['QuestionID'] ){
                    Update_ID = QuestionList[QuestionIndex+1]['QuestionID']+"_"+QuestionList[QuestionIndex+1]['SubQuestionID'];


                    document +="<tr class='RowShortQ'>";
                    document +="<th class='ColShortQ'>"+ QuestionList[QuestionIndex]['Sub_Q'] +"</th>";
                    document +="<td class='gridShortQ'><input type='number' id='text_answer' name='"+Update_ID+"'></td>";
                    document += "</tr>";

                    //update the CurrentQuestionIndex to check the next one
                    QuestionIndex += 1; 
                }
                document += "</table>";
                document += "<input type='text' id='userComments' placeholder='Additional comments'>";
                document += " <button class='floatleft' onclick='BackQuestions()'>Back</button>";
                document += "<button class='floatright' onclick='shortNextButton()'>Next</button>";
                document += "</form>";

            }else{
                var Update_ID = QuestionList[QuestionIndex]['QuestionID'];
                IsSubQ='no';

                document += "<form class='ShortQForm'>";
                
                document += "<table class='ShortQTable'>";
                document +="<tr class='RowShortQ'>";
                document +="<th class='ColShortQ'>Enter Your Answer Here: </th>";
                document +="<td class='gridShortQ'><input type='number' id='text_answer' name='"+Update_ID+"'></td>";
                document +="</tr>";
                document +=" </table>";

                document += "<input type='text' id='userComments' placeholder='Additional comments'>";
                document += " <button class='floatleft' onclick='BackQuestions()'>Back</button>";
                document += "<button class='floatright' onclick='shortNextButton()'>Next</button>";
                
                document +=" </form>";
             
            }
            $('#question').html(document);
            NoteLoad();
            AnswerLoad(QuestionList[QuestionIndex]['QuestionID'],'short',IsSubQ );
        }
        
    }
}

//================ All Update Function ==================


//Update answer function for multi chocie 
function multiAnswerUpdate(src){
    var answer = src.value
    var ID = src.name
    var updateID = ID.split("_");

    //update for sub_question
    if(updateID.length > 1){
        var Q_ID = parseInt(updateID[0]);
        var SubQID = parseInt(updateID[1]);

        //send the infomation to controller for update 
        var url = 'Controller.php';
        var query = {page: 'Suvery', command: 'AnswerUpdate' , Q_ID: ''+Q_ID+'' , SubQID: ''+SubQID+'' , Answer:''+answer+'' };            
        $.post(url, query)

    }else{
        var Q_ID = parseInt(updateID[0]);

        //send the infomation to controller for update 
        var url = 'Controller.php';
        var query = {page: 'Suvery', command: 'AnswerUpdate' , Q_ID: ''+Q_ID+'' , SubQID: 0 , Answer:''+answer+'' };            
        $.post(url, query)
    }

}
   
//this function use to update the shortAnswer
function shortAnswerUpdate(){
    var textInputs = document.querySelectorAll('form input[type="number"]');
    var inputArray = [];
    for (var i = 0; i < textInputs.length; i++){

        //get all input (value , Q_ID and QSubID from its name)
        var input = textInputs[i];
        var name = input.getAttribute('name');
        var answer = input.value;
        var nameParts = name.split("_");
        var Q_ID = parseInt(nameParts[0]);
        var QSubID = parseInt(nameParts[1]);

        //send the infomation to controller for update 
        if(QSubID != null && answer != null){
            
            var url = 'Controller.php';
            var query = {page: 'Suvery', command: 'AnswerUpdate' , Q_ID: ''+Q_ID+'' , SubQID: ''+QSubID+'' , Answer:''+answer+'' };            
            $.post(url, query)

        }else if(QSubID == null && answer != null){
            
            var url = 'Controller.php';
            var query = {page: 'Suvery', command: 'AnswerUpdate' , Q_ID: ''+Q_ID+'' , SubQID: 0 , Answer:''+answer+'' };            
            $.post(url, query)
            
        }
    }   
}

//call when click next to update the note from user to db
function NoteUpdate(){

    var textbox = document.getElementById("userComments");

    // Get the value of the textbox element
    var note = textbox.value;

    if(note != null){

        var url = 'Controller.php';
        var query = {page: 'Suvery', command: 'NoteUpdate' , Q_ID: ''+CurrentQuestionID+'' , note:''+note+'' };            
        $.post(url, query)
    }
}


//================ All Load Function ==================

//load Note
function NoteLoad(){
    var url = 'Controller.php';
    var query = {page: 'Suvery', command: 'LoadNote' , Q_ID: ''+CurrentQuestionID+''};            
    $.post(url, query , function(data){
        var result = JSON.parse(data);

        if(result != null){
            var textbox = document.getElementById("userComments");

            //set the note
            textbox.defaultValue = result;
        }
    });
}

//load answer for questions 
function AnswerLoad(Q_ID ,type, IsSubQ){
    var url = 'Controller.php';
    var query = {page: 'Suvery', command: 'LoadAnswers' , Q_ID: ''+Q_ID+''};            
    $.post(url, query , function(data){

        var result = JSON.parse(data);

        if(result != "Failed"){
            
            //if check it contain sub question or not 
            if(IsSubQ == 'yes'){

                for(var i = 0; i < result.length; i++)
                {   
                    //Get data
                    var name = (result[i]['QuestionID']+"_"+ result[i]['SubQuestionID']).toString();
                    var answer = result[i]['SubAnswer'];

                    //for multi question
                    if(type == 'multi'){

                        // Retrieve the radio button group by its name
                        var radioGroup = document.getElementsByName(name);

                        radioGroup.forEach(function(radioButton) {
                        // Check if the radio button matches the desired value
                            if (radioButton.value === (answer.toString())) {
                                radioButton.checked = true;
                            }
                        });
                    }else{    
                        // Retrieve the textbox by its name
                        var textbox = document.getElementsByName(name)[0];
                        textbox.defaultValue = answer;
                    }
                }           
                
            }else{

                var name = (result[0]['QuestionID']).toString();
                var answer = result[0]['MainAnswer'];
                
                if(type == 'multi'){
                   
                    // Retrieve the radio button group by its name
                    var radioGroup = document.getElementsByName(name);

                    radioGroup.forEach(function(radioButton) {
                    // Check if the radio button matches the desired value
                        if (radioButton.value === (answer.toString())) {
                            radioButton.checked = true;
                        }
                    });
                }else{

                    // Retrieve the textbox by its name
                    var textbox = document.getElementsByName(name);
                    textbox.defaultValue = answer;
                }
            }          
        }
    });
}


//This function will connect to Controller for get the question list 
//And save it to sessionStorage
function QuestionLoad(){

    var url = 'Controller.php';
    var query = {page: 'Suvery', command: 'LoadQuestionList'};        
    
    $.post(url, query, function(data) {
        sessionStorage.setItem("QuestionList", data);   
    });
}

// load the last index that user stop working on berfore 
//return the QuestionID
function LastProgressCheck(){
    var Q_ID; 
    var url = 'Controller.php';
    var query = {page: 'Suvery', command: 'LastProgress'};        
    
    $.post(url, query, function(data) {
        sessionStorage.setItem("CurrentQuestion", data);  
    });
}

//================ Button Function ==================    

// this function use to find the index of the question
function findIndex(num) {
    let smallestIndex = Infinity;
    for (let i = 0; i < QuestionList.length; i++) {
      if (QuestionList[i]['QuestionID'] == num && i < smallestIndex) {        
        smallestIndex = i;
      }
    }
    return smallestIndex != Infinity ? smallestIndex : -1;
  }
    
function shortNextButton(){
    shortAnswerUpdate();
    NoteUpdate(); 
    NextQuestions();
}

function multiNextButton(){
    NoteUpdate(); 
    NextQuestions();
}
