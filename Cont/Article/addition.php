<?php 
	header("content-type:text/html;charset=UTF8");
	require './curd.php';
	$getSort = getSortData();
	var_dump($getSort);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加</title>
	<style>
		a{
			color:#333;
			font-size:12px;
		}
		th,td{
			text-align: center;
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
			background:rgba(0,0,0,0.3);
			font-size:16px;
		}
		.inputBox input{
			width:240px;
			height:30px;
			font-size:16px;
			padding:0;
			margin:0;
			padding-left:10px;
			outline:none;
			border:none;
			background:rgba(0,0,0,0.3);
		}
		.box{
			text-align:left;
			width:250px;
			height:30px;
			margin:0 auto;
			line-height:30px;
			overflow:hidden;
		}
		.box select{
			width:250px;
			height:28px;
			border:1px solid #333;
			outline:none;
			background:rgba(0,0,0,0.3);
		}
		input[type="submit"]{
			width:60px;
			height:30px;
		}
	</style>
</head>
<body>
	<form action="./curd.php?act=add&table=article" method="post">
		<table align="center" width="400" border="0" cellspacing="0" cellpadding="10">
			<thead>
				<th colspan="2">文章管理系统</th>
			</thead>
			<tr>
				<td>标题:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="Title">
					</div>
				</td>
			</tr>
			<tr>
				<td>作者:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="Author">
					</div>
				</td>
			</tr>
			<tr>
				<td>内容:</td>
				<td>
					<div class="inputText">
						<textarea name="Cont" cols="30" rows="10"></textarea>
					</div>
				</td>
			</tr>
			<tr>
				<td>类别:</td>
				<td>
					<div class="box">
						<select name="Sort" id="">
							<?php foreach ($getSort as $key => $value) { ?>
								<option value="<?php echo $value['id']; ?>"><?php echo $value['Sort']; ?></option>
							<?php } ?>
						</select>
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