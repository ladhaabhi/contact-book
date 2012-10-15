<?php
session_start();
include_once "../../common/common.php";
include_once "../../common/sqls.php";


if (!(isset($_SESSION['user']) && isset ($_SESSION['uid']))) {
     header('Location:/tisko/view/login.php');
}

$user = $_SESSION['user'];
$uid = $_SESSION['uid'];

$field = $_GET['field'];
$val = $_GET['val'];
$cont = $_GET['cont'];
$compny = $_GET['compny'];

if($field == 'key')
$result = executeQuery(getContsByKey($uid,$val));
else if ($field == 'search')
$result = executeQuery(getContBySearch($uid, $val, $cont, $compny));   
   
 echo "<table id='cont' border='1'>
<tr>
<th></th>
<th>Name</th>
<th>Contact</th>
<th>Email id</th>
<th>Company</th>
<th>Address</th>
</tr>";

    while ($row = mysql_fetch_array($result)) {
        echo "<tr>";
        echo "<td><input type='radio' name='cont' value='" . $row['seq'] . "' onclick='val();'/></td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['cont'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['compny'] . "</td>";
        echo "<td>" . $row['addr'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>
