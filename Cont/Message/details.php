<?php 
	require './cont.php';
	$link = connect();
	$table=!empty($_GET['table'])?$_GET['table']:'';
	$id=!empty($_GET['id'])?$_GET['id']:'';
	$array = detailsData($table,$id);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>详情页</title>
	<style>
		th,td{
			text-align: center;
		}
		td p {
			width:200px;
			height:60px;
			text-align:left;
			font-size:14px;
			margin:0 auto;
			overflow:hidden;
			text-overflow:ellipsis;
			display:-webkit-box;
			-webkit-box-orient:vertical;
			-webkit-line-clamp:3;
		}
		a{
			color:#333;
			font-size:12px;
		}
	</style>
</head>
<body>
	<table align="center" width="400" border="1" cellpadding="10" cellspacing="0">
		<thead>
			<th colspan="2">详情页</th>
		</thead>
		<tr>
			<td>姓名:</td>
			<td><?php echo $array['UserName'] ?></td>
		</tr>
		<tr>
			<td>性别:</td>
			<td><?php echo $array['UserSex'] ?></td>
		</tr>
		<tr>
			<td>电话/手机号:</td>
			<td><?php echo $array['UserTel'] ?></td>
		</tr>
		<tr>
			<td style="text-align:right;" colspan="2"><a href="MessList.php">点击跳转到列表页</a></td>
		</tr>
	</table>
</body>
</html>