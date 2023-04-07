<script src="../scripts/Navigation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<nav>
    <img src="../images/LOGOS/TRU-LG02.png" alt="logo">
    <ul>
        <li><span id="username"><?php echo $_SESSION['userFirstName'];?></span> <span id="userlastname"><?php echo $_SESSION['userLastName']; ?></span></li>
        <li><button onclick="hideShowMenu()"><img src="../images/icons/menu.png" alt="menu" class="icon"></button></li>
        <li style="display:none;"><span id="userposition"><?php echo $_SESSION['userPosition'];?></span></li>
    </ul>
</nav>
<div class="submenu" id="sidemenu">
    <button class="closebutton" onclick="hideShowMenu()">X</button>
    <ul id="submenulist">
        <li onclick='mainPage()'> <p>Dashboard </p> </li>
        <li onclick='survey()'> <p>Survey</p> </li>
        <li onclick='currentReport()'> <p>Current Report</p> </li>
        <li onclick='signOut()' id="signout-btn"> <p> Log Out </p> </li>
    </ul>
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

<form method='post' action='Controller.php' id='form-user-management' style='display:none'>
    <input type='hidden' name='page' value='Navigation'>
    <input type='hidden' name='command' value='UploadCsv'>
</form>

<form method='post' action='Controller.php' id='form-sign-out' style='display:none'>
    <input type='hidden' name='page' value='Navigation'>
    <input type='hidden' name='command' value='SignOut'>
</form>