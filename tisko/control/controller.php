<?php

session_start();
include_once '..\common\common.php';
include_once '..\common\db.php';
include_once '..\common\sqls.php';


$user = $_SESSION['user'];


$action = $_GET['act'];

if ($action == 'login') {

    $email = $_POST['luid'];
    $pwd = $_POST['lpwd'];

    if (isset($email) && isset($pwd)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location:/tisko/view/login.php?err=email');
        } else {
            if (chkLogin($email, $pwd)) {
                $_SESSION['user'] = $email;
                header('Location:/tisko/view/welcome.php');
            } else {
                header('Location:/tisko/view/login.php?err=login');
            }
        }
    } else {
        header('Location:/tisko/view/login.php');
    }
} else if ($action == 'register') {

    $email = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];

    if (isset($email) && isset($pwd) && isset($name) && isset($dob)) {
        $yy = substr($dob, 6, 4);
        $mm = substr($dob, 0, 2);
        $dd = substr($dob, 3, 2);
        $date = $yy . "/" . $mm . "/" . $dd;
        $regexDate = '/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/';

        if ((!preg_match($regexDate, $dob)) || $yy > 2011 || $yy < 1900) {
            header('Location:/tisko/view/login.php?err=date');
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location:/tisko/view/login.php?err=email');
        } else {
            if (executeQuery(getRegUserSql($email, md5($pwd), $name, $date))) {
                $_SESSION['user'] = $email;
                header('Location:/tisko/view/welcome.php');
            } else {
                header('Location:/tisko/view/login.php?err=reg');
            }
        }
    } else {
        header('Location:/tisko/view/login.php');
    }
} else if ($action == 'addCont') {
    $name = $_POST['name'];
    $cont = $_POST['cont'];
    $email = $_POST['uid'];
    $compny = $_POST['compny'];
    $addr = $_POST['addr'];

    $uid = $_SESSION['uid'];

    if (isset($name) && isset($cont) && isset($uid)) {
        if (executeQuery(getAddContSql($uid, $name, $cont, $compny, $addr, $email))) {
            header('Location:/tisko/view/welcome.php');
        }
    } else {
        header('Location:/tisko/view/login.php');
    }
} else if ($action == 'editCont') {
    $name = $_POST['name'];
    $cont = $_POST['cont'];
    $email = $_POST['uid'];
    $compny = $_POST['compny'];
    $addr = $_POST['addr'];

    $uid = $_SESSION['uid'];

    $seq = $_GET['seq'];


    if (isset($name) && isset($cont) && isset($uid)) {
        if (executeQuery(getEditContSql($name, $cont, $compny, $addr, $email, $seq))) {
            header('Location:/tisko/view/welcome.php');
        }
    } else {
        header('Location:/tisko/view/login.php');
    }
} else if ($action == 'sendMail') {

    include_once '..\common\lib\class.phpmailer.php';

    $to = $_POST['email'];
    $grp = $_POST['grpEmail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer();
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPDebug = 2;                     // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port = 465;                   // set the SMTP port for the GMAIL server
    $mail->Username = "rohit.frnd4you@gmail.com";  // GMAIL username
    $mail->Password = "28194532";

    $mail->SetFrom($user, 'DoNotReply');
    $mail->AddReplyTo($user);

    $mail->Subject = $subject;
    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

    $mail->MsgHTML($message);
    if (trim($to) != '') {
        $to_array = array();
        $to_array = split(';', $to);
        foreach ($to_array as $value)
            if (trim($value) != '')
                $mail->AddAddress(trim($value));
    }
    if (trim($grp) != '') {
        $to_grp = array();
        $to_grp = split(';', $grp);
        foreach ($to_grp as $value) {
            $uid = $_SESSION['uid'];
            $result = executeQuery(getGrpMemSql($uid, trim($value)));
            while ($row = mysql_fetch_array($result)) {
                if (trim($row['email']) != '')
                    $mail->AddAddress(trim($row['email']));
            }
        }
    }

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        header('Location:/tisko/view/welcome.php');
    }
} else if ($action == 'editProfile') {

    $uid = $_SESSION['uid'];

    $name = $_POST['name'];
    $email = $_POST['uid'];
    $npwd = $_POST['npwd'];
    $repwd = $_POST['repwd'];
    $dob = $_POST['dob'];

    $yy = substr($dob, 6, 4);
    $mm = substr($dob, 0, 2);
    $dd = substr($dob, 3, 2);
    $date = $yy . "/" . $mm . "/" . $dd;
    $regexDate = '/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/';

    if ((trim($dob) != '') && ((!preg_match($regexDate, $dob)) || $yy > 2011 || $yy < 1900)) {
        header('Location:/tisko/view/login.php');
    } else if ((trim($email) != '') && (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
        header('Location:/tisko/view/login.php');
    } else {

        $updates = '';
        if (trim($name) != '')
            $updates = $updates . " name = '$name',";
        if (trim($email) != '')
            $updates = $updates . " uid = '$email',";
        if (trim($dob) != '')
            $updates = $updates . " dob = '$date',";
        if ((trim($npwd) != '') && $npwd == $repwd) {
            $npwd = md5($npwd);
            $updates = $updates . " pwd = '$npwd',";
        }

        if (trim($updates) == '' || executeQuery(getUpdateUserDtlSql($uid, substr($updates, 0, strlen($updates) - 1)))) {
            if (trim($email) != '')
                $_SESSION['user'] = $email;
            header('Location:/tisko/view/welcome.php');
        } else {
            header('Location:/tisko/view/login.php');
        }
    }
} else {
    header('Location:/tisko/view/login.php');
}
?>
