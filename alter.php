<?php
header("Content-Type: text/html;charset=utf-8"); 
include 'array.php';
include 'table.php';
include 'connect.php';
include 'photo.php';

$id = $_POST[id];
if ($id == '' || !is_numeric($id)  ) {
    die('请输入要修改的用户ID ');
}
$result = mysql_query("SELECT * FROM vip WHERE id='$id'");
if (!$result) {
    die('没有ID为'.$id.'的用户！ ');
}

echo "已修改如下用户信息！<br/>";
echo "<br/>";
echo "修改前：<br/>";

table($result);
$point = $_POST[point];
if ($point != '' && is_numeric($point) ) {
    if($point + mysql_fetch_array(mysql_query("SELECT `point` FROM `vip` WHERE `id` = '$id'"))['point'] >= 0) {
		$sentence = "UPDATE `vip` SET `point` = `point` + '$point' WHERE `id` = '$id'";
	} else {
	    die("<br><br><br>用户积分不足！");
	}
} else {
	$first = true;
	$i=1;
	for ($i=1; $i < $field; $i++) {
		if ($queryArray[$i] == null || in_array($list[$i], $noAlter )) {
			continue;
		}
		if ($first) {
			$sentence = "UPDATE `vip` SET $list[$i]='$queryArray[$i]'";
			$first=false;
			continue;
		}
		$sentence .= ",$list[$i]='$queryArray[$i]'";
	}
	$sentence .= " WHERE id='$id'";
}
mysql_query($sentence);  // 执行修改
if ($_FILES["photo"]["error"] <= 0) {
    $alterPhoto = photo();
    mysql_query("UPDATE `vip` SET `photo` = '$alterPhoto' WHERE `id` = '$id' ");
}
// 修改后
$result = mysql_query("SELECT * FROM vip WHERE id='$id'");

echo "<br/>";
echo "<br/>";
echo "修改后：<br/>";

table($result);

mysql_close($con);
?>

