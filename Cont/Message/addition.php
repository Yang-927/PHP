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
		input[type="submit"]{
			width:60px;
			height:30px;
		}
	</style>
</head>
<body>
	<form action="./cont.php?act=add&table=message" method="post">
		<table align="center" width="400" border="0" cellspacing="0" cellpadding="10">
			<thead>
				<th colspan="2">信息</th>
			</thead>
			<tr>
				<td>姓名:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="UserName">
					</div>
				</td>
			</tr>
			<tr>
				<td>性别:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="UserSex">
					</div>
				</td>
			</tr>
			<tr>
				<td>电话:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="UserTel">
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
					<a href="MessList.php">跳转到文章列表</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>