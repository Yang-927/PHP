<?php 
	header("content-type:text/html;charset=UTF8");

	require './curd.php';

	$table=!empty($_GET['table'])?$_GET['table']:'';

	$id=!empty($_GET['id'])?$_GET['id']:'';
	echo "$id";
	$array = getUpdateData($table,$id);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>数据修改页</title>
	<style>
		a{
			color:#333;
			font-size:12px;
		}
		th,td{
			text-align: center;
		}
		th{
			font-size:18px;
		}
		.inputBox{
			width:250px;
			height:30px;
			margin:0 auto;
			border:1px solid #333;
			border-radius:5px;
			overflow:hidden;
		}
		.inputText{
			width:250px;
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
			background:rgba(0,0,0,0);
			font-size:16px;
		}
		.imgBox{
			width:250px;
			height:30px;
			margin:0 auto;
			overflow:hidden;
		}
		.inputBox input{
			width:248px;
			height:28px;
			font-size:16px;
			padding:0;
			margin:0;
			padding-left:10px;
			outline:none;
			border:none;
			background:rgba(0,0,0,0);
		}
		form{
			padding:30px;
			border:2px solid #333;
		}
		input[type="submit"]{
			width:60px;
			height:30px;
			background:#000;
			border:none;
			color:#fff;
		}
		input[type="file"]{
			background:rgba(0,0,0,0);
			outline:none;
		}
	</style>
</head>
<body>
	<form action="./curd.php?act=update&table=article&id=<?php echo $array['id'] ?>" method="POST" enctype="multipart/form-data">
		<table align="center" height="400" width="400" border="0" cellspacing="0" cellpadding="10">
			<thead>
				<th colspan="2">文章修改</th>
			</thead>
			<tr>
				<td>标题:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="title" value="<?php echo $array['title'] ?>">
					</div>
				</td>
			</tr>
			<tr>
				<td>内容:</td>
				<td>
					<div class="inputText">
						<textarea name="content" cols="30" rows="10">
							<?php echo $array['content'] ?>
						</textarea>
					</div>
				</td>
			</tr>
			<tr>
				<td>作者:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="author"  value="<?php echo $array['author'] ?>">
					</div>
				</td>
			</tr>
			<tr>
				<td>配图:</td>
				<td>
					<div class="imgBox">
						<input type="file" name="image">
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
					<a href="list.php">跳转到文章列表</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>