<?php 
header("Content-Type: text/html;charset=utf-8"); 
function photo() {
	$photo = $_FILES["photo"];
	if ((($photo["type"] == "image/png") || ($photo["type"] == "image/jpeg") || ($photo["type"] == "image/bmp") || ($photo["type"] == "image/pjpeg")) && ($photo["size"] < 2000000)) {
		$photoDir = dirname(__FILE__).'/photo/';
		$filetype = pathinfo($photo["name"], PATHINFO_EXTENSION); // 获取后缀
		$photoName = $_POST[id]  .  "." . $filetype; // id_name.extension
		move_uploaded_file($photo["tmp_name"], $photoDir.$photoName);
		return $_POST[id]  .  "." . $filetype;
	} else {
		echo "照片只能为png, jpg, bmp格式，且体积小于2M!";
		return '';
	}
}
?>