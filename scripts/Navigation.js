function hideShowMenu() {
    var subMenu = document.getElementById("sidemenu");
    var userPoselem = document.getElementById("userposition");
    var menulist = document.getElementById('submenulist');
    if (subMenu.style.display == "block") {
        subMenu.style.display = "none";
    }
    else {
        subMenu.style.display = "block";
        if (userPoselem.innerText == 'admin') {              /* this part creates the menu item 'Admin Options' if the user has admin position */
            // Create a new li element
            var li = document.createElement('li');

            // Set the onclick event to userManagement function
            li.setAttribute('onclick', 'userManagement()');

            // Create a new p element
            var p = document.createElement('p');

            // Set the text content of the p element to 'Admin Options'
            p.textContent = 'Admin Options';

            // Append the p element to the li element
            li.appendChild(p);

            // Append the li element to the submenulist element
            menulist.appendChild(li);
        }
    }

}

function hideShowMessages() {
    var subMessages = document.getElementById("subMessages");
    if (subMessages.style.display == "block") {
        subMessages.style.display = "none";
    }
    else {
        subMessages.style.display = "block";
    }
}

function hideShowNotifications() {
    var subMessages = document.getElementById("subNotifications");
    if (subMessages.style.display == "block") {
        subMessages.style.display = "none";
    }
    else {
        subMessages.style.display = "block";
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

function userManagement() {
    $('#form-user-management').submit();
}

function signOut() {
    $('#form-sign-out').submit();
}