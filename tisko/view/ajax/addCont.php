<?php

session_start();
include_once "../../common/common.php";
include_once "../../common/sqls.php";


if (!(isset($_SESSION['user']) && isset($_SESSION['uid']))) {
    header('Location:/tisko/view/login.php');
}

$user = $_SESSION['user'];
$uid = $_SESSION['uid'];


 echo "<br><br><br><br><form name='addCont'   method='post' action='/tisko/control/controller.php?act=addCont'>
                            <table name='addCont' >
                                <tr>
                                    <td>Name</td>
                                    <td></td>
                                    <td><input type='text' name='name' onchange='return chk(this.value,\"Name\",\"aname\");'/></td>
                                    <td> <div  class='msg' id='aname' ></div></td>
                                </tr>
                                <tr>
                                    <td>Contact</td>
                                    <td></td>
                                    <td><input type='text' name='cont' onchange='return chkNum(this.value,\"Contact\",\"acont\");'/></td>
                                    <td> <div  class='msg' id='acont' ></div></td>
                                </tr>
                                <tr>
                                    <td>Email id</td>
                                    <td></td>
                                    <td><input type='text' name='uid' onchange='return valCont(\"email\"); '/></td>
                                    <td> <div  class='msg' id='auid' ></div></td>
                                </tr>
                                <tr>
                                    <td>Company</td>
                                    <td></td>
                                    <td><input type='text' name='compny'/></td>
                                    <td> <div  class='msg' id='acomp' ></div></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td></td>
                                    <td><input type='text'  name = 'addr'/></td>
                                    <td> <div  class='msg' id='addr' ></div></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type='submit' name = 'addCont' value='Add Contact' onclick='return valCont(\"\");'/></td>
                                    <td></td>
                                </tr>
                            </table>
                        </form>";
?>
