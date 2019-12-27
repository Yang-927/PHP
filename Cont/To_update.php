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
	$sql = "SELECT id,UserName from register where id=$id limit 1";
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
			text-align:center;
		}
		.inputBox{
			width:200px;
			height:30px;
			border:1px solid #333;
			border-radius:5px;
			overflow:hidden;
		}
		.inputBox input{
			width:190px;
			height:30px;
			font-size:16px;
			padding:0;
			margin:0;
			padding-left:10px;
			outline:none;
			border:none;
			background:rgba(0,0,0,0.3);
		}
	</style>
</head>
<body>
	<form action="update.php" method="post">
		<input type="hidden" name="id" value="<?php echo $array['id']; ?>">
		<table align="center" border="0" cellspacing="0" cellpadding="10">
			<thead>
				<th colspan="2">修改</th>
			</thead>
			<tr>
				<td>用户名:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="UserName" value="<?php echo $array['UserName'] ?>">
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>