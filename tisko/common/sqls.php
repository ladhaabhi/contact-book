<?php

function getLoginSql() {
    return "SELECT * FROM user where uid = ? AND pwd = ?";
}

function getUser($user){
    return "SELECT * FROM user WHERE uid = '$user'";
}

function getChkPwdSql($uid,$pwd){
    return "SELECT pwd FROM user WHERE seq = $uid AND pwd = '$pwd'";
}

function getUpdateUserDtlSql($uid,$updates){
    return "UPDATE user SET $updates WHERE seq = $uid";
}

function getRegUserSql($uid, $pwd, $name, $dob) {
    return "INSERT INTO user(uid,pwd,name,dob) VALUES ('$uid','$pwd','$name','$dob')";
}

function getContKeys($user){
    return "SELECT DISTINCT(SUBSTR(name,1,1)) AS keyy FROM add_book WHERE uid =$user ORDER BY name";
}

function getConts($user){
    return "SELECT seq,uid,name,cont,compny,addr,email FROM add_book WHERE uid =$user ORDER BY name";
}

function getContsByKey($user,$key){
     return "SELECT * FROM add_book WHERE uid = $user AND name like '$key%' ORDER BY name";
}

function getContBySearch($user, $name, $cont, $comp) {
    return "SELECT * FROM add_book WHERE uid = $user AND name like '%$name%' AND cont like '%$cont%' AND compny like '%$comp%' ORDER BY name";
}

function getGrpForUser($uid){
    return "SELECT grpName FROM grp WHERE uid = $uid ORDER BY grpName";;
}

function getAddContSql($uid, $name, $cont, $compny, $addr, $email) {
    return "INSERT INTO add_book(uid,name,cont,compny,addr,email) 
        VALUES ($uid,'$name','$cont','$compny','$addr','$email')";
}

function getDelContSql($seq) {
    return "DELETE FROM add_book where seq =$seq";
}

function getContDtlSql($seq){
    return "SELECT * FROM add_book WHERE seq =$seq";
}

function getEditContSql($name, $cont, $compny, $addr, $email, $seq) {
    return "UPDATE add_book SET name= '$name', cont= '$cont', compny= '$compny', addr= '$addr' ,email = '$email' WHERE seq =$seq";
}

function getGrpsSql($uid){
    return "SELECT grpName,grpmem FROM grp WHERE uid = $uid ORDER BY grpName";
}

function getGrpMemSql($uid,$grp){
    return "SELECT * FROM add_book WHERE uid = $uid AND 
           INSTR((SELECT grpmem FROM grp WHERE uid = $uid AND grpName = '$grp'),seq) ORDER BY name";
}

function getNonGrpMemSql($uid,$grp){
    return "SELECT * FROM add_book WHERE uid = $uid AND 
           NOT INSTR((SELECT grpmem FROM grp WHERE uid = $uid AND grpName = '$grp'),seq) ORDER BY name";
}

function getUpdateUserGrpSql($mem,$uid,$grp){
    return "UPDATE grp SET grpmem = '$mem' WHERE uid = $uid AND grpName = '$grp'";
}

function getAddUserToGrpSql($mem,$uid,$grp){
    return "UPDATE grp SET grpmem = concat(grpmem,concat(';','$mem')) WHERE uid = $uid AND grpName = '$grp'";
}

function getCrtGrpSql($uid,$grp){
    return "INSERT INTO grp(uid,grpName) VALUES ($uid,'$grp')";
}

function getDelGrpSql($uid,$grp){
    return "DELETE FROM grp where uid = $uid AND grpName = '$grp'";
}
?>
