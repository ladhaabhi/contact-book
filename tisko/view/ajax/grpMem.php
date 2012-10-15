<?php
session_start();
include_once "../../common/common.php";
include_once "../../common/sqls.php";

if (!(isset($_SESSION['user']) && isset($_SESSION['uid']))) {
    header('Location:/tisko/view/login.php');
}

$user = $_SESSION['user'];
$uid = $_SESSION['uid'];

$grp = $_GET['grp'];
$act = $_GET['act'];


{
$result = executeQuery(getGrpMemSql($uid,$grp));
$result1 = executeQuery(getNonGrpMemSql($uid,$grp));

echo "<div id='grpMem' style='height:450px; width: 45%; float:left; overflow:scroll; background-color: yellowgreen;'>
     <table border='1'>
     <caption>Contacts in group</caption>
     <tr>
     <th></th>
     <th>Name</th>
     <th>Contact</th>
     <th>Email id</th>
     </tr>";

while ($row = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td><input type='checkbox' name='grpCont' value='" . $row['seq'] . "' onclick='val();'/></td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['cont'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "</tr>";
}
echo "</table ></div>
     
     <div id='arrow' style='height:450px; width: 10%; float:left;'>
     <input type='button' name= 'left' value='   <<   ' style='margin: 50% 30%' onclick='addMemToGrp();'/><br>
     <input type='button' name= 'right' value='   >>   ' style='margin: 10% 30%' onclick='remMemFrmGrp();'/>
     </div>
     
    <div id='nonGrpMem' style='height:450px; width: 45%; float:left; overflow:scroll; background-color: yellowgreen ;'>
      <table border='1'>
      <caption>Contacts not in group</caption>
     <tr>
     <th></th>
     <th>Name</th>
     <th>Contact</th>
     <th>Email id</th>
     </tr>";

while ($row = mysql_fetch_array($result1)) {
    echo "<tr>";
    echo "<td><input type='checkbox' name='NonGrpCont' value='" . $row['seq'] . "' onclick='val();'/></td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['cont'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "</tr>";
}
echo "</table ></div>";
}
?>
