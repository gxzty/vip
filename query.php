<?php
header("Content-Type: text/html;charset=utf-8"); 

include 'array.php';
include 'table.php';
include 'connect.php';

if ($_REQUEST['queryAll']) {
    $result = mysql_query("SELECT * FROM vip");
} else if ($_REQUEST['ASC']) {
    $result = mysql_query("SELECT * FROM vip ORDER BY `createTime` ASC");
} else if ($_REQUEST['DESC']) {
    $result = mysql_query("SELECT * FROM vip ORDER BY `createTime` DESC");
} else {
	$condition = $_POST[condition] ? 'AND' : 'OR';
	$mess = $_POST[mess] ? '%' : '';

	$first = true;
	for ($i=0; $i < $field; $i++) {
		if ($queryArray[$i] == null) {
			continue;
		}
		if ($first) {
			$sentence = "SELECT * FROM vip WHERE $list[$i] LIKE '$mess$queryArray[$i]$mess' ";
			$first = false;
			continue;
		}
		$sentence .= $condition." ".$list[$i]." LIKE "."'$mess$queryArray[$i]$mess'"." ";
	}
	$result = mysql_query($sentence);
}

if (!$result) {
    die('查询失败： ' . mysql_error());
} else {
    table($result);
}

mysql_close($con);
?>
