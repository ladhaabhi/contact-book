<?php

include_once 'db.php';
include_once 'sqls.php';

$con = getConn();

function getConn() {
    if (DB == "MYSQL") {
        return getMySqlConn();
    }
}

function getMySqlConn() {
    $con = mysql_connect("localhost", "abhi", "forget");

    if (!$con) {
        die('Could not connect: ' . mysql_error());
    } else {
        mysql_select_db("myapp", $con);
        return $con;
    }
}

function getMySqliConn() {
    $mysqli = new mysqli('localhost', 'abhi', 'forget', 'myapp');
    if (mysqli_connect_errno()) {
        echo "Connection Failed: " . mysqli_connect_errno();
        exit();
    } else {
        return $mysqli;
    }
}

function executeQuery($sql) {
    if (DB == "MYSQL") {
        return mysql_query($sql);
    }
}

function chkLogin($email, $pwd) {
    if (DB == "MYSQL") {
        $mysqli = getMySqliConn();
        $stmt = $mysqli->prepare(getLoginSql());
        $stmt->bind_param("ss", $email, md5($pwd));
        $stmt->execute();

        if ($stmt->fetch())
            return true;
        else
            return false;
    }
}

?>
