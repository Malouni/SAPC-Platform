function hideShowMenu() {
    // Get the sidemenu, userposition, and submenulist elements
    var subMenu = document.getElementById("sidemenu");
    var userPoselem = document.getElementById("userposition");
    var menulist = document.getElementById('submenulist');
    
    // Get an array of all the li elements in the submenulist
    var liList = menulist.getElementsByTagName("li");

    // If the sidemenu is currently displayed, hide it; otherwise, show it
    if (subMenu.style.display == "block") {
        subMenu.style.display = "none";
    }
    else {
        subMenu.style.display = "block";

        // Check if the "Admin Options" li element already exists in the submenulist
        var adminOptionExists = false;
        for (var i = 0; i < liList.length; i++) {
            var p = liList[i].getElementsByTagName("p")[0];
            if (p.textContent == "Admin Options") {
                adminOptionExists = true;
                break;
            }
        }

        // If the user has admin position and the "Admin Options" li element does not exist, create it and add it to the submenulist
        if (userPoselem.innerText == 'admin' && !adminOptionExists) {
            var li = document.createElement('li');
            li.setAttribute('onclick', 'userManagement()');
            var p = document.createElement('p');
            p.textContent = 'Admin Options';
            li.appendChild(p);
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

function currentReport() {
    $('#form-current-Report').submit();
}

function userManagement() {
    $('#form-user-management').submit();
}

function signOut() {
    $('#form-sign-out').submit();
}