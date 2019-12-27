<?php 
	header("content-type:text/html;charset=UTF8");
	// 连接数据库
	$link = mysqli_connect('127.0.0.1','root','root');
	// 选择数据库
	mysqli_select_db($link,"myself");
	// 设置字符集
	mysqli_set_charset($link,"UTF8");
	// 查询
	$sql = "SELECT *FROM books";
	// 执行
	$res = mysqli_query($link,$sql);
	// 获取结果集
	while ($row = mysqli_fetch_assoc($res)) {
		$array[] = $row;
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文章列表</title>
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
			text-align:left;
			font-size:14px;
			margin:0 auto;
			overflow:hidden;
			text-overflow:ellipsis;
			display:-webkit-box;
			-webkit-box-orient:vertical;
			-webkit-line-clamp:2;
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
		td > img{
			width:150px;
			height:80px;
		}
	</style>
</head>
<body>
	<table width="1050" align="center" border="1" cellspacing="0" cellpadding="5">
 		<thead>
 			<th colspan="7" style="font-size:22px;">文章信息列表</th>
 		</thead>
 		<tr>
 			<th>序列号</th>
 			<th>标题</th>
 			<th>封面</th>
 			<th>作者</th>
 			<th>内容</th>
 			<th>首次添加时间</th>
 			<th>操作</th>
 		</tr>
 		<?php 
 			if(!$array){
 				echo "<script>
					alert('列表为空,请添加')
					location.href = 'addition.html'
 				</script>";
 			}
 			foreach ($array as $key => $value) { ?>
 				<tr>
		 			<td><?php echo $value['id']; ?></td>
		 			<td><p class="Title"><?php echo $value['Title']; ?></p></td>
		 			<td><img src="<?php echo $value['Img']; ?>" alt=""></td>
		 			<td><?php echo $value['Author']; ?></td>
		 			<td><p><?php echo $value['Cont']; ?></p></td>
		 			<td><?php echo $value['Time']; ?></td>
		 			<td class="operation">
		 				<a href="./details.php?id=<?php echo $value['id'];?>">详情</a>
		 				<a href="./To_update.php?id=<?php echo $value['id'];?>">修改</a>
		 				<a href="./delete.php?id=<?php echo $value['id'];?>">删除</a>
		 			</td>
		 		</tr>
 		<?php } ?>
 		<tr>
 			<td colspan="7">
 				<a class="addBtn" href="addition.html">添加</a>
 			</td>
 		</tr>
 	</table>
</body>
</html>