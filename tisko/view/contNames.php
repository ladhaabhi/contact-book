<?php
session_start();
include_once "../common/common.php";
include_once "../common/sqls.php";


if (!(isset($_SESSION['user']) && isset($_SESSION['uid']))) {
    header('Location:/tisko/view/login.php');
}

$user = $_SESSION['user'];
$uid = $_SESSION['uid'];


$result = executeQuery(getContsByKey($uid, ''));

echo "<table border='1'>
<tr>
<th></th>
<th>Name</th>
<th>Contact</th>
<th>Emial id</th>
<th>Company</th>
<th>Address</th>
</tr>";

while ($row = mysql_fetch_array($result)) {
    if (trim($row['email']) != '' ) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='cont' value='" . $row['email'] . "'/></td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['cont'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['compny'] . "</td>";
        echo "<td>" . $row['addr'] . "</td>";
        echo "</tr>";
    }
}
echo "</table><br><br>";

echo "<input type = 'button' name = 'edt' value='select' onclick='post_value();' /> ";


mysql_close($con);
?>

<html>
    <head>

        <script langauge="javascript">
            function post_value(){
   
                var seq="";
                var cont = document.getElementsByName('cont');
                var i = cont.length;
                while (i--) {
                    if(cont[i].checked)
                        seq = seq + cont[i].value + "; ";
                }
   
                if(seq.trim() != "")        
                {
                    opener.document.f1.email.value = opener.document.f1.email.value + seq;
                    self.close();
                }
            }
        </script>

        <title>select contacts</title>
    </head>
</html>
