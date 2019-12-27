<?php 
	header("content-type:text/html;charset=UTF8");
	$id = $_GET['id'];
	// 数据库连接
	$link = mysqli_connect('127.0.0.1','root','root');
	// 选择数据库
	mysqli_select_db($link,'myself');
	// 设置字符集
	mysqli_set_charset($link,'UTF8');
	// 查询
	$sql = "SELECT * from books where id=$id";
	// 执行sql
	$res = mysqli_query($link,$sql);
	// 获取结果集
	$array = mysqli_fetch_array($res);
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
			<td style="text-align:right;" colspan="2"><a href="BooksList.php">点击跳转到列表页</a></td>
		</tr>
	</table>
</body>
</html>