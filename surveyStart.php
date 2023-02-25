<html>

<head>
    <title>Survey Page</title>
    <link rel="shortcut icon" href="https://moodle.tru.ca/theme/image.php/tru/theme/1674135438/favicon">
    <link rel="stylesheet" href="https://use.typekit.net/uxw2ihw.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="https://moodle.tru.ca/theme/yui_combo.php?rollup/3.17.2/yui-moodlesimple-min.css"><script type="text/javascript" async="" src="https://ssl.google-analytics.com/ga.js"></script><script charset="utf-8" id="yui_3_17_2_1_1677191489584_8" src="https://moodle.tru.ca/theme/yui_combo.php?m/1674135438/core/event/event-min.js&amp;m/1674135438/filter_mathjaxloader/loader/loader-min.js" async=""></script><link charset="utf-8" rel="stylesheet" id="yui_3_17_2_1_1677191489584_19" href="https://moodle.tru.ca/theme/yui_combo.php?3.17.2/cssbutton/cssbutton-min.css"><script charset="utf-8" id="yui_3_17_2_1_1677191489584_20" src="https://moodle.tru.ca/theme/yui_combo.php?m/1674135438/core/widget/widget-focusafterclose-min.js&amp;3.17.2/plugin/plugin-min.js&amp;m/1674135438/core/lockscroll/lockscroll-min.js&amp;m/1674135438/core/notification/notification-dialogue-min.js&amp;m/1674135438/core/notification/notification-alert-min.js&amp;m/1674135438/core/notification/notification-exception-min.js&amp;m/1674135438/core/notification/notification-ajaxexception-min.js&amp;m/1674135438/filter_glossary/autolinker/autolinker-min.js" async=""></script><script charset="utf-8" id="yui_3_17_2_1_1677191489584_29" src="https://moodle.tru.ca/theme/yui_combo.php?3.17.2/event-mousewheel/event-mousewheel-min.js&amp;3.17.2/event-resize/event-resize-min.js&amp;3.17.2/event-hover/event-hover-min.js&amp;3.17.2/event-touch/event-touch-min.js&amp;3.17.2/event-move/event-move-min.js&amp;3.17.2/event-flick/event-flick-min.js&amp;3.17.2/event-valuechange/event-valuechange-min.js&amp;3.17.2/event-tap/event-tap-min.js" async=""></script><script id="firstthemesheet" type="text/css">/** Required in order to fix style inclusion problems in IE with YUI **/</script><link rel="stylesheet" type="text/css" href="https://moodle.tru.ca/theme/styles.php/tru/1674135438_1660049672/all">
    <link rel="stylesheet" href="surveyStart.css">
    

    <!-- Google font download code -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://www.tru.ca/distance/bbstyles/ol_css/ol_course-moodle.css" type="text/css" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


    <script>
        $(document).ready(function(){
            $("#action-menu-toggle-1").click(function(){
                $("#action-menu-1-menu").toggleClass('dropdown-menu dropdown-menu-right menu align-tr-br show');
                $("#action-menu-1-menu").toggleClass('dropdown-menu dropdown-menu-right menu align-tr-br ');
        });   
    });
    </script>
  

</head>






<body id="page-mod-quiz-view" class="format-weeks  path-mod path-mod-quiz chrome dir-ltr lang-en yui-skin-sam yui3-skin-sam moodle-tru-ca pagelayout-incourse course-41780 context-2763253 cmid-2074726 category-256  jsenabled">    

    <div id="page-wrapper" class="d-print-block">
    
      
    
        <nav class="fixed-top navbar navbar-expand moodle-has-zindex" aria-label="Site navigation" id="yui_3_17_2_1_1677196329644_35">
                   
        
            <a href="https://moodle.tru.ca" class="navbar-brand aabtn has-logo">
                    <span class="logo d-none d-sm-inline">
                        <img src="https://moodle.tru.ca/pluginfile.php/1/core_admin/logocompact/300x300/1674135438/TRU_Logo_Left_moodle.png" alt="TRU Moodle">
                    </span>
                <span class="site-name d-none d-md-inline">TRU Suvery</span>
            </a>
        
                
            <ul class="nav navbar-nav ml-auto" id="yui_3_17_2_1_1677196329644_43">
                    
                <!-- navbar_plugin_output -->
                <li class="nav-item" id="yui_3_17_2_1_1677196329644_49">
                    <div class="popover-region popover-region-notifications collapsed" id="nav-notification-popover-container" data-userid="126626" data-region="popover-region">
                        <div class="popover-region-toggle nav-link" data-region="popover-region-toggle" role="button" aria-controls="popover-region-container-63f7fc2b1a01e63f7fc2b181355" aria-haspopup="true" aria-label="Show notification window with no new notifications" tabindex="0" id="yui_3_17_2_1_1677196329644_48">
                            <i class="icon fa fa-bell fa-fw " title="Toggle notifications menu" aria-label="Toggle notifications menu"></i>
                            <div class="count-container hidden" data-region="count-container" aria-label="There are 0 unread notifications">0</div>
                        </div>

                        <div id="popover-region-container-63f7fc2b1a01e63f7fc2b181355" class="popover-region-container" data-region="popover-region-container" aria-expanded="false" aria-hidden="true" aria-label="Notification window" role="region">
                            <div class="popover-region-header-container">
                                <h3 class="popover-region-header-text" data-region="popover-region-header-text">Notifications</h3>
                                <div class="popover-region-header-actions" data-region="popover-region-header-actions">       
                                    <a class="mark-all-read-button" href="#" title="Mark all as read" data-action="mark-all-read" role="button" aria-label="Mark all as read">
                                        <span class="normal-icon"><i class="icon fa fa-check fa-fw " aria-hidden="true"></i></span>
                                        <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw " title="Loading" aria-label="Loading"></i></span>
                                    </a>

                                    <a href="https://moodle.tru.ca/message/notificationpreferences.php?userid=126626" title="Notification preferences" aria-label="Notification preferences">
                                        <i class="icon fa fa-cog fa-fw " aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                                
                            <div class="popover-region-content-container" data-region="popover-region-content-container" aria-busy="false">
                                <div class="popover-region-content" data-region="popover-region-content">
                                    <div class="all-notifications" data-region="all-notifications" role="log" aria-busy="false" aria-atomic="false" aria-relevant="additions"></div>
                                    <div class="empty-message" tabindex="0" data-region="empty-message">You have no notifications</div>
                                </div>
                                <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw " title="Loading" aria-label="Loading"></i></span>
                            </div>
                        </div>
                    </div>
                </li>

                    <!-- user_menu -->
                <li class="nav-item d-flex align-items-center" id="yui_3_17_2_1_1677196329644_42">
                    <div class="usermenu" id="yui_3_17_2_1_1677196329644_41"><div class="action-menu moodle-actionmenu nowrap-items d-inline" id="action-menu-1" data-enhance="moodle-core-actionmenu">
                        <div class="menubar d-flex " id="action-menu-1-menubar" role="menubar">
                            <div class="action-menu-trigger" id="yui_3_17_2_1_1677196329644_40">
                                <div class="dropdown" id="yui_3_17_2_1_1677196329644_39">
                                    <a href="#" tabindex="0" class="d-inline-block  dropdown-toggle icon-no-margin" id="action-menu-toggle-1" aria-label="User menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" aria-controls="action-menu-1-menu">
                                        <span class="userbutton">
                                            <span class="usertext mr-1">Duy Nguyen</span><span class="avatars">
                                            <span class="avatar current"><img src="https://secure.gravatar.com/avatar/3ad0594f62149af6535732d234b396d2?s=35&amp;d=mm" class="userpicture defaultuserpic" width="35" height="35" alt="">
                                        </span></span></span>
                                        <b class="caret"></b>
                                    </a>
                                        
                                    <div class="dropdown-menu dropdown-menu-right menu align-tr-br" id="action-menu-1-menu" data-rel="menu-content" aria-labelledby="action-menu-toggle-1" role="menu" data-align="tr-br">
                                        <div class="dropdown-divider" role="presentation"><span class="filler">&nbsp;</span></div>                                       
                                        <a href="https://moodle.tru.ca/my/" class="dropdown-item menu-action" role="menuitem" data-title="mymoodle,admin" aria-labelledby="actionmenuaction-1">
                                            <i class="icon fa fa-tachometer fa-fw " aria-hidden="true"></i>
                                            <span class="menu-action-text" id="actionmenuaction-1">Dashboard</span>
                                        </a>

                                        <div class="dropdown-divider" role="presentation"><span class="filler">&nbsp;</span></div>
                                        <a href="https://moodle.tru.ca/user/profile.php?id=126626" class="dropdown-item menu-action" role="menuitem" data-title="profile,moodle" aria-labelledby="actionmenuaction-2">
                                            <i class="icon fa fa-user fa-fw " aria-hidden="true"></i>
                                            <span class="menu-action-text" id="actionmenuaction-2">Profile</span>
                                        </a>                                                                    
                                          
                                        <div class="dropdown-divider" role="presentation"><span class="filler">&nbsp;</span></div>
                                        <a href="https://moodle.tru.ca/user/preferences.php" class="dropdown-item menu-action" role="menuitem" data-title="preferences,moodle" aria-labelledby="actionmenuaction-5">
                                            <i class="icon fa fa-wrench fa-fw " aria-hidden="true"></i>
                                            <span class="menu-action-text" id="actionmenuaction-5">Preferences</span>
                                        </a>
                                           
                                        <div class="dropdown-divider" role="presentation"><span class="filler">&nbsp;</span></div>
                                        <a href="https://moodle.tru.ca/login/logout.php?sesskey=v6SRmevKcJ" class="dropdown-item menu-action" role="menuitem" data-title="logout,moodle" aria-labelledby="actionmenuaction-6">
                                            <i class="icon fa fa-sign-out fa-fw " aria-hidden="true"></i>
                                            <span class="menu-action-text" id="actionmenuaction-6">Log out</span>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>  
                </li>
            </ul>
        </nav>
        
        <div id="page" class="container-fluid d-print-block">
        <div id="page-content" class="row pb-3 d-print-block" style="padding-top: 0px; padding-bottom: 0px;">
                    <div id="region-main-box" class="col-12">
                        <section id="region-main" aria-label="Content">
                            <div role="main">
                                <h1>Science Strategic Plan 2023 - Survey</h1>
                                <hr>
                            
                                <div class="box py-3 quizinfo" style="margin-top: 20px;margin-bottom: 20px;">
                                    <p>Thanks for your participation, the only time constraint for this survey is the due date,otherwise you can answer the questions 
                                    <br>at any moment, all your progress will be automatically saved and you can come back to it at any time you like.
                                    </p>

                                    <p>The survey is designed to take a total of 10 minutes.</p>
                                    <p>Due date: Friday, 03 Februrary 2023</p>
                                </div>

                                <table class="generaltable quizattemptsummary">
                                    <thead>
                                        <tr>
                                        <th class="header c0" style="text-align:left;" scope="col">State</th>
                                        <th class="header c1 lastcol" style="text-align:center;" scope="col">Progress</th>
                                        </tr>
                                    </thead>

                                    <tbody><tr class="lastrow">
                                        <td class="cell c0" style="text-align:left;">Finished<span class="statedetails">Submitted Thursday, 9 February 2023, 3:12 PM</span></td>
                                        <td class="cell c1 lastcol" style="text-align:center;"><span class="noreviewmessage">Not permitted</span></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="box py-3 quizattempt">
                                    <br>
                            
                                    <div class="continuebutton">
                                        <form method="get" action="https://moodle.tru.ca/course/view.php" id="yui_3_17_2_1_1677180135137_44">
                                            <input type="hidden" name="id" value="41780">
                                            <button type="submit" class="btn btn-secondary" id="single_button63f7bce899b8c17" title="">Begin Questionarie</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>   
        </div>
    </div>
</body>
</html>