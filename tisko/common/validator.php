<?php
session_start();
include_once '..\common\common.php';
include_once '..\common\db.php';
include_once '..\common\sqls.php';

$field = $_GET['field'];
$value = $_GET['val'];


if ($field == 'email') {
    if (userExists($value)) {
        echo "Email id already in use";
    }
} else if ($field == 'pwd') {
    if (!chkPwd($value)) {
        echo "Wrong password";
    }
}

function userExists($uid) {

    $sql = getUser($uid);
    $res = executeQuery($sql);
    if (mysql_num_rows($res) > 0)
        return true;
    else
        return false;
}

function chkPwd($pwd){
    $uid = $_SESSION['uid'];
    $res = executeQuery(getChkPwdSql($uid,md5($pwd)));
    if (mysql_num_rows($res) > 0)
        return true;
    else
        return false;
    
}

?>
