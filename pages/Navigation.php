<script src="../scripts/Navigation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<nav>
    <img src="../images/LOGOS/TRU-LG02.png" alt="logo">
    <ul>
        <li><button onclick="hideShowNotifications()"><img src="../images/icons/notifications.png" alt="notifications" class="icon"></button></li>
        <li><button onclick="hideShowMessages()"><img src="../images/icons/message.png" alt="messages" class="icon"></button></li>
        <li><span id="username"><?php echo $_SESSION['userFirstName'];?></span><span id="userlastname"><?php echo $_SESSION['userLastName']; ?></span></li>
        <li><button onclick="hideShowMenu()"><img src="../images/icons/menu.png" alt="menu" class="icon"></button></li>
    </ul>
</nav>
<div class="submenu" id="sidemenu">
    <button class="closebutton" onclick="hideShowMenu()">X</button>
    <ul>
        <li onclick='mainPage()'> <p>Dashboard </p> </li>
        <li onclick='survey()'> <p>Survey</p> </li>
        <li onclick='currentReport()'> <p>Current Report</p> </li>
        <li onclick='signOut()'> <p> Log Out </p> </li>
    </ul>
</div>

<div class="textsubmenu" id="subMessages">
    <button class="closebutton" onclick="hideShowMessages()">X</button>
    <p>Messages</p>
    <div class="messagescontainer">
        <p>No messages yet</p>
    </div>
    <form action="sendMessage.php">
        <input type="text" placeholder="Send message to admin">
        <button type="submit"> Send Message</button>
    </form>

</div>

<div class="notsubmenu" id="subNotifications">
    <button class="closebutton" onclick="hideShowNotifications()">X</button>
    <p>Notifications</p>
    <div class="messagescontainer">
        <p>No notifications yet</p>
    </div>
</div>

<form method='post' action='Controller.php' id='form-main-page' style='display:none'>
    <input type='hidden' name='page' value='Navigation'>
    <input type='hidden' name='command' value='MainPage'>
</form>

<form method='post' action='Controller.php' id='form-survey' style='display:none'>
    <input type='hidden' name='page' value='Navigation'>
    <input type='hidden' name='command' value='SurveyStart'>
</form>

<form method='post' action='Controller.php' id='form-current-Report' style='display:none'>
    <input type='hidden' name='page' value='Navigation'>
    <input type='hidden' name='command' value='PresentReport'>
</form>

<form method='post' action='Controller.php' id='form-sign-out' style='display:none'>
    <input type='hidden' name='page' value='Navigation'>
    <input type='hidden' name='command' value='SignOut'>
</form>