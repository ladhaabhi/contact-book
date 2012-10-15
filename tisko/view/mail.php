<?php
session_start();
include_once "../common/common.php";
include_once "../common/sqls.php";


if (!(isset($_SESSION['user']) && isset($_SESSION['uid']))) {
    header('Location:/tisko/view/login.php');
}

$user = $_SESSION['user'];
$uid = $_SESSION['uid'];
?>

<script type="text/javascript" src="scripts/jHtmlArea-0.7.0.js"></script>
<link rel="Stylesheet" type="text/css" href="style/jHtmlArea.css" />


<script type="text/javascript">    
    $("#txtDefaultHtmlArea").htmlarea(); // Initialize jHtmlArea's with all default values
          
    $(document).ready(function() {
        $('#toAutoComp').autocomplete({source: function(request, response) {
                $.ajax({
                    url: '/tisko/view/ajax/autoCompMail.php',
                    dataType: 'json',
                    data: {key: $.trim((request.term).split(";").pop()) },
                    success: function( data ) {response(data);}
                })
            },
            select: function( event, ui ) {
                
                var terms = (this.value).split(";");
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( "; " );
                return false;
                
            } 
        });
    });
    
    function chkMail(){
        var to = document.f1.email.value;
        var grp = document.f1.grpEmail.value;
        
        var to_array = to.split(';');
        for( i =0; i< to_array.length ; i++)
            {
                if(to_array[i].trim() != '' && !chkEmail(to_array[i].trim()))
                    {
                        alert("not a valid email '" + to_array[i].trim() + "'");
                        return false;
                    }
                    
            }
        if($.trim(to) == '' && $.trim(grp) == '')
            {alert("Enter atleast one receipent");return false;}
    }
          
</script>


<form name ="f1" method='post' action='/tisko/control/controller.php?act=sendMail'>
    <pre>
  <a href="javascript:void(0);" NAME="My Window Name" title=" My title here "  onClick=window.open("contNames.php","Ratting","width=550,height=770,left=150,top=200,scrollbars=1");>
To</a>         : <input name='email' id ="toAutoComp"type='text' size="100"/>
<a href="javascript:void(0);" NAME="My Window Name" title=" My title here " 
     onClick=window.open("grpCont.php","Ratting","width=550,height=770,left=150,top=200,scrollbars=1");>
Add Group</a>   : <input name='grpEmail' type='text' size="100" />
  
Subject    : <input name='subject' type='text' size="100"/></pre>
    <textarea name ="message" id="txtDefaultHtmlArea" cols="200" rows="40"><p><h3>Test H3</h3>This is some sample text to test out the <b>WYSIWYG Control</b>.</p></textarea>
    <input type="submit" value="Send mail" onclick="return chkMail();" />


</form>
