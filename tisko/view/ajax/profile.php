<?php
session_start();
include_once "../../common/common.php";
include_once "../../common/sqls.php";


if (!(isset($_SESSION['user']) && isset($_SESSION['uid']))) {
    header('Location:/tisko/view/login.php');
}

$user = $_SESSION['user'];
$uid = $_SESSION['uid'];

$result = executeQuery(getUser($user));

if (!$row = mysql_fetch_array($result)) {
    header('Location:/tisko/view/welcome.php');
} else {

    echo "<div id='myProfile' style='margin: 5% 5%'>

                        <form name='profile'   method='post' action='/tisko/control/controller.php?act=editProfile'>
                            <table name='profile' class='register' >
                            <caption>User Details</caption>
                                <tr>
                                    <td>Name</td>
                                    <td><input type='text' disabled='true' value='" . $row['name'] . "' /></td>
                                    <td><input type='text' name='name' /></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Email id</td>
                                    <td><input type='text' disabled='true' value='" . $row['uid'] . "' /></td>
                                    <td><input type='text' name='uid' onchange='return chkProfile(this.value,\"Email id\",\"puid\");'/></td>
                                    <td> <div  class='msg' id='puid' ></div></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>Old password<br><input type='password' name='oldPwd' id='oldPwd' onchange='return chkOldPwd(this.value);'/></td>
                                    <td id='pwd'>new password<br><input type='password' name='npwd' onchange='return chkProfile(this.value,\"Password\",\"ppwd\");'/><br>
                                    re-enter password<br><input type='password' name='repwd' onchange='return chkProfile(this.value,\"Password\",\"ppwd\");'/></td>
                                    <td> <div  class='msg' id='ppwd' ></div></td>
                                </tr>
                                <tr>
                                    <td>Date Of Birth (yyyy-mm-dd)</td>
                                    <td><input type='text' disabled='true' value='" . $row['dob'] . "' /></td>
                                    <td><input type='text' id ='profileDate' name='dob' onchange='return chkProfile(this.value,\"Date\",\"pdate\");'/></td>
                                    <td> <div  class='msg' id='pdate' ></div></td>
                                </tr>
                                <tr>
                                    <td colspan = '4'><center><input type='submit' name = 'reg' class='ui-button' value='Edit/Back' onclick='return valProfile();'/></center></td>
                                </tr>

                            </table>

                        </form>
                    </div>";
}
?>

<script> $( "#profileDate" ).datepicker({  });  $("#pwd").hide(1);</script>
