<?php
header("Content-Type: text/html;charset=utf-8"); 

include 'connect.php';

$id = $_POST[id];
if ($id == '') {
    die('请输入充值用户ID ！');
}
$pay = $_POST[pay];
if ($pay == '') {
    $sentence = "SELECT * FROM `pay` WHERE `id` = '$id' ORDER BY payTime DESC";
	$result = mysql_query($sentence);
} else {
	$sentence = "INSERT INTO `pay`(`id`,`name`,`pay`) VALUES('$id', (SELECT `name` FROM `vip` WHERE `vip`.`id`='$id'), '$pay')";
	mysql_query($sentence);

	$sentence = "UPDATE `vip` SET `pay` =`pay` + '$pay' WHERE `id` = '$id'";
	mysql_query($sentence);

	$sentence = "UPDATE `vip` SET `level` = (SELECT `level` FROM `level` WHERE `small` <= `vip`.`pay` AND `vip`.`pay` < `big`), `leaveTime` = IF((SELECT `rate` FROM `level` WHERE `level` = `vip`.`level`) < ((SELECT `level` FROM `level` WHERE `small` <= `vip`.`pay` AND `vip`.`pay` < `big`)), DATE_ADD(CURDATE() ,INTERVAL (SELECT `time` FROM `level` WHERE `level` = (SELECT `level` FROM `level` WHERE `small` <= `vip`.`pay` AND `vip`.`pay` < `big`)) MONTH), `leaveTime`) WHERE `id` = '$id';";
	mysql_query($sentence);

	$sentence = "UPDATE `vip` SET `point` = `point` + '$pay' * (SELECT `rate` FROM `level` WHERE `level`=`vip`.`level`) WHERE `id` = '$id';";
	mysql_query($sentence);


	$sentence = "SELECT * FROM `pay` WHERE `id` = '$id' ORDER BY payTime DESC LIMIT 1";
	$result = mysql_query($sentence);

}
if (!$result) {
	die ("本次操作失败，原因：".mysql_error());
}
$row = mysql_fetch_array($result);
if (!$row) {
	die("没有这个用户或改用户未充值过");
}
echo "<table border='1'>
<tr>
<th>平台ID</th>
<th>会员名称</th>
<th>充值金额</th>
<th>充值时间</th>
</tr>";
do {
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['pay'] . "</td>";
echo "<td>" . $row['payTime'] . "</td>";
} while ($row = mysql_fetch_array($result));
echo "</table>";
mysql_close($con);
?>