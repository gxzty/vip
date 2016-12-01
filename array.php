<?php
$list[0] = 'id';
$list[1] = 'name';
$list[2] = 'gender';
$list[3] = 'identity';
$list[4] = 'brithday';
$list[5] = 'phone';
$list[6] = 'photo';
$list[7] = 'qq';
$list[8] = 'point';
$list[9] = 'level';
$list[10] = 'address';
$list[11] = 'email';
$list[12] = 'whos';
$list[13] = 'createTime';
$list[14] = 'leaveTime';
$list[15] = 'pay';
$list[16] = 'state';

$noAlter= array('state', 'pay', 'leaveTime', 'createTime', 'level');


$i = 0;
$field = 17;
while ($i<$field) {
	$queryArray[$i] = $_POST[$list[$i]];
	$i++;
}
?>