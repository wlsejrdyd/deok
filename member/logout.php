<?
session_start();
if ($_SESSION["SNS"]) {
	unset($_SESSION["naver_state"]);
}
unset($_SESSION["userid"]);
unset($_SESSION["s_userid"]);
unset($_SESSION["SNS"]);

echo "<script>alert('�α׾ƿ� �Ǿ����ϴ�.');location.href='/';</script>";
?>