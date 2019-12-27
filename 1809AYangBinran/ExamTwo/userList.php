<?php 
	header("content-type:text/html;charset=UTF8");
	
	//数据库操作 
	$link = mysqli_connect("127.0.0.1","root","root");

	mysqli_select_db($link,"test");

	mysqli_set_charset($link,'UTF8');

	$sql = "SELECT * FROM users";

	$res = mysqli_query($link,$sql);

	while ($row = mysqli_fetch_assoc($res)) {
		$array[] = $row;
	}

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
 		</tr>
 		<?php 
 			foreach ($array as $key => $value) { ?>
 				<tr>
		 			<td><?php echo $value['id']; ?></td>
		 			<td><?php echo $value['user_name']; ?></td>
		 		</tr>
 		<?php } ?>
 	</table>
 </body>
 </html>