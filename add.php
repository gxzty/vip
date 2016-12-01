<?php
header("Content-Type: text/html;charset=utf-8"); 

include 'array.php';
include 'table.php';
include 'connect.php';
include 'photo.php';

 if ($queryArray[0]=='' ) {
	 die("ID不能为空!");
 } 
 if ($queryArray[1]=='' ) {
	 die("姓名不能为空!");
 }
 if ($queryArray[15] < 5 ) {
	 die("充值金额不能小于5!");
 }
 
$photoName = $_FILES["photo"]["error"] > 0 ? '' : photo();
$pay = $queryArray[15];
$level = "(SELECT `level` FROM `level` WHERE `small` <= '$pay' AND '$pay' < `big`)";
$add = "INSERT INTO `vip`(`id`,`name`, `gender`, `point`, `level`, `pay`, `phone`,  `photo`, `address`, `identity`, `brithday`, `qq`, `email`, `whos`) 
VALUES ('$queryArray[0]','$queryArray[1]','$queryArray[2]','$queryArray[8]',".$level.",'$queryArray[15]','$queryArray[5]','$photoName','$queryArray[10]','$queryArray[3]','$queryArray[4]','$queryArray[7]','$queryArray[11]','$queryArray[12]')";

if (mysql_query($add)) {
	$pointime = "UPDATE `vip` SET `point` = `pay` * (SELECT `rate` FROM `level` WHERE `level`=`vip`.`level`) , `leaveTime` =  DATE_ADD(CURDATE(), INTERVAL (SELECT `time` FROM `level` WHERE `level`=`vip`.`level`) MONTH) WHERE `id` = ".$queryArray[0];
	mysql_query($pointime);  // 积分与失效期
	mysql_query("INSERT INTO `pay` (`id`, `name`, `pay`) VALUES ('$queryArray[0]', '$queryArray[1]', '$queryArray[15]')");
	echo "新会员创建成功！<br/>";
	echo "<br/>";
	$result = mysql_query("SELECT * FROM `vip` ORDER BY `createTime` DESC LIMIT 1;");

	table($result);
} else {
    die ('新增错误' . mysql_error());
}

mysql_close($con);
?>
