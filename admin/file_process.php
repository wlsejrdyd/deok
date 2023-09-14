<?
include_once ($_SERVER["DOCUMENT_ROOT"]."/lib/config.php");

$mode = $_POST["mode"];

// ���� ���ε� ��ġ
$uploads_dir = $_SERVER["DOCUMENT_ROOT"]."/upload/main_banner";

// ��� Ȯ����
$allow_ext = array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF");

$sql = "select * from main_left_ad_list order by idx desc";
$res = mysqli_query($conn, $sql);
$rs = mysqli_fetch_array($res);

// ���� ó���κ�
if ($mode == "left_file") {
	$count = "5";
	for ($i="1"; $i<=$count; $i++) {
		//����ó���κ�(���������� �����ȵ�)
		if ($_POST["delete_chk".$i]) {
			$del_sql = "update main_left_ad_list set file_name".$i."='', link".$i."='', edit_date".$i."=now() where idx = '1'";
			mysqli_query($conn, $del_sql);
			echo "<script>alert('�����Ǿ����ϴ�.');location.href='/admin/ad_manager/ad_main_manage.php';</script>";
		}
		if ($_FILES["left_banner_file_".$i]["name"]) {

			$error = $_FILES["left_banner_file_".$i]["error"];
			$name_1 = basename($_FILES["left_banner_file_".$i]["name"]);
			$ext = array_pop(explode('.', $name_1));
			
			$name = "main_".time("Ymd")."_".$i.".".$ext;

			if ($error != UPLOAD_ERR_OK) {
				switch ($error) {
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						echo "������ �ʹ� Ů�ϴ�. ($error)";
						break;
					case UPLOAD_ERR_NO_FILE;
						echo "������ ÷�ε��� �ʾҽ��ϴ�. ($error)";
						break;
					default:
						echo "������ ����� ���ε� ���� �ʾҽ��ϴ�. ($error)";
				}
				exit;
			}
			if (!in_array($ext, $allow_ext)) {
				echo "������ �ʴ� Ȯ�����Դϴ�.";
				exit;
			}
			
			move_uploaded_file($_FILES["left_banner_file_".$i]["tmp_name"], $uploads_dir."/$name");
			$sql = "update main_left_ad_list set file_name".$i."='$name', link".$i."='".$_POST["left_link_".$i]."', edit_date".$i."=now() where idx = '1'";
			mysqli_query($conn, $sql);
			
		} else if ($_POST["left_link_".$i] != $rs["link".$i]) {
			$sql = "update main_left_ad_list set link".$i."='".$_POST["left_link_".$i]."', edit_date".$i."=now() where idx = '1'";
			mysqli_query($conn, $sql);
		}
	}
	echo "<script>location.href='/admin/ad_manager/ad_main_manage.php/';</script>";
	exit;
// ������ ó�� �κ�
} else if ($mode == "right_file") {
	$count = "5";
	for ($i="1"; $i<=$count; $i++) {
		//����ó���κ�(���������� �����ȵ�)
		if ($_POST["delete_chk".$i]) {
			$del_sql = "update main_right_ad_list set file_name".$i."='', link".$i."='', edit_date".$i."=now() where idx = '1'";
			mysqli_query($conn, $del_sql);
			echo "<script>alert('�����Ǿ����ϴ�.');location.href='/admin/ad_manager/ad_main_manage.php';</script>";
		}
		
		if ($_FILES["right_banner_file_".$i]["name"]) {
			
			$error = $_FILES["right_banner_file_".$i]["error"];
			$name_1 = basename($_FILES["right_banner_file_".$i]["name"]);
			$ext = array_pop(explode('.', $name_1));
			
			$name = "main_".time("Ymd")."_".$i.".".$ext;

			if ($error != UPLOAD_ERR_OK) {
				switch ($error) {
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						echo "������ �ʹ� Ů�ϴ�. ($error)";
						break;
					case UPLOAD_ERR_NO_FILE;
						echo "������ ÷�ε��� �ʾҽ��ϴ�. ($error)";
						break;
					default:
						echo "������ ����� ���ε� ���� �ʾҽ��ϴ�. ($error)";
				}
				exit;
			}
			if (!in_array($ext, $allow_ext)) {
				echo "������ �ʴ� Ȯ�����Դϴ�.";
				exit;
			}
			
			move_uploaded_file($_FILES["right_banner_file_".$i]["tmp_name"], $uploads_dir."/$name");
			$sql = "update main_right_ad_list set file_name".$i."='$name', link".$i."='".$_POST["right_link_".$i]."', edit_date".$i."=now() where idx = '1'";
			mysqli_query($conn, $sql);
			
		} else if ($_POST["right_link_".$i] != $rs["link".$i]) {
			$sql = "update main_right_ad_list set link".$i."='".$_POST["right_link_".$i]."', edit_date".$i."=now() where idx = '1'";
			mysqli_query($conn, $sql);
		}
	}
	echo "<script>location.href='/admin/ad_manager/ad_main_manage.php/';</script>";
	exit;
} else if ($mode == "page_file") {
	$uploads_dir = $_SERVER["DOCUMENT_ROOT"]."/upload/user_banner";
	
	$select_sql = "select * from page_ad_list where code = $_POST[main_code]";
	$select_res = mysqli_query($conn, $select_sql);
	$select_rs = mysqli_fetch_array($select_res);
	
	//����ó���κ�(���������� �����ȵ�)
	if ($_POST["delete_chk"]) {
		$del_sql = "update page_ad_list set ";
		$del_sql .= "file_name='', ";
		$del_sql .= "link='', ";
		$del_sql .= "class_name='', ";
		$del_sql .= "pcs='', ";
		$del_sql .= "area='', ";
		$del_sql .= "support='', ";
		$del_sql .= "edit_date=now() ";
		$del_sql .= "where code='".$_POST["main_code"]."'";
		mysqli_query($conn, $del_sql);
		exit;
	}
	
	if ($_FILES["page_banner_file"]["name"]) {
		$error = $_FILES["page_banner_file"]["error"];
		$name_1 = basename($_FILES["page_banner_file"]["name"]);
		$ext = array_pop(explode('.', $name_1));
		
		$name = "page_".time("Ymd")."_".$ext;

		if ($error != UPLOAD_ERR_OK) {
			switch ($error) {
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					echo "������ �ʹ� Ů�ϴ�. ($error)";
					break;
				case UPLOAD_ERR_NO_FILE;
					echo "������ ÷�ε��� �ʾҽ��ϴ�. ($error)";
					break;
				default:
					echo "������ ����� ���ε� ���� �ʾҽ��ϴ�. ($error)";
			}
			exit;
		}
		if (!in_array($ext, $allow_ext)) {
			echo "������ �ʴ� Ȯ�����Դϴ�.";
			exit;
		}
		
		move_uploaded_file($_FILES["page_banner_file"]["tmp_name"], $uploads_dir."/$name");
	} else {
		$name = $select_rs["file_name"];
	}
	
	if ($select_rs["idx"]) {
		$sql = "update page_ad_list set ";
		$sql .= "file_name='$name', ";
		$sql .= "link='".$_POST["page_link"]."', ";
		$sql .= "class_name='".$_POST["class_name"]."', ";
		$sql .= "pcs=".$_POST["pcs"]."', ";
		$sql .= "area='".$_POST["area"]."', ";
		$sql .= "support='".$_POST["support"]."', ";
		$sql .= "edit_date=now() ";
		$sql .= "where code='".$_POST["code"]."'";
	} else {
		$sql = "insert into page_ad_list set ";
		$sql .= "main_code='".$_POST["main_code"]."', ";
		$sql .= "code='".$_POST["code"]."', ";
		$sql .= "file_name='$name', ";
		$sql .= "link='".$_POST["page_link"]."', ";
		$sql .= "class_name='".$_POST["class_name"]."', ";
		$sql .= "pcs='".$_POST["pcs"]."', ";
		$sql .= "area='".$_POST["area"]."', ";
		$sql .= "support='".$_POST["support"]."', ";
		$sql .= "edit_date=now()";
	}
	$res = mysqli_query($conn, $sql);

	echo "<script>alert('���ε� ����');location.href='/admin/ad_manager/ad_page_manage.php';</script>";
} else if ($mode == "footer_change") {
	$contents1 = $_POST["contents1"];
	$contents2 = $_POST["contents2"];
	$contents3 = $_POST["contents3"];
	
	$sql = "update footer_change set contents_1='$contents1', contents_2='$contents2', contents_3='$contents3' where idx = '1'";
	$res = mysqli_query($conn, $sql);
	if ($res) {
		echo "<script>alert('�����Ǿ����ϴ�');location.href='/admin/footer_change.php';</script>";
	} else {
		echo "<script>alert('������ �����߽��ϴ�.');location.href='history.go(-1)';</script>";
	}
} else if ($mode == "header_change") {
	$contents1 = $_POST["contents1"];
	$contents2 = $_POST["contents2"];
	$contents3 = $_POST["contents3"];
	
	$sql = "update footer_change set contents_1='$contents1', contents_2='$contents2', contents_3='$contents3' where category = 'h'";
	$res = mysqli_query($conn, $sql);
	if ($res) {
		echo "<script>alert('�����Ǿ����ϴ�');location.href='/admin/header_change.php';</script>";
	} else {
		echo "<script>alert('������ �����߽��ϴ�.');location.href='history.go(-1)';</script>";
	}
}
?>
