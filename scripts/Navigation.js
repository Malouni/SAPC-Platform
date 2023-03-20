function hideShowMenu() {
    var subMenu = document.getElementById("sidemenu");
    if(subMenu.style.display == "block"){
        subMenu.style.display = "none";
    }
    else{
        subMenu.style.display = "block";
    }
}

function hideShowMessages() {
    var subMessages = document.getElementById("subMessages");
    if(subMessages.style.display == "block"){
        subMessages.style.display = "none";
    }
    else{
        subMessages.style.display = "block";
    }
}

function hideShowNotifications() {
    var subMessages = document.getElementById("subNotifications");
    if(subMessages.style.display == "block"){
        subMessages.style.display = "none";
    }
    else{
        subMessages.style.display = "block";
    }
}

function showorderdocs(){
    var subDocs= document.getElementById("orderbydocs");
    if(subDocs.style.display == "block"){
        subDocs.style.display = "none";
    }
    else{
        subDocs.style.display = "block";
    }
}

function showordertime(){
    var subTime= document.getElementById("orderbytime");
    if(subTime.style.display == "block"){
        subTime.style.display = "none";
    }
    else{
        subTime.style.display = "block";
    }
}

function mainPage() {
    $('#form-main-page').submit();
}

function survey() {
    $('#form-survey').submit();
}

function currentReport() {
    $('#form-current-Report').submit();
}

function signOut() {
    $('#form-sign-out').submit();
}