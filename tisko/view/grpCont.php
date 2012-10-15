<?php
session_start();
include_once "../common/common.php";
include_once "../common/sqls.php";


if (!(isset($_SESSION['user']) && isset($_SESSION['uid']))) {
    header('Location:/tisko/view/login.php');
}

$user = $_SESSION['user'];
$uid = $_SESSION['uid'];


$result = executeQuery(getGrpForUser($uid));

echo "<table border='1'>
<tr>
<th></th>
<th>Contact Groups</th>
</tr>";

while ($row = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td><input type='checkbox' name='cont' value='" . $row['grpName'] . "'/></td>";
    echo "<td>" . $row['grpName'] . "</td>";
    echo "</tr>";
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
                    opener.document.f1.grpEmail.value = opener.document.f1.grpEmail.value  + seq;
                    self.close();
                }
            }
        </script>

        <title>select contacts</title>
    </head>
</html>
