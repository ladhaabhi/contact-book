<?php
session_start();
include_once "../../common/common.php";
include_once "../../common/sqls.php";

if (!(isset($_SESSION['user']) && isset($_SESSION['uid']))) {
    header('Location:/tisko/view/login.php');
}

$res = Array();

$key = $_GET['key'];
$attr = $_GET['attr'];

$uid = $_SESSION['uid'];

$result = executeQuery("Select * from add_book where uid = $uid AND name like '%$key%'");

while ($row = mysql_fetch_array($result)) {
    if(trim($row['email']) != "")
    $res[] = $row['email'];
}

echo json_encode($res);
?>
