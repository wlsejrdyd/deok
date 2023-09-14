<?
include_once ($_SERVER["DOCUMENT_ROOT"]."/lib/config.php");

$idx = $_GET["idx"];

$sql = "delete from page_ad_list where idx = '$idx'";
mysqli_query($conn, $sql);

echo "<script>alert('삭제되었습니다.');location.href='/admin/ad_manager/ad_page_list.php';</script>";