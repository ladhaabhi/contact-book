xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                          
function valLogin()
{ 
    var isValidEmail = chk(document.login.luid.value,'Email id','luid');
    var isValidPassword = chk(document.login.lpwd.value,'Password','lpwd');
                                    
    if(isValidEmail && isValidPassword)   
        return true;
    else
        return false;        
}

function chkOldPwd(pwd)
{
    if($.trim(pwd) == '')
    {
        $('#ppwd').html('');
        return false;
    }
    $.ajax({
        url: '/tisko/common/validator.php?field=pwd&val='+pwd,
        success: function(data) {
            $('#ppwd').html(data);
            if(data.length <= 0)
            {
                $("#pwd").show(1);
                document.profile.oldPwd.value = '';
                $("#oldPwd").attr('disabled', 'true');
            }
            else
                $("#pwd").hide(1);
            
        }
    });
}
            
function valReg()
{ 
    var isValidName = chk(document.reg.name.value,'Name','rname');
    var isValidEmail = chk(document.reg.uid.value,'Email id','ruid');
    var isValidPassword = chk(document.reg.pwd.value,'Password','rpwd');
    var isValidDate = chk(document.reg.dob.value,'Date','rdate');
                                                   
    if(isValidName && isValidEmail && isValidPassword && isValidDate)   
        return true;
    else
        return false;        
}

function valProfile()
{ 
   
    var isValidEmail = chkProfile(document.profile.uid.value,'Email id','puid');
    var isValidPassword = (chkProfile(document.profile.npwd.value,'Password','ppwd') && chkProfile(document.profile.repwd.value,'Password','ppwd'));
    var isValidDate = chkProfile(document.profile.dob.value,'Date','pdate');
    
    if(isValidEmail && isValidPassword && isValidDate)   
        return true;
    else
        return false;        
}

function valCont(scope)
{
    var isValidEmail = true;
    var email = document.addCont.uid.value;
     
    if($.trim(email) != "")
    {
        isValidEmail = chk(email,'Email id','auid');
    }
    else
        {
             $("#auid").html("");
        }
    
    if(scope == 'email')
        return isValidEmail;
    
    var isValidName = chk(document.addCont.name.value,'Name','aname');
    var isValidCont = chkNum(document.addCont.cont.value,'Contact','acont');
   
    if(isValidName && isValidCont && isValidEmail)   
        return true;
    else
        return false; 
     
}
            
function chk(val,field,id)
{
    if($.trim(val) == "")
    {
        $("#"+id).html("Enter " + field);
        return false;
    }
    else
        $("#"+id).html("");
                                
    if(field == 'Email id')
    {
        if(!chkEmail(val))
        {
            $("#"+id).html("Not a valid Email id");
            return false;
        }
                            
        if(id == 'ruid')
        {
            $.ajax({
                url: '/tisko/common/validator.php?field=email&val='+val,
                success: function(data) {
                    $('#'+id).html(data);
                    if(data.length > 0)
                        document.reg.uid.value = '';    
                }
            });
        }
                    
                    
    }
                
    if(id== 'rdate')
    {
        var regex = /^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/;
        var yr = val.substr(6,10);
                    
        if((!regex.test(val)) || yr > '2011' || yr < '1900')
        {
            $("#"+id).html("Enter a valid date in the format mm/dd/yyyy");
            return false;
        }
    }
    return true;
}

function chkProfile(val,field,id)
{
    if(val.trim() != ""){
        if( field == 'Email id')
        {
            if(!chkEmail(val))
            {
                $("#"+id).html("Not a valid Email id");
                return false;
            }
            else
                $("#"+id).html("");
                            
          
            $.ajax({
                url: '/tisko/common/validator.php?field=email&val='+val,
                success: function(data) {
                    $('#'+id).html(data);
                    if(data.length > 0)
                        document.profile.uid.value = '';    
                }
            });
                     
        }   
        else if(field == 'Date')
        {
            var regex = /^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/;
            var yr = val.substr(6,10);
                    
            if((!regex.test(val)) || yr > '2011' || yr < '1900')
            {
                $("#"+id).html("Enter a valid date in the format mm/dd/yyyy");
                return false;
            }
            else
                $("#"+id).html("");
        }
        else if(field == 'Password')
        {
            var npwd = document.profile.npwd.value;
            var repwd = document.profile.repwd.value;
            if(npwd != repwd)
            {
                $("#"+id).html("New password and re-entered Password doesnot match");
                return false;
            }
            else
                $("#"+id).html("");
        }
    }
    return true;
}   

function chkEmail(val)
{
    
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var atpos=val.indexOf("@");
    var dotpos=val.lastIndexOf(".");
      
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=val.length || reg.test(val) == false)
        return false;
    else
        return true;
}

function chkNum(val,field,id)
{
    if(isNaN(val) || $.trim(val) == "")
    {
        $("#"+id).html("Enter a valid " + field);
        return false;              
    }
    else
        $("#"+id).html("");
    
    return true;
    
}

function getCont(field,val)
{       
    var name = document.getElementById("autoName").value;  
    var cont = document.getElementById("autoCont").value;  
    var compny = document.getElementById("autoCompny").value;
    
    name = field == 'key' ? val : name ;
    
    $.ajax({
        url: '/tisko/view/ajax/contKey.php?field='+field+'&val='+name+'&cont='+cont+'&compny='+compny,
        success: function(data) {
            $('#cont').html(data);
        }
    });
               
}

function edit(val)
{
    var cont = document.getElementsByName('cont');
    var i = cont.length;
    while (i--) {
        if(cont[i].checked)
            break;
    }
    if(i>=0)
        if (val == "del")
        {
            $.ajax({
                url: '/tisko/view/ajax/editCont.php?act=del&val='+cont[i].value,
                success: function(data) {
                    $('#main').html(data);
                }
            });
                
        }
        else if (val == "edit")
        {
            $.ajax({
                url: '/tisko/view/ajax/editCont.php?act=edit&val='+cont[i].value,
                success: function(data) {
                    $('#main').html(data);
                }
            });
                
        }
}

function grpSel()
{
    
    var grps = document.getElementById("grps").value;
    
    $.ajax({
        url: '/tisko/view/ajax/grpMem.php?act=select&grp=' + grps,
        success: function(data) {
            $('#memList').html(data);
        }
    });
    
}

function addMemToGrp()
{
    var seq = "";   
    var grp = document.getElementById("grps").value;       
    var cont = document.getElementsByName('NonGrpCont');
    var i = cont.length;
    while (i--) {
        if(cont[i].checked)
            seq = seq + cont[i].value + ",";
    }
    seq= seq + "0";
       
    if(seq == "0")
    {
        alert("Select atleast one contact");
        return false;
    }
    else
    {
        $.ajax({
            url: '/tisko/view/ajax/mngGrpMem.php?act=addMem&grp='+grp+'&seq='+seq,
            success: function(data) {
                $('#memList').html(data);
            }
        });        
    }
    
}

function remMemFrmGrp()
{
    var seq = "";
    var flg = true;
    var grp = document.getElementById("grps").value;       
    var cont = document.getElementsByName('grpCont');
    var i = cont.length;
    while (i--) {
        if(!cont[i].checked)
            seq = seq + cont[i].value + ",";
        else
            flg=false;
    }
    seq= seq + "0";
       
    if(flg)
    {
        alert("Select atleast one contact");
        return false;
    }
    else
    {
        $.ajax({
            url: '/tisko/view/ajax/mngGrpMem.php?act=remMem&grp='+grp+'&seq='+seq,
            success: function(data) {
                $('#memList').html(data);
            }
        });        
    }
}

function crtGrp()
{
    var grp = document.getElementById("newGrp").value; 
    if($.trim(grp) == "")
    {
        alert("Enter group name");
        return false;
    }
    else if (! /^[a-zA-Z0-9]+$/.test(grp)) {
        alert("Enter group name as alphanumeric only");
        return false;
    }

    else
    {
        $.ajax({
            url: '/tisko/view/ajax/mngGrpMem.php?act=crtGrp&grp='+grp,
            success: function(data) {
                $('#grpMain').html(data);
            }
        });        
    }
}

function delGrp()
{
    var grp = document.getElementById("grps").value; 
    if($.trim(grp) == "")
    {
        alert("Select group");
        return false;
    }
    else
    {
        $.ajax({
            url: '/tisko/view/ajax/mngGrpMem.php?act=delGrp&grp='+grp,
            success: function(data) {
                $('#grpMain').html(data);
            }
        });        
    }
}


function setAutoComp()
{
    alert("in");
    $('#cname').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '/tisko/view/ajax/autoCompName.php',
                dataType: "json",
                data: {
                    key: request.term
                },
                success: function( data ) {
                    response(data);
                }
            })
        }

    });
}