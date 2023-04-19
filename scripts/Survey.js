var CurrentQuestionID;
var QuestionList;
var LabelList;
var QuestionNum;
var totalQuestion; 
var shortUpdateID = [];
var OneOptionID = []; 

document.addEventListener("DOMContentLoaded", function(){
    QuestionLoad(); 
});
  

//This function will get and display the next questions 
function NextQuestions(){
 
    var NextQuestionID = parseInt(CurrentQuestionID) + 1;
    var NextQuestionIndex = findIndex(NextQuestionID);    
 
    //if index found 
    if(NextQuestionIndex != -1 && QuestionNum != totalQuestion + 1){
        //update the CurrentQuestion
        CurrentQuestionID = NextQuestionID;
        // render the UI
        QuestionRender(NextQuestionIndex);               

    }else{
         //update the CurrentQuestion
         CurrentQuestionID = NextQuestionID;
         // render the UI
         QuestionRender(NextQuestionIndex);
         btnShow();
    }    
}

//This function will get the question before with the answer(if exit).
function BackQuestions(){

    var BackQuestionID = parseInt(CurrentQuestionID) - 1;
    var BackQuestionIndex = findIndex(BackQuestionID);
    
    //if index found 
    if(BackQuestionIndex != -1 && BackQuestionIndex != 0){
        //update the CurrentQuestion
        CurrentQuestionID = BackQuestionID;
        // render the UI
        QuestionRender(BackQuestionIndex);

    }else{
         //update the CurrentQuestion
         CurrentQuestionID = BackQuestionID;
         // render the UI
         QuestionRender(BackQuestionIndex);
         //Disable Button
         DisableButton('floatleft');
    }    
}

// this will gender the question html based on data got from db
function QuestionRender(QuestionIndex){    
    
    if(sessionStorage.getItem("QuestionList") == "Failed"){
        var document ="<p class='headers'>No connection to the DataBase, Please try again latter</p>";
        $('#question').html(document);
    }
    else{
        var document;
        var QNum = "Q"+ QuestionNum + ". " ; 

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

        //Answer form
        document +="<form>";
        document +=" <table id='question-table'>";

        //Set Question
        document +="<tr>";
        document += "<th colspan='2' id='QuestionField'>"+QNum+""+QuestionList[QuestionIndex]['Question']+"</th>";
        document +="</tr>";

        var QuesetionType = (QuestionList[QuestionIndex]['Type']).split("_");
        
        
        if(QuesetionType[0] == 'single'){   
            var Update_ID = QuestionList[QuestionIndex]['QuestionID'];

            if(QuesetionType[1] == 'multi' ){

                //For Multi Choice Questions
                document += "<tr class='option-sq'>";
                document += "<td class='radio-option'>";
                document += "<br>";

                //connect label and radio button
                var IdNum = 1;  
                for(let i =0 ; i < LabelList.length ; i++){

                    if(LabelList[i]['QuestionID'] == Update_ID){
                        var id = 'op' + IdNum;
                        document += "<input type='radio' id='"+id+"' name='"+Update_ID+"' onchange='multiAnswerUpdate(this ,false);' value= "+LabelList[i]['InputValue']+">";
                        document += "<label for='"+id+"'> "+LabelList[i]['InputValue']+" </label><br>"; 
                        IdNum += 1 ;
                    }
                }         
                                
                document += "</td>";
                document += "</tr>";
                document +="</table>";
               
                document += "<input type='text' id='userComments' placeholder='Additional comments'>";
                document += " <button class='floatleft' onclick='BackBtn()'>Back</button>";
                document += "<button class='floatright' id='nextBtn' onclick='multiNextButton()'>Next</button>";

                
                document +="</form>";
                document += "<button class='floatright' id='finBtn' style='display:none;' onclick='surveyFin()'>Finish</button>";


            }else{  

                //For short answer Questions                
                document +="<tr>";
                document +="<td  colspan='2' class='text-input'><input type='number' id='text_answer' name='"+Update_ID+"'></td>";
                document +="</tr>";
                document +="</table>";

                document += "<input type='text' id='userComments' placeholder='Additional comments'>";
                document += " <button class='floatleft' onclick='BackBtn()'>Back</button>";
                document += "<button class='floatright' id='nextBtn' onclick='shortNextButton()'>Next</button>";


                document +="</form>";                
                document += "<button class='floatright' id='finBtn' style='display:none;' onclick='surveyFin()'>Finish</button>";

            }

            $('#question').html(document);
            NoteLoad();
            SingleAnswerLoad(QuestionList[QuestionIndex]['QuestionID'],QuesetionType[1]);
        
        }else{
            //Gender all the subquestion by using while loops
            //if the next CurrentQuestionIndex has same QuestionID => still have more subquestions
            var multi_document = "";
            var short_document= "";
            var typeArray = [];
            var IdNum = 1;  
            var id = 0;            
            var Update_ID = QuestionList[QuestionIndex]['QuestionID']+"_"+QuestionList[QuestionIndex]['SubQuestionID'];
            var IsFrist = true;             
            
            do { 

                if(!IsFrist){       

                    //update the QuestionIndex to check the next one
                    QuestionIndex += 1;
                    Update_ID = QuestionList[QuestionIndex]['QuestionID']+"_"+QuestionList[QuestionIndex]['SubQuestionID'];

                }else{
                    IsFrist = false;                        
                }      

                typeArray.push(QuestionList[QuestionIndex]['SubType']);

                if(QuestionList[QuestionIndex]['SubType'] == 'multi'){  
                    var OptionCount = 0; 
                    
                    //For Multi Choice Questions
                    multi_document += "<tr class='option-sq'>";
                    multi_document += "<td class='subQ-Qtext' id='sub-table-header"+IdNum+"'>"+QuestionList[QuestionIndex]['Sub_Q']+"</td>";    

                    //connect label and radio button
                    for(let i =0 ; i < LabelList.length ; i++){

                        if(LabelList[i]['QuestionID'] == QuestionList[QuestionIndex]['QuestionID'] && LabelList[i]['SubQuestionID'] == QuestionList[QuestionIndex]['SubQuestionID'] ){
                            var id = 'op' + IdNum;
                            multi_document += "<td class='radio-option'><input type='radio' id='"+id+"' name='"+Update_ID+"' onchange='multiAnswerUpdate(this ,false);' value= "+LabelList[i]['InputValue']+"></td>";
                            multi_document += "<td class='label-option'><label for='"+id+"'> "+LabelList[i]['InputValue']+" </label><br></td>"; 
                            IdNum += 1 ;
                            OptionCount +=1
                        }
                    }                        
                    multi_document += "</tr>";
                    
                    if(OptionCount == 1){
                        OneOptionID.push(Update_ID);
                    }
                       
                }else {

                    //For ShortAnswer Sub-Questions
                    short_document += "<tr class='input-sq SQ'>";
                    short_document += "<td><p class='subQTexttd'>" + QuestionList[QuestionIndex]['Sub_Q'] + "</p></td>";
                    short_document += "<td class='text-input'><input class='SQinput' type='number' id='text_answer' name='" + Update_ID + "' placeholder='Type your answer here'></td>";
                    short_document += "</tr>";

                }
            }while(QuestionList[QuestionIndex]['QuestionID'] == QuestionList[QuestionIndex + 1]['QuestionID'] );

            
            multi_document += " </table>";
            multi_document += "</tr>";

            //close off the table 
            document += multi_document + short_document;
            document +="</table>";

            document += "<input type='text' id='userComments' placeholder='Additional comments'>";
            document += " <button class='floatleft' onclick='BackBtn()'>Back</button>";
            document += "<button class='floatright' id='nextBtn' onclick='shortNextButton()'>Next</button>";

            document +="</form>";         
            document += "<button class='floatright' id='finBtn' style='display:none;' onclick='surveyFin()'>Finish</button>";


            $('#question').html(document);
            NoteLoad();
            ComposedAnswerLoad(QuestionList[QuestionIndex]['QuestionID'], typeArray);
        } 
    }
}

//================ All Update Function ==================


//Update answer function for multi chocie 
function multiAnswerUpdate(src , IsUpdate){
    var answer = src.value
    var ID = src.name
    var updateID = ID.split("_");

    //update for sub_question
    if(updateID.length > 1){
        var Q_ID = parseInt(updateID[0]);
        var SubQID = parseInt(updateID[1]);

        //send the infomation to controller for update 
        var url = 'Controller.php';
        var query = {page: 'Suvery', command: 'AnswerUpdate' , Q_ID: ''+Q_ID+'' , SubQID: ''+SubQID+'' , IsUpdate: ''+IsUpdate+'' , Answer:''+answer+'' };            
        $.post(url, query)

    }else{
        var Q_ID = parseInt(updateID[0]);

        //send the infomation to controller for update 
        var url = 'Controller.php';
        var query = {page: 'Suvery', command: 'AnswerUpdate' , Q_ID: ''+Q_ID+'' , SubQID: 0 , IsUpdate: ''+IsUpdate+'' , Answer:''+answer+'' };            
        $.post(url, query)
    }
    //update the radio function in case if change the answer
    if(IsUpdate !=  'true'){

        var radioGroup = document.getElementsByName(ID);

        radioGroup.forEach(function(radioButton) {
            radioButton.onchange = function() {
              multiAnswerUpdate(this , 'true');
            };
        });
    }

}
   
//this function use to update the shortAnswer
function shortAnswerUpdate(){
    var textInputs = document.querySelectorAll('form input[type="number"]');

    if(textInputs != ""){
        var inputArray = [];
        for (var i = 0; i < textInputs.length; i++){

            //get all input (value , Q_ID and QSubID from its name)
            var input = textInputs[i];
            var name = input.getAttribute('name');
            var answer = input.value;
            var nameParts = name.split("_");
            var Q_ID = nameParts[0];
            var QSubID = nameParts[1];
            var IsUpdate;
            
            var foundMatch = false;

            if (shortUpdateID.length > 0) {
                // Check for update or insert to db
                for (var j = 0; j < shortUpdateID.length; j++) {
                    if (shortUpdateID[j] == name) {
                        foundMatch = true;
                        break;
                    }
                }

                IsUpdate = foundMatch ? 'true' : 'false';
            } else {
                IsUpdate = 'false';
            }
                
            //send the infomation to controller for update 
            if(QSubID != null && answer != null){
                var url = 'Controller.php';
                var query = {page: 'Suvery', command: 'AnswerUpdate' , Q_ID: ''+parseInt(Q_ID)+'' , SubQID: ''+parseInt(QSubID)+'' , IsUpdate: ''+IsUpdate+'' , Answer:''+answer+'' };            
                $.post(url, query)

            }else if(QSubID == null && answer != null){
                var url = 'Controller.php';
                var query = {page: 'Suvery', command: 'AnswerUpdate' , Q_ID: ''+parseInt(Q_ID)+'' , SubQID: 0 , IsUpdate: ''+IsUpdate+'' , Answer:''+answer+'' };            
                $.post(url, query)                
            }            
        }
    }   
}

//call when click next to update the note from user to db
// NoteIsUpdate is use to check should use Update or Insert in db( true if LoadNote can load the note)
var NoteIsUpdate;

function NoteUpdate(IsUpdateNote){

    var textbox = document.getElementById("userComments");

    // Get the value of the textbox element
    var note = textbox.value;

    if(note != ""){

        var url = 'Controller.php';
        var query = {page: 'Suvery', command: 'NoteUpdate' , Q_ID: ''+CurrentQuestionID+'' , IsUpdateNote: ''+IsUpdateNote+'' , note:''+note+'' };            
        $.post(url, query)

    }
}

//This function only call if question is multi and only one option + without exit in database yet 
function OneOptionQ(){

    //this will go to all the ID in array to Insert Into db with answer 0 
    for(var i= 0 ; i < OneOptionID.length ; i++){

        var ID = OneOptionID[i];
        var updateID = ID.split("_");

        //update for sub_question      
        var Q_ID = parseInt(updateID[0]);
        var SubQID = parseInt(updateID[1]);

        //send the infomation to controller for update 
        var url = 'Controller.php';
        var query = {page: 'Suvery', command: 'AnswerUpdate' , Q_ID: ''+Q_ID+'' , SubQID: ''+SubQID+'' , IsUpdate: 'false' , Answer: 0 };            
        $.post(url, query)

        var radioGroup = document.getElementsByName(ID);

        radioGroup.forEach(function(radioButton) {
            radioButton.onchange = function() {
              multiAnswerUpdate(this , 'true');
            };
        });
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
            //set IsUpdate = true for note
            NoteIsUpdate = 'true';
            //set the note
            textbox.defaultValue = result;            
        }else{
            NoteIsUpdate = 'false';
        }
    });
}

//load answer for Single questions 
function SingleAnswerLoad(Q_ID ,type){
    var url = 'Controller.php';
    var query = {page: 'Suvery', command: 'LoadAnswers' , Q_ID: ''+Q_ID+'' , Q_Type: 'single'};           
    
 
    $.post(url, query , function(data){
        var result = JSON.parse(data);

        if(result != "Failed"){
            var name = (result[0]['QuestionID']).toString();
            var answer = result[0]['MainAnswer'];
            
            if(type == 'multi'){
                
                // Retrieve the radio button group by its name
                var radioGroup = document.getElementsByName(name);

                radioGroup.forEach(function(radioButton) {
                    radioButton.onchange = function() {
                      multiAnswerUpdate(this , 'true');
                    };

                    // Check if the radio button matches the desired value
                    if (radioButton.value === (answer.toString())) {
                      radioButton.checked = true;
                  }
                });
            }else{
                // Retrieve the textbox by its name
                var textbox = document.getElementsByName(name)[0];
                textbox.defaultValue = answer;
                shortUpdateID.push(name);
            }                      
        }
    });
}

//load answer for composed questions 
function ComposedAnswerLoad(Q_ID ,typeArray){
    var url = 'Controller.php';
    var query = {page: 'Suvery', command: 'LoadAnswers' , Q_ID: ''+Q_ID+'' , Q_Type: 'composed'};            
    $.post(url, query , function(data){

        var result = JSON.parse(data);

        if(result != "Failed"){
            var radioGroup ;

            for(var i = 0; i < result.length; i++)
            {   
                //Get data
                var name = (result[i]['QuestionID']+"_"+ result[i]['SubQuestionID']).toString();
                var answer = result[i]['SubAnswer'];
    
                //for multi question
                if(typeArray[i] == 'multi'){
        
                    // Retrieve the radio button group by its name
                    var radioGroup = document.getElementsByName(name);
                    
                    radioGroup.forEach(function(radioButton) {
                      radioButton.onchange = function() {
                        multiAnswerUpdate(this , 'true');
                      };

                      // Check if the radio button matches the desired value
                      if (radioButton.value === (answer.toString())) {
                        radioButton.checked = true;
                    }
                    });
                        
                }else{    
                    // Retrieve the textbox by its name
                    var textbox = document.getElementsByName(name)[0];
                    shortUpdateID.push(name);
                    textbox.defaultValue = answer;        
                }          
            }                      
        }else{
            if(OneOptionID.length > 0){

                for(var j= 0 ; j < OneOptionID.length ; j++){
                   
                    var ID = OneOptionID[j];
                    var radioGroup = document.getElementsByName(ID);
            
                    radioGroup.forEach(function(radioButton) {
                        radioButton.onchange = function() {
                          OneOptionQ();  
                          multiAnswerUpdate(this , 'true');
                        };
                    });
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
        LabelLoad();
    });
}

//Load the Label for the Multi choice Questions 
function LabelLoad(){

    var url = 'Controller.php';
    var query = {page: 'Suvery', command: 'LoadLabelList'};        

    $.post(url, query, function(data) {
        sessionStorage.setItem("LabelList", data);   
        LastProgressCheck();
    });    
}

// load the last index that user stop working on berfore 
//return the QuestionID
function LastProgressCheck(){
    var url = 'Controller.php';
    var query = {page: 'Suvery', command: 'LastProgress'};        
    
    $.post(url, query, function(data) {
        sessionStorage.setItem("CurrentQuestion", data);  
        fristUpdate();
    });
}


function fristUpdate(){

    QuestionList = JSON.parse(sessionStorage.getItem("QuestionList"));
    LabelList = JSON.parse(sessionStorage.getItem("LabelList"));
    var endIndex = QuestionList.length - 1;

    // 0 is mean this is the first time user open the survey
    if(JSON.parse(sessionStorage.getItem("CurrentQuestion")) == 0){
        CurrentQuestionID = QuestionList[0]["QuestionID"];
    }else{
        CurrentQuestionID = JSON.parse(sessionStorage.getItem("CurrentQuestion"));
    }

    QuestionNumber(CurrentQuestionID);
    updateProgressBar(QuestionNum);
    QuestionRender(findIndex(CurrentQuestionID));  
    if(QuestionList[endIndex]['QuestionID'] == CurrentQuestionID){
        btnShow();
    }else if(CurrentQuestionID == QuestionList[0]['QuestionID']){
        DisableButton('floatleft');
    }
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
    QuestionNum += 1;
    updateProgressBar(QuestionNum);
    shortAnswerUpdate();
    NoteUpdate(NoteIsUpdate); 
    NextQuestions(); 
    shortUpdateID.length = 0 ; 
    OneOptionID.length = 0 ;
}

function multiNextButton(){
    QuestionNum += 1;
    updateProgressBar(QuestionNum);
    NoteUpdate(NoteIsUpdate); 
    NextQuestions();
    shortUpdateID.length = 0 ; 
    OneOptionID.length = 0 ;
}

function BackBtn(){
    QuestionNum -= 1;
    updateProgressBar(QuestionNum);
    NoteUpdate(NoteIsUpdate); 
    shortAnswerUpdate();
    BackQuestions();
    shortUpdateID.length = 0 ; 
    OneOptionID.length = 0 ;
}

//for disable the button 
function DisableButton(btnClass) {
    var buttons = document.getElementsByClassName(btnClass);
    buttons[0].disabled = true;
}

function updateProgressBar(progress) {    
    const fill = document.querySelector(".fill");
    const percentage = Math.max(0, Math.min(100, ((progress -1) / totalQuestion) * 100));
    fill.style.width = `${percentage}%`;
}

function QuestionNumber(QuestionID){
    var endIndex = QuestionList.length - 1; 
    totalQuestion =  QuestionList[endIndex]['QuestionID'] - QuestionList[0]['QuestionID'] ;
    QuestionNum = (QuestionID - QuestionList[0]['QuestionID']) + 1;
}

function btnShow(){

    var Nextbtn = document.getElementById("nextBtn");
    var Finbtn = document.getElementById("finBtn");
    
    Nextbtn.style.display = "none";
    Finbtn.style.display = "block";      
}

//go to user review btn
function surveyFin(){
    shortAnswerUpdate();
    $('#SurveyFinSubmit').submit();
}







