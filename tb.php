<?php
echo "已修改如下玩家信息！<br><br>";
  echo "修改前：<br>";
	echo "<table border='1'>
	<tr>
	<th>ID</th>
	<th>当前分数</th>
	<th>当前库存</th>
	<th>黑白名单</th>
	<th>账号状态</th>
	</tr>";
		echo "<tr>";
		echo "<td>12345</td>";
		echo "<td>20000000</td>";
		echo "<td>0</td>";
		echo "<td>黑名单</td>";
		echo "<td>正常</td>";
		echo "</tr>";
	echo "</table>";
  echo "<br><br>修改后：<br>";
	echo "<table border='1'>
	<tr>
	<th>ID</th>
	<th>当前分数</th>
	<th>当前库存</th>
	<th>黑白名单</th>
	<th>账号状态</th>
	</tr>";
		echo "<tr>";
		echo "<td>12345</td>";
		echo "<td>20000000</td>";
		echo "<td>0</td>";
		echo "<td>正常</td>";
		echo "<td>正常</td>";
		echo "</tr>";
	echo "</table>";
?>