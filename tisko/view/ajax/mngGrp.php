<?php

session_start();

include_once "../../common/common.php";
include_once "../../common/sqls.php";

if (!(isset($_SESSION['user']) && isset($_SESSION['uid']))) {
    header('Location:/tisko/view/login.php');
}

$user = $_SESSION['user'];
$uid = $_SESSION['uid'];

echo "<div id='grpMain'>";

$res = executeQuery(getGrpsSql($uid));

echo "<h2>Select Group : <select name='grps' id='grps' value ='options' onchange='grpSel();'><option value=''> </option>";
while ($row = mysql_fetch_array($res)) {
    $name = $row['grpName'];
    $val = $row['grpmem'];
    echo "<option value='$name'>$name</option>";
}
echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;";
echo"<input type='button' value='Delete Group' onclick='delGrp()';/><br><br>";
echo "Create Group : <input type='text' id='newGrp' name='newGrp'/> &nbsp;&nbsp; <input type='button' value='Create Group' onclick='crtGrp()';/><br><br>";


echo "<div id='memList' style='height:450px; width: 100%; overflow:scroll'>";
include('grpMem.php');     
echo "</div><br><br>";

echo "</div></h2>";
?>