<?php

session_start();
include_once "../../common/common.php";
include_once "../../common/sqls.php";
$user = $_SESSION['user'];
$uid = $_SESSION['uid'];

$val = $_GET['val'];
$action = $_GET['act'];

if (isset($uid) && isset($val) && isset($action)) {
    if ($action == 'del') {
        if (executeQuery(getDelContSql($val))) {
            include('cont.php');
        }
    } else if ($action == 'edit') {

        $result = executeQuery(getContDtlSql($val));

        if (!$row = mysql_fetch_array($result)) {
            header('Location:/tisko/view/welcome.php');
        } else {

            echo "<br><br><br><br><form name='addCont'   method='post' action='/tisko/control/controller.php?act=editCont&seq=$val'>
                            <table name='addCont' >
                                <tr>
                                    <td>Name</td>
                                    <td></td>
                                    <td><input type='text' name='name' onchange='return chk(this.value,\"Name\",\"aname\");' value='" . $row['name'] . "'/>
                                    <td> <div  class='msg' id='aname' ></div></td>
                                </tr>
                                <tr>
                                    <td>Contact</td>
                                    <td></td>
                                    <td><input type='text' name='cont' onchange='return chkNum(this.value,\"Contact\",\"acont\");' value='" . $row['cont'] . "'/>
                                    <td> <div  class='msg' id='acont' ></div></td>
                                </tr>
                                <tr>
                                    <td>Email id</td>
                                    <td></td>
                                    <td><input type='text' name='uid' value='" . $row['email'] . "'/>
                                    <td> <div  class='msg' id='auid' ></div></td>
                                </tr>
                                <tr>
                                    <td>Company</td>
                                    <td></td>
                                    <td><input type='text' name='compny' value='" . $row['compny'] . "'/>
                                    <td> <div  class='msg' id='acomp' ></div></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td></td>
                                    <td><input type='text'  name = 'addr' value='" . $row['addr'] . "'/>
                                    <td> <div  class='msg' id='addr' ></div></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type='submit' name = 'addCont' value='Edit/Back' onclick='return valCont();'/></td>
                                    <td></td>
                                </tr>
                            </table>
                        </form>";
        }
    } else {
        header('Location:/tisko/view/login.php');
    }
} else {
    header('Location:/tisko/view/login.php');
}
?>
