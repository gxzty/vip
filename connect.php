<?php
$con = mysql_connect("45.58.54.172","2100d","everyDay");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("2100d", $con);
mysql_query("set character set 'utf8'");   //避免中文乱码字符转换
?>