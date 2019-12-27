<?php 
	require './cont.php';
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
	</style>
</head>
<body>
	<form action="./cont.php?act=update&table=message&id=<?php echo $array['id']; ?>" method="POST">
		<input type="hidden" name="id" value="<?php echo $array['id']; ?>">
		<table align="center" border="0" cellspacing="0" cellpadding="10">
			<thead>
				<th colspan="2">修改</th>
			</thead>
			<tr>
				<td>姓名:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="UserName" value="<?php echo $array['UserName'] ?>">
					</div>
				</td>
			</tr>
			<tr>
				<td>性别:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="UserSex" value="<?php echo $array['UserSex'] ?>">
					</div>
				</td>
			</tr>
			<tr>
				<td>电话/手机号:</td>
				<td>
					<div class="inputBox">
						<input type="text" name="UserTel" value="<?php echo $array['UserTel'] ?>">
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
					<a href="MessList.php">跳转到信息列表</a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>