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

$result = executeQuery("Select $attr from add_book where uid = $uid AND $attr like '%$key%'");

while ($row = mysql_fetch_array($result)) {
    $res[] = $row[$attr];
}

echo json_encode($res);
?>
