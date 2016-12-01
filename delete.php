<?php
header("Content-Type: text/html;charset=utf-8"); 

include 'table.php';
include 'connect.php';

$id = $_POST[id];
$result = mysql_query("SELECT * FROM vip WHERE id='$id'");

echo "以下用户已被删除!<br/>";
table($result);

mysql_query("DELETE FROM `vip` WHERE id='$id'");
mysql_close($con);
?>
