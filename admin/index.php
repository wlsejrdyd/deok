<?
@session_start();

$id = "admin";
$pw = md5("qlrejr1!");
if ($_SESSION["a_userid"]) {
	echo "<script>location.href='/admin/ad_manager/ad_main_manage.php';</script>";
	exit;
}

if ($_POST["mode"] == "login") {
	$userid = $_POST["userid"];
	$passwd = md5($_POST["passwd"]);

	if ($userid == $id) {
		if ($passwd == $pw) {
			echo "<script>alert('�α��� �Ǿ����ϴ�');location.href='/admin/ad_manager/ad_main_manage.php';</script>";
			$_SESSION["a_userid"] = $_POST["userid"];
		} else {
			echo "<script>alert('��й�ȣ�� ��ġ���� �ʽ��ϴ�.');location.href='/admin/index.php';</script>";
		}
	} else {
		echo "<script>alert('������ �������θ� �α��� �� �� �ֽ��ϴ�.');location.href='/admin/index.php';</script>";
	}
}
?>
<html>
<head>

<title>Vig Deok ������ ������</title>
<link rel="stylesheet" href="/css/admin_style.css">
<script type="text/javascript">
function submit_chk() {
	var f = document.login_form;
	if (f.userid.value == "") {
		alert("���̵� �Է����ּ���");
		f.userid.focus();
		return false;
	} else if (f.passwd.value == "") {
		alert("��й�ȣ�� �Է����ּ���");
		f.passwd.focus();
		return false;
	} else {
		f.submit();
	}
}
</script>
</head>
<body>
<div class="admin_wrap">
	<span style="font-weight:bold">��� ������ �α���</span><br /><br />
	<form name="login_form" action="<?=$PHP_SELF?>" method="POST">
		<input type="hidden" name="mode" value="login"/>
		
		<div class="login_info">
			���̵� <input type="text" name="userid" class="userid"/><br />
			��й�ȣ <input type="password" name="passwd" class="passwd"/>
		</div>
		<div class="login_btn_div">
			<input type="button" onclick="submit_chk()" value="�α���" class="login_btn"/>
		</div>
		<br /><br />
		<span style="font-weight:bold; color:red">������ �� ���ٽ� ���� ó���� ���� �� �ֽ��ϴ�.</span>
	</form>
</div>
</body>
</html>