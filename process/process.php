<?
session_start();
include_once($_SERVER["DOCUMENT_ROOT"]."/lib/config.php");

if ($_GET["mode"]) {
	$mode = $_GET["mode"];
} else if ($_POST["mode"]) {
	$mode = $_POST["mode"];
}

if ($_POST["email_2"] == "0") {
	$email_2 = "naver.com";
} else if ($_POST["email_2"] == "1") {
	$email_2 = "daum.net";
} else if ($_POST["email_2"] == "2") {
	$email_2 = "gmail.com";
}
$userid = $_POST["userid"];
$subject = $_POST["subject"];
$contents = $_POST["c_contents"];
$email = $_POST["email_1"]."@".$email_2;

// ��㹮�� ���� �κ�
if ($mode == "counseling_w") {
	$sql = "insert into counseling_list set userid='$userid', subject='$subject', contents='$contents', reg_date = now()";
	mysqli_query($conn, $sql);
	echo "<script>alert('��ϵǾ����ϴ�.Ȯ�� �� �亯 �帮���� �ϰڽ��ϴ�.');location.href='/';</script>";
// ȸ������ �κ�
} else if ($mode == "join") {
	if ($_POST["SNS"]) {
		if ($_POST["s_userid"]) { 
			$sql = "insert into member set userid = '$_SESSION[s_userid]', sns='$_POST[SNS]', email='$email', email_chk='$_POST[email_chk]', reg_date = now()";
		} else {
			$sql = "insert into member set userid = '$_POST[email_1]', sns='$_POST[SNS]', email='$email', email_chk='$_POST[email_chk]', reg_date = now()";
		}
	} else {
		$passwd = md5($_POST["password"]);

		$sql = "insert into member set userid = '$userid', passwd = '$passwd', email='$email', email_chk = '$_POST[email_chk]', reg_date = now()";
	}
	mysqli_query($conn, $sql);
	$_SESSION["userid"] = $_POST["email_1"];

	echo "<script>alert('ȸ�������� �Ϸ�Ǿ����ϴ�.');location.href='/';</script>";
// �α��� �κ�
} else if ($mode == "login") {
	$userid = $_POST["userid"];
	$pw = md5($_POST["password"]);

	$sql = "select * from member where userid = '$userid'";
	$res = mysqli_query($conn, $sql);
	$rs = mysqli_fetch_array($res);

	if ($rs["idx"]) {
		if ($pw == $rs["passwd"]) {
			echo "<script>alert('�α��� �Ǿ����ϴ�.');location.href='/';</script>";
			$_SESSION["userid"] = $userid;
		} else {
			echo "<script>alert('��й�ȣ�� ��ġ���� �ʽ��ϴ�.'); location.href=history.go(-1);</script>";
		}
	} else {
		echo "<script>alert('���Ե� ȸ���� �ƴմϴ�.'); location.href=history.go(-1);</script>";
	}
// ȸ������ �κ�
} else if ($mode == "del_user") {
	$idx = $_GET["idx"];
	$sql = "delete from member where idx = '$idx'";
	mysqli_query($conn, $sql);

	echo "<script>alert('�����Ǿ����ϴ�.'); location.href='/admin/member_list.php';</script>";
// ��й�ȣ ����κ�
} else if ($mode == "pw_change") {
	$pw = md5($_POST["pw"]);

	$sql = "update member set passwd = '$pw' where userid = '$_POST[pw_userid]'";
	mysqli_query($conn, $sql);

	echo "<script>alert('��й�ȣ�� ����Ǿ����ϴ�.'); location.href='/member/login.php';</script>";
}
