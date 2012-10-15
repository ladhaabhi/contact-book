<?php

session_start();
include_once "../../common/common.php";
include_once "../../common/sqls.php";


if (!(isset($_SESSION['user']) && isset($_SESSION['uid']))) {
    header('Location:/tisko/view/login.php');
}

$user = $_SESSION['user'];
$uid = $_SESSION['uid'];
$res = executeQuery(getContKeys($uid));
$rows = mysql_num_rows($res);

echo "<div id='main'>";
if ($rows > 0) {
   
    echo "<h1>Search by Key : </h1> <a onclick = 'getCont(\"key\",\"\");' >All &nbsp;&nbsp;</a>     ";
    while ($row = mysql_fetch_array($res)) {
        $temp = $row['keyy'];
        echo "<a  onclick='getCont(\"key\",\"$temp\");'> $temp &nbsp;&nbsp;</a>";
    }
    
    echo "<pre>
    <form name='SearchCont'> 
    Name   : <input type='text' name='name' id='autoName' />   Contact  : <input type='text' name='cont' id='autoCont' />   Company  : <input type='text' name='compny' id='autoCompny' />     <input type='button' value = 'search' onclick ='getCont(\"search\",this.value);' />
    </form>
    <script> $('#autoName').autocomplete({source: function(request, response) {
            $.ajax({
                url: '/tisko/view/ajax/autoCompName.php',
                dataType: 'json',
                data: {key: request.term, attr:'name'},
                success: function( data ) {response(data);}
            })
        }
        });
        
        $('#autoCont').autocomplete({source: function(request, response) {
            $.ajax({
                url: '/tisko/view/ajax/autoCompName.php',
                dataType: 'json',
                data: {key: request.term, attr:'cont'},
                success: function( data ) {response(data);}
            })
        } });
        
        $('#autoCompny').autocomplete({source: function(request, response) {
            $.ajax({
                url: '/tisko/view/ajax/autoCompName.php',
                dataType: 'json',
                data: {key: request.term, attr:'compny'},
                success: function( data ) {response(data);}
            })
        } });
        
</script>
</pre>";

    $result = executeQuery(getConts($uid));
   
    echo "<div id='cont' style='height:450px; width: 700px; overflow:scroll'><table id='cont' border='1'>
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
    echo "</table></div><br><br>";

    echo "<input type = 'button' name = 'edt' value='View/Edit' onclick='edit(\"edit\");' /> ";
    echo " <input type = 'button' name = 'del' value='Delete' onclick='edit(\"del\");' />";
} else {
    echo "No contacts present for $user";
}

echo "</div>";



?>
