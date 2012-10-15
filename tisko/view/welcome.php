<?php
session_start();
include_once "../common/common.php";
include_once "../common/sqls.php";

if (!isset($_SESSION['user'])) {
    header('Location:login.php');
} else {
    $user = $_SESSION['user'];
    $result = executeQuery(getUser($user));

    while ($row = mysql_fetch_array($result)) {
        $uid = $row['seq'];
    }

    if (isset($uid))
        $_SESSION['uid'] = $uid;
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Welcome</title>

        <script type="text/javascript" src="/tisko/common/js/jquery.js"></script>
        <script type="text/javascript" src="/tisko/common/js/validate.js"></script>
        <script type="text/javascript" src="/tisko/common/js/jquery-1.6.2.js"></script>
        <script type="text/javascript" src="/tisko/common/js/jquery-ui.js"></script>
        <script src="/tisko/common/ui/jquery.ui.core.js"></script>
        <script src="/tisko/common/ui/jquery.ui.widget.js"></script>
        <script src="/tisko/common/ui/jquery.ui.tabs.js"></script>
        <link type="text/css" href="/tisko/common/css/ui-darkness/jquery-ui.css" rel="stylesheet"/>

        <style type="text/css">
            a:hover {cursor:pointer; } 
            td, th, caption {
                padding: 5px;
                font-size:16px; line-height:1.4; color:#fff; 
            }
            a,form,option{
                font-size:16px; line-height:1.4; color:#000;
            }

            table {
                text-align: left;
                width: 600px;
                border-collapse:separate;
                empty-cells:show;
            }

        </style>

        <script type="text/javascript"> 
                            
            $(document).ready(function() {
                
                $( "#tabs" ).tabs({
                    ajaxOptions: {
                        error: function( xhr, status, index, anchor ) {
                            $( anchor.hash ).html(
                            "Couldn't load this tab. We'll try to fix this as soon as possible." );
                        }
                    }
                }); 
            });       
        </script>

    </head>
    <body> 
        <div id="tabs" style="float: left; width: 100%; height: 100%; background-color: lightskyblue; overflow: scroll;">
            <ul>
                <li><a href="ajax/cont.php">Contacts</a></li>
                <li><a href="ajax/addCont.php">Add Contact</a></li>
                <li><a href="ajax/mngGrp.php">Manage Group's</a></li>
                <li><a href="mail.php">Send Mail</a></li>
                <li><a href="ajax/profile.php">My Profile</a></li>
                <li><a href="login.php?user=reset">Logout</a></li> 
            </ul> 
        </div>

    </body>
</html>