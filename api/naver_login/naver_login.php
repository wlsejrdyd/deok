<?php
session_start();
// NAVER LOGIN
define('NAVER_CLIENT_ID', '28SJWvbW1OaiGvLL0Yo8');
define('NAVER_CLIENT_SECRET', 'EpWOF1AvGz');
define('NAVER_CALLBACK_URL', 'http://www.deok.kr/api/naver_login/callback.php');

// ���̹� �α��� ������ū ��û ����
$naver_state = md5(microtime() . mt_rand());
//$_SESSION['naver_state'] = $naver_state;
$naver_apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".NAVER_CLIENT_ID."&redirect_uri=".urlencode(NAVER_CALLBACK_URL)."&state=".$naver_state;
?>
<img src="/images/naver_btn.png" style="width:10%; cursor:pointer" alt="���̹��α���" onclick="window.open('<?=$naver_apiURL?>', '���̹��α���', 'width:300, height:400')">