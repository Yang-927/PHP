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
		.inputText{
			width:194px;
			height:100px;
			padding:3px;
			margin:0 auto;
			border:1px solid #333;
			border-radius:5px;
			overflow:hidden;
		}
		textarea{
			width:100%;
			height:100%;
			border:0;
			padding:0;
			resize:none;
			background:rgba(0,0,0,0.3);
			font-size:16px;
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
				<td>标题:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="Title" value="<?php echo $array['Title'] ?>">
					</div>
				</td>
			</tr>
			<tr>
				<td>作者:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="Author" value="<?php echo $array['Author'] ?>">
					</div>
				</td>
			</tr>
			<tr>
				<td>内容:</td>
				<td>
					<div class="inputText">
						<textarea name="Cont" value=""><?php echo $array['Cont'] ?></textarea>
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