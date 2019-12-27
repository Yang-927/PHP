<?php 
	require './curd.php';
	$link = connect();
	$table=!empty($_GET['table'])?$_GET['table']:'';
	$id=!empty($_GET['id'])?$_GET['id']:'';
	$array = getUpdateData($table,$id);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		a{
			color:#333;
			font-size:12px;
		}
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
	<form action="./curd.php?act=update&table=article&id=<?php echo $array['id']; ?>" method="POST">
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
			<tr>
				<td colspan="2" style="text-align:right;">
					<a href="BooksList.php">跳转到文章列表</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>