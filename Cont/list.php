<?php 
	header("content-type:text/html;charset=UTF8");
	// 数据库连接
	$link = mysqli_connect('127.0.0.1','root','root');
	// 选择数据库
	mysqli_select_db($link,'myself');
	// 设置字符集
	mysqli_set_charset($link,'UTF8');
	// 查询
	$sql = "SELECT * FROM register";
	// 执行sql
	$res = mysqli_query($link,$sql);
	// 获取结果集
	while ($row = mysqli_fetch_assoc($res)) {
		$array[] = $row;
	}
	// var_dump($array);

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>用户列表</title>
 	<style>
 		/*a{
 			text-decoration:none;
 			color:#333;
 		}*/
 		th,td{
 			text-align: center;

 		}
 	</style>
 </head>
 <body>
 	<table width="600" align="center" border="1" cellspacing="0" cellpadding="5">
 		<thead>
 			<th colspan="4" style="font-size:22px;">用户注册信息表</th>
 		</thead>
 		<tr>
 			<th>序列号</th>
 			<th>用户名</th>
 			<th>注册时间</th>
 			<th>操作</th>
 		</tr>
 		<?php 
 			foreach ($array as $key => $value) { ?>
 				<tr>
		 			<td><?php echo $value['id']; ?></td>
		 			<td><?php echo $value['UserName']; ?></td>
		 			<td><?php echo $value['Time']; ?></td>
		 			<td>
		 				<a href="./To_update.php?id=<?php echo $value['id'];?>">修改</a>
		 				<a href="./delete.php?id=<?php echo $value['id'];?>">删除</a>
		 			</td>
		 		</tr>
 		<?php } ?>
 	</table>
 </body>
 </html>