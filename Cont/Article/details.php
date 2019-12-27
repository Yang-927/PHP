<?php 
	require './curd.php';
	$link = connect();
	$table=!empty($_GET['table'])?$_GET['table']:'';
	$id=!empty($_GET['id'])?$_GET['id']:'';
	// $array = detailsData($table,$id);
	$array = getDetails($id);
	var_dump($array);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
			<td>标题:</td>
			<td><?php echo $array['Title'] ?></td>
		</tr>
		<tr>
			<td>作者:</td>
			<td><?php echo $array['Author'] ?></td>
		</tr>
		<tr>
			<td>内容:</td>
			<td><p><?php echo $array['Cont'] ?></p></td>
		</tr>
		<tr>
			<td>类别:</td>
			<td><?php echo $array['Sort']; ?></td>
		</tr>
		<tr>
			<td style="text-align:right;" colspan="2"><a href="BooksList.php">点击跳转到列表页</a></td>
		</tr>
	</table>
</body>
</html>