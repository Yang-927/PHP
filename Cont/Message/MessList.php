<?php 
	header("content-type:text/html;charset=UTF8");

	require './cont.php';
	$link = connect();
	$table = "message";

	$array = getList($link,$table);
	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>信息</title>
	<style>
		.operation a{
			display:inline-block;
			background: #333;
			font-size:14px;
			text-decoration:none;
			width:40px;
			height:20px;
			color:#fff;
		}
		th,td{
			text-align:center;
		}
		td p {
			width:200px;
			height:40px;
			line-height:40px;
			text-align:left;
			font-size:14px;
			margin:0 auto;
			overflow:hidden;
			text-overflow:ellipsis;
			display:-webkit-box;
			-webkit-box-orient:vertical;
			-webkit-line-clamp:1;
		}
		.Title{
			width:200px;
			height:40px;
			line-height:40px;
			text-align:center;
			font-size:16px;
			margin:0 auto;
			overflow:hidden;
			text-overflow:ellipsis;
			display:-webkit-box;
			-webkit-box-orient:vertical;
			-webkit-line-clamp:1;
		}
		.addBtn{
			display: block;
			width:60px;
			height:30px;
			background: #333;
			color:#fff;
			line-height:30px;
			margin:0 auto;
		}
	</style>
</head>
<body>
	<table width="1050" align="center" border="1" cellspacing="0" cellpadding="5">
 		<thead>
 			<th colspan="6" style="font-size:22px;">信息</th>
 		</thead>
 		<tr>
 			<th>序列号</th>
 			<th>姓名</th>
 			<th>性别</th>
 			<th>电话/手机号</th>
 			<th>添加时间</th>
 			<th>操作</th>
 		</tr>
 		<?php foreach ($array as $key => $value) { ?>
 				<tr>
		 			<td><?php echo $value['id']; ?></td>
		 			<td><?php echo $value['UserName']; ?></td>
		 			<td><?php echo $value['UserSex']; ?></td>
		 			<td><?php echo $value['UserTel']; ?></td>
		 			<td><?php echo $value['Time']; ?></td>
		 			<td class="operation">
		 				<a href="./details.php?act=details&table=message&id=<?php echo $value['id'];?>">详情</a>
		 				<a href="./update.php?table=message&id=<?php echo $value['id'];?>">修改</a>
		 				<a href="./cont.php?act=del&table=message&id=<?php echo $value['id'];?>">删除</a>
		 			</td>
		 		</tr>
 		<?php } ?>
 		<tr>
 			<td colspan="6">
 				<a class="addBtn" href="./addition.php">添加</a>
 			</td>
 		</tr>
 	</table>
</body>
</html>