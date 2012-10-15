<?php
session_start();
if($_GET['user'] == 'reset')
{
    session_unset();
    header('Location:/tisko/view/login.php');
}

if ((isset($_SESSION['user']) && isset($_SESSION['uid']))) {
    header('Location:/tisko/view/welcome.php');
}

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>login</title>
        <script type="text/javascript" src="/tisko/common/js/jquery.js"></script>
        <script type="text/javascript" src="/tisko/common/js/validate.js"></script>
        <script type="text/javascript" src="/tisko/common/js/jquery-ui.js"></script>
        <link type="text/css" href="/tisko/common/css/ui-darkness/jquery-ui.css" rel="stylesheet"/>

        <style type="text/css">
            td{
                padding: 5px;
                font-size:16px; line-height:1.4; color:#FFF; 
            }

            table {
                text-align: left;
                width: 600px;

            }

            div.msg {
                background-color: lightsalmon;
            }

            body{
                background-color: lightskyblue;
                font-size:12px; line-height:1.4; color:#000; 
            }


        </style>

        <script type="text/javascript">
            
            $(function() {
                $( "#date" ).datepicker({
                    numberOfMonths: 3
                });
            });
        
        </script>

    </head>
    <body>
        <image src="/tisko/common/images/gloss_wave.png"  alt="Pulpit rock" width="100%" height="5%" /> 
        <table name="main" border="0" style="margin: 50px 50px;">
            <tr><td style="height: 700px;">
                    <div id="1" >
                        <form name='login' method='post' action='/tisko/control/controller.php?act=login'>
                            <table name="login" class="login" >
                                <tr>
                                    <td>Email id</td>
                                    <td></td>
                                    <td><input type='text' name='luid' onchange="return chk(this.value,'Email id','luid');"/></td>
                                    <td> <div class="msg" id="luid" ></div></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td></td>
                                    <td><input type='password' name='lpwd' onchange="return chk(this.value,'Password','lpwd');"/></td>
                                    <td><div  class="msg" id="lpwd"></div></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type='submit' name = 'login' value='Login' onclick="return valLogin();"/></td>
                                    <td></td>
                                </tr>

                            </table>

                        </form>
                    </div>
                </td>
                <td style="width: 0.2px; background-color: white;"></td>
                <td>

                    <div id="2" >

                        <form name='reg'   method='post' action='/tisko/control/controller.php?act=register'>
                            <table name="register" class="register" >
                                <tr>
                                    <td>Name</td>
                                    <td></td>
                                    <td><input type='text' name='name' onchange="return chk(this.value,'Name','rname');"/></td>
                                    <td> <div  class="msg" id="rname" ></div></td>
                                </tr>
                                <tr>
                                    <td>Email id</td>
                                    <td></td>
                                    <td><input type='text' name='uid' onchange="return chk(this.value,'Email id','ruid');"/></td>
                                    <td> <div  class="msg" id="ruid" ></div></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td></td>
                                    <td><input type='password' name='pwd' onchange="return chk(this.value,'Password','rpwd');"/></td>
                                    <td> <div  class="msg" id="rpwd" ></div></td>
                                </tr>
                                <tr>
                                    <td>Date Of Birth (yyyy-mm-dd)</td>
                                    <td></td>
                                    <td><input type='text' id ="date" name='dob' onchange="return chk(this.value,'Date','rdate');"/></td>
                                    <td> <div  class="msg" id="rdate" ></div></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type='submit' name = 'reg' class="ui-button" value='Register' onclick="return valReg();"/></td>
                                    <td></td>
                                </tr>

                            </table>

                        </form>
                    </div></td>

            </tr></table>
        <?php
        $error = $_GET['err'];
        if ($error == 'email') {
            ?> 
            <script>
                alert("Invalid Email Id");
            </script>
            <?php
        } else if ($error == 'login') {
            ?> 
            <script>
                alert("Invalid Email id or Password");
            </script>
            <?php
        } else if ($error == 'reg') {
            ?>
            <script>
                alert("Email id already in use");
            </script>
            <?php
        } else if ($error == 'date') {
            ?>
            <script>
                alert("Enter a valid date in the format mm/dd/yyyy");
            </script>
            <?php
        }
        ?>
<image src="/tisko/common/images/gloss_wave.png"  alt="Pulpit rock" width="100%" height="5%" top/> 
    </body>
</html>
