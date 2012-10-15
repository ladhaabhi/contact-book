<?php

session_start();
include_once "../../common/common.php";
include_once "../../common/sqls.php";
$user = $_SESSION['user'];
$uid = $_SESSION['uid'];

$grp = $_GET['grp'];
$val = $_GET['seq'];
$action = $_GET['act'];

if (isset($uid) && isset($val) && isset($action) && isset($grp)) {
    if ($action == 'addMem') {
        executeQuery(getAddUserToGrpSql($val, $uid, $grp));
    } else if ($action == 'remMem') {
        executeQuery(getUpdateUserGrpSql($val, $uid, $grp));
    }
    include('grpMem.php');
} else if (isset($uid) && isset($action) && isset($grp)) {
    if ($action == 'crtGrp') {
        if(!executeQuery(getCrtGrpSql($uid,$grp)))
                echo "<script>alert('Group already exists');</script>";
    } else if ($action == 'delGrp') {
        executeQuery(getDelGrpSql($uid,$grp));
    }
    include('mngGrp.php');
} else {
    header('Location:/tisko/view/login.php');
}
?>
