<?
include_once ($_SERVER["DOCUMENT_ROOT"]."/lib/config.php");

// ���̵�ã��
if ($_POST["mode"] == "search_id") {
	$result_arr = array();

	$sql = "select * from member where email = '$_POST[email]' and sns = ''";
	$res = mysqli_query($conn, $sql);

	for ($i="0"; $i<=$rs = mysqli_fetch_array($res); $i++) {
		$userid .= array_push($result_arr, $rs["userid"]);
	}
	echo json_encode($result_arr);
// ��й�ȣ ����
} else if ($_POST["mode"] == "change_pw") {
	$sql = "select * from member where userid ='$_POST[userid]' and email = '$_POST[email]'";
	$res = mysqli_query($conn, $sql);
	$rs = mysqli_fetch_array($res);

	if (!$rs["idx"]) {
		echo "0";
	} else {
		echo "1";
	}
}