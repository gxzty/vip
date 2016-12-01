<?php
function table ($result) {
	$needPhoto = $_POST[needPhoto];
	if (!$result) {
	    die ("本次操作失败，原因：".mysql_error());
	}
	$row = mysql_fetch_array($result);
	if (!$row) {
	    die("没有这个用户");
	}
	echo "<table border='1'>
	<tr>
	<th>平台ID</th>
	<th>会员状态</th>
	<th>会员名称</th>
	<th>会员性别</th>
	<th>证件号码</th>
	<th>出生日期</th>
	<th>联系电话</th>
	<th>QQ/微信</th>
	<th>会员积分</th>
	<th>VIP等级</th>
	<th>充值金额</th>
	<th>通讯地址</th>
	<th>电子邮件</th>
	<th>归属客服</th>
	<th>会员照片</th>
	<th>加入时间</th>
	<th>失效时间</th>
	</tr>";
	$count=0;
	do {
		$count++;
		echo "<tr>";

/*			$i = 0;
		while ($i<17) {
			if ($list[$i] == 'state') {
				$state=$row['state'];
				$color=($state=="正常"?"#00FF00":($state=="即将失效"?"#FFFF00":"#FF0000"));
				echo "<td bgcolor='$color'>" . $row['state'] . "</td>";
				$i++;
				continue;
			}
			if ($list[$i] == 'photo') {
			    if ($needPhoto) {
					echo "<td><img src='http://ztory.cn/vip/photo/".$row['photo']."' /></td>";
				} else {
					echo "<td>" . $row['photo'] ."</td>";
				}
				$i++;
				continue;
			}
			echo "<td>" . $row[$list[$i]] . "</td>";
			echo "</tr>";
			$i++;
		}
		*/
	echo "<td>" . $row['id'] . "</td>";
		$state=$row['state'];
		$color=($state=="正常"?"#00FF00":($state=="即将失效"?"#FFFF00":"#FF0000"));
		echo "<td bgcolor='$color'>" . $row['state'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['gender'] . "</td>";
		echo "<td>" . $row['identity'] . "</td>";
		echo "<td>" . $row['brithday'] . "</td>";
		echo "<td>" . $row['phone'] . "</td>";
		echo "<td>" . $row['qq'] . "</td>";
		echo "<td>" . $row['point'] . "</td>";
		echo "<td>" . $row['level'] . "</td>";
		echo "<td>" . $row['pay'] . "</td>";
		echo "<td>" . $row['address'] . "</td>";
		echo "<td>" . $row['email'] . "</td>";
		echo "<td>" . $row['whos'] . "</td>";
		if ($needPhoto) {
			if ($row['photo']) {
				echo "<td><img src='http://ztory.cn/vip/photo/".$row['photo']."' /></td>";
			} else {
			    echo "<td>无</td>";
			}
		} else {
			echo "<td>" . $row['photo'] ."</td>";
		}
		echo "<td>" . $row['createTime'] . "</td>";
		echo "<td>" . $row['leaveTime'] . "</td>";
		
	} while($row = mysql_fetch_array($result));
	echo "</table>";
	echo "共有 ".$count." 条结果";
}
?>